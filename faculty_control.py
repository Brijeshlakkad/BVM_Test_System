#!/usr/bin/python
import sys
import os
from config import *
from no_found import *
from test_details import Test
from user_details import *
def get_test_posted_details(userid):
    conn,cursor=connect_to_database()
    sql="select test_id from tests where test_postedby='%s'"%(userid)
    try:
        cursor.execute(sql)
        results=cursor.fetchall()
        if cursor.rowcount==0:
            return no_found("You have not posted any test yet. :(")
        response=""
        for row in results:
            testid=row[0]
            t=Test()
            t.test_details(conn,cursor,testid)
            response+="""<div id="%s" style="padding:20px;"><div class="row"><div class="col-sm-6"><h3>%s</h3><span><button class="btn btn-sm btn-primary" id="view_insights" onclick="view_insights('%s')" type="submit" id="brij">View Insights and Results <span class="glyphicon glyphicon-search"></span></button></div><div class="col-sm-6"><span class="glyphicon glyphicon-time"></span> Posted on  %s</div></div><hr /><div style="line-height:45px;"><div class="row"><div class="col-sm-6">Total Questions</div><div class="col-sm-6">%s</div></div><div class="row"><div class="col-sm-6">Course</div><div class="col-sm-6">%s</div></div><div class="row"><div class="col-sm-6">Subjects</div><div class="col-sm-6">%s</div></div></div></div><hr/><hr/>
            """%(t.test_id,t.test_title,t.test_id,t.test_time,t.test_total_num,t.test_course,t.test_sub_string)
        response+="""
        <script>
        function view_insights(test_id){
            $.ajax({
        		type: 'POST',
        		url: 'faculty_interface.py',
        		data: 'get_test_results='+test_id,
        		success  : function (data)
        		{
                    $("#"+test_id).html(data);
        		}
        	});
        }
        </script>"""
        return response
    except:
        return -99
    finally:
        conn.close()
def get_test_results(test_id):
    conn,cursor=connect_to_database()
    t=Test()
    f=t.test_details(conn,cursor,test_id)
    if f!=11:
        return -99
    sql="select result_id,student_id,test_id,result_right,result_attended,result_total,result_left_time,result_total_time,result_attempt,result_updated_time from results where test_id='%s' ORDER BY result_updated_time DESC"%(test_id)
    try:
        cursor.execute(sql)
        results=cursor.fetchall()
        if cursor.rowcount==0:
            return no_found("No one has given test yet.")
        for row in results:
            result_id=row[0]
            student_id=row[1]
            test_id=row[2]
            result_right=row[3]
            result_attended=row[4]
            result_total=row[5]
            result_left_time=row[6]
            result_total_time=row[7]
            result_attempt=row[8]
            result_updated_time=row[9]
            result_wrong=int(result_total)-int(result_right)
            result_remained=int(result_total)-int(result_attended)
            result_taken_time=int(result_total_time)-int(result_left_time)
            hours=0
            min=0
            sec=0
            if result_taken_time%60!=0:
                sec=result_taken_time%60
                min=result_taken_time/60
            if min%60!=0:
                min=min+min%60
                hours=min/60
            student_idno=get_student_any_value_by_id(student_id,"student_idno")
            student_fname=get_student_any_value_by_id(student_id,"student_fname")
            student_lname=get_student_any_value_by_id(student_id,"student_lname")
            result_taken_time="%s Hours %s Minutes %s Seconds"%(hours,min,sec)
            response="""<div class="row"><h3>%s</h3><div class="row">
            <div id="show_result" class="row">
    		<div class="col-lg-offset-2 col-lg-8 col-lg-offset-2">
            <h4>%s %s</h4> ID Number: %s
    			<table class="table">
    				<tr>
    					<th class="success">Right</th>
    					<th class="danger">Wrong</th>
    					<th class="info">Attended</th>
    					<th class="warning">Remained</th>
    					<th class="active">Total Questions</th>
    				</tr>
    				<tr>
    					<td class="success">%s</td>
    					<td class="danger">%s</td>
    					<td class="info">%s</td>
    					<td class="warning">%s</td>
    					<td class="active">%s</td>
    				</tr>
    			</table>
    			<div style="background-color: black;color: white;font-size: 15px;">Solved in  %s</div>
    			</div>
    		</div>
            </div></div>"""%(t.test_title,student_fname,student_lname,student_idno,result_right,result_wrong,result_attended,result_remained,result_total,result_taken_time)
    except:
        return -99
    finally:
        conn.close()
    return response
