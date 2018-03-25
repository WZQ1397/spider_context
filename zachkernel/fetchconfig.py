# author zach.wang
# -*- coding:utf-8 -*-
import json, logging, os, time, re, sys
from logging.handlers import TimedRotatingFileHandler
from logging.handlers import RotatingFileHandler

abspath = os.path.abspath(os.path.join(os.path.dirname("__file__"),os.path.pardir)) + "/"

class LYM_CONFIG(object): #读取json格式配置
  def __init__(self, value=""):
    self.value = value
  #TODO ZACH TEST SUCCESS
  def read_json(self, para, prefix):
    path = abspath + "config/"
    with open(path + prefix + "config.json", 'r') as f:
      conf = json.loads(f.read())
      #print(conf)
    return conf[para]
  
  #TODO ZACH TEST SUCCESS
  # 判断页面是否使用gzip
  def ungzip(self, data):
    try:
      value = gzip.decompress(data)
    except:
      pass
    print(self.value)
    return self.value
  
  # 把记录写到文件中去
  def write_to_file(self, weblst_sub, sqldata, prefix, title):
    filenum = str(re.split(".html", re.split("/", str(weblst_sub))[-1])[0])
    midpath = 'spiderdata/' + prefix + '/data/'
    filepath = abspath + midpath + filenum + '.sql'
    listval = title + "\n" + weblst_sub + "\n-----------"
        
    with open(abspath + midpath + "list/" + prefix + time.strftime('%Y-%m-%d', time.localtime()) + '.lst', 'a') as f:
      f.write("————————————" + time.strftime('%Y-%m-%d', time.localtime()) + "————————————\n")
    with open(abspath + midpath + "list/" + prefix + time.strftime('%Y-%m-%d', time.localtime()) + '.lst', 'ab') as f:
      f.write(listval.encode())
    with open(filepath, 'wb') as f:
      f.write(sqldata.encode())

# 日志类
class Logger(object):
  def log(self, logName, logLevel, logger, info):
    log_fmt = '%(asctime)s\tFile \"%(filename)s\",line %(lineno)s\t%(levelname)s: %(message)s'
    formatter = logging.Formatter(log_fmt)
    #创建TimedRotatingFileHandler对象
    log_file_handler = TimedRotatingFileHandler(filename=logName, when="D", interval=2, backupCount=7)
    #log_file_handler.suffix = "%Y-%m-%d_%H-%M.log"
    #log_file_handler.extMatch = re.compile(r"^\d{4}-\d{2}-\d{2}_\d{2}-\d{2}.log$")
    log_file_handler.setFormatter(formatter)    
    logging.basicConfig(filename=logName,level=logging.INFO)
    log = logging.getLogger()
    log.addHandler(log_file_handler)
    #循环打印日志
    count = 0
    if logLevel == "INFO" or logLevel == "DEBUG":
      log.info(info)
    if logLevel == "ERROR":
      log.error(info)
    log.removeHandler(log_file_handler)
