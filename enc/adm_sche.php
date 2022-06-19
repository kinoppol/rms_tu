<?php echo '<form id="formxx" name="formxx" method="post" enctype="multipart/form-data" action="';echo '?p='.$_REQUEST[p].'&mod='.$_REQUEST[mod].'#ok';;echo '">
		<table align="center" width="95%" class="table table-striped table-hover" border="0" style="border-collapse: collapse">
		';
echo '<tr><td width="300"><b><big>กรุณาเลือก ห้องประชุม/รถ </big></b></td>';
echo '<td><select size="1" name="sch_id" class="form-control" onchange="SubmitForm(\'formxx\');">  ';
echo "<option value='' $check>กรุณาเลือก </option>";
$Query = mysql_query('select * from sch order by sch_type_id,sch_id');
while($arr = mysql_fetch_array($Query)){
if ($_REQUEST[sch_id] == $arr[sch_id]){$check = 'selected';}else{$check ='';}
echo sprintf("<option value=\"$arr[sch_id]\" $check>[".datadic('sch_type',$arr[sch_type_id])."] $arr[sch_name] </option>");
}
echo '</select></td> ';
;echo '		</table>
</form>

<script>
function SubmitForm(formId) {
    var oForm = document.getElementById(formId);
    if (oForm) {
        oForm.submit(); 
    }
    else {
        alert("DEBUG - could not find element " + formId);
    }
}
</script>

';
if ($_REQUEST[sch_id] == ''){}else{
$monthNames = Array('มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฏาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม');
if (!isset($_REQUEST['d'])) $_REQUEST['d'] = sprintf('%02d',date('d'));
if (!isset($_REQUEST['m'])) $_REQUEST['m'] = sprintf('%02d',date('n'));
if (!isset($_REQUEST['y'])) $_REQUEST['y'] = date('Y');
$currentMonth = $_REQUEST['m'];
$currentYear = $_REQUEST['y'];
$p_year = $currentYear;
$n_year = $currentYear;
$p_month = sprintf('%02d',($currentMonth-1));
$n_month = sprintf('%02d',($currentMonth+1));
if ($p_month == 0 ) {
$p_month = 12;
$p_year = $currentYear -1;
}
if ($n_month == 13 ) {
$n_month = 1;
$n_year = $currentYear +1;
}
$days=array('1'=>'อาทิตย์','2'=>'จันทร์','3'=>'อังคาร','4'=>'พุธ','5'=>'พฤหัส','6'=>'ศุกร์','7'=>'เสาร์');
;echo '

<style>
@media (max-width: 600px) {  
    .table-sm {
        font-size:10px !important;
    }
}
</style>

<table width="95%" border="0" cellspacing="0" cellpadding="0" class="table table-sm table-hover table-striped">
<tr>
<td width="33%" align="left" colspan="2">  <a href="';echo $_SERVER['PHP_SELF'] .'?m='.$p_month .'&y='.$p_year.'&p='.$_REQUEST[p].'&mod='.$_REQUEST[mod].'&sch_id='.$_REQUEST[sch_id];;echo '" > < ก่อนหน้า</a></td>
<td width="33%" align="center"colspan="3">  <a href="';echo $_SERVER['PHP_SELF'] .'?m='.date(m) .'&y='.date(Y).'&p='.$_REQUEST[p].'&mod='.$_REQUEST[mod].'&sch_id='.$_REQUEST[sch_id];;echo '"  > วันนี้ </a></td>
<td width="33%" align="right"colspan="2"><a href="';echo $_SERVER['PHP_SELF'] .'?m='.$n_month .'&y='.$n_year.'&p='.$_REQUEST[p].'&mod='.$_REQUEST[mod].'&sch_id='.$_REQUEST[sch_id];;echo '"  >ถัดไป ></a>  </td>
</tr>




<tr align="center">
<td colspan="7"><B>';echo $monthNames[$currentMonth-1].' '.($currentYear+543);;echo '</B></td>
</tr>
<tr >
';for($i=1;$i<=7;$i++){;echo '<td align="center" width="14%" height=\'20\' bgcolor="#7DC3E3" style="color:#FFFFFF"><B>';echo $days[$i];;echo '</B></td>
';};echo '</tr>
';
$timestamp = mktime(0,0,0,$currentMonth,1,$currentYear);
$maxday = date('t',$timestamp);
$thismonth = getdate ($timestamp);
$startday = $thismonth['wday'];
for ($i=0;$i<($maxday+$startday);$i++) {
if(($i %7) == 0 ) echo '<tr>';
if($i <$startday){echo '<td ></td>';}else{
$cur_y = $currentYear;
$cur_m =sprintf('%02d',$currentMonth);
$cur_d =sprintf('%02d',($i -$startday +1));
if ($_REQUEST[y].''.$_REQUEST[m].''.$_REQUEST[d] == $cur_y.''.$cur_m.''.$cur_d){
$font_color = "<a href='".$_SERVER['PHP_SELF'] .'?m='.$cur_m .'&y='.$cur_y.'&d='.sprintf('%02d',($i -$startday +1)).'&p='.$_REQUEST[p].'&mod='.$_REQUEST[mod].'&sch_id='.$_REQUEST[sch_id]."' style='color:#336699;font-size:14pt'>";
$cell_color = '#BBDDFF';
}else{
$font_color = "<a href='".$_SERVER['PHP_SELF'] .'?m='.$cur_m .'&y='.$cur_y.'&d='.sprintf('%02d',($i -$startday +1)).'&p='.$_REQUEST[p].'&mod='.$_REQUEST[mod].'&sch_id='.$_REQUEST[sch_id]."' style='color:#000000'>";
$cell_color = '#F0F0F0';
}
$startdate = $cur_y.'-'.$cur_m.'-'.$cur_d.' 00:00:00';
$enddate = $cur_y.'-'.$cur_m.'-'.$cur_d.' 23:59:59';
$datesearch = "AND ( 
				(sch_detail_startdate < '$enddate' and sch_detail_startdate > '$startdate' ) or 
				(sch_detail_startdate < '$startdate' and sch_detail_enddate > '$enddate' ) or 
				( sch_detail_startdate > '$startdate' and sch_detail_enddate < '$enddate') or
				( sch_detail_enddate > '$startdate' and sch_detail_enddate < '$enddate') 
				)";
$sql_detail = "SELECT * FROM sch_detail WHERE sch_id = '$_REQUEST[sch_id]' and school_id= '$_SESSION[school_id]' $datesearch   ";
$dbquery2 = mysql_db_query($dbname,$sql_detail);
$num_rows = mysql_num_rows($dbquery2);
if ($num_rows >= '1'){
$num_rows_txt = "<font color='red'>(".$num_rows.')</font>';
}else{
$num_rows_txt = '';
}
echo "<td align='center' height='80' valign='top' bgcolor='".$cell_color."' height='20px'><b>".$font_color."<div style='height:100%;width:100%'>".($i -$startday +1) .'<br>'.$num_rows_txt.'</div></a></b></td>';
}
if(($i %7) == 6 ) echo '</tr>';
}
;echo '
</tr>
</table>

