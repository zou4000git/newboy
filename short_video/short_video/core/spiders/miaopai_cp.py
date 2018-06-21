# _*_ coding=utf8 _*_
import scrapy
import re
import traceback
import json
import logging

BASE_URL = 'https://www.miaopai.com/u/'


class miaopai_cp_spider(scrapy.Spider):
    name = "miaopaicp"
    allowed_domains = ['miaopai.com']

    def start_requests(self):
        logging.info("START " + self.name)
        yield self.getHomepageRequest("cctvc")

    def getHomepageRequest(self, cp_id):
        return scrapy.Request(url=BASE_URL + cp_id, callback=self.parse_homepage, meta={'cp_id': cp_id})

    def getFriendsRequest(self, suid, type_="f", pageNum=0):
        url = "https://www.miaopai.com/gu/fans?page=%d&suid=%s" \
            if type_ == 'f' else \
            "https://www.miaopai.com/gu/follow?page=%d&suid=%s"
        meta = dict()
        meta['suid'] = suid
        meta['pageNum'] = pageNum
        meta['type_'] = type_
        return scrapy.Request(url=url % (0, suid), callback=self.parseXMLPage, meta=meta, dont_filter=True)

    def parse_homepage(self, response):
        # print response.body
        meta = response.meta
        cp_id = meta['cp_id']
        try:
            #  几个统计量
            bottomInfor = response.css("ul.bottomInfor span.num::text")
            video_count = bottomInfor[0].extract()
            guanzhu_count = bottomInfor[1].extract()
            fensi_count = bottomInfor[2].extract()
            vc = self.parseNum(video_count)
            gc = self.parseNum(guanzhu_count)
            fc = self.parseNum(fensi_count)
            # 账号信息
            info = response.css("div.personalText")[0]
            cp_name = info.css('p.name a span::text')[0].extract()
            cp_address = info.css('p.address::text')[0].extract()
            # 判定如果 "ta很懒什么都没有留下" 那么可能就是僵尸了
            cp_description = info.css('p.brief::text')[0].extract().replace("\n", "")
            print "%s %s %s %s %d %d %d" % (
                str(cp_id), str(cp_name), str(cp_address), str(cp_description), vc, gc, fc)
            # 关注
            glink = "https://www.miaopai.com/u/%s/relation/follow.htm" % cp_id
            # 粉丝
            flink = "https://www.miaopai.com/u/%s/relation/fans.htm" % cp_id

            item = {
                'type_': 'miaopaicp',
                'source': 'miaopai',
                'cp_id': cp_id,
                'url': response.url,
                'cp_name': cp_name,
                'cp_description': cp_description,
                'cp_address': cp_address,
                'vc': vc,
                'gc': gc,
                'fc': fc
            }
            yield item
            yield scrapy.Request(url=glink, callback=self.parseSuidPage,
                                 meta={'f': fc > 0, 'g': gc > 0})
            # videos
            # 存有当页所有的视频信息
            # videosTags = response.css(".contentLeft .videoCont")

        except IndexError:
            print traceback.format_exc()
        except Exception, e:
            print e.message, " ", traceback.format_exc(), " ", response.url

    def parseNum(self, string):
        if ',' in string:
            return int(string.replace(',', ''))
        if "万" not in string:
            return int(string)
        else:
            return int(float(string[:-1]) * 10000)

    def parseSuidPage(self, response):
        # 原则上 suid 对于关注和粉丝页面都是一样的,所以只需要访问一次这个就行了
        # suid 用于遍历好友时标志用户
        suid = response.css('button.guanzhu.gz::attr(suid)')[0].extract()
        meta = response.meta
        if meta['f']:
            yield self.getFriendsRequest(suid=suid, type_='f', pageNum=0)
        if meta['g']:
            yield self.getFriendsRequest(suid=suid, type_='g', pageNum=0)

    def parseXMLPage(self, response):
        data = json.loads(response.body)
        # print repr(data)
        msg = data['msg']
        if not msg:
            pass
        else:
            selector = scrapy.Selector(text=msg)
            aa = selector.css("div.box div.box_top a::attr(href)")
            for a in aa:
                cp_id = self.getCpidFromUrl(a.extract())
                yield self.getHomepageRequest(cp_id)
            meta = response.meta
            meta['pageNum'] += 1
            yield self.getFriendsRequest(suid=meta['suid'], type_=meta['type_'], pageNum=meta['pageNum'])

    def getCpidFromUrl(self, url):
        return re.findall(pattern="https://www.miaopai.com/u/(.*)", string=url)[0]
