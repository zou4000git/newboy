# _*_ coding=utf8 _*_
from scrapy.http import HtmlResponse
import scrapy
import random
from core.json_response_parser import build_json_response

# 酷燃视频接口 html_in_json
class KuranSpider(scrapy.Spider):
    name = 'kuran'
    allowed_domains = ["krcom.cn"]

    def __init__(self, name=None, **kwargs):
        self.current_idx_of_keyword = 0
        super(KuranSpider,self).__init__()

    def start_requests(self):
        pages = []
        random_token = str(random.random()).split('0.',1)[1]
        page = 1
        self.current_idx_of_keyword += 1
        url = "https://krcom.cn/aj/hot/loadingmore?ajwvr=6&cursor=60&YmdH=2018061518&__rnd=" + random_token
        page = scrapy.Request(url, meta={"page": page})
        pages.append(page)
        return pages

    def parse(self, response):
        json_response = build_json_response(response)

        body = ""
        if "data" in json_response:
            if "html" in json_response["data"]:
                body = json_response["data"]["html"]
        else:
            body = json_response["msg"]
        html_response = HtmlResponse(response.url, status=200, body=body, encoding="utf8")
        print html_response
        for item in self.do_parse(html_response):
            pass
            #yield item

    def do_parse(self, html_response):
        print html_response.xpath("//div[@class='V_list_a']/h3")
        return []