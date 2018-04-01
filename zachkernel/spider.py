# author zach.wang
# -*- coding:utf-8 -*-

from bs4 import BeautifulSoup
from urllib import request
import gzip, re, time, os, random, sys
from fetchconfig import LYM_CONFIG
from db_select import DB_SELECT
from logger import Log

header = ""
#配置简单对付防采集
if header == "" :
    #print("check point")
    header = {'User-Agent': 'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; WOW64; Trident/5.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; .NET4.0C; .NET4.0E)'}
else:
    header = LYM_CONFIG().read_json('email',)
	
listtitle, lymdata ,weblst_sub = "", "", ""
#抓取页面主地址
url = 'https://www.haoyangmao8.com/page_1.html'
#url = 'http://www.wanzhuanlea.com/17358.html'

#文件前缀
prefix = 'lym'

#获取方式xml,html5lib
get_method = 'html5lib'

#TODO
###抓取匹配区域

LIST_TAG = 'div'
LIST_ATTR = "read-more"
LIST_SPLIT_TUPLE1 = ["\""]
LIST_SPLIT_TUPLE2 = [1]
ARTICLE_TAG = 'dd'
ARTICLE_ATTR = "kan"

SPLITDICT = {'<!--':0,'<script>':0,'<div id="wendibu">':0}
SUBSTRDICT = {'haoyangmao8.*.html':"51lym.vip"}
SUBNUMDICT = {'haoyangmao8.*.html':0}
CHANGEDICT = {'<dd class="kan">':'我要撸羊毛51lym.vip'}

#TODO
LOG_CHOICE = 'info'

lst = []

def ungzip(data, url):
    try:
        data = gzip.decompress(data)
    except:
        pass
    return data

def log_list(choice,lymdata,weblst_sub):
    choice = choice.lower();
    ch_dict = {'debug':20,'info':10,'error':0}
    if ch_dict[choice] >= 20:
        Log().log_sys(lymdata,'debug',prefix)
    if ch_dict[choice] >= 10:
        Log().log_sys(weblst_sub,prefix)
    if ch_dict[choice] >= 0:
        __console__=sys.stdout
        f_handler=open(os.path.abspath(os.path.join(os.path.dirname("__file__"),os.path.pardir)) + '/spiderdata/log/err.log', 'a')
        sys.stderr=f_handler
        sys.stdout=__console__


def weblist(main):
    req = request.Request(main,headers=header)
    res = request.urlopen(req)
    print(header)
    print("----------")
    #处理数据是否gzip
    data = ungzip(res.read(),main)
    soup = BeautifulSoup(data,get_method)
    count = 0
    
    
    #获取页面文章列表
    for weblst in list(soup.find_all(LIST_TAG,class_=LIST_ATTR)):
        i = 0
        while len(LIST_SPLIT_TUPLE1) > i:
            listlink = re.split(LIST_SPLIT_TUPLE1[i], str(weblst.a))[LIST_SPLIT_TUPLE2[i]]
            lst.append(listlink)
            #print(re.split('"', str(weblst)))
            i = i+1
   
    print(lst)
    print("gain {} article\n".format(str(len(lst))))
    time.sleep(3)

    for weblst_sub in lst:
        req_context = request.Request(weblst_sub, headers=header)
        res_context = request.urlopen(req_context)
        context = ungzip(res_context.read(), weblst_sub)
        context_data = BeautifulSoup(context, 'html5lib')

        #设置发布时间
        posttime = int(time.time())
        #获取标题
        listtitle = context_data.find('title').text
        
        #初始化数据元素树
        lymdata = str(context_data.find_all(ARTICLE_TAG,class_=ARTICLE_ATTR))
        
   
        for k,v in SPLITDICT.items():
            print(k,v)
            lymdata = re.split(k,str(lymdata))[v]
  
        for k,v in SUBSTRDICT.items():
            print(k,v)
            lymdata = re.subn(k,v,lymdata)[SUBNUMDICT[k]]

        #替换关键词
        for k,v in CHANGEDICT.items():
            print(k,v)
            lymdata = lymdata.replace(k,v)
  
        #TODO
        DB_CHOICE = DB_SELECT('typecho').dbselect('x',listtitle,lymdata)
                                           
        sqldata = DB_CHOICE
        print(listtitle,sqldata)
        time.sleep(random.randint(1,5))

        LYM_CONFIG().write_to_file(weblst_sub, sqldata, prefix, listtitle)

        log_list('debug',lymdata,weblst_sub)

        #lst.remove(weblst_sub)
        count = count + 1
    print("fetch {} article success".format(count))

weblist(url)

