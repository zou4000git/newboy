# coding=utf-8
import json
import re
import scrapy

def build_json_response(response, encoding=None):
    body = response.body
    # 1. change encoding to UTF8 if it is not
    if encoding:
        body = body.decode(encoding)
    elif "Content-Type" in response.headers:
        content_type = response.headers["Content-Type"]
        pattern = re.compile("charset=(.+)")
        matches = re.findall(pattern, content_type)

        if matches:
            response_encoding = matches[0].upper()
            if response_encoding != "UTF8" or response_encoding != "UTF-8":
                body = body.decode(response_encoding)

    try:

        try:
            return load_json(body)
        except:
            scrapy.log.msg("Failed to parse as standard json, try others")

            # handle case like var data = [{news}]
            pattern = re.compile(r'(\[[\s\S]+\]|\{[\s\S]+\});?')
            matches = re.findall(pattern, body)
            if matches:
                return load_json(matches[0])
    except Exception, e:
        if encoding is None:
            scrapy.log.msg("Failed to parse, try use encoding GB18030")
            return build_json_response(response, "GB18030")
        else:
            raise


def load_json(content):
    try:
        return json.loads(content)
    except:
        content = content.replace("\n", "")

        re_item = re.compile(r'(?<=[{,])[\t ]*\'?(\w+)\'?[\t ]*(?=:)')  # 替换key中单引号为双引号，或者为没有引号的key加上引号
        content = re_item.sub("\"\g<1>\"", content)
        re_item = re.compile(r'(?<=:)[\t ]*\'([^\']*?)\'')  # 替换value中的单引号为双引号
        content = re_item.sub(lambda match: "\"" + match.group(1).replace("\"", "\\\"") + "\"", content)
        content = re.sub(r'\}[, ]+\]', '}]', re.sub(r'\},{2,}\{', '},{', content))

        return json.loads(content)
