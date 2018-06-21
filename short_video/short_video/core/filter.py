# _*_ coding=utf8 _*_
import os

from scrapy.dupefilter import RFPDupeFilter
from scrapy.utils.request import request_fingerprint


class CustomFilter(RFPDupeFilter):
    """A dupe filter that considers specific ids in the url"""

    def __init__(self):
        RFPDupeFilter.__init__(self)
        history=set()

    def __getid(self, url):
        mm = url.split("&refer")[0]  # or something like that
        return mm

    def request_seen(self, request):
        fp = self.__getid(request.url)
        if fp in self.fingerprints:
            return True
        self.fingerprints.add(fp)
        if self.file:
            self.file.write(fp + os.linesep)
