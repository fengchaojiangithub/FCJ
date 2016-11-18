#!D:\shixun1\python\python.exe
# -*- coding: UTF8 -*-
print
import urllib
import urllib2
import MySQLdb
import re

class News:

    #init
    def __init__(self):
        self.url = "http://news.baidu.com/"

    #convert div to ''
    def tranTags(self, x):
        pattern = re.compile('<img.*?>')
        res = re.sub(pattern, '', x)
        return res

    #getPage
    def getPage(self):
        url = self.url
        request = urllib2.Request(url)
        response = urllib2.urlopen(request)
        return response.read()

    #get titleCode
    def getTitl(self):
        page = self.getPage()
        pattern = re.compile('<div id="pane-news"(.*?)<div class=".*?" id="tupianxinwen">', re.S)
        code = re.search(pattern,page)
        return  code.group()

    #get title
    def getTitle(self):
        page = self.getTitl()
        pattern = re.compile('<a href="(http://.*?").*?>(.*?)</a>', re.S)
        items = re.findall(pattern,page)
        return items



# 打开数据库连接
db = MySQLdb.connect("localhost","root","root","python",charset="GBK")
cursor = db.cursor()
newi = News()
new = newi.getTitle()

for i in new:
    print i[0],newi.tranTags(i[1])
    t_title = newi.tranTags(i[1])
    sql = """INSERT INTO news_title(t_title,t_url)VALUES(%s, %s )""" % ("'"+t_title+"'","'"+i[0]+"'")
    #vala = (vall,val[0])
    try:
        cursor.execute(sql)
        db.commit()
    except:
        db.rollback()
