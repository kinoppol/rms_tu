<?php 
//gengraph('', '50' , '100' , $color , $width='500' , $height='30')
;echo '&nbsp;&nbsp;&nbsp;<b>�����Ũӹǹ�ؤ�ҡ�<b>
<table align=\'center\' border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" width="95%">
	<tr><td colspan="2"><b>��ṡ�����<b></td>
	<tr>
		<td width="90%"><b>��</b></td>
		<td width="10%" align="center" ><b><center>�ӹǹ</center></b></td>
	<tr><td colspan="2"><hr size="1"></td>
		';
		$sql = "SELECT sex_id , count(people_id) as MySUM  FROM people WHERE people_exit != '1' and school_id = '$_SESSION[school_id]'  and people.people_id != '9999999999999' group by sex_id ORDER BY sex_id ";
		$result = mysql_db_query($dbname,$sql);
		while($arr = mysql_fetch_array($result)){
		echo '<tr  '.$onmouseover.' valign="top">'.
			'<td>'.datadic('sex',$arr[sex_id]).'</td>'.
			'<td><center>'.$arr[MySUM].'</td>';

$data0[] = iconv("TIS-620", "UTF-8", datadic('sex',$arr[sex_id]));
$data1[] = $arr[MySUM];

		echo '<tr><td colspan="2"><hr size="1"></td>';

		$P_total = $P_total + $arr[MySUM];
		}

		echo '<tr  '.$onmouseover.' valign="top">'.
			'<td align="right"><b>���</b></td>'.
			'<td><center>'.$P_total.'</td>';
		echo '<tr><td colspan="2"><hr size="1"></td>';
		
		;echo '</table>

<br>
<center>
';
include_once 'open_flash_chart_object.php';
include_once( 'open-flash-chart.php' );
srand((double)microtime()*1000000);
$bar_1 = new bar_3d( 75, '#3334AD' );

foreach ($data1 as $key => $value) {
    $bar_1->data[] = $value;
	$max_data[] = $value;
}

$g = new graph();
$g->title( iconv("TIS-620", "UTF-8",'����ػ�ӹǹ�ؤ�ҡ� (��)'), '{font-family: tahoma; font-size: 14px;}' );
$g->data_sets[] = $bar_1;
$g->set_x_axis_3d( 12 );
$g->x_axis_colour( '#909090', '#ADB5C7' );
$g->y_axis_colour( '#909090', '#ADB5C7' );
$g->set_x_labels( $data0 );
$g->set_x_label_style( 10, '#9933CC', 0, 1 );
$g->set_x_axis_steps( 1 );
$g->bg_colour = '#FFFFFF';
$g->set_y_max( max($max_data) );
$g->y_label_steps( 4 );
//$g->set_y_legend( iconv("TIS-620", "UTF-8",'�ӹǹ'), 12, '{font-family: tahoma; font-size: 20px; font-color:#736AFF}');
$g->set_width( 700 );
$g->set_height( 200 );
$g->set_js_path('');
$g->set_output_type('js');
echo $g->render();

unset ($data0);
unset ($data1);
unset ($max_data);
;echo '</center>
<br>

<hr size="1">


<table align=\'center\' border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" width="95%">
	<tr><td colspan="2"><b>��ṡ����дѺ����֡��<b></td>
	<tr>
		<td width="90%"><b>�дѺ����֡��</b></td>
		<td width="10%" align="center" ><b><center>�ӹǹ</center></b></td>
	<tr><td colspan="2"><hr size="1"></td>
		';
		$sql = "SELECT edu_id , count(people_id) as MySUM  FROM people WHERE people_exit != '1' and school_id = '$_SESSION[school_id]'  and people.people_id != '9999999999999' group by edu_id ORDER BY edu_id desc";
		$result = mysql_db_query($dbname,$sql);
		while($arr = mysql_fetch_array($result)){
		echo '<tr  '.$onmouseover.' valign="top">'.
			'<td>'.datadic('edu',$arr[edu_id]).'</td>'.
			'<td><center>'.$arr[MySUM].'</td>';

$data0[] = iconv("TIS-620", "UTF-8", datadic('edu',$arr[edu_id]));
$data1[] = $arr[MySUM];

		echo '<tr><td colspan="2"><hr size="1"></td>';
		}
		;echo '</table>

