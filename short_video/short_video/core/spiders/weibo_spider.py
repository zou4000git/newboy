# _*_ coding=utf8 _*_
import scrapy
import random
import time
import datetime
from core.search_tools import SearchBaiduHotWordTool
import logging
import traceback
import re
from urllib import quote
import json

class WeiboSpider(scrapy.Spider):
    num_of_keywrod = 58440
    current_idx_of_keyword = 0
    name = "weibo"
    allowed_domains = ["m.weibo.cn"]

    def __init__(self, name=None, **kwargs):
        self.current_idx_of_keyword = 0
        super(WeiboSpider,self).__init__()

    def start_requests(self):
        keyword_pages = []
        self.keyword_tool = SearchBaiduHotWordTool()
        keyword = self.keyword_tool.next()
        page = 1
        while keyword is not None:
            self.current_idx_of_keyword += 1
            url = self.packRequestUrl(keyword, page)
            keyword_page = scrapy.Request(url, meta={"keyword": keyword, "page": page})
            keyword_pages.append(keyword_page)
            keyword = self.keyword_tool.next()
            time.sleep(10)
            #if self.current_idx_of_keyword > 0:
            #    break
        return keyword_pages

    def packRequestUrl(self, keyword, page):
        container_id = quote("100103type=71&q=" + keyword)
        title = quote("全部视频-" + keyword)
        ext_param = quote("title=全部视频")
        lfid = quote("100103type=64&q=" + keyword + "&t=0")
        return "https://m.weibo.cn/api/container/getIndex?containerid=" + container_id + "&title=" + title + "&extparam="+ ext_param + "&luicode=10000011&lfid=" + lfid + "&page=" + str(page)

    def parse(self, response):
        try:
            keyword = response.meta['keyword']
            res = json.loads(response.body)
            if len(res['data']['cards']) == 0:
                print keyword, ' ',response.url,' has no data'
                return
            print keyword, ' page is : ', res['data']['cardlistInfo']['page'], '. has ',res['data']['cardlistInfo']['total'], ' total videos'
            blog_list = res['data']['cards'][0]['card_group']
            for blog in blog_list:
                tag_pattern = re.compile(r'<[^>]+>',re.S)
                blog_text = tag_pattern.sub('',blog['mblog']['text'])
                print blog_text.encode('utf-8'), blog['mblog']['created_at'].encode('utf-8')
                item = {}
                item['type_'] = 'video'
                item["title"] = blog_text.encode('utf-8')
                if "page_info" in blog['mblog']:
                    item['img'] = blog['mblog']['page_info']['page_pic']['url']
                    item['url'] = blog['mblog']['page_info']['page_url']
                else:
                    item['img'] = ''
                    item['url'] = "https://m.weibo.cn/status/" + str(blog['mblog']['id'])
                item["pub_time"] = blog['mblog']['created_at']
                item["description"] = blog_text.encode('utf-8')
                item["author"] = blog['mblog']['user']['screen_name']
                item['cp_id'] = blog['mblog']['user']['id']
                item["source"] = 'weibo'
                item["play_count"] = blog['mblog'].get("obj_ext",0)
                item["like"] = blog['mblog']['attitudes_count']
                item["comment"] = blog['mblog']['comments_count']
                item["share"] = blog['mblog']['reposts_count']
                yield item
            extra_urls = ""
            if res['data']['cardlistInfo']['page'] is not None:
                current_page = self.extract_page_from_url(response.url)
                next_page = res['data']['cardlistInfo']['page']
                # if int(next_page) <= current_page:
                #     next_page = current_page + 1
                extra_urls = self.extra_urls_to_scrapy(keyword, next_page)
                if extra_urls:
                    for url in extra_urls:
                        yield scrapy.Request(url, callback=self.parse, meta={"keyword":keyword})

        except Exception, e:
            logging.error(e.message + " " + traceback.format_exc())

    def extra_urls_to_scrapy(self, keyword, page):
        url = self.build_next_page_url(keyword, page)
        return [url]

    def extract_page_from_url(self,url):
        return int(url.split('page=',1)[1])
    def build_next_page_url(self, keyword, page):
        return self.packRequestUrl(keyword, page)

