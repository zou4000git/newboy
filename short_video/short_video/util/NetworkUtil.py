# encoding=utf8
import json
import pycurl
import urllib
import hashlib
import StringIO
import collections


class NetworkUtil(object):
    @staticmethod
    def curl_get(url, type='html'):
        strio = StringIO.StringIO()
        curl = pycurl.Curl()
        curl.setopt(pycurl.URL, url)
        curl.setopt(pycurl.WRITEFUNCTION, strio.write)
        curl.setopt(pycurl.FOLLOWLOCATION, 1)
        curl.setopt(pycurl.MAXREDIRS, 5)
        curl.perform()
        # code = curl.getinfo(curl.HTTP_CODE)
        ret = strio.getvalue()
        strio.close()
        curl.close()
        if ret:
            if type == 'json':
                try:
                    ret = json.loads(ret, object_pairs_hook=collections.OrderedDict)
                    return ret
                except ValueError:
                    print 'ValueError: No JSON object could be decoded'
                    return None
            elif type == 'html':
                return ret
        else:
            return None

    @staticmethod
    def curl_post(url, post_data, type='html'):
        strio = StringIO.StringIO()
        curl = pycurl.Curl()
        curl.setopt(pycurl.URL, url)
        curl.setopt(pycurl.WRITEFUNCTION, strio.write)
        curl.setopt(pycurl.FOLLOWLOCATION, 1)
        curl.setopt(pycurl.MAXREDIRS, 5)
        curl.setopt(curl.POSTFIELDS, urllib.urlencode(post_data))
        curl.perform()
        # code = curl.getinfo(curl.HTTP_CODE)
        ret = strio.getvalue()
        strio.close()
        curl.close()
        if ret:
            if type == 'json':
                try:
                    ret = json.loads(ret, object_pairs_hook=collections.OrderedDict)
                    return ret
                except ValueError:
                    print 'ValueError: No JSON object could be decoded'
                    return None
            elif type == 'html':
                return ret
        else:
            return None

    @staticmethod
    def zkname(name):
        import sys
        sys.path.append('/usr/local/ons_agent/names/')
        from nameapi import getHostByKey
        ret = getHostByKey(name)
        return ret[1], ret[2]


if __name__ == '__main__':
    print NetworkUtil.zkname('all25030.hz_weixin.80000051.mongodb.com')
    print NetworkUtil.curl_get('http://www.baidu.com')
    print NetworkUtil.curl_get(
        'http://hz.webdev.com/CompetitorAnalyze/ComprehensiveTop?date=2018-05-08&origin=0&source=toutiao', type='json')
