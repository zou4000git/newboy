#!/bin/sh
cd /data/webdocs/stable/short_video
spider_name=$1
echo 'start scrapy spider named ${spider_name}'
/usr/local/python27/bin/scrapy crawl $spider_name
