# This package will contain the spiders of your Scrapy project
#
# Please refer to the documentation for information on how to create and manage
# your spiders.
import sys

reload(sys)
sys.setdefaultencoding('utf-8')
LOG_PATH = "logs/"
import logging
from logging.handlers import TimedRotatingFileHandler
import os
import re


def logInit():
    if not os.path.exists(LOG_PATH):
        os.makedirs(LOG_PATH)
    print "# logInt start"
    log_fmt = '%(asctime)s\tFile \"%(filename)s\",line %(lineno)s\t%(levelname)s: %(message)s'
    formatter = logging.Formatter(log_fmt)
    log_file_handler = TimedRotatingFileHandler(filename=LOG_PATH + "short_video_scrapy_spider",
                                                when="D", interval=1, backupCount=10)
    log_file_handler.suffix = "%Y-%m-%d.log"
    log_file_handler.extMatch = re.compile(r"^\d{4}-\d{2}-\d{2}.log$")
    log_file_handler.setFormatter(formatter)
    logging.basicConfig(level=logging.INFO)
    log = logging.getLogger()
    log.addHandler(log_file_handler)


logInit()
