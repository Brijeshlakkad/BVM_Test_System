#!/usr/bin/python
import cgi, cgitb
import sys
import os
import pymysql

class test:
	global test_id,title,course,postedby,sub_string,total_num,time
	def test_details(self,conn,cursor,testid):
		sql_test="SELECT test_id,test_title,test_course,test_subjects,test_postedby,test_total_num,test_time FROM tests where test_id='%s'"%(testid)
		try:
			cursor.execute(sql_test)
			result_of_test = cursor.fetchone()
			self.test_id=result_of_test[0]
			self.title=result_of_test[1]
			self.course=result_of_test[2]
			str_sub=result_of_test[3]
			self.postedby=result_of_test[4]
			self.total_num=result_of_test[5]
			self.time=result_of_test[6]
			if self.postedby=="-99":
				self.postedby="CareerHub"
			subjects=str_sub.split("|")
			if len(subjects)==1:
				self.sub_string=str_sub.strip()
			else:
				self.sub_string=""
				j=0
				for i in subjects:
					if j==0:
						self.sub_string+=i.strip()
					else:
						self.sub_string+=", "+i.strip()
					j+=1
				self.sub_string+=""
		except:
			conn.rollback()
			print("Server is taking load...")
	def test_exists(self,conn,cursor,testid):
		sql_test="SELECT * FROM tests where test_id='%s'"%(testid)
		try:
			cursor.execute(sql_test)
			num = cursor.rowcount
			if num==1:
				return 1
			else:
				return -99
		except:
			return -99
