#!/usr/bin/python
import cgi, cgitb
import pymysql
from security import *
import test_running
from user_details import *
from faculty_control import *
print("Content-type:text/html;Content-type: image/jpeg\r\n\r\n")
cgitb.enable(display=0, logdir="/path/to/logdir")
form = cgi.FieldStorage()
if form.getvalue('get_test_posted_details'):
    userid = protect_data(form.getvalue('get_test_posted_details'))
    response=get_test_posted_details(userid)
    print("%s"%response.strip())
if form.getvalue('get_test_results'):
    test_id = protect_data(form.getvalue('get_test_results'))
    response=get_test_results(test_id)
    print("%s"%response.strip())
