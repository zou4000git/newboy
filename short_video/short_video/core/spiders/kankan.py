# _*_ coding=utf8 _*_

import scrapy, datetime, re, logging, traceback, json
from time import time

from core.search_tools import SearchBaiduHotWordTool

# 这里可以设置搜索结果的开始时间，如果为0，那就是不进行开始时间过滤，格式是用秒数表示的时间
# START_TIME = int(time()) - 24 * 60 * 60 * 2 # 这样就是两天内的数据
START_TIME = 0

# 这里设置翻页到的最早时间，超过这个时间就不继续翻页

FILTER_TIME = int(time()) - 24 * 60 * 60 * 365


class kankan(scrapy.Spider):
    name = "kankan"
    allowed_domains = ['kankanews.com']

    templates = [
        # 注意都有一个%s
        # 用于生成spider的访问链接
        # 填充的都是timestamp
        'http://baoliao.api.kankanews.com/kkuser/listinfo/list/appclassid/617/timestamp/%s?androidver=5.2.6',  # 视频
        # 精选
        'http://baoliao.api.kankanews.com/kkuser/listinfo/list/appclassid/618/timestamp/%s?androidver=5.2.6'  # 深度
    ]

    # http://api.app.kankanews.com/kankan/v5/kkappsearchv2?word==%E5%B3%B0%E4%BC%9A&type=all&page=1&size=20&stime=0&etime=1528976369
    def start_requests(self):
        # app或者web scroll接口（两个平台一致）
        # 接口标准约定第一次请求timestamp是0
        # 滚动接口
        for template in self.templates:
            yield self.getNextScrollRequest(template, 0)
        # 精选页毛病比较多，所以不用0，用当前时间戳
        yield self.getNextScrollRequest(
            'http://api.app.kankanews.com/kankan/v5/KKAppList/command/indexv4/appclassid/1/timestamp/%s/androidver/5.2.6',
            int(time()))
        # app 搜索接口
        self.SEARCH_TOOL = SearchBaiduHotWordTool()
        while True:
            search_req = self.getNextKeyWordRequest()
            if search_req:
                yield search_req
            else:
                break

    def getNextKeyWordRequest(self):
        keyword = self.SEARCH_TOOL.next()
        if keyword:
            return self.getSearchRequest(keyword, 0)
        else:
            return None

    def getSearchRequest(self, keyword, pageNum):
        return scrapy.Request(
            url='http://api.app.kankanews.com/kankan/v5/kkappsearchv2?word=%s&type=video&page=%d&size=20&stime=%d&etime=%d' % (
                keyword, pageNum, START_TIME, int(time())),
            callback=self.parseSearchPage, meta={
                'keyword': keyword,
                'pageNum': pageNum
            }, dont_filter=True)

    def parseSearchPage(self, response):
        data = json.loads(response.body)
        if data['err_code'] == 403:
            return
            # parse json and save
        for video in data['list']:
            item = self.parseVideoProcess(video)
            if not item:
                continue
            elif isinstance(item, dict):
                yield item
            elif isinstance(item, str) and item == 'break':
                # todo: 后期不需要全量建立的时候，根据日期来判定终止条件，在parseVideoProcess里返回
                break

        # next page
        pageNum = response.meta['pageNum'] + 1
        keyword = response.meta['keyword']
        yield self.getSearchRequest(keyword, pageNum)

    def parseVideoProcess(self, video):
        if video.get('type') != 'video' and video.get('videourl') == '':
            # ps 有的text类型也有视频
            return None
        filelength = video.get('filelength').replace("''", '')
        if "'" in filelength:
            times_array = filelength.split("'")
            length = int(times_array[0]) * 6 + int(times_array[1])
        else:
            length = int(filelength)
        item = {
            'type_' : 'video',
            'title': video['title'],
            'url': video['titleurl'].replace('\\', ''),
            'duration': length,
            'img': video['titlepic'].replace('\\', ''),
            'pub_time': datetime.datetime.strptime(video['newsdate'], '%Y-%m-%d'),
            'source': 'kankan',
            'type_': 'video',
            'description': video.get('intro', ''),
            'newstime': video.get('newstime', 0)
        }
        print str(item['title'])
        return item

    # ***看看页卡接口翻页规则全记录***
    # 1) 如果某一页获取的item数少于21，那么为最后一页
    # 2） glabalID=617 视频
    # 3） timestamp第一次为0，后面每次用最后一个item的newstime去更新timestamp留着下次用

    def getNextScrollRequest(self, template, timestamp):
        return scrapy.Request(
            url=template % str(timestamp), callback=self.parseScrollPage, meta={'template': template})

    def parseScrollPage(self, response):
        data = json.loads(response.body)
        video_list = None
        if data.get('intro') != '精选':
            video_list = data.get('list')  # normal formation
        else:
            # 精选接口的奇葩设计
            video_list = []
            for i in data.get('list', []):
                for j in i.get('list', []):
                    video_list.append(j)
        data = video_list
        size = len(data)
        timestamp = 0
        for video in data:
            item = self.parseVideoProcess(video)
            if isinstance(item, dict):
                timestamp = item.get('newstime')
                yield item
            size += 1
        if timestamp != 0 and timestamp > FILTER_TIME:
            yield self.getNextScrollRequest(response.meta['template'], timestamp)
