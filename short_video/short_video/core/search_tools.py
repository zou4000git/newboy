# _*_ coding=utf8 _*_
import logging
from util.MysqlUtil import MysqlUtil
import urllib2, json


class SearchCharacterTool(object):

    def __init__(self):
        with open('3500.txt') as file_object:
            self.contents = file_object.read()
        self.idx = 0
        self.length = len(self.contents)

    def next(self):
        """返回下一个搜索关键字,如果返回None就表示到头了"""
        if self.idx < self.length:
            temp = self.contents[self.idx]
            self.idx += 1
            return temp
        else:
            return None


class SearchDbJiebaWordTool(object):
    def __init__(self):
        self.num_of_keywrod = 58440
        self.current_idx_of_keyword = 0

    def next(self):
        if self.current_idx_of_keyword < self.num_of_keywrod:
            keyword = MysqlUtil.getKeyword(idx=self.current_idx_of_keyword)
            self.current_idx_of_keyword += 1
            return keyword.word
        else:
            return None


class SearchBaiduHotWordTool(object):
    def __init__(self):
        request = urllib2.Request("http://running.webdev.com/Datasupport/BaiduKeyword")
        response = urllib2.urlopen(request)
        html = response.read()
        data = json.loads(html)['data']
        self.hot_word_list = []
        for word in data:
            self.hot_word_list.append(str(word))


    def next(self):
        try:
            return self.hot_word_list.pop()
        except Exception:
            return None


if __name__ == '__main__':
    s = SearchCharacterTool()
    print s.next()
    print s.next()
