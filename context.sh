#!/bin/bash
PW=147ZAQ
USER=info_51lym_vip
DB=info_51lym_vip
SPIDER_PATH=/www/spider_context/
SQL_FILE_NAME=joint.sql
function sql_import()
{
	ABS_SQL=$SPIDER_PATH$lst/$SQL_FILE_NAME
	ls $ABS_SQL >/dev/null 2>&1 && echo ok || touch $ABS_SQL
	python3.4 joint.py
	sleep 2
	mysql -u$USER -p$PW -f -D$DB <$ABS_SQL
}
cd $SPIDER_PATH
for lst in ym1 ym2
do
	cd $lst
	#mv data/* data_bk
	find data -ctime +3 -type f -exec mv {} data_bk \;
	sql_import $lst
	sleep 10
	cd ..
done
