# _*_ coding=utf8 _*_
import scrapy
import random
import datetime
import logging
import traceback

from core.search_tools import SearchBaiduHotWordTool
from core.common_spider_tools import shutdown, isOld

SEARCH_PERCENT = False  # True 搜索百分号 False 搜索热点词


# 注意,搜索百分号会在某些页之后无论如何翻页得到的都是相同的内容

class search_web_pear_video_spider(scrapy.Spider):
    current_idx_of_keyword = 0
    name = "pear_web_search"
    allowed_domains = ["pearvideo.com"]

    def start_requests(self):
        logging.info("START " + self.name)
        print 'current　search pattern is ' + ("%" if SEARCH_PERCENT else "keyword")
        self.SEARCH_TOOL = SearchBaiduHotWordTool()
        if SEARCH_PERCENT:
            yield scrapy.Request(url="http://www.pearvideo.com/search.jsp?start=0&k=%25",
                                 callback=self.parse, meta={'keyword': "%25"})
        else:
            while True:
                search_req = self.nextKeyWordRequest()
                if search_req:
                    yield search_req
                else:
                    break

    def parse(self, response):
        """搜索首页"""
        try:
            # 首次获取总数目
            keyword = response.meta['keyword']
            if response.css('div.no-result'):
                # yield self.nextKeyWordRequest()
                return
            total = int(response.css('div.search-result-num > span::text')[0].extract())
            print "keyword %s total %d" % (keyword, total)
            # 记录一下当前关键字的搜索结果数
            keyword_item = dict()
            keyword_item['type_'] = 'keyword'
            keyword_item['word'] = keyword
            keyword_item['num'] = total
            yield keyword_item

            if total > 0:
                yield scrapy.Request("http://www.pearvideo.com/search_loading.jsp?start=0"
                                     + "&k=" + keyword + "&sort=first_publish_time",
                                     meta={'current': 0, 'total': total,
                                           'keyword': keyword},
                                     callback=self.parse_loading_list)
            # else:
            #     yield self.nextKeyWordRequest()
        except Exception, e:
            logging.error(e.message + " " + traceback.format_exc())

    def parse_loading_list(self, response):
        """aysnc loading xhr page in partical html"""
        try:
            for li in response.css('li.result-list'):
                tt = li.css('h2.tt::text')[0].extract()
                logging.info("%d %s %s" % (response.meta['current'], str(response.meta['keyword']), str(tt)))
                news = self.getItemFromLi(li)
                yield news
                cp = self.getCpFromLi(li)
                yield cp
                if isOld(news['pub_time']):
                    print 'old data,time to say goodbye now,next key word'
                    return
        except Exception, e:
            logging.error(e.message + " " + traceback.format_exc())
        # 翻页
        cur = response.meta['current']
        cur += 10
        total = response.meta['total']
        if cur < total:
            yield scrapy.Request(
                'http://www.pearvideo.com/search_loading.jsp?start=' + str(cur) + '&k=' + response.meta[
                    'keyword'] + "&sort=first_publish_time"
                , meta={'current': cur,
                        'total': total,
                        'keyword': response.meta['keyword']
                        },
                callback=self.parse_loading_list)

    def nextKeyWordRequest(self):
        """更改新的搜索条件,重置页码"""
        searchWorld = self.getNextSearchWord()
        if searchWorld:
            return scrapy.Request(url="http://www.pearvideo.com/search.jsp?start=0&k=%s" % searchWorld,
                                  callback=self.parse, meta={'keyword': searchWorld})
        else:
            return False

    def getItemFromLi(self, li):
        item = {}
        item['type_'] = 'video'
        item['source'] = 'pearvideo'
        item['url'] = "http://www.pearvideo.com/" + li.css('div.list-left>a::attr(href)')[0].extract()
        item['img'] = li.css('div.list-left>a>img::attr(src)')[0].extract()
        item['title'] = li.css('div.list-left>a>img::attr(alt)')[0].extract()
        datestr = li.css('div.publish-time::text')[0].extract()[3:]
        item['pub_time'] = datetime.datetime.strptime(datestr, '%Y-%m-%d')
        item['description'] = li.css('div.cont::text')[0].extract()
        item['like'] = li.css('span.i-icon.like-num::text')[0].extract()
        item['cp_id'] = self.getCpIdFromLi(li)
        item['cp_name'] = self.getCpNameFromLi(li)
        return item

    def getCpFromLi(self, li):
        item = {}
        item['type_'] = 'cp'
        item['source'] = 'pearvideo'
        item['cp_id'] = self.getCpIdFromLi(li)
        item['cp_name'] = self.getCpNameFromLi(li)
        item['url'] = "https://www.pearvideo.com/%s" % item['cp_id']
        return item

    def getCpIdFromLi(self, li):
        return li.css('a.i-icon.col-name::attr(href)')[0].extract()

    def getCpNameFromLi(self, li):
        return li.css('a.i-icon.col-name::text')[0].extract()

    def getNextSearchWord(self):
        wd = self.SEARCH_TOOL.next()
        if wd:
            return wd
        else:
            shutdown("搜索词遍历完毕")

    def getNextLocalSearchWord(self):
        '''just for local test while u cannot connect to product server'''
        temp_searchword_list = ("折木奉", "中南", "烟台", "中国", "腾讯", "QQ")
        return random.choice(temp_searchword_list)