<br>
<center>
';
include_once 'open_flash_chart_object.php';
include_once( 'open-flash-chart.php' );
srand((double)microtime()*1000000);
$bar_1 = new bar_3d( 75, '#3334AD' );

foreach ($data1 as $key => $value) {
    $bar_1->data[] = $value;
	$max_data[] = $value;
}

$g = new graph();
$g->title( iconv("TIS-620", "UTF-8",'����ػ�ӹǹ�ؤ�ҡ� (����֡��)'), '{font-family: tahoma; font-size: 14px;}' );
$g->data_sets[] = $bar_1;
$g->set_x_axis_3d( 12 );
$g->x_axis_colour( '#909090', '#ADB5C7' );
$g->y_axis_colour( '#909090', '#ADB5C7' );
$g->set_x_labels( $data0 );
$g->set_x_label_style( 10, '#FFFFFF', 0, 1 );
$g->set_x_axis_steps( 5 );
$g->bg_colour = '#FFFFFF';
$g->set_y_max( max($max_data) );
$g->y_label_steps( 4 );
//$g->set_y_legend( iconv("TIS-620", "UTF-8",'�ӹǹ'), 12, '{font-family: tahoma; font-size: 20px; font-color:#736AFF}');
$g->set_width( 700 );
$g->set_height( 200 );
$g->set_js_path('');
$g->set_output_type('js');
echo $g->render();
unset ($data0);
unset ($data1);
unset ($max_data);
;echo '</center>
<br>

<hr size="1">

<table align=\'center\' border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" width="95%">
	<tr><td colspan="2"><b>��ṡ������˹�˹�ҷ��<b></td>
	<tr>
		<td width="90%"><b>���˹�˹�ҷ��</b></td>
		<td width="10%" align="center" ><b><center>�ӹǹ <br>(���˹�)</center></b></td>
	<tr><td colspan="2"><hr size="1"></td>
		';
		$sql = "SELECT people_pro.people_stagov_id , count(people_pro.people_id) as MySUM  FROM people_pro , people_stagov , people WHERE people.people_id = people_pro.people_id  and people.people_exit != '1' and people_pro.school_id = '$_SESSION[school_id]' and people_stagov.people_stagov_id = people_pro.people_stagov_id  and people.people_id != '9999999999999'  and people_pro.people_dep_id != '888' group by people_pro.people_stagov_id ORDER BY people_stagov.people_depgroup_id , people_pro.people_stagov_id ";
		$result = mysql_db_query($dbname,$sql);
		while($arr = mysql_fetch_array($result)){
		echo '<tr  '.$onmouseover.' valign="top">'.
			'<td>'.datadic('people_stagov',$arr[people_stagov_id]).'</td>'.
			'<td><center>'.$arr[MySUM].'</td>';

$data0[] = iconv("TIS-620", "UTF-8", datadic('people_stagov',$arr[people_stagov_id]));
$data1[] = $arr[MySUM];

		echo '<tr><td colspan="2"><hr size="1"></td>';
		}
		;echo '</table>

<br>
<center>
';
include_once 'open_flash_chart_object.php';
include_once( 'open-flash-chart.php' );
srand((double)microtime()*1000000);
$bar_1 = new bar_3d( 75, '#3334AD' );

foreach ($data1 as $key => $value) {
    $bar_1->data[] = $value;
	$max_data[] = $value;
}

