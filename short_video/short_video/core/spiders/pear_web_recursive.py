# _*_ coding=utf8 _*_
import scrapy
from util.MysqlUtil import MysqlUtil
import datetime
import logging

# 递归次数有待商榷
MAX_DEPTH = 5

BASE_URL = "http://www.pearvideo.com/"


class pear_video_spider(scrapy.Spider):
    """获取一下主页的所有链接,从此出发不断递归 MAX_DEPTH 次"""

    name = "pear"
    allowed_domains = ["pearvideo.com"]

    def start_requests(self):
        logging.info("START " + self.name)
        yield scrapy.Request(url="http://www.pearvideo.com/", callback=self.parse_homepage)

    def parse_homepage(self, response):
        hrefs = response.css('a[href^="video_"]::attr(href)')
        for href in hrefs:
            yield scrapy.Request(url=BASE_URL + href.extract(), callback=self.parse, meta={'depth': 1})

    def parse_cp(self, response):
        item = {}
        item['source'] = 'pearvideo'
        item['url'] = response.url
        item['img'] = response.css("div.column-logo>img::attr(src)")[0].extract()
        item['cp_id'] = response.url[response.url.rfind("/") + 1:]
        item['cp_name'] = response.css("div.column-logo>img::attr(src)")[0].extract()
        item['description'] = response.css("div.list-author-intro::text")[0].extract()
        item['type_'] = 'cp'
        yield item

    def parse(self, response):
        url = response.url
        title = response.css("h1.video-tt::text")
        if title:
            item = {}
            item['type_'] = 'video'
            item['source'] = 'pearvideo'
            item["title"] = title[0].extract().encode('utf-8')
            date = response.css("div.date::text")[0].extract().encode('utf-8')
            item['pub_time'] = datetime.datetime.strptime(date, "%Y-%m-%d %H:%M")
            item["description"] = response.css("div.summary::text")[0].extract().encode('utf-8')
            item["cp_name"] = response.css("div.col-name::text")[0].extract().encode('utf-8')
            item["url"] = url
            item['cp_id'] = response.css("div.thiscat>a::attr(href)")[0].extract()
            tags = response.css("span.tag::text")
            tags_str = ""
            for tag in tags:
                tags_str += tag.extract() + ","
            item['tag'] = tags_str
            item['like'] = response.css("div.fav::text")[0].extract()
            item['img'] = response.css("div#poster > img::attr(src)")[0].extract()
            print(item["title"])
            yield item
            cp_id = item['cp_id']
            if MysqlUtil.hasCp(cp_id, "pearvideo"):
                # already have the author,do not need to visit her homepage
                pass
            else:
                yield scrapy.Request("https://www.pearvideo.com/%s" % item['cp_id'], callback=self.parse_cp)

            # 递归深入相关视频
            depth = response.meta['depth']
            if depth > MAX_DEPTH:
                return
            hrefs = response.css('a[href^="video_"]::attr(href)')
            for href in hrefs:
                yield scrapy.Request(url=BASE_URL + href.extract(), callback=self.parse, meta={'depth': (depth + 1)})
