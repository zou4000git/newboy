# -*- coding: utf-8 -*-

# Define your item pipelines here
#
# Don't forget to add your pipeline to the ITEM_PIPELINES setting
# See: https://doc.scrapy.org/en/latest/topics/item-pipeline.html
import json
from util.MysqlUtil import MysqlUtil
from config.models import GalaxyShortVideo, GalaxyCp
from util.FormatUtil import FormatUtil
from datetime import datetime
import codecs
from time_parser import format_pub_time as parseTime
import logging


class PearVideoScrapyPipeline(object):
    def __init__(self):
        self.file = codecs.open('pear_video_data_utf8.json', 'wb', encoding='utf-8')
        self.file2 = codecs.open('miaopai_cp_unused.json', 'wb', encoding='utf-8')
        pass

    def process_map(self, item):
        map = {"video": self.process_video_item,
               'keyword': self.process_keyword_item,
               "cp": self.process_cp_item,
               'miaopaicp': self.process_miaopai_cp_item}
        return map[item['type_']]

    def process_item(self, item, spider):
        return self.process_map(item)(item, spider)

    def process_video_item(self, item, spider):
        date = datetime.now()
        news_hash = FormatUtil.md5(item.get('url'))
        shortVideo = MysqlUtil.hasNews(news_hash)
        if shortVideo is None:
            shortVideo = GalaxyShortVideo()
            shortVideo.created_at = date
        else:
            logging.info('Find duplicated news: ' + str(news_hash))
        shortVideo.raw_id = news_hash
        shortVideo.cp_id = item.get('cp_id', '')
        shortVideo.cp_name = item.get('cp_name')
        shortVideo.url = item['url']
        shortVideo.title = item.get('title')
        shortVideo.img = item.get('img')
        shortVideo.description = item.get("description")
        shortVideo.catalog = item.get('catalog')
        shortVideo.tag = item.get('tag')
        shortVideo.duration = item.get('duration')
        shortVideo.source = item.get('source')
        shortVideo.comment = item.get('comment')
        shortVideo.like = item.get('like', 0)
        shortVideo.share = item.get('share')
        shortVideo.play_count = item.get('play_count')
        shortVideo.pub_time = parseTime(item.get("pub_time"))
        shortVideo.updated_at = date
        MysqlUtil.insert_one(shortVideo)

    def process_keyword_item(self, item, spider):
        self.file.write(str('%s %d' % (item['word'], item['num'])).decode('unicode_escape') + "\n")
        return item

    def process_cp_item(self, item, spider):
        cp = MysqlUtil.hasCp(source=item.get('source'), cp_id=item.get('cp_id'))
        if not cp:
            cp = GalaxyCp()
            cp.raw_id = FormatUtil.md5(item['cp_id'])
            cp.cp_id = item['cp_id']
            cp.cp_name = item.get('cp_name')
            cp.url = item.get('url')
            cp.img = item.get('img')
            cp.source = item['source']
            cp.description = item.get('description')
            cp.catalog = item.get('catalog')
            cp.comment = item.get('comment')
            cp.like = item.get('like')
            cp.share = item.get('share')
            cp.play_count = item.get('play_count')
            date = datetime.now()
            cp.updated_at = date
            cp.created_at = date
            MysqlUtil.insert_one(cp)

    def process_miaopai_cp_item(self, item, spider):
        if item['vc'] == 0:
            self.file2.write(repr(item).decode('unicode_escape') + "\n")
        else:
            self.process_cp_item(item, spider)
