# _*_ coding=utf8 _*_
import datetime
import re
import arrow
from dateutil.parser import *


def format_pub_time(pub_time):
    if isinstance(pub_time, datetime.datetime):
        return pub_time
    if not pub_time:
        return datetime.datetime.now().strftime('%Y-%m-%d %H:%M:%S')
    try:
        return datetime.datetime.strptime(pub_time, '%Y-%m-%d %H:%M:%S').strftime('%Y-%m-%d %H:%M:%S')
    except:
        pass
    try:
        return datetime.datetime.strptime(pub_time, '%m/%d/%Y %H:%M:%S').strftime('%Y-%m-%d %H:%M:%S')
    except:
        pass
    try:
        return datetime.datetime.strptime(pub_time, "%a %b %d %H:%M:%S +0800 %Y").strftime('%Y-%m-%d %H:%M:%S')
    except:
        pass

    published_hours_ago = re.match(ur'(\d+)小时前', pub_time)
    if published_hours_ago:
        try:
            return (datetime.datetime.now() - datetime.timedelta(hours=int(published_hours_ago.group(1)))).strftime(
                '%Y-%m-%d %H:%M:%S')
        except:
            pass

    published_minutes_ago = re.match(ur'(\d+)分钟前', pub_time)
    if published_minutes_ago:
        try:
            return (
                    datetime.datetime.now() - datetime.timedelta(
                minutes=int(published_minutes_ago.group(1)))).strftime(
                '%Y-%m-%d %H:%M:%S')
        except:
            pass
    published_today = re.match(ur'今天 (\d+):(\d+)', pub_time)
    if published_today:
        try:
            return (
                    datetime.datetime.now().strftime('%Y-%m-%d ') + published_today.group(
                1) + ':' + published_today.group(
                2) + ':00')
        except:
            pass

    parsed_time = __parse_time(pub_time)
    if parsed_time:
        return parsed_time
    try:
        parsed_time = parse(pub_time, fuzzy_with_tokens=True)[0].replace(tzinfo=None)
        if parsed_time > arrow.now().replace(days=1).datetime.replace(tzinfo=None):
            parsed_time = arrow.Arrow.fromdatetime(parsed_time).replace(years=-1).datetime.replace(tzinfo=None)
        return parsed_time.strftime('%Y-%m-%d %H:%M:%S')
    except:
        pass
    if not parsed_time:
        return datetime.datetime.now().strftime('%Y-%m-%d %H:%M:%S')
    return parsed_time


def __parse_time(time_string):
    if re.match("\d{10}", time_string):
        return datetime.datetime.fromtimestamp(float(time_string[:10]))

    formatted_pub_time = time_string.replace('年', '-').replace('月', '-').replace('日', '') if isinstance(
        time_string, str) else time_string
    if isinstance(formatted_pub_time, str):
        formatted_pub_time = formatted_pub_time.replace("&nbsp;", " ")

        # 处理年月日
        pattern = re.compile(r'((?:\d{2,4}[-./])?\d{1,2}[-./]\d{1,2}) (\d{2}:\d{1,2}(?::\d{1,2})?)')
        match = pattern.findall(formatted_pub_time)
        if match:
            formatted_pub_time = match[0][0] + " " + match[0][1]

        pattern = re.compile(r'(?:(\d{2,4})[-./])?(\d{1,2})[-./](\d{1,2})(?: (\d{1,2}):(\d{1,2})(?::(\d{1,2}))?)?')
        match = pattern.findall(formatted_pub_time)

        if match:
            year, month, day, hour, minute, second = match[0]
            if not year:
                year = str(datetime.datetime.now().year)
            if len(year) == 2:
                year = "20" + year

            def __format_time_item(time_item):
                if len(time_item) == 0:
                    return "00"
                if len(time_item) == 1:
                    return "0" + time_item
                return time_item

            month, day, hour, minute, second = map(__format_time_item, (month, day, hour, minute, second))
            pub_time = year + "-" + month + "-" + day + " " + hour + ":" + minute + ":" + second
            parsed_time = datetime.datetime.strptime(pub_time, '%Y-%m-%d %H:%M:%S')
            if parsed_time > arrow.now().replace(days=1).datetime.replace(tzinfo=None):
                parsed_time = arrow.Arrow.fromdatetime(parsed_time).replace(years=-1).datetime.replace(tzinfo=None)
            return parsed_time.strftime('%Y-%m-%d %H:%M:%S')
        else:
            return None
