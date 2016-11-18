#!/usr/bin/python//
# -*- coding: UTF-8 -*-
# print "Content-type:text/html"
print "Content-type:text/html"
print 
from conf import *   
import urllib
import urllib2
import re
import cgi
import MySQLdb
res = MysqldbHelper()

class News:
    #init
    def __init__(self):
        self.url = "http://news.baidu.com/"

    #convert div to ''
    def tranTags(self, x):
        pattern = re.compile('<div.*?</div>')
        res = re.sub(pattern, '', x)
        return res
 
    #getPage
    def getPage(self):
        url = self.url
        request = urllib2.Request(url)
        response = urllib2.urlopen(request)
        return response.read()

    #get navCode
    def getNavCode(self):
        page = self.getPage()
        pattern = re.compile('(<div id="menu".*?)<i class="slogan"></i>', re.S)
        navCode = re.search(pattern, page)
        return navCode.group(1)
        
    #get nav
    def getNav(self):
        navCode = self.getNavCode()
        pattern = re.compile('<a href="(http://.*?/).*?>(.*?)</a>', re.S)
        itmes = re.findall(pattern, navCode)
        return itmes
        # for item in itmes:
        #     print item[0], self.tranTags(item[1])
        #     
        #     
        #    
newi = News()
new = newi.getNav()
# print new
res = res.getadd(new)

# # 打开数据库连接
# db = MySQLdb.connect("localhost","root","root","python",charset="GBK")
# cursor = db.cursor()
# newi = News()
# new = newi.getNav()

# for i in new:
#     print i[0],newi.tranTags(i[1])
#     n_name = newi.tranTags(i[1])
#     sql = """INSERT INTO news_nav(n_name,n_url)VALUES(%s, %s )""" % ("'"+n_name+"'","'"+i[0]+"'")
#     #vala = (vall,val[0])
#     try:
#         cursor.execute(sql)
#         db.commit()
#     except:
#         db.rollback()

