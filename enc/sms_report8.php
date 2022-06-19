<?php echo '<br>
';
$startdate = $_REQUEST[startdate_year].'-'.$_REQUEST[startdate_month].'-'.$_REQUEST[startdate_date];
$enddate = $_REQUEST[enddate_year].'-'.$_REQUEST[enddate_month].'-'.$_REQUEST[enddate_date];
if ($_REQUEST[semes] == ''){
$Queryxx = mysql_query("select * from dateedu where dateedu_start<='$todate' and dateedu_end>='$todate' limit 0 , 1");
while($arrxx = mysql_fetch_array($Queryxx)){
$_REQUEST[semes] = $arrxx[dateedu_eduyear];
}
}
$sql = "SELECT * FROM dateedu where dateedu_eduyear = '$_REQUEST[semes]'";
$dbquery = mysql_db_query($dbname,$sql);
$result = mysql_fetch_array($dbquery);
if ($startdate != '--'){
$dateedu_start = $startdate;}else{
$dateedu_start = $result[dateedu_start];}
if ($startdate != '--'){
$dateedu_end = $enddate;}else{
$dateedu_end = $result[dateedu_end];}
if ($_REQUEST[search_id] != ''){
$sql = "SELECT * FROM student WHERE (student_id like '$_REQUEST[search_id]%' or group_id = '$_REQUEST[search_id]')  and status = '0'  and school_id = '$_SESSION[school_id]' GROUP BY group_id limit 0 , 1";
$dbquery = mysql_db_query($dbname,$sql);
$result = mysql_fetch_array($dbquery);
$group_id_select = $result[group_id];
if ($group_id_select != ''){
$group_id_select = " and student_group_id = '$group_id_select' ";
}
$sql = "SELECT * FROM student_group WHERE student_group_hidden = '0' $group_id_select GROUP BY grade_name and school_id = '$_SESSION[school_id]'  ORDER BY grade_name desc limit 0 , 1";
$dbquery = mysql_db_query($dbname,$sql);
$result = mysql_fetch_array($dbquery);
$_REQUEST[grade_name] = $result[grade_name];
}
;echo '<form name="form" method="post" enctype="multipart/form-data" action="';echo '?p='.$_REQUEST[p].'&sp=manage&mod='.$_REQUEST[mod].'';;echo '">
<table align="center" width="80%" border="0" class="table table-striped table-hover">
	';
textinput('<b>ค้นหา รหัสนักเรียน</b>','search_id',$_REQUEST[search_id],'text','16','16','0');
;echo '
	<tr><td><b>เลือกระดับชั้น</b></td><td>
		<select size="1" name="grade_name" class="form-control">
		';
if ($_REQUEST[search_id] == ''){
;echo '		<option value=\'\' disabled selected>เลือกระดับชั้น</option>
		';
}
$Query = mysql_query("SELECT * FROM student_group WHERE student_group_hidden = '0' and school_id = '$_SESSION[school_id]'  $group_id_select GROUP BY grade_name ORDER BY grade_name desc");
while($arr = mysql_fetch_array($Query)){
if ($_REQUEST[grade_name] == $arr[grade_name]){$check = 'selected';}else{$check ='';}
echo '<option value="'.$arr[grade_name].'" '.$check.'>'.$arr[grade_name].'</option>';
}
;echo '		</select>
	</td>

	<tr><td><b>คัดกรองข้อมูล</b></td><td>
		<select size="1" name="major_name" class="form-control">
		<option value=\'\'>ข้อมูลทั้งหมด</option>
		';
$Query = mysql_query("SELECT * FROM student_group WHERE student_group_hidden = '0' and school_id = '$_SESSION[school_id]' GROUP BY major_name ORDER BY major_name");
while($arr = mysql_fetch_array($Query)){
if ($_REQUEST[major_name] == $arr[major_name]){$check = 'selected';}else{$check ='';}
echo '<option value="'.$arr[major_name].'" '.$check.'>'.$arr[major_name].'</option>';
}
;echo '		</select>
	</td>

		<tr><td><b>ภาคเรียนปัจจุบัน</b></td><td>';echo $_REQUEST[semes];echo '</td>
	';
$people_startdate = explode('-',$dateedu_start);
$date_select = $people_startdate[2];
$month_select = $people_startdate[1];
$year_select = $people_startdate[0];
dateinput('ตั้งแต่วันที่','startdate_date','startdate_month','startdate_year',$date_select,$month_select,$year_select,'100','1','');
$people_startdate = explode('-',$dateedu_end);
$date_select = $people_startdate[2];
$month_select = $people_startdate[1];
$year_select = $people_startdate[0];
dateinput('ถึงวันที่','enddate_date','enddate_month','enddate_year',$date_select,$month_select,$year_select,'100','1','');
bottoninput('submit','เลือก','','');
;echo '</table>
</form>

