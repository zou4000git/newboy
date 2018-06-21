# _*_ coding=utf8 _*_
# CCTV LEADERS
import scrapy
import re
from core.common_spider_tools import *
import logging
INDEX_ALL = True


# 开会好像说了这个东西不用怎么跑，，反正都写了，姑且留着后用
class cntv_leader_video_spider(scrapy.Spider):
    name = "cntv_leader"
    allowed_domains = ['cntv.cn', 'cctv.com']

    def start_requests(self):
        logging.info("START " + self.name)
        yield scrapy.Request(url="http://politics.cntv.cn/leaders/zgzyldr/index.shtml", callback=self.parseLeaderMenu)
        yield scrapy.Request(url='http://politics.cntv.cn/leaders/gjldr/index.shtml', callback=self.parseLeaderMenu)
        yield scrapy.Request(url='http://politics.cntv.cn/leaders/dfldr/index.shtml', callback=self.parseLeaderMenu)

    def parseLeaderMenu(self, response):
        links = response.css('a[target="_blank"]::attr(href)')
        for link in links:
            if 'http://politics.cntv.cn/leaders/person/' in link.extract():
                yield scrapy.Request(url=link.extract(), callback=self.parseLeader)

    def parseLeader(self, response):
        """遍历每位领导人的所有新闻"""
        # 由于对于领导人A而言,所有的视频基本信息都存放在<script> varobjcon=[]中
        # 所以不需要进行翻页
        # 第一次全量入库之后以后每天只关注当日即可
        body = response.body
        pattern = re.compile('\{"url": "(.*)","title": "(.*)","image": "(.*)","date": "(.*)"\}')
        it = re.finditer(pattern, string=body)
        yesterday = getYesterday()
        for match in it:
            meta = dict()
            meta['url'] = match.group(1)
            meta['title'] = match.group(2)
            meta['img'] = match.group(3)
            meta['pub_time'] = datetime.datetime.strptime(match.group(4), '%Y-%m-%d')
            if 'cctv.com' not in meta['url']:
                # 这里一套cntv的特殊解析规则
                # 参见 http://tv.cntv.cn/video/C10420/d24159ccac164dbc80f415681bdaf118
                continue
            if INDEX_ALL:
                yield scrapy.Request(url=meta['url'], callback=self.parseVideo, meta=meta)
            else:
                if meta['pub_time'] > yesterday:
                    # new video
                    yield scrapy.Request(url=meta['url'], callback=self.parseVideo, meta=meta)

    def parseVideo(self, response):
        """一个单独的video&news 页面"""
        item = dict()
        item['type_'] = 'video'
        item['source'] = 'cntv'
        item['url'] = response.url
        item['img'] = response.meta['img']
        item['title'] = response.meta['title']
        item['pub_time'] = self.getDatetime(response)
        item['cp_name'] = response.css('p.info i::text')[0].extract()
        LONG_TEXT = re.sub('<.*?>', '',
                           response.css('div.cnt_bd')[0].extract())
        item['duration'] = 0
        item['like'] = 0
        item['tag'] = ''
        item['cp_id'] = ''
        print str(item['title'])
        # todo:
        yield item

    def getDatetime(self, response):
        try:
            info = response.css('p.info')[0].extract()
            date_str_array = re.findall(pattern='\d{4}年\d{2}月\d{2}日 \d{2}:\d{2}', string=info)
            date_str = date_str_array[0]
            return datetime.datetime.strptime(date_str, "%Y年%m月%d日 %H:%M")
        except Exception:
            return response.meta['pub_time']
