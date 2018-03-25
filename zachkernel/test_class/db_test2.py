import pymysql
conn = pymysql.connect(host='127.0.0.1',port=3306,user='info_51lym_vip',password='147ZAQ',db='info_51lym_vip')
#conn = pymysql.connect('127.0.0.1',3306,'info_51lym_vip','147ZAQ','info_51lym_vip')
cur = conn.cursor()  
cur.execute("select version()")  
for i in cur:  
    print(i)  
cur.close()  
conn.close()
