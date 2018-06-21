# _*_ coding=utf8 _*_
# 人民网视频搜索接口
# for example : http://search.people.com.cn/cnpeople/videosearch.do?keyword=d&siteName=news&pageCode=gb2312
# 返回数据 1.最多400条 2.无法翻页 3.xml格式
#  <item>
#             <content_id>30044207</content_id>
#             <title>
#                 <![CDATA[森林、动物、瀑布……  “3D公厕”亮相重庆沙坪坝区]]>
#             </title>
#             <description>
#                 <![CDATA[森林、动物、瀑布……  “3D公厕”亮相重庆沙坪坝区]]>
#             </description>
#             <url>
#                 <![CDATA[http://tv.people.com.cn/n1/2018/0607/c413792-30044207.html]]>
#             </url>
#             <media>
#                 <media_infor>
#                     <pic_path>
#                         <![CDATA[http://tv.people.com.cn/NMediaFile/videotemp/201806/07/LOCALVIDEO20180607153526F6953418014.jpg]]>
#                     </pic_path>
#                     <pic_width>160</pic_width>
#                     <pic_height>120</pic_height>
#                     <pic_desc>
#                         <![CDATA[森林、动物、瀑布……  “3D公厕”亮相重庆沙坪坝区]]>
#                     </pic_desc>
#                 </media_infor>
#             </media>
#         </item>

import scrapy
from core.search_tools import SearchCharacterTool
import datetime, re
import logging


class PeopleSearchSpider(scrapy.Spider):
    name = "people_web_search"
    allowed_domains = ['people.com.cn']

    def start_requests(self):
        logging.info("START " + self.name)
        # 由于人民网视频搜索使用的是like匹配,所以搜单个字效果好一点
        # 但是吧这个搜索不能注入 %
        self.ST = SearchCharacterTool()
        while True:
            search_req = self.getNextRequest()
            if search_req:
                yield self.getNextRequest()
            else:
                break

    def parseXML(self, response):
        items = response.css('item')
        for one in items:
            item = dict()
            item['title'] = self.getTextInXMLK(one, 'title')
            item['description'] = self.getTextInXMLK(one, 'description')
            item['url'] = self.getTextInXMLK(one, 'url')
            item['img'] = self.getTextInXMLK(one, 'pic_path')
            yield scrapy.Request(url=item['url'], callback=self.parseDetailPage, meta=item)
        yield self.getNextRequest()

    def getTextInXMLK(self, XML, k):
        return XML.css(k + '::text')[0].extract()

    def getNextRequest(self):
        # PS: 人民网搜索入口无法选择排序搜索
        keyword = self.getNextKeyWord()
        if keyword:
            return scrapy.Request(
                url='http://search.people.com.cn/cnpeople/videosearch.do?keyword=%s&siteName=news&pageCode=gb2312' % self.getNextKeyWord(),
                callback=self.parseXML)
        else:
            return False

    def getNextKeyWord(self):
        return self.ST.next()

    def parseDetailPage(self, response):
        item = response.meta
        item['type_'] = 'video'
        item['source'] = 'people'
        item['title'] = response.meta.get('title', self.getTitleFromDetailPageResp(response))
        item['img'] = response.meta.get('img')
        item['url'] = response.url
        item['pub_time'] = self.getDatetimeFromDetailPageResp(response)
        item['cp_name'] = self.getAuthor(response)
        item['cp_id'] = ''
        print str(item['title'])
        yield item

    def getAuthor(self, response):
        if response.css('div.v-intro span::text'):
            author_info = response.css('div.v-intro span::text')[0].extract()
            author_info = author_info[author_info.find('：') + 1:-1]
            return author_info
        else:
            return ''

    def getTitleFromDetailPageResp(self, response):
        if response.css('div.daohang h2::text'):
            # 不管上面的标题居中还是偏左,两种页面板式下标题的选择方式不变
            return response.css('div.daohang h2::text')[0].extract()
        elif response.css('div.w1000.clearfix.tit-ld h2::text'):
            return response.css('div.w1000.clearfix.tit-ld h2::text')[0].extract()
        else:
            return ''

    def getDatetimeFromDetailPageResp(self, response):
        if response.css('div.publishtime::text'):
            publishtime = response.css('div.publishtime::text')[0].extract()
            return datetime.datetime.strptime(publishtime, '发布时间:%Y年%m月%d日%H:%M')
        else:
            pattern = "\d{4}年\d{2}月\d{2}日\d{2}:\d{2}"
            res = re.findall(pattern, response.body)
            if res:
                return datetime.datetime.strptime(res[0], '%Y年%m月%d日%H:%M')
            else:
                return datetime.datetime.now()
