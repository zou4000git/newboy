# _*_ coding=utf8 _*_
import datetime
import json
import re
import traceback
import logging
import scrapy

from core.common_spider_tools import isOld

search_base_url = "http://vblog.people.com.cn/search/getsearchs?wd=%25&type=1&size=500&page="
root_url = "http://tv.people.com.cn"


class people_video_spider(scrapy.Spider):
    name = "people_web"
    allowed_domains = ['people.com.cn']

    def start_requests(self):
        logging.info("START " + self.name)
        # 视频新闻中心->category page->detail page
        yield scrapy.Request("http://tv.people.com.cn/GB/14645/index.html", callback=self.parseMediaNewsCenter)
        # 主页
        yield scrapy.Request("http://tv.people.com.cn", callback=self.parseHomepage)
        # 人民微视频 搜索%接口 原本非常耗时，但是经过了日期的优化，现在速度还好，遍历一遍搜索词汇就是了
        yield scrapy.Request(search_base_url + str(0), meta={'pageNum': 1}, callback=self.parseSearch)

    # http://tv.people.com.cn/n1/2018/0426/c67527-29951953.html
    # 详情页的链接其实可以看出来具体发布日期
    # 判断是否是旧的(根据日期)

    def _isOld(self, data):
        date = None
        try:
            if isinstance(data, str):
                url = data
                r = re.findall(pattern="(\d{4})/(\d{2})(\d{2})", string=url)
                if r:
                    date_tuple = r[0]
                    date = datetime.datetime(year=int(date_tuple[0]), month=int(date_tuple[1]), day=int(date_tuple[2]),
                                             hour=0, minute=0, second=0, microsecond=0)
            elif isinstance(data, datetime.datetime):
                date = data
            else:
                return False
            if date:
                return isOld(date)
            else:
                return False
        except Exception, e:
            print e.message + traceback.format_exc()
            return False

    def parseMediaNewsCenter(self, response):
        tagNewsPagesURL = response.css("div.p2_c2 h2.tit2>a::attr('href')")
        for tagURL in tagNewsPagesURL:
            print str(tagURL.extract())
            if "http://tv.people.com.cn/GB/61600/index.html" == tagURL.extract():
                # 这是 '时政' 页,样式比较特别
                yield scrapy.Request(url="http://tv.people.com.cn/GB/61600/index.html", callback=self.parseShiZheng)
            else:
                # 普通category页
                yield scrapy.Request(tagURL.extract(), self.parseTagPage)

    def parseTagPage(self, response):
        li_s = response.css('div.d2_4.clear>ul>li')
        if not li_s:
            return
        for li in li_s:
            href = root_url + li.css('a::attr(href)')[0].extract()

            if self._isOld(str(href)):
                print 'old data,bye :~)'
                return

            img = root_url + li.css('img::attr(src)')[0].extract()
            title = li.css('a::text')[0].extract()
            yield scrapy.Request(url=href, callback=self.parseDetailPage, meta={
                'img': img,
                'title': title
            })

        # 翻页
        yield scrapy.Request(url=self.growURL(response.url), callback=self.parseTagPage)

    def parseDetailPage(self, response):
        item = dict()
        item['type_'] = 'video'
        item['source'] = 'people'
        item['title'] = response.meta.get('title', self.getTitleFromDetailPageResp(response))
        item['img'] = response.meta.get('img')
        item['url'] = response.url
        item['pub_time'] = self.getDatetimeFromDetailPageResp(response)
        item['cp_name'] = self.getAuthor(response)
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

    # 时政页面比较奇葩,有三种不同的列表格式
    def parseShiZheng(self, response):
        if '404 Not Found' in response.body:
            return
        # type 0 page
        li_s = response.css("ul.list_14b.d2sz_1.clear>li")
        for li in li_s:
            meta = dict()
            meta['date'] = datetime.datetime.strptime(li.css('i::text')[0].extract(), '%Y-%m-%d %H:%M:%S')

            # 判断什么时候不在翻页
            if self._isOld(meta['date']):
                print "old news ,return"
                return

            meta['title'] = li.css('a::text')[0].extract()
            url = root_url + li.css('a::attr(href)')[0].extract()
            yield scrapy.Request(url=url, meta=meta, callback=self.parseShiZhentType_0_Detail)
        # 翻页
        yield scrapy.Request(self.growURL(response.url), callback=self.parseShiZheng)

    def parseShiZhentType_0_Detail(self, response):
        # 时政新闻的详情页
        item = dict()
        item['type_'] = 'video'
        item['source'] = 'people'
        item['title'] = response.meta['title']
        item['url'] = response.url
        item['pub_time'] = response.meta['date']
        item['cp_name'] = response.css('div.v-intro>span::text')[0].extract()
        item['cp_id'] = ''
        print str(item['title'])
        yield item

    # vblog 微视频搜索接口,返回json
    def parseSearch(self, response):
        pageNum = response.meta['pageNum']
        print "/******************** %d ***********************/" % pageNum
        json_object = json.loads(response.body)
        if json_object['list']:
            for data in json_object['list']:
                item = dict()
                item['type_'] = 'video'
                item['source'] = 'people'
                item['title'] = data['TITLE']
                item['img'] = data['IMAGES']
                item['cp_name'] = data['NICK']
                item['url'] = data['VIDEOLINK']
                item['pub_time'] = datetime.datetime.strptime(data['CREATED'], '%Y-%m-%d')
                if isOld(item['pub_time']):
                    print 'old data,no more page,goodbye :)'
                    return
                item['cp_id'] = data['CREATED_BY']
                print str(item['title'])
                yield item
            yield scrapy.Request(search_base_url + str(pageNum), meta={'pageNum': (pageNum + 1)}, callback=self.parse)
        else:
            print 'baby, say goodbye now :)'

    def growURL(self, url):
        if 'index.html' in url:
            return url.replace("index.html", "index2.html")
        else:
            pattern = ".*/index([0-9]*).html"
            mat = re.match(pattern=pattern, string=url)
            pageNumStr = mat.group(1)
            pageNum = int(pageNumStr)
            return url.replace(pageNumStr + ".html", "%d.html" % (pageNum + 1))

    def parseHomepage(self, response):
        # 人民网首页乱七八糟,视频列表可以看到 vblog(人民微视频) 人民视频(包含/n1/的绝对路径或者以/n1/开头的相对路径)
        as_ = response.css('a[target="_blank"]')
        for a in as_:
            link = a.css('a::attr(href)')[0].extract()
            if link.startswith('/n1/'):
                link = 'http://tv.people.com.cn' + link
            if '/n1/' in link:
                yield scrapy.Request(url=link, callback=self.parseDetailPage, meta={})
