# _*_ coding=utf8 _*_

import scrapy
import json
import datetime
import re
import logging

# 9 体育
# 59 音乐
# 6 美食
# 31 汽车
# 3 财富
# 4 娱乐
# 8 科技
# 5 生活
# 2 世界
# 10 新知

categorys = (9, 59, 6, 31, 3, 4, 8, 5, 2, 1, 10)


class app_pear_video_spider(scrapy.Spider):
    name = "pear_app"
    allowed_domains = ['pearvideo.com']

    # 测试后发现,home.jsp的信息最全,
    # getCategoryConts.jsp 信息不是很全,所有为了可维护性,把后面的解析改成了适配两个接口

    def start_requests(self):
        logging.info("START " + self.name)
        # 梨视频app的所有页卡
        # 注意，所有页卡都在翻一定页数（18-100不等）之后不再返回内容，
        for category in categorys:
            url = "http://app.pearvideo.com/clt/jsp/v4/getCategoryConts.jsp?categoryId=%d&start=0&categoryId=%d" % (
                category, category)
            yield scrapy.Request(url=url, cookies={'PEAR_UUID': "353570061820366",
                                                   "JSESSIONID": "E3A354114E8C0F1E1910D86A05C5C379"},
                                 callback=self.parsePage)

    def parsePage(self, response):
        logging.info("****************** %s *********************" % response.url)
        # parse current
        resp_data = response.body
        resp_json = json.loads(resp_data)
        if resp_json['resultCode'] == '1':
            # 根据访问的地址判断应该如何解析提炼迭代体
            iterator = getDataListFromJSON(resp_json)
            if len(iterator) == 0:
                logging.info("空值")
                return
            for one_news in iterator:
                # CP 部分
                user_item = getCpFromJSON(one_news)
                yield user_item
                ## item
                item = getShortVideoItemFromJSON(one_news)
                yield item
            next_url = getNextUrl(response, resp_json)
            if next_url:
                yield scrapy.Request(next_url, callback=self.parse)


def getShortVideoItemFromJSON(one_news):
    item = {}
    item['type_'] = 'video'
    item['source'] = 'pearvideo'
    item['title'] = one_news['name']
    logging.info(str(item['title']))
    item['pub_time'] = getDateFromJSON(one_news)
    item['description'] = getSummary(one_news)
    item['url'] = getUrl(one_news)
    item['img'] = getImgUrl(one_news)
    item['like'] = one_news['praiseTimes']
    userInfo = one_news['userInfo']
    item['cp_id'] = "author_" + userInfo['userId']
    item['cp_name'] = userInfo['nickname']
    item['tag'] = getTagStr(one_news)
    return item


def getCpFromJSON(one_news):
    userInfo = one_news['userInfo']
    cp_id = "author_" + userInfo['userId']
    user_item = {}
    user_item['type_'] = 'cp'
    user_item['source'] = 'pearvideo'
    user_item['url'] = "http://www.pearvideo.com/author_" + userInfo['userId']
    user_item['img'] = userInfo['pic']
    user_item['cp_id'] = cp_id
    user_item['cp_name'] = userInfo['nickname']
    return user_item


def getDateFromJSON(cont):
    if 'pic' in cont:
        return getDateFromPicURL(cont['pic'])
    else:
        return ''


def getDateFromPicURL(address):
    try:
        if 'cont/' in address:
            date_str = address[address.find('cont/') + 5:address.rfind('/cont-')]
        else:
            date_str = address[address.find('main/') + 5:address.find('main/') + 13]
        return datetime.datetime.strptime(date_str, '%Y%m%d')
    except Exception:
        return datetime.datetime.now()


def getDataListFromJSON(json_object):
    iterator = []
    if 'dataList' in json_object:
        for data in json_object['dataList']:
            contList = data['contList']
            for cont in contList:
                iterator.append(cont)
    if 'contList' in json_object:
        for cont in json_object['contList']:
            iterator.append(cont)
    if 'hotList' in json_object:
        for cont in json_object['hotList']:
            iterator.append(cont)
    return iterator


def getUrl(cont):
    """ 注意,link是http,不要用 """
    if 'shareUrl' in cont:
        return cont['shareUrl']
    elif 'url' in cont:
        return cont['url']
    elif 'contId' in cont:
        return "http://app.pearvideo.com/clt/jsp/v4/content.jsp?contId=%s" % cont['contId']


def getImgUrl(cont):
    if 'sharePic' in cont:
        return cont['sharePic']
    elif 'pic' in cont:
        return cont['pic']
    else:
        return ""


def getTagStr(cont):
    if 'tags' in cont:
        tags = cont['tags']
        tag_str = ''
        for tag in tags:
            tag_str += tag['name'] + ","
        if "," in tag_str:
            tag_str = tag_str[:len(tag_str) - 1]
        return tag_str
    return ''


def getSummary(cont):
    if 'summary' in cont:
        return cont['summary']
    else:
        return ''


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
