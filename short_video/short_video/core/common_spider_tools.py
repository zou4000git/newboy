# _*_ coding=utf8 _*_
import datetime
from scrapy.exceptions import CloseSpider


def getYesterday():
    today = datetime.date.today()
    oneday = datetime.timedelta(days=1)
    yesterday = today - oneday
    return yesterday


def isOld(dt_time):
    return dt_time < datetime.datetime.combine(getYesterday(), datetime.time(0, 0))


def shutdown(reason='cancelled'):
    raise CloseSpider(reason=reason)
