# author zach.wang
# -*- coding:utf-8 -*-
import os
from fetchconfig import LYM_CONFIG
#used to foreach sql files to single
#TODO ZACH TEST SUCCESS
#gain current path
PATH = os.path.abspath(os.path.dirname(__file__))

#fetch var to find data dir
PREFIX = 'ym1'
#print(PATH)

#main function
if(os.path.exists('joint.sql')):
    os.remove('joint.sql')
for filename in os.listdir(PREFIX + 'data'):
    with open('joint.sql', 'a') as f:
        f.write("source " + PATH + "/" + PREFIX + "/" + filename + "\n")
