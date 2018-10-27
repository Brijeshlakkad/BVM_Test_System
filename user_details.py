#!/usr/bin/python
import pymysql
import cgi, cgitb
import sys
import os
import random
import config
import find_file
import string
import private_data
from smtplib import SMTP_SSL as SMTP
from email.mime.text import MIMEText
class student:
	def student_details(self,user):
		sql="select * from students where student_email='%s'"%user
		conn,cursor=config.connect_to_database()
		try:
			cursor.execute(sql)
			results=cursor.fetchall()
			for row in results:
				self.student_id=row[0]
				self.student_idno=row[1]
				self.student_fname=row[2]
				self.student_lname=row[3]
				self.stundet_email=row[4]
				self.student_password=row[5]
				self.student_mobile_no=row[6]
		except:
			print("Error")
		conn.close()
class student_by_id:
	def student_details(self,userid):
		sql="select * from students where student_id='%s'"%userid
		conn,cursor=config.connect_to_database()
		try:
			cursor.execute(sql)
			results=cursor.fetchall()
			for row in results:
				self.student_id=row[0]
				self.student_idno=row[1]
				self.student_fname=row[2]
				self.student_lname=row[3]
				self.stundet_email=row[4]
				self.student_password=row[5]
				self.student_mobile_no=row[6]
		except:
			print("Error")
		conn.close()

def get_student_any_value(user,f):
	stu=student()
	stu.student_details(user)
	if f=="student_id":
		return stu.student_id
	if f=="student_idno":
		return stu.student_idno
	elif f=="student_fname":
		return stu.student_fname
	elif f=="student_lname":
		return stu.student_lname
	elif f=="student_email":
		return stu.student_email
	elif f=="student_password":
		return stu.student_password
	elif f=="student_mobile_no":
		return stu.student_mobile_no
	else:
		return 0
def get_student_any_value_by_id(userid,f):
	stu=student_by_id()
	stu.student_details(userid)
	if f=="student_id":
		return stu.student_id
	if f=="student_idno":
		return stu.student_idno
	elif f=="student_fname":
		return stu.student_fname
	elif f=="student_lname":
		return stu.student_lname
	elif f=="student_email":
		return stu.student_email
	elif f=="student_password":
		return stu.student_password
	elif f=="student_mobile_no":
		return stu.student_mobile_no
	else:
		return 0
class faculty:
	def faculty_details(self,user):
		sql="select * from faculty where f_email='%s'"%user
		conn,cursor=config.connect_to_database()
		try:
			cursor.execute(sql)
			results=cursor.fetchall()
			for row in results:
				self.f_id=row[0]
				self.f_idno=row[1]
				self.f_fname=row[2]
				self.f_lname=row[3]
				self.stundet_email=row[4]
				self.f_password=row[5]
				self.f_mobile_no=row[6]
		except:
			print("Error")
		conn.close()
class faculty_by_id:
	def faculty_details(self,userid):
		sql="select * from faculty where f_id='%s'"%userid
		conn,cursor=config.connect_to_database()
		try:
			cursor.execute(sql)
			results=cursor.fetchall()
			for row in results:
				self.f_id=row[0]
				self.f_idno=row[1]
				self.f_fname=row[2]
				self.f_lname=row[3]
				self.stundet_email=row[4]
				self.f_password=row[5]
				self.f_mobile_no=row[6]
		except:
			print("Error")
		conn.close()

def get_faculty_any_value(user,f):
	fa=faculty()
	fa.faculty_details(user)
	if f=="f_id":
		return fa.f_id
	elif f=="f_fname":
		return fa.f_fname
	elif f=="f_lname":
		return fa.f_lname
	elif f=="f_email":
		return fa.f_email
	elif f=="f_password":
		return fa.f_password
	elif f=="f_mobile_no":
		return fa.f_mobile_no
	else:
		return 0
def get_faculty_any_value_by_id(userid,f):
	fa=faculty_by_id()
	fa.faculty_details(userid)
	if f=="f_id":
		return fa.f_id
	elif f=="f_fname":
		return fa.f_fname
	elif f=="f_lname":
		return fa.f_lname
	elif f=="f_email":
		return fa.f_email
	elif f=="f_password":
		return fa.f_password
	elif f=="f_mobile_no":
		return fa.f_mobile_no
	else:
		return 0
def get_any_document(user,doc):
	return find_file.find_student_get_file(user,doc)
