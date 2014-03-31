#!/usr/bin/python
import MySQLdb
import subprocess
import os
import resource
import signal

def setlimit1():
    resource.setrlimit(resource.RLIMIT_CPU, (1, 1))

def setlimit2():
    resource.setrlimit(resource.RLIMIT_CPU, (1, 1))

db = MySQLdb.connect("localhost","root","apple","judge" )
cursor = db.cursor()


while (1):
	cursor.execute("select * from queue limit 1")
	data = cursor.fetchone()
	if (data):
		fname=data[0]
		uname=data[1]
		#pstr="sudo gcc file/"+str(data[2])+"/"+fname + " 2 >& file/"+str(data[2])+"/err.txt"
		proc = subprocess.call("g++ file/"+str(data[2])+"/"+fname + " 2 >& file/"+str(data[2])+"/err.txt",shell=True)
		cursor.execute("delete from queue limit 1")
		#db.commit()

db.close()