<table width="95%"  align="center" border="0" cellpadding="2" cellspacing="2" class="table table-sm table-hover table-striped">
<tr><td colspan="2"><b><big>
';
datethai2($_REQUEST[y].'-'.$_REQUEST[m].'-'.$_REQUEST[d],'');
;echo '</big></b></td>
';
for ($i=500;$i<2000;$i) {
$i = sprintf('%04d',$i);
$startdate = $_REQUEST[y].'-'.$_REQUEST[m].'-'.$_REQUEST[d].' '.substr($i,0,2).':'.substr($i,2,2).':00';
$enddate =$_REQUEST[y].'-'.$_REQUEST[m].'-'.$_REQUEST[d].' '.substr($i,0,2).':'.substr($i,2,2).':59';
$datesearch = "AND ( 
				(sch_detail_startdate <= '$enddate' and sch_detail_startdate >= '$startdate' ) or 
				(sch_detail_startdate <= '$startdate' and sch_detail_enddate >= '$enddate' ) or 
				( sch_detail_startdate >= '$startdate' and sch_detail_enddate <= '$enddate') or
				( sch_detail_enddate >= '$startdate' and sch_detail_enddate <= '$enddate') 
				)";
$sql_detail = "SELECT * FROM sch_detail WHERE school_id= '$_SESSION[school_id]' $datesearch and sch_id = '$_REQUEST[sch_id]' ORDER BY sch_detail_startdate ";
$result_detail = mysql_db_query($dbname,$sql_detail);
$num_rows = mysql_num_rows($result_detail);
if ($num_rows >= '1'){$bgcolor = '#F0CCCC';}else{
$bgcolor = '#F0F0F0';
$start_txt = '';
$end_txt = '';
}
while($result = mysql_fetch_array($result_detail)){
if ($result[sch_detail_starttime] == $i ){$start_txt .= '<img src="starttime.png" title="เริ่มต้น" align="center" width="16"> <a href="adm_detail.php?sch_detail_id='.$result[sch_detail_id].'" title="เริ่มต้น : '.datadic('sch_detail',$result[sch_detail_id]).'" class="lightwindow page-options" params="lightwindow_type=external,lightwindow_width=700,lightwindow_height=500">'.datadic('sch_detail',$result[sch_detail_id]).'</a>';}else{}
if ($result[sch_detail_endtime] == $i ){$end_txt .= ' <a href="adm_detail.php?sch_detail_id='.$result[sch_detail_id].'" title="สิ้นสุด : '.datadic('sch_detail',$result[sch_detail_id]).'" class="lightwindow page-options" params="lightwindow_type=external,lightwindow_width=700,lightwindow_height=500">'.datadic('sch_detail',$result[sch_detail_id]).'</a> <img src="endtime.png" title="สิ้นสุด" align="center" width="16">';}else{}
if ($result[sch_detail_starttime] != $i &&$result[sch_detail_endtime] != $i ){$current_txt = '<a href="adm_detail.php?sch_detail_id='.$result[sch_detail_id].'" title="'.datadic('sch_detail',$result[sch_detail_id]).'" class="lightwindow page-options" params="lightwindow_type=external,lightwindow_width=700,lightwindow_height=500">'.datadic('sch_detail',$result[sch_detail_id]).'</a>';}else{}
}
if ($num_rows >= '2'){
echo '</tr><td align="center" bgcolor="#F0F0F0" width="20%">'.substr($i,0,2).':'.substr($i,2,2) .'</td><td width="80%" align="center" bgcolor="'.$bgcolor.'">'.$end_txt.' '.$current_txt.' '.$start_txt.'</td></tr>';
}else{
echo '</tr><td align="center" bgcolor="#F0F0F0" width="20%">'.substr($i,0,2).':'.substr($i,2,2) .'</td><td width="80%" align="center" bgcolor="'.$bgcolor.'">'.$start_txt.' '.$current_txt.' '.$end_txt.'</td></tr>';
}
$start_txt = '';
$end_txt = '';
$current_txt = '';
$i = $i+15;
$mystring = $i;
$findme   = '60';
$pos = strpos($mystring,$findme);
if ($pos !== false) {
$i = $i+40;
}else {
}
}
;echo '</table>
<br><br>


';
}
?>