<table align=\'center\' border="0" cellpadding="0" cellspacing="0" class="table table-striped table-hover" width="95%">
	<tr>
		<td width="7%" align="center" ><b><center>อันดับที่</center></b></td>
		<td width="33%"><b>ชื่อกลุ่ม</font></b></td>
		<td width="30%" align="center" colspan="1"><b><center>ชื่อครูที่ปรึกษา</center></b></td>
		<td width="10%" align="center" colspan="1"><b><center>จำนวนครั้ง</center></b></td>
		<td width="10%" align="center" colspan="1"><b><center>คิดเป็น %</center></b></td>
		<td width="10%" align="center" colspan="1"><b><center>เรียกดู</center></b></td>


	';
if ($_REQUEST[major_name] != '')
$major_name_search = " and major_name = '$_REQUEST[major_name]' ";
$Query = mysql_query("SELECT * FROM student_group where grade_name = '$_REQUEST[grade_name]'  and school_id = '$_SESSION[school_id]'  AND student_group_hidden = '0' $group_id_select $major_name_search order by   student_group_year desc , student_group_id ");
$x=0;
while($arr = mysql_fetch_array($Query)){
$x++;
if ($_REQUEST[student_group_id] == $arr[student_group_id]){
$bgcolor = ' bgcolor=#F0F0F0 ';
}else{
$bgcolor = '';
}
echo '<tr '.$onmouseover.' '.$bgcolor.' valign="top">
	<td><center>'.$x.'</td><td><b>'.$arr[student_group_id].'</b><br>'.group_name($arr[student_group_id],4).'<br>
	<a href="sms_list.php?student_group_id='.$arr[student_group_id].'" title="รายชื่อในกลุ่ม" class="lightwindow page-options" params="lightwindow_type=external,lightwindow_width=600,lightwindow_height=400"><img src="2.png" border="0" width="16" align="center"> ตรวจสอบรายชื่อในกลุ่มนี้</a>
	</td>
	<td><center>
	
	'.teacher_name($arr[teacher_id1],'1');
if ($arr[teacher_id1] != '')
echo '
<a href="sms_homeroom_print.php?&student_group_id='.$arr[student_group_id].'&teacher_id='.$arr[teacher_id1].'&startdate_year='.$_REQUEST[startdate_year].'&startdate_month='.$_REQUEST[startdate_month].'&startdate_date='.$_REQUEST[startdate_date].'&enddate_year='.$_REQUEST[enddate_year].'&enddate_month='.$_REQUEST[enddate_month].'&enddate_date='.$_REQUEST[enddate_date].'&expo=2#ok" target="_blank" title="ทั้งหมด ภาคเรียนปัจจุบัน"><img src="chk_doc.png" border="0" align="center"></a>

<a href="sms_homeroom_print.php?&student_group_id='.$arr[student_group_id].'&teacher_id='.$arr[teacher_id1].'&startdate_year='.$_REQUEST[startdate_year].'&startdate_month='.$_REQUEST[startdate_month].'&startdate_date='.$_REQUEST[startdate_date].'&enddate_year='.$_REQUEST[enddate_year].'&enddate_month='.$_REQUEST[enddate_month].'&enddate_date='.$_REQUEST[enddate_date].'&expo=4#ok" target="_blank" title="ทั้งหมด ทุกภาคเรียน"><img src="chk_doc.png" border="0" align="center"></a>';
echo '<br>'.teacher_name($arr[teacher_id2],'1');
if ($arr[teacher_id2] != '')
echo '
<a href="sms_homeroom_print.php?&student_group_id='.$arr[student_group_id].'&teacher_id='.$arr[teacher_id2].'&startdate_year='.$_REQUEST[startdate_year].'&startdate_month='.$_REQUEST[startdate_month].'&startdate_date='.$_REQUEST[startdate_date].'&enddate_year='.$_REQUEST[enddate_year].'&enddate_month='.$_REQUEST[enddate_month].'&enddate_date='.$_REQUEST[enddate_date].'&expo=2#ok" target="_blank" title="ทั้งหมด ภาคเรียนปัจจุบัน"><img src="chk_doc.png" border="0" align="center"></a>

<a href="sms_homeroom_print.php?&student_group_id='.$arr[student_group_id].'&teacher_id='.$arr[teacher_id2].'&startdate_year='.$_REQUEST[startdate_year].'&startdate_month='.$_REQUEST[startdate_month].'&startdate_date='.$_REQUEST[startdate_date].'&enddate_year='.$_REQUEST[enddate_year].'&enddate_month='.$_REQUEST[enddate_month].'&enddate_date='.$_REQUEST[enddate_date].'&expo=4#ok" target="_blank" title="ทั้งหมด ทุกภาคเรียน"><img src="chk_doc.png" border="0" align="center"></a>';
echo '<br>'.teacher_name($arr[teacher_id3],'1');
if ($arr[teacher_id3] != '')
echo '
<a href="sms_homeroom_print.php?&student_group_id='.$arr[student_group_id].'&teacher_id='.$arr[teacher_id3].'&startdate_year='.$_REQUEST[startdate_year].'&startdate_month='.$_REQUEST[startdate_month].'&startdate_date='.$_REQUEST[startdate_date].'&enddate_year='.$_REQUEST[enddate_year].'&enddate_month='.$_REQUEST[enddate_month].'&enddate_date='.$_REQUEST[enddate_date].'&expo=2#ok" target="_blank" title="ทั้งหมด ภาคเรียนปัจจุบัน"><img src="chk_doc.png" border="0" align="center"></a>

<a href="sms_homeroom_print.php?&student_group_id='.$arr[student_group_id].'&teacher_id='.$arr[teacher_id3].'&startdate_year='.$_REQUEST[startdate_year].'&startdate_month='.$_REQUEST[startdate_month].'&startdate_date='.$_REQUEST[startdate_date].'&enddate_year='.$_REQUEST[enddate_year].'&enddate_month='.$_REQUEST[enddate_month].'&enddate_date='.$_REQUEST[enddate_date].'&expo=4#ok" target="_blank" title="ทั้งหมด ทุกภาคเรียน"><img src="chk_doc.png" border="0" align="center"></a>';
echo '</td>';
$sql = "SELECT count(*) AS mycount FROM student_home  where student_group_id = '$arr[student_group_id]' and school_id = '$_SESSION[school_id]' and student_home_date >= '$startdate' and student_home_date <= '$enddate' GROUP BY student_group_id ";
$dbquery = mysql_db_query($dbname,$sql);
$result = mysql_fetch_array($dbquery);
echo '<td><center>'.$result[mycount].'</td>';
$resultpercent = (100 / 20 ) * $result[mycount];
echo '<td><center>'.gengraph(number_format($resultpercent,2,'.',''),'','','','100','10').'</td>';
echo '<td><center><a  href="sms_report8_sub.php?p='.$_REQUEST[p].'&sp=edit&search_id='.$_REQUEST[search_id].'&student_group_id='.$arr[student_group_id].'&grade_name='.$_REQUEST[grade_name].'&semes='.$_REQUEST[semes].'&mod='.$_REQUEST[mod].'&startdate_year='.$_REQUEST[startdate_year].'&startdate_month='.$_REQUEST[startdate_month].'&startdate_date='.$_REQUEST[startdate_date].'&enddate_year='.$_REQUEST[enddate_year].'&enddate_month='.$_REQUEST[enddate_month].'&enddate_date='.$_REQUEST[enddate_date].'#1" title="ดูข้อมูลเพิ่มเติม" class="lightwindow page-options" params="lightwindow_type=external"><img src="img/search.png" border="0" alt="เรียกดู"></a></center></td></tr>';
$data0[] = group_name($arr[student_group_id],4);
$data1[] = number_format($resultpercent,2,'.','');
}
;echo '</table>

