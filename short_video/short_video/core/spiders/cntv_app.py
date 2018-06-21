# _*_ coding=utf8 _*_
import scrapy, datetime, json, re, traceback
from core.common_spider_tools import isOld
import logging


# 今天是2018.6.11，新华视频的app接口又改了，原有的接口失效
# 希望app维护者能够安分一点
# 哈利路亚

# well job
# 经过了新华视频app开发者艰苦卓绝的攻坚
# 这个接口现在可以稳定的一直翻页下去了haha


class cntv_app_video_list(scrapy.Spider):
    name = "cntv_app"
    allowed_domains = ['cntv.cn', 'cctv.com']

    def start_requests(self):
        logging.info("START " + self.name)
        yield scrapy.Request(
            url="http://api.cntv.cn/list/CboxSpecialList?id=TDAT1504838902038321&serviceId=cbox&serviceId=cbox&n=20&p=1",
            callback=self.parseVideoList, meta={'page': 1})

    def _isOld(self, url):
        date = None
        try:
            date = self.getDatetimeFromUrl(url)
            if date:
                return isOld(date)
            else:
                return False
        except Exception, e:
            return False

    def getDatetimeFromUrl(self, url):
        r = re.findall(pattern="(\d{4})/(\d{1,2})(\d{1,2})", string=url)
        date_tuple = r[0]
        date = datetime.datetime(year=int(date_tuple[0]), month=int(date_tuple[1]), day=int(date_tuple[2]),
                                 hour=0, minute=0, second=0, microsecond=0)
        return date

    def parseVideoList(self, response):
        data = json.loads(response.body)['data']
        if not len(data):
            print response.body
            return
        for video in data:
            item = {
                'title': video.get('title'),
                'img': video.get('bigImgUrl'),
                'vid': video.get('vid'),
                'tag': video.get('cornerStr'),
            }
            if self._isOld(item['img']):
                # 这个站点的去重逻辑其实是很不稳定的，因为除了图片的url无法获取具体时间
                # 但是也还是有一些图片（数量不少）中不包含具体日期
                # 那就只能继续下去咯
                print 'old data,ready to end application,see u tomorrow ~'
                return
            yield scrapy.Request(
                url='http://vdn.apps.cntv.cn/api/getHttpVideoInfo.do?pid=%s'
                    '&tsp=1528690036&uid=cc6de5a17110ad3e66b2a95b819f1a84&vc=EDFA8713806CE22FBC49EBDD06676C08&vn=3&wlan=w'
                    % item['vid'], callback=self.parseVideoDetail, meta=item)
        meta = response.meta
        page = meta['page'] + 1
        yield scrapy.Request(
            url="http://api.cntv.cn/list/CboxSpecialList?id=TDAT1504838902038321&serviceId=cbox&serviceId=cbox&n=20&p=%d" % page,
            callback=self.parseVideoList, meta={'page': page})

    def parseVideoDetail(self, response):
        item = response.meta
        data = json.loads(response.body)
        item['pub_time'] = datetime.datetime.strptime(data.get('f_pgmtime'), '%Y-%m-%d %H:%M:%S')
        item['description'] = data.get('desc')
        item['url'] = response.url
        item['title'] = data.get('title')
        item['tag'] = data.get('tag')
        item['cp_name'] = data.get('editer_name')
        item['duration'] = int(float(data.get('video').get('totalLength')))
        item['like'] = 0
        item['cp_id'] = data.get('produce_id')
        item['source'] = 'cntv'
        item['type_'] = 'video'
        logging.info(str(item['title']))
        yield item
