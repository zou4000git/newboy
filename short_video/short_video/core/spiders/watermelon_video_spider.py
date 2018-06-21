# _*_ coding=utf8 _*_

import scrapy
import json
import datetime
import time
import re
import logging
from util.MysqlUtil import MysqlUtil

categorys = (video_new, subv_xg_music, subv_xg_movie, subv_xg_society, subv_xg_agriculture, subv_xg_game, subv_xg_food, subv_xg_life, subv_xg_sport, subv_xg_jmj)


class watermelon_video_spider(scrapy.Spider):
    name = "watermelon_video"
    allowed_domains = ['if.snssdk.com']

    start_urls = [
        # "http://app.pearvideo.com/clt/jsp/v4/home.jsp?isHome=1&channelCode=110100&isHome=1&channelCode=110100&start=133280"
    ]
    max_behot_time = int(time.time())
    for category in categorys:
        start_urls.append(
            "http://lf.snssdk.com/video/app/stream/v51/?category=%d&refer=1&count=20&max_behot_time=%d&list_entrance=main_tab&last_refresh_sub_entrance_interval=1528190281&loc_mode=7&tt_from=auto&lac=4566&cid=19737601&play_param=codec_type%3A1&strict=1&iid=34615972636&device_id=46066109002&ac=wifi&channel=tengxun_new&aid=32&app_name=video_article&version_code=657&version_name=6.5.7&device_platform=android&ab_version=356660%2C344692%2C361439%2C368846%2C368911%2C367032%2C358365%2C368038%2C356602%2C369505%2C355630%2C354439%2C365867%2C354608%2C368665%2C346576%2C320649%2C361852&ssmix=a&device_type=vivo+X9s+Plus&device_brand=vivo&language=zh&os_api=25&os_version=7.1.2&uuid=866355039422390&openudid=61d4d2f1534c85f0&manifest_version_code=257&resolution=1080*1920&dpi=480&update_version_code=65702&_rticket=1528190282291&fp=P2TqLrFIL2G7FlHeFlU1FYwIPrmI&rom_version=Funtouch+OS_3.1_PD1635_A_1.19.7%d" % (
                category, max_behot_time))

    def start_requests(self):
        for url in self.start_urls:
            #yield scrapy.Request(url, cookies={'PEAR_UUID': "353570061820366",
             #                                  "JSESSIONID": "E3A354114E8C0F1E1910D86A05C5C379"})
            yield scrapy.Request(url, cookies={})

    def parse(self, response):
        logging.info("****************** %s *********************" % response.url)
        # parse current
        resp_data = response.body
        resp_json = json.loads(resp_data)
        if resp_json['message'] == 'success':
            # 根据访问的地址判断应该如何解析提炼迭代体
            iterator = getDataListFromJSON(resp_json)
            if len(iterator) == 0:
                logging.info("空值")
            for one_news in iterator:
                ## item
                item=getShortVideoItemFromJSON(one_news)
                #yield item
            next_url = getNextUrl(response, resp_json)
            if next_url:
                yield scrapy.Request(next_url, callback=self.parse)

def getShortVideoItemFromJSON(one_news):
    item = {}
    item['__name__']='watermelon_video'
    item['title'] = one_news['title']
    logging.info(str(item['title']))
    item['date'] = one_news.get('publish_time')
    item['summary'] = getSummary(one_news)
    item['url'] = one_news.get('article_url','')
    item['img'] = one_news['middle_image']['url']
    item['duration'] = one_news.get('video_duration',0)
    userInfo = one_news['user_info']
    item['cp_id'] = userInfo['user_id']
    item['author'] = userInfo['name']
    item['tags'] = one_news['tag']
    item['like'] = one_news['digg_count']
    item['share'] = one_news['share_count']
    item['comment'] = one_news.get('comment_count')
    item['source'] = 'watermelon'
    return item


def getDataListFromJSON(json_object):
    iterator = []
    if 'data' in json_object:
        for data in json_object['data']:
            content_str = data['content']
            content = json.loads(content_str)
            for cont in content:
                iterator.append(cont)

    return iterator

def getNextUrl(response, resp_json):
    if 'nextUrl' in resp_json:
        if resp_json['nextUrl']:
            return resp_json['nextUrl']
    url = response.url
    pattern = re.compile(r'.*&?(start=([0-9]*))&?.*')
    result = re.match(pattern, url)
    if result:
        old_sub_url = result.group(1)
        start_num = int(result.group(2))
        start_num += 10
        if start_num > 1000:
            return ""
        suburl = "start=%d" % start_num
        url = url.replace(old_sub_url, suburl)
        return url
    return response.url
