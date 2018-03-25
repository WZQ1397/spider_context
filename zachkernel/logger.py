# author zach.wang
# -*- coding:utf-8 -*-
from fetchconfig import LYM_CONFIG,Logger
import datetime, os
class Log(object):
  def log_sys(self, textinfo, level="INFO", prefix=""):
    #set logger basic config
    Logdir = os.path.abspath(os.path.join(os.path.dirname("__file__"),os.path.pardir)) + '/spiderdata/log/' 
    Logname = prefix + datetime.datetime.now().strftime('%Y-%m-%d') + ".log"
    
    #fetch var to monitor status
    target_file = 'spider.py'
    LOG_LEVEL = level.upper()
    
    #generate log file
    Logger().log(logName=Logdir + Logname, logLevel=LOG_LEVEL, logger=target_file, info=textinfo)

