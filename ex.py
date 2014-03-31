#!/usr/bin/python
import MySQLdb
import subprocess
import os
import resource
import signal
import filecmp

def setlimits():
    resource.setrlimit(resource.RLIMIT_CPU, (1, 1))




while (1):
	db = MySQLdb.connect("localhost","root","apple","judge" )
	cursor = db.cursor()
	db.commit()
	cursor.execute("select * from queue limit 1")
	data = cursor.fetchone()
	if(data):
		print data[0]
	else:
		print "bye"
	if (data):
		fname=data[0]
		uname=data[1]
		flag=0
		pstr="g++ file/"+str(data[2])+"/"+fname + " 2> file/"+str(data[2])+"/err.txt -o file/"+str(data[2])+"/test"
		proc = subprocess.call(pstr,shell=True)
		st = os.stat("file/"+str(data[2])+"/err.txt")
		if (st.st_size==0):
			for num in range(1,5):
				pstr="./file/"+str(data[2])+"/test 0< file/"+str(data[2])+"/input"+str(num)+".txt 1> file/"+str(data[2])+"/output.txt"
				proc = subprocess.call(pstr,shell=True,preexec_fn=setlimits)
				print proc
				if (proc >= 137):
					sql="insert into output values('"+fname+"',1,0.0)"
					cursor.execute(sql)
					db.commit()
					flag=1
					os.system("rm file/"+str(data[2])+"/test")
					os.system("rm file/"+str(data[2])+"/err.txt")
					os.system("rm file/"+str(data[2])+"/output.txt")
					break
				elif (proc==0):
					run=filecmp.cmp("file/"+str(data[2])+"/out"+str(num)+".txt","file/"+str(data[2])+"/output.txt")
					if(run!=True):
						sql="insert into output values('"+fname+"',3,0.0)"
						cursor.execute(sql)
						db.commit()
						flag=1
						os.system("rm file/"+str(data[2])+"/test")
						os.system("rm file/"+str(data[2])+"/err.txt")
						os.system("rm file/"+str(data[2])+"/output.txt")
						break
				else:
					sql="insert into output values('"+fname+"',4,0.0)"
					cursor.execute(sql)
					db.commit()
					flag=1
					os.system("rm file/"+str(data[2])+"/test")
					os.system("rm file/"+str(data[2])+"/err.txt")
					os.system("rm file/"+str(data[2])+"/output.txt")
					break
			if(flag==0):
				obj=resource.getrusage(resource.RUSAGE_CHILDREN)
				obj=obj[0]+obj[1]
				sql="insert into output values('"+fname+"',0,"+str(obj)+")"
				cursor.execute(sql)
				db.commit()
				sql="update questions set subm=subm+1 where quesno="+str(data[2])
				cursor.execute(sql)
				db.commit()
				os.system("rm file/"+str(data[2])+"/test")
				os.system("rm file/"+str(data[2])+"/err.txt")
				os.system("rm file/"+str(data[2])+"/output.txt")
		else:
			sql="insert into output values('"+fname+"',2,0.0)"
			cursor.execute(sql)
			db.commit()
			os.system("rm file/"+data[0]+"/err.txt")
		os.system("rm file/"+str(data[2])+"/test")
		os.system("rm file/"+str(data[2])+"/"+fname)
		cursor.execute("delete from queue limit 1")
		db.commit()
		db.close()
	#break

	

#db.close()