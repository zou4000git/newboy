# _*_ coding=utf8 _*_

import scrapy, datetime, re, logging, traceback, json
from time import time

from core.search_tools import SearchBaiduHotWordTool

# 这里可以设置搜索结果的开始时间，如果为0，那就是不进行开始时间过滤，格式是用秒数表示的时间
# START_TIME = int(time()) - 24 * 60 * 60 * 2 # 这样就是两天内的数据
START_TIME = 0


class kankan(scrapy.Spider):
    name = "kankan_app_search"
    allowed_domains = ['xinhuanet.com', 'news.cn']

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
        return self.getSearchRequest(keyword, 0)

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
            yield self.getNextKeyWordRequest()
            return
            # parse json and save
        for video in data['list']:
            if video['type'] != 'video':
                print 'not video'
                continue
            filelength = video['filelength']
            times_array = filelength.split("'")
            length = int(times_array[0]) * 6 + int(times_array[1])
            item = {
                'title': video['title'],
                'url': video['titleurl'].replace('\\', ''),
                'duration': length,
                'img': video['titlepic'].replace('\\', ''),
                'pub_time': datetime.datetime.strptime(video['newsdate'], '%Y-%m-%d'),
                'source': 'kankan',
                'type_': 'video'
            }
            print str(item['title'])
            yield item
        # next page
        pageNum = response.meta['pageNum'] + 1
        keyword = response.meta['keyword']
        yield self.getSearchRequest(keyword, pageNum)
