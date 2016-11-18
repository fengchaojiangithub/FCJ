# !/usr/bin/python//
# -*- coding: UTF-8 -*-
print     
import urllib
import urllib2
import re
import MySQLdb

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

    #get navCode
    def getNavCode(self):
        page = self.getPage()
        pattern = re.compile('<div id="headline-tabs" class="mod-headline-tab">(.*?)<style>', re.S)
        navCode = re.search(pattern, page)
        return navCode.group(1)
    #get navCode
    def getTitle(self):
        page = self.getNavCode()
        pattern = re.compile('<a href="(http://.*?")?>(.*?)</a>', re.S)
        itmes = re.findall(pattern, page)
        for item in itmes:
            print item[0], self.tranTags(item[1])
    
                                                                  
newi = News()
print newi.getTitle()


