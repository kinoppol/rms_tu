<?php 
if ($_REQUEST[sp] == 'add'){
	include('function_upload.php');
	$i=0;
	$importdbfile = "$destination_path/$pointfile";
	if(file_exists($importdbfile)) {
		$importdb = file($importdbfile);
		$totaldb = sizeof($importdb);
		for ($i=0 ; $i<$totaldb ; $i++) {
					if ($_REQUEST[uploadfile_type] == '1'){
						$split = explode(",",$importdb[$i]);
						$student_id =  $split[0]; 								//split
						$semes =  $split[1]; 								//split
						$act_value =  $split[2]; 								//split


						$accept_user = checkstudentid($student_id);
						if ($accept_user == '0'){

						}else{
							$sql = "insert into act_student ( ".
							"student_id, ".
							"semes, ".		
							"act_id, ".		
							"school_id, ".		
							"people_id, ".		
							"act_value) ".
							"values (".
							"'$student_id', ".
							"'$semes', ".
							"'$_REQUEST[act_id]', ".
							"'$_SESSION[school_id]', ".
							"'$_SESSION[userid]', ".
							"'$act_value')"; 
							$dbquery = mysql_db_query($dbname, $sql);
							
							$sql = "update act_student set ".
							" act_value='$act_value' , ".
							" people_id='$_SESSION[userid]' ".
							" where student_id='$student_id' and semes='$semes'  and act_id='$_REQUEST[act_id]' and school_id = '$_SESSION[school_id]' "; 
							$dbquery = mysql_db_query($dbname, $sql);
							
						}
					}
				}
			}
	$files_del = $importdbfile;
	if(file_exists("$files_del")) unlink("$files_del");

	echo '<br><center><b><big>นำเข้าข้อมูลเรียบร้อยแล้ว จำนวน '.$i.' เรคคอร์ด </b></center>';
	echo '<hr size="1">';

include 'ath_refresh.php';
}
;echo '
<form name="form" method="post" enctype="multipart/form-data"  onsubmit="return checkIt()"  action="'; echo '?p='.$_REQUEST[p].'&sp=add';;echo '">
<table align="center" width="95%" border="0" class="table table-striped table-hover"  style="border-collapse: collapse">
	';
	echo '<tr><td colspan="2"><b><big>นำเข้าข้อมูลบัญชีผู้ใช้ด้วยไฟล์</big></b></td>';
	echo '<tr><td>ชนิดไฟล์ข้อมูล</td><td><input type="radio" name="uploadfile_type" value="1" checked> 3 ฟิลด์</td>';
	echo '<tr><td>ไฟล์ข้อมูล</td><td><input type="file" name="uploadfile" class="form-control"></td>';	
	echo '<tr><td colspan="2">*** ไฟล์ฐานข้อมูล csv ที่สร้างโดยโปรแกรม Excel ประกอบด้วย 3 ฟิวด์ คือ <br><b> รหัสนักเรียน , ภาคเรียน , สถานะการผ่าน/ไม่ผ่านกิจกรรม ( 0 คือไม่ผ่าน , 1 คือผ่าน )</b></td>';
;echo '<tr><td>
		กรุณาเลือกกลุ่ม : </td><td><select size="1" name="act_id" class="form-control">
		';
		$Query = mysql_query("select * from act order by act_id"); 
		while($arr = mysql_fetch_array($Query)){
		if ($_REQUEST[act_id] == $arr[act_id]){$check = "selected";}else{$check ="";}
		echo sprintf("<option value=\"$arr[act_id]\" $check>$arr[act_name]</option>"); 
		}
		;echo '</select></td>

';
	echo '<tr><td colspan="2" align="right"><input type="submit" value="นำเข้าข้อมูล" class="btn btn-primary"></td>';
;echo '</table>
&nbsp;&nbsp;&nbsp;<font color="red">* การนำเข้าข้อมูลด้วยไฟล์ที่ไม่ถูกต้อง มีผลทำให้ฐานข้อมูลเสียหายได้</font>
</form>

<hr size="1">








';?>