<br>
<center>
';
if (count($data0) != '0'){
$xxx=0;
foreach ($data0 as $value) {
$xxx++;
if ($xxx != 1)
$return_value1 .= ',';
$return_value1 .= '"'.$value.'"';
}
}
if (count($data1) != '0'){
$xxx=0;
foreach ($data1 as $value) {
$xxx++;
if ($xxx != 1)
$return_value2 .= ',';
$return_value2 .= ''.$value.'';
}
}
;echo '

<script>
	$(function () {
        //-------------
        //- BAR CHART -
        //-------------
        var barChartCanvas = $("#barChart").get(0).getContext("2d");
        var barChart = new Chart(barChartCanvas);
        var barChartData = {

		';
echo ' labels: ['.$return_value1.'], ';
;echo '
          datasets: [
            {
              label: "",
              pointStrokeColor: "#c1c7d1",
              pointHighlightFill: "#fff",
              pointHighlightStroke: "rgba(115, 163, 31, 1)",
		';
echo 'data: ['.$return_value2.']';
;echo '              
            }
          ]
        };
        barChartData.datasets[0].fillColor = "#38b449";
        barChartData.datasets[0].strokeColor = "#38b449";
        barChartData.datasets[0].pointColor = "#38b449";

        var barChartOptions = {
          //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
          scaleBeginAtZero: true,
          //Boolean - Whether grid lines are shown across the chart
          scaleShowGridLines: true,
          //String - Colour of the grid lines
          scaleGridLineColor: "rgba(0,0,0,.05)",
          //Number - Width of the grid lines
          scaleGridLineWidth: 1,
          //Boolean - Whether to show horizontal lines (except X axis)
          scaleShowHorizontalLines: true,
          //Boolean - Whether to show vertical lines (except Y axis)
          scaleShowVerticalLines: true,
          //Boolean - If there is a stroke on each bar
          barShowStroke: true,
          //Number - Pixel width of the bar stroke
          barStrokeWidth: 2,
          //Number - Spacing between each of the X value sets
          barValueSpacing: 5,
          //Number - Spacing between data sets within X values
          barDatasetSpacing: 1,
          //String - A legend template
          legendTemplate: "<ul class=\\"<%=name.toLowerCase()%>-legend\\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\\"background-color:<%=datasets[i].fillColor%>\\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
          //Boolean - whether to make the chart responsive
          responsive: true,
          maintainAspectRatio: false
        };

        barChartOptions.datasetFill = false;
        barChart.Bar(barChartData, barChartOptions);
	});
</script>

		              	<div class="chart-responsive"><canvas id="barChart" height="500"></canvas></div>
</center>
<br>
';?>
