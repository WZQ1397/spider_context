# author zach.wang
# -*- coding:utf-8 -*-

from fetchconfig import LYM_CONFIG
import time

db_default_dict = {'typecho':'typecho_contents','zblog':'zbp_post','wordpress':'wp_posts'}
#dbtype = 'typecho'

class DB_SELECT(object):
  # this is program DB type 
  def __init__(self,dbtype):
    self.dbtype = str(dbtype).lower()

  def dbselect(self,postname,listtitle,lymdata):
    #print(postname)
    ctime = str(int(time.time()))
    try:
      if postname == "x":
        postname = db_default_dict[self.dbtype]
        print(postname)
      if self.dbtype == 'typecho':	
        postsql = "insert into " + postname + "(`title`,`slug`,`created`,`modified`,`text`,`order`,`authorId`,`type`,`status`,`allowComment`,`allowPing`,`allowFeed`) values('" + listtitle + "','" + listtitle + "'," + ctime + "," + ctime + ",'" + lymdata + "',0,1,'post','publish','1','1','1');insert into typecho_relationships(cid) select cid from typecho_contents where slug='" + listtitle + "';"
      elif self.dbtype == 'discuz':
        sql_thread = "INSERT INTO `pre_forum_thread` (`fid`,`posttableid`,`author`,`authorid`,`subject`,`dateline`,`lastpost`,`lastposter`) values(" + father_forum +","+ posttableid +"," + ",'admin'," + authorid + ",'" + listtitle + "','" + ctime + "','" + ctime + "','admin');"
        sql_post = "INSERT INTO `pre_forum_post` (`pid`, `fid`, `tid`, `first`, `author`, `authorid`, `subject`, `dateline`, `message`, `useip`) VALUES(" + posttableid + "," + father_forum + "," +  Tid + "," + 1 + ",'admin'," + 1 + "," + listtitle + "," + ctime + ",'" + lymdata + "'," + "'127.0.0.1');"
        postsql = sql_thread + sql_post
      elif self.dbtype == 'wordpress':
        postsql = "INSERT INTO `wp_posts` (`post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_category`, `post_excerpt`) VALUES (" + 1 + ","+ ctime + "," + ctime + ",'" + lymdata + "','" + listtitle + "','" + lymdata[:50] + "','" + listtitle + "');"
      elif self.dbtype == 'zblog':
        postsql = "INSERT INTO `postname` (`log_ID`, `log_CateID`, `log_AuthorID`, `log_Tag`, `log_Status`, `log_Type`, `log_Alias`, `log_IsTop`, `log_IsLock`, `log_Title`, `log_Intro`, `log_Content`, `log_PostTime`, `log_CommNums`, `log_ViewNums`, `log_Template`, `log_Meta`) VALUES(1, 1, 1,'" + listtitle + "', 0, 0, '', 0, 0,'" + listtitle + "', '" + listtitle + "', '" + lymdata + "'," + str(int(time.time())) + ", 0, 1, '', '');"
      else:
        print("not correct type")  
    except:
        raise Exception("post not exist!")	
  	
    return postsql

#TODO ZACH TEST SUCCESS
class DB_test(object):
  #this is database type
  def __init__(self,dbtype):
    self.dbtype = str(dbtype).lower()

  def return_info(self,flag):
    if flag == 1:
      info = "database connect failed!"
    else:
      info = "database connect success!"
    return info

  def db_test(self, mypassword, mydb, myport = "", myhost = '127.0.0.1', myuser = 'root'):
    fault = 0
    global port
    if self.dbtype == 'mysql':
      import pymysql
      if myport == "":
        myport = 3306
      try:
        conn = pymysql.connect(host = myhost, port = myport, user = myuser, password = mypassword, db = mydb)
        point = conn.cursor()
        point.execute("select version()")
      except Exception:
        print("error:", Exception)
        conn.rollback()
        fault = 1
      finally:
        #最终关闭数据库连接
        conn.close()
  
    if self.dbtype == 'mongo':
      if myport == "":
        myport = 3306
      try:
        from pymongo import MongoClient
        conn = MongoClient(myhost, myport)
        dbname = conn.mydb
        # 连接mydb数据库， 没有则自动创建
    
        my_set = dbname.test_set
        # 使用test_set集合， 没有则自动创建
    
      except Exception:
        print("error:", Exception)
        fault = 1

      finally: #最终关闭数据库连接
        dbname.disconnect()
    
    print(self.return_info(fault))