#!/usr/bin/python
import cgi, cgitb
import sys
import os
import pymysql
import config
class Test:
	def test_details(self,conn,cursor,testid):
		sql_test="SELECT test_id,test_title,test_course,test_subjects,test_postedby,test_total_num,test_time FROM tests where test_id='%s'"%(testid)
		try:
			cursor.execute(sql_test)
			result_of_test = cursor.fetchone()
			self.test_id=result_of_test[0]
			self.test_title=result_of_test[1]
			self.test_course=result_of_test[2]
			str_sub=result_of_test[3]
			self.test_postedby=result_of_test[4]
			self.test_total_num=result_of_test[5]
			self.test_time=result_of_test[6]
			if self.test_postedby=="-99":
				self.test_postedby="Admin"
			subjects=str_sub.split("|")
			if len(subjects)==1:
				self.test_sub_string=str_sub.strip()
			else:
				self.test_sub_string=""
				j=0
				for i in subjects:
					if j==0:
						self.test_sub_string+=i.strip()
					else:
						self.test_sub_string+=", "+i.strip()
					j+=1
				self.test_sub_string+=""
			return 11
		except:
			conn.rollback()
			return -99
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
