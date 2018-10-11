#!/usr/bin/python
import cgi, cgitb
import sys
import os
import pymysql
import config
from no_found import no_found
def add_question(testid,que,a1,a2,a3,a4,ans):
	conn,cursor=config.connect_to_database()
	testid=int(testid)
	sql="Insert into questions(question,a1,a2,a3,a4,test_id,que_ans) values('%s','%s','%s','%s','%s','%s','%s')"%(que,a1,a2,a3,a4,testid,ans)
	try:
		cursor.execute(sql)
		testid=int(testid)
		sql2="Select test_total_num from tests where test_id='%s'"%(testid)
		try:
			cursor.execute(sql2)
			results = cursor.fetchone()
			num=results[0]
			n=int(num)
			n+=1
			sql3="Update tests SET test_total_num='%s' where test_id='%s'"%(n,testid)
			try:
				cursor.execute(sql3)
				conn.commit()
				return "1"
			except:
				conn.rollback()
				return "-1"
		except:
			conn.rollback()
			return "-1"
	except:
		conn.rollback()
		return "-1"
	finally:
		conn.close()

def update_question(queid,que,a1,a2,a3,a4,ans):
	conn,cursor=config.connect_to_database()
	sql="Update questions SET question='%s',a1='%s',a2='%s',a3='%s',a4='%s',que_ans='%s' where que_id='%s'"%(que,a1,a2,a3,a4,ans,queid)
	try:
		cursor.execute(sql)
		conn.commit()
		return "1"
	except:
		conn.rollback()
		return "-1"
	finally:
		conn.close()


def show_questions(testid):
	conn,cursor=config.connect_to_database()
	sql="Select que_id,que_time,question FROM questions where test_id='%s'"%(testid)
	try:
		cursor.execute(sql)
		results = cursor.fetchall()
		if cursor.rowcount==0:
			return no_found("Question(0)")
		response="";
		for row in results:
			divid=row[0]
			time=row[1]
			datetime=time.strftime('%H : %M')
			que=row[2]
			response+="""<div id="%s" class='style_prevu_kit que_div' style="padding:40px;"><div class="row"><h2>%s</h2><span class="pull-right"><form action="edit_question.php" method="post" ><input type="hidden" name="que_id" value="%s" /><button class="btn btn-sm btn-primary" type="submit" >Edit <span class="glyphicon glyphicon-pencil"></span></button></form></span><span class="pull-right"><button class="btn btn-sm btn-danger" onclick="remove_que(%s,%s)" >Delete <span class="glyphicon glyphicon-trash"></span></button></span></div><div class="row"><div class="col-md-offset-5 col-md-5 col-md-offset-2"> <span class="glyphicon glyphicon-time"></span> Posted on %s</div></div></div><hr/><hr/>"""%(divid,que,divid,divid,testid,time)
		return response;
	except:
		conn.rollback()
		return "-1"
	finally:
		conn.close()

def remove_questions_of_test(testid):
	conn,cursor=config.connect_to_database()
	sql="Delete from questions where test_id='%s'"%(testid)
	try:
		cursor.execute(sql)
		conn.commit()
		return "1"
	except:
		conn.rollback()
		return "-1"
	finally:
		conn.close()

def remove_question(queid,testid):
	conn,cursor=config.connect_to_database()
	sql="Delete from questions where que_id='%s'"%(queid)
	try:
		cursor.execute(sql)
		sql2="Select test_total_num from tests where test_id='%s'"%(testid)
		try:
			cursor.execute(sql2)
			results = cursor.fetchone()
			num=results[0]
			n=int(num)
			n-=1
			sql3="Update tests SET test_total_num='%s' where test_id='%s'"%(n,testid)
			try:
				cursor.execute(sql3)
				conn.commit()
				return "1"
			except:
				conn.rollback()
				return "-1"
		except:
			conn.rollback()
			return "-1"
	except:
		conn.rollback()
		return "-1"
	finally:
		conn.close()

def total_que_num(testid):
	conn,cursor=config.connect_to_database()
	sql="Select test_total_num From tests where test_id='%s'"%(testid)
	try:
		cursor.execute(sql)
		results = cursor.fetchone()
		num=results[0]
		return num
	except:
		conn.rollback()
		return "-1"
	finally:
		conn.close()