$g = new graph();
$g->title( iconv("TIS-620", "UTF-8",'����ػ�ӹǹ�ؤ�ҡ� (���˹�˹�ҷ��)'), '{font-family: tahoma; font-size: 14px;}' );
$g->data_sets[] = $bar_1;
$g->set_x_axis_3d( 12 );
$g->x_axis_colour( '#909090', '#ADB5C7' );
$g->y_axis_colour( '#909090', '#ADB5C7' );
$g->set_x_labels( $data0 );
$g->set_x_label_style( 10, '#FFFFFF', 0, 1 );
$g->set_x_axis_steps( 3 );
$g->bg_colour = '#FFFFFF';
$g->set_y_max( max($max_data) );
$g->y_label_steps( 5 );
//$g->set_y_legend( iconv("TIS-620", "UTF-8",'�ӹǹ'), 12, '{font-family: tahoma; font-size: 20px; font-color:#736AFF}');
$g->set_width( 700 );
$g->set_height( 200 );
$g->set_js_path('');
$g->set_output_type('js');
echo $g->render();
unset ($data0);
unset ($data1);
unset ($max_data);
;echo '</center>
<br>

<hr size="1">

<table align=\'center\' border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" width="95%">
	<tr><td colspan="2"><b>��ṡ���Ἱ����˹��§ҹ<b></td>
	<tr>
		<td width="90%"><b>Ἱ����˹��§ҹ</b></td>
		<td width="10%" align="center" ><b><center>�ӹǹ</center></b></td>
	<tr><td colspan="2"><hr size="1"></td>
		';
		$sql = "SELECT DISTINCT people_pro.people_id , people_pro.people_dep_id , count(DISTINCT people_pro.people_id) as MySUM  FROM people_pro , people_stagov , people WHERE people.people_id = people_pro.people_id  and people.people_exit != '1' and  people_pro.school_id = '$_SESSION[school_id]' and people_stagov.people_stagov_id = people_pro.people_stagov_id  and people.people_id != '9999999999999' GROUP BY people_pro.people_dep_id ORDER BY people_pro.people_dep_id ";
		$result = mysql_db_query($dbname,$sql);
		while($arr = mysql_fetch_array($result)){
		echo '<tr  '.$onmouseover.' valign="top">'.
			'<td>'.datadic('people_dep',$arr[people_dep_id]).'</td>'.
			'<td><center>'.$arr[MySUM].'</td>';

$data0[] = iconv("TIS-620", "UTF-8", datadic('people_dep',$arr[people_dep_id]));
$data1[] = $arr[MySUM];

		echo '<tr><td colspan="2"><hr size="1"></td>';
		}
		;echo '</table>


<br>
<center>
';
include_once 'open_flash_chart_object.php';
include_once( 'open-flash-chart.php' );
srand((double)microtime()*1000000);
$bar_1 = new bar_3d( 75, '#3334AD' );

foreach ($data1 as $key => $value) {
    $bar_1->data[] = $value;
	$max_data[] = $value;
}

$g = new graph();
$g->title( iconv("TIS-620", "UTF-8",'����ػ�ӹǹ�ؤ�ҡ� (˹��§ҹ)'), '{font-family: tahoma; font-size: 14px;}' );
$g->data_sets[] = $bar_1;
$g->set_x_axis_3d( 12 );
$g->x_axis_colour( '#909090', '#ADB5C7' );
$g->y_axis_colour( '#909090', '#ADB5C7' );
$g->set_x_labels( $data0 );
$g->set_x_label_style( 10, '#FFFFFF', 0, 1 );
$g->set_x_axis_steps( 10 );
$g->bg_colour = '#FFFFFF';
$g->set_y_max( max($max_data) );
$g->y_label_steps( 4 );
//$g->set_y_legend( iconv("TIS-620", "UTF-8",'�ӹǹ'), 12, '{font-family: tahoma; font-size: 20px; font-color:#736AFF}');
$g->set_width( 700 );
$g->set_height( 200 );
$g->set_js_path('');
$g->set_output_type('js');
echo $g->render();
unset ($data0);
unset ($data1);
unset ($max_data);
;echo '</center>
<br>
';?>
