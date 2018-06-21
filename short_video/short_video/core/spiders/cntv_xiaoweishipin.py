# _*_ coding=utf8 _*_
import scrapy, re, datetime, json,logging

# 组会说的，对于央媒下的这种群众上传的视频，其实没多大必要进行抓取
class xiaoweishipin_video_spider(scrapy.Spider):
    """ 央视网 => 央视视频 => 小微视频 """
    name = "cntv_xiaowei"
    allowed_domains = ['cntv.cn', 'cctv.com']

    # http://api.cntv.cn/video/getCboxMicroVideoListAction?serviceId=cbox&n=20&p=2&serviceId=cbox
    def start_requests(self):
        logging.info("START " + self.name)
        yield scrapy.Request(
            url="http://api.cntv.cn/video/getCboxMicroVideoListAction?serviceId=cbox&n=20&p=2&serviceId=cbox",
            callback=self.parseTagItemList)

    def parseTagItemList(self, response):
        itemList = json.loads(response.body)['itemList']
        for item in itemList:
            title = item['title']
            linkUrl = item['linkUrl']
            print str(title) + ' ' + str(linkUrl)
            meta = {
                'page': 1,
                'link': linkUrl
            }
            yield scrapy.Request(
                url="http://api.cntv.cn/video/getCboxMicroVideoListAction?serviceId=cbox&id=%s&n=20&p=%d" % (
                    meta['link'], meta['page']), callback=self.parseVideoList, meta=meta)

        # http://api.cntv.cn/video/getCboxMicroVideoListAction?serviceId=cbox&
        # id=PAGEfoYQ89rxVVLnf5a2efxs170629
        # &n=20&p=3

    def parseVideoList(self, response):
        videoList = json.loads(response.body)['videoList']
        for video in videoList:
            item = dict()
            item['type_'] = 'video'
            item['source'] = 'cntv'
            item['title'] = video['video_title']
            item['url'] = video['video_url']
            item['duration'] = self.getDurationFromText(video['video_length'])
            item['tag'] = video['page_name']
            item['img'] = video['video_key_frame_url']
            # 因为从app的接口拿的信息不完全,所以需要跳转到详情web页面来获取其他信息
            yield scrapy.Request(url=item['url'], callback=self.parseWebVideoDetail, meta=item)
        if not len(videoList):
            return
        meta = response.meta
        meta['page'] = meta['page'] + 1
        yield scrapy.Request(
            url="http://api.cntv.cn/video/getCboxMicroVideoListAction?serviceId=cbox&id=%s&n=20&p=%d" % (
                meta['link'], meta['page']), callback=self.parseVideoList, meta=meta)

    def parseWebVideoDetail(self, response):
        item = response.meta
        # try:
        item['pub_time'] = self.getDatetime(response)
        # except Exception,e:
        #     print e.message+" "+response.url
        item['like'] = int(response.css('#pczan>i::text')[0].extract())
        item['tag'] = self.getTags(response)
        LONG_CONTENT = self.getContents(response)
        item['cp_name'] = self.getAuthor(response)
        item['cp_id'] = ''
        print str(item['title'])
        yield item

    def getDatetime(self, response):
        info = response.css('div.function span.info::text')[0].extract()
        date_str_array = re.findall(pattern='\d{4}年\d{2}月\d{2}日 \d{2}:\d{2}', string=str(info))
        date_str = date_str_array[0]
        return datetime.datetime.strptime(date_str, "%Y年%m月%d日 %H:%M")

    def getTags(self, response):
        ori_searchKeyWords = response.css("div#searchkeywords a::text")
        words = ""
        for keyWord in ori_searchKeyWords:
            words += keyWord.extract() + " "
        return words

    def getContents(self, response):
        cs = response.css('div.content p')
        text = ""
        for c in cs:
            text += c.extract()
        text = re.sub('<.*?>', '', text)
        return text

    def getAuthor(self, response):
        relevance = response.css('div.relevance::text')
        ori_text = relevance[0].extract()
        result = ori_text.strip()
        return result

    def getDurationFromText(self, text):
        du = text.split(':')
        return int(du[0]) * 3600 + int(du[1]) * 60 + int(du[2])
