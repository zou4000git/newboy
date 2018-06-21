# _*_ coding=utf8 _*_
import scrapy
import datetime
import json
import re
import traceback
import logging
from core.common_spider_tools import isOld

MAX_DEPTH = 30


# todo: warning warning,新华网暂未找到合适的高效搜索入口
class xinhua_video_spider(scrapy.Spider):
    name = "xinhua_web"
    allowed_domains = ['xinhuanet.com', 'news.cn']

    def start_requests(self):
        logging.info("START " + self.name)
        # 首页(不翻页),进了详情页继续递归相关视频
        yield scrapy.Request("http://www.xinhuanet.com/video/index.htm", callback=self.parse_mess_page)
        # 资讯 纪实 军事 娱乐 体育 财经 搞笑(不翻页)
        categorys = ('news', 'jishi', 'mil', 'yule', 'sport', 'fortune', 'gx')
        for category in categorys:
            yield scrapy.Request("http://www.xinhuanet.com/video/%s.htm" % category, callback=self.parse)
        # # # 滚动(翻页,带时间判断)
        yield scrapy.Request(
            url="http://qc.wa.news.cn/nodeart/list?nid=11104135&pgnum=9&cnt=10&tp=1&orderby=1?callback=fuck",
            callback=self.parseLoadingPage)
        # 主主站首页
        yield scrapy.Request(url='http://www.xinhuanet.com/',
                             callback=self.parseMainHomepage)

    # 主站首页
    def parseMainHomepage(self, response):
        links = response.css('span.icon.icon1+a::attr(href)')
        for link in links:
            yield scrapy.Request(link.extract(), callback=self.parse_single_page, meta={'depth': 0})

    def parse_mess_page(self, response):
        """首页结构比较混乱,只提取特定的useful url就好"""
        ass = response.css('a::attr(href)')
        set_of_href = set()
        for a in ass:
            if "http://www.xinhuanet.com/video/2" in a.extract():
                set_of_href.add(a.extract())
        for href in set_of_href:
            yield scrapy.Request(href, callback=self.parse_single_page, meta={'depth': 0})

    def parse_single_page(self, response):
        item = dict()
        item['type_'] = 'video'
        item['source'] = 'xinhuavideo'
        item['title'] = response.meta.get('title', self.getTitle(response))
        item['url'] = response.url
        item['pub_time'] = self.getDatetime(response)
        item['cp_name'] = self.getAuthor(response)
        item['description'] = self.getDescription(response)
        item['img'] = response.meta.get('img')
        print str(item['title'])
        yield item
        if response.meta['depth'] > MAX_DEPTH:
            return
        metas = self.getRelatedVideoList(response)
        for meta in metas:
            meta['depth'] = response.meta['depth'] + 1
            yield scrapy.Request(meta['url'], callback=self.parse_single_page, meta=meta)

    def getRelatedVideoList(self, response):
        result = list()
        try:
            lis = response.css('div.playerbar_contain_scroll ul.imglist li')

            for li in lis:
                img_href = li.css('img::attr(src)')[0].extract()
                img_href = 'http://www.xinhuanet.com/video/' + img_href.replace('../../', '')
                d = {
                    'url': li.css('a::attr(href)')[1].extract(),
                    'img': img_href,
                    'title': li.css('img::attr(alt)')[0].extract()
                }
                result.append(d)
        except Exception, e:
            print "related video error ", e.message, " ", response.url
        finally:
            return result

    def getTitle(self, response):
        if response.css('div.crumbs h2::text'):
            return response.css('div.crumbs h2::text')[0].extract()
        elif response.css('div.h-news h-title::text'):
            return response.css('div.h-news h-title::text')[0].extract()
        else:
            return ""

    def getDatetime(self, response):
        if response.css('span#pubtime span::text'):
            date_text = response.css('span#pubtime span::text')[0].extract()
            return datetime.datetime.strptime(date_text.strip(), '%Y年%m月%d日 %H:%M:%S')
        elif response.css('span.h-time::text'):
            return datetime.datetime.strptime(response.css('span.h-time::text')[0].extract().strip(),
                                              "%Y-%m-%d %H:%M:%S")
        else:
            return datetime.datetime.now()

    def getDescription(self, response):
        if response.css('#p-detail::text'):
            description = ""
            for detail in response.css("#p-detail::text"):
                description += detail.extract()
            return description
        return ""

    def getAuthor(self, response):
        if response.css("div.videoInfo.domPC>span>span::text"):
            return response.css("div.videoInfo.domPC>span>span::text")[2].extract()
        elif response.css('span.p-jc::text'):
            return response.css("span.p-jc::text")[1].extract().strip()
        else:
            return ""

    def parse(self, response):
        for ol in response.css('ol.col3'):
            item = dict()
            item['type_'] = 'video'
            item['source'] = 'xinhuavideo'
            item['url'] = ol.css('a.srcLink::attr(href)')[0].extract()
            item['title'] = ol.css('p.title>a::text')[0].extract()
            item['img'] = ol.css('p.pics img::attr(src)')[0].extract()
            item['cp_name'] = ol.css('p.info>b::text')[0].extract()
            item['pub_time'] = datetime.datetime.strptime(
                ol.css('p.info>span::text')[0].extract(), '%Y-%m-%d %H:%M:%S')
            print str(item['title'])
            yield item

    def parseLoadingPage(self, response):
        """滚动加载页"""
        # xhr
        try:
            ori_str = response.body
            if ('"message":"无查询结果"' in ori_str) or ('{"status":"-1","message":"null"}' in ori_str):
                print " THE END -- 无查询结果"
                return
            else:
                json_str = ori_str[1:-1]
                json_obj = json.loads(json_str)
                iterator = json_obj['data']['list']
                if len(iterator) > 0:
                    for cont in iterator:
                        item = dict()
                        item['source'] = "xinhuavideo"
                        item['type_'] = 'video'
                        item['title'] = cont['Title']
                        item['url'] = cont['LinkUrl']
                        item['img'] = cont['PicLinks']
                        item['cp_name'] = cont['Editor']
                        item['pub_time'] = datetime.datetime.strptime(
                            cont['PubTime'], '%Y-%m-%d %H:%M:%S')
                        item['description'] = cont['m4v']
                        print str(item['title'])
                        yield item

                        if isOld(item['pub_time']):
                            # 如果新闻比较旧,那就不翻下一页了
                            return

        except Exception, e:
            print traceback.format_exc() + " " + e.message
            print str(response.body)
            return
        yield scrapy.Request(self.getNextUrl(response.url), self.parseLoadingPage)

    def getNextUrl(self, current_url):
        pattern = re.compile(r'.*(pgnum=([0-9]*)).*')
        matcher = re.match(string=current_url, pattern=pattern)
        if matcher:
            cur_page = int(matcher.group(2))
            next_page = cur_page + 1
            cur_page_str = matcher.group(1)
            next_page_str = 'pgnum=%d' % next_page
            return current_url.replace(cur_page_str, next_page_str)
        return ""
