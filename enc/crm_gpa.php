<?php 
session_start();
$Query =  mysql_query ('SELECT * FROM config ORDER BY config_id ');
while($arr = mysql_fetch_array($Query)){
$xyz = $arr[config_id];
$config_value[$xyz] = $arr[config_value];
}
$_SESSION[school_id] = $_REQUEST[school_id];
if ($_REQUEST[semes] == ''){
$Queryxx = mysql_query("select * from dateedu where dateedu_start<='$todate' and dateedu_end>='$todate' limit 0 , 1");
while($arrxx = mysql_fetch_array($Queryxx)){
$_REQUEST[semes] = $arrxx[dateedu_eduyear];
}
}
$sqlx = "select count(*) as maxstudent FROM student WHERE status = '0' and school_id = '$_REQUEST[school_id]' ";
$dbqueryx = mysql_db_query($dbname,$sqlx);
$resultx = mysql_fetch_array($dbqueryx);
;echo '
<table align=\'center\' border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" width="95%">
	<tr><td colspan="2"><b>ข้อมูลคะแนนเก็บเฉลี่ย<b></td>
	<tr>
';
if ($_REQUEST[grade_id] != ''){
;echo '		<td width="35%" align="center"><b>ชื่อกลุ่ม</b></td>
';
}else{
;echo '		<td width="35%" align="center"><b>ระดับชั้น</b></td>
';
}
;echo '
		<td width="35%" align="center"><b></b></td>
		<td width="15%" align="center" ><b>คะแนนเก็บเฉลี่ย</b></td>
		<td width="15%" align="center" ><b>ผลการเรียนเฉลี่ย</b></td>
	<tr><td colspan="4"><hr size="1"></td>
		';
$x=0;
$yy=0;
$avg_score = 0;
if ($_REQUEST[grade_id] != ''){
$sql = "SELECT * , COUNT(*) AS MySUM FROM student where status = '0' and school_id = '$_REQUEST[school_id]' and grade_id = '$_REQUEST[grade_id]' GROUP BY  group_id ";
}else{
$sql = "SELECT * , COUNT(*) AS MySUM FROM student where status = '0' and school_id = '$_REQUEST[school_id]' GROUP BY  grade_id ";
}
$result = mysql_db_query($dbname,$sql);
while($arr = mysql_fetch_array($result)){
$x++;
if ($_REQUEST[grade_id] != ''){
$Query1 = mysql_query("SELECT * FROM student where grade_id = '$_REQUEST[grade_id]' and group_id = '$arr[group_id]'  and school_id = '$_REQUEST[school_id]' GROUP BY  group_id");
}else{
$Query1 = mysql_query("SELECT * FROM student where grade_id = '$arr[grade_id]' and school_id = '$_REQUEST[school_id]' GROUP BY  group_id");
}
while($arrx = mysql_fetch_array($Query1)){
$Query2 = mysql_query("select * from studing where student_group_id = '$arrx[group_id]' and semes = '".$_REQUEST[semes]."' and school_id = '$_REQUEST[school_id]' 
		GROUP BY subject_id , teacher_id , student_group_id
		ORDER BY subject_id , teacher_id , student_group_id ");
while($arrxx = mysql_fetch_array($Query2)){
$Query_gpa = mysql_query("select studing_data.semes , studing_data.subject_id , studing_data.school_id , studing_data.teacher_id , studing_data.student_id , ROUND(SUM(studing_data.student_score), 1) as score , student.school_id , student.student_id , student.status from student , studing_data 
				where studing_data.semes = '".$arrxx[semes]."' and studing_data.subject_id = '".$arrxx[subject_id]."' and studing_data.school_id = '".$_REQUEST[school_id]."' and studing_data.teacher_id  = '".$arrxx[teacher_id]."' 
				and studing_data.student_id = student.student_id 
				and studing_data.school_id = student.school_id 
				and student.status != '1' 
				GROUP BY studing_data.semes , studing_data.subject_id , studing_data.school_id , studing_data.teacher_id , studing_data.student_id 
				ORDER BY score desc");
while($arr_gpa = mysql_fetch_array($Query_gpa)){
$sqlscore = "SELECT student_id FROM studing_comment WHERE student_id = '$arr_gpa[student_id]' and  semes = '$arr_gpa[semes]' and school_id = '$arr_gpa[school_id]' and subject_id = '$arr_gpa[subject_id]' and teacher_id = '$arr_gpa[teacher_id]' GROUP BY student_id ";
$dbqueryscore = mysql_db_query($dbname,$sqlscore);
$num_rows = mysql_num_rows($dbqueryscore);
if ($num_rows == '1'){}else{
$yy++;
$avg_score = $avg_score +$arr_gpa[score];
}
}
}
}
if ($avg_score == 0){
$avg_score = 0;
}else{
$avg_score = $avg_score/$yy;
$avg_score = number_format($avg_score,2,'.','');
}
echo '<tr  '.$onmouseover.' valign="top">';
if ($_REQUEST[grade_id] != ''){
if ($config_value[0] == 0){
echo	'<td><b>'.group_name($arr[group_id],4).'</b></td>';
}else{
echo	'<td><b>'.group_name($arr[group_id],5).'</b></td>';
}
}else{
echo	'<td align="center"><a href="?p='.$_REQUEST[p].'&school_id='.$_REQUEST[school_id].'&grade_id='.$arr[grade_id].'"><strong>'.datadic('level',$arr[grade_id]).'</strong></a></td>';
}
echo	'<td align="center">'.gengraph($avg_score,'','','','100%','20').'</td>'.
'<td align="center"><strong>'.$avg_score.'</strong></td>'.
'<td align="center"><strong>'.scoretograde($avg_score).'</strong></td>';
echo '<tr><td colspan="4"><hr size="1"></td>';
$sumscore = $sumscore +$avg_score;
}
$sumscore = $sumscore/$x;
$sumscore = number_format($sumscore,2,'.','');
echo '<tr  '.$onmouseover.' valign="top">'.
'<td align="center"><strong>รวม</strong></td>'.
'<td align="center">'.gengraph($sumscore,'','','','100%','20').'</td>'.
'<td align="center"><strong>'.$sumscore.'</strong></td>'.
'<td align="center"><strong>'.scoretograde($sumscore).'</strong></td>';
echo '<tr><td colspan="4"><hr size="1"></td>';
;echo '</table>
';?>
