#!/usr/bin/python
import cgi, cgitb
import sys
import os
import pymysql
from config import *
from test_details import *
from no_found import no_found

def print_on_screen_test(conn,cursor,arr_id,status):
	if status=="visited":
		print("""<div class="row" style="margin-left:20px;margin-bottom:20px;"><h2>Visited tests</h2></div><hr/>""")
	for i in arr_id:
		obj=Test()
		f=obj.test_exists(conn,cursor,i)
		if f!=1:
			continue
		obj.test_details(conn,cursor,i)
		test_id=obj.test_id
		test_title=obj.test_title
		test_course=obj.test_course
		test_postedby=obj.test_postedby
		test_sub_string=obj.test_sub_string
		test_time=obj.test_time
		test_total_num=obj.test_total_num
		print("""<div id="%s" class='style_prevu_kit test_div' style="padding:10px;"><div class="row"><div class="col-sm-6"><h3>%s</h3></div><div class="col-sm-6"><span class="glyphicon glyphicon-time"></span> Posted on  %s</div></div><hr /><div class="row"><div class="col-sm-6">Total Questions</div><div class="col-sm-6">%s</div></div><div class="row"><div class="col-sm-6">Course</div><div class="col-sm-6">%s</div></div><div class="row"><div class="col-sm-6">Subjects</div><div class="col-sm-6">%s</div></div><div class="row"><div class="col-sm-6"></div><div class="col-sm-6"><form method="post" action="take_test.php"><input type="hidden" name="test_id" value="%s"/><button type="submit" class="btn btn-primary">Apply now!</button></form></div></div></div><hr/><hr/>"""%(test_id,test_title,test_time,test_total_num,test_course,test_sub_string,test_id))

def update_test_filter_panel(test_name):
	conn,cursor=connect_to_database()
	sql="SELECT test_title,test_course,test_subjects,test_total_num,test_postedby,test_time,test_duration,test_id FROM tests where test_title like '%%{}%%'".format(test_name)
	try:
		cursor.execute(sql)
		if cursor.rowcount<=0:
			return "11%s"%no_found("Tests(0)")
		results = cursor.fetchall()
		response="11"
		for row in results:
			test_title=row[0]
			test_course=row[1]
			test_subjects=row[2]
			test_total_num=row[3]
			test_postedby=row[4]
			test_time=row[5]
			test_duration=row[6]
			test_id=row[7]
			subjects=test_subjects.split("|")
			if len(subjects)==1:
				test_sub_string=str_sub.strip()
			else:
				test_sub_string=""
				j=0
				for i in subjects:
					if j==0:
						test_sub_string+=i.strip()
					else:
						test_sub_string+=", "+i.strip()
					j+=1
				test_sub_string+=""
			response+="""<div id="%s" class='style_prevu_kit test_div' style="padding:10px;"><div class="row"><div class="col-sm-6"><h3>%s</h3></div><div class="col-sm-6"><span class="glyphicon glyphicon-time"></span> Posted on  %s</div></div><hr /><div class="row"><div class="col-sm-6">Total Questions</div><div class="col-sm-6">%s</div></div><div class="row"><div class="col-sm-6">Course</div><div class="col-sm-6">%s</div></div><div class="row"><div class="col-sm-6">Subjects</div><div class="col-sm-6">%s</div></div><div class="row"><div class="col-sm-6"></div><div class="col-sm-6"><form method="post" action="take_test.php"><input type="hidden" name="test_id" value="%s"/><button type="submit" class="btn btn-primary">Apply now!</button></form></div></div></div><hr/><hr/>"""%(test_id,test_title,test_time,test_total_num,test_course,test_sub_string,test_id)
		return response
	except:
		conn.rollback()
		return -99
	conn.close()

def update_filter_visited(candid):
	conn,cursor=connect_to_database()
	sql_visit="select test_id from visited_test where student_id='%s'"%candid
	status="visited"
	try:
		cursor.execute(sql_visit)
		results=cursor.fetchall()
		arr_id=[]
		flag=0
		for row in results:
			testid=row[0]
			flag+=1
			if testid not in arr_id:
				arr_id.append(testid)
			else:
				flag-=1
		if flag==0 or len(arr_id)==0:
			no_found.no_found("Please select your skills to proceed...")
		else:
			print_on_screen_test(conn,cursor,arr_id,status)
	except:
		return "-99"
