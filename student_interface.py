#!/usr/bin/python
import cgi, cgitb
import pymysql
from security import *
import update_filter_test
import test_running
from user_details import *
import student_reload_certificates
print("Content-type:text/html;Content-type: image/jpeg\r\n\r\n")
cgitb.enable(display=0, logdir="/path/to/logdir")
form = cgi.FieldStorage()
if form.getvalue('test_name') and form.getvalue('student_id'):
    test_name = protect_data(form.getvalue('test_name'))
    student_id = protect_data(form.getvalue('student_id'))
    response=update_filter_test.update_test_filter_panel(test_name)
    print("%s"%response.strip())
if form.getvalue('visited_tests'):
	candid = protect_data(form.getvalue('visited_tests'))
	update_filter_test.update_filter_visited(candid)

if form.getvalue('que_reload') and form.getvalue('current_id'):
	testid = protect_data(form.getvalue('que_reload'))
	current_id = protect_data(form.getvalue('current_id'))
	test_running.que_reload(testid,current_id)

if form.getvalue('delete_visited_test'):
	running_testid = protect_data(form.getvalue('delete_visited_test'))
	test_running.delete_visited_test(running_testid)

if form.getvalue('get_student_any_value_by_id') and form.getvalue('userid'):
    field = protect_data(form.getvalue('get_student_any_value_by_id'))
    userid = protect_data(form.getvalue('userid'))
    response=get_student_any_value_by_id(userid,field)
    print("%s"%response.strip())
if form.getvalue('certificate_reload'):
	c_id9 = protect_data(form.getvalue('certificate_reload'))
	student_reload_certificates.reload_certificate(c_id9)

if form.getvalue('certificate_total'):
	c_id10 = protect_data(form.getvalue('certificate_total'))
	student_reload_certificates.certificate_total_count(c_id10)
