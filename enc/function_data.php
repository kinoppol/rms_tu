<?php 
function bytes2str($bytes)
{
$bytes=floor($bytes);
if ($bytes >536870912)
$str = sprintf('%5.2f GBs',$bytes/1073741824);
else if ($bytes >524288)
$str = sprintf('%5.2f MBs',$bytes/1048576);
else
$str = sprintf('%5.2f KBs',$bytes/1024);
return $str;
}
function time2str($time)
{
$str='';
$time = floor($time);
if (!$time)
return '0 วินาที';
$d = $time/86400;
$d = floor($d);
if ($d){
$str .= "$d วัน, ";
$time = $time %86400;
}
$h = $time/3600;
$h = floor($h);
if ($h){
$str .= "$h ชั่วโมง, ";
$time = $time %3600;
}
$m = $time/60;
$m = floor($m);
if ($m){
$str .= "$m นาที, ";
$time = $time %60;
}
if ($time)
$str .= "$time วินาที, ";
$str = ereg_replace(', $','',$str);
return $str;
}
function saveimg($img_fileupload,$imgPath,$w=100,$h=60,$pointfile)
{
global $information;
$chk_img=0;
if($img_fileupload[name]!='') {
if(($img_fileupload[type]=='image/jpg') ||($img_fileupload[type]=='image/jpeg') ||($img_fileupload[type]=='image/pjpeg')){
$src_img=imagecreatefromjpeg($img_fileupload[tmp_name]);
$type='.jpg';
}else if($img_fileupload[type]=='image/gif'){
$src_img=imagecreatefromgif($img_fileupload[tmp_name]);
$type='.gif';
}
else{
$returnValue[0]=1;
$returnValue[1]='';
return $returnValue;
}
if($img_fileupload[size] >$information[imgSize_limit]) {
$returnValue[0]=2;
$returnValue[1]=''.(number_format((($information[imgSize_limit])/1024),2)).' KB';
return $returnValue;
}
$chk_img=1;
}else{
$returnValue[0]=3;
$returnValue[1]='';
return $returnValue;
}
$isFilename=$img_fileupload[name];
$old_w=imagesx($src_img);
$old_h=imagesy($src_img);
if (($old_w<$w) and ($old_h<$h)) {
$new_h=$old_h;
$new_w=$old_w;
}else {
if ($old_w>$old_h) {
$how=$old_w/$w;
$new_w=floor($old_w/$how);
$new_h=floor($old_h/$how);
}
else {
$how=$old_h/$h;
$new_w=floor($old_w/$how);
$new_h=floor($old_h/$how);
}
}
if($type=='.jpg'){
$dst_img=imagecreatetruecolor($new_w,$new_h);
imagecopyresampled($dst_img,$src_img,0,0,0,0,$new_w,$new_h,$old_w,$old_h);
$textcolor = imagecolorallocate($dst_img,$information[colorRED],$information[colorGREEN],$information[colorBLUE]);
imagestring($dst_img,2,$new_w-90,$new_h-15,$information[label],$textcolor);
imagejpeg($dst_img,$imgPath.'/'.$pointfile.'',90);
}else{
$dst_img=imagecreatetruecolor($new_w,$new_h);
$colorTransparent = imagecolortransparent($src_img);
imagepalettecopy($src_img,$dst_img);
imagefill($dst_img,0,0,$colorTransparent);
imagecolortransparent($dst_img,$colorTransparent);
imagetruecolortopalette($dst_img,true,256);
imagecopyresampled($dst_img,$src_img,0,0,0,0,$new_w,$new_h,$old_w,$old_h);
imagegif($dst_img,$imgPath.'/'.$pointfile.'');
}
imagedestroy($src_img);
imagedestroy($dst_img);
$returnValue[0]=0;
$returnValue[1]=$pointfile.$type;
$returnValue[2]=$imgPath;
return $returnValue;
}
function validip($ip) {
if (!empty($ip) &&ip2long($ip)!=-1) {
$reserved_ips = array (
array('0.0.0.0','2.255.255.255'),
array('10.0.0.0','10.255.255.255'),
array('127.0.0.0','127.255.255.255'),
array('169.254.0.0','169.254.255.255'),
array('172.16.0.0','172.31.255.255'),
array('192.0.2.0','192.0.2.255'),
array('192.168.0.0','192.168.255.255'),
array('255.255.255.0','255.255.255.255')
);
foreach ($reserved_ips as $r) {
$min = ip2long($r[0]);
$max = ip2long($r[1]);
if ((ip2long($ip) >= $min) &&(ip2long($ip) <= $max)) return false;
}
return true;
}else {
return false;
}
}
function getip() {
if (validip($_SERVER['HTTP_CLIENT_IP'])) {
return $_SERVER['HTTP_CLIENT_IP'];
}
foreach (explode(',',$_SERVER['HTTP_X_FORWARDED_FOR']) as $ip) {
if (validip(trim($ip))) {
return $ip;
}
}
if (validip($_SERVER['HTTP_X_FORWARDED'])) {
return $_SERVER['HTTP_X_FORWARDED'];
}elseif (validip($_SERVER['HTTP_FORWARDED_FOR'])) {
return $_SERVER['HTTP_FORWARDED_FOR'];
}elseif (validip($_SERVER['HTTP_FORWARDED'])) {
return $_SERVER['HTTP_FORWARDED'];
}elseif (validip($_SERVER['HTTP_X_FORWARDED'])) {
return $_SERVER['HTTP_X_FORWARDED'];
}else {
return $_SERVER['REMOTE_ADDR'];
}
}
function get_user_browser() 
{
$u_agent = $_SERVER['HTTP_USER_AGENT'];
$ub = '';
if(preg_match('/MSIE/i',$u_agent)) 
{
$ub = 'ie';
}
elseif(preg_match('/Firefox/i',$u_agent)) 
{
$ub = 'firefox';
}
elseif(preg_match('/Safari/i',$u_agent)) 
{
$ub = 'safari';
}
elseif(preg_match('/Chrome/i',$u_agent)) 
{
$ub = 'chrome';
}
elseif(preg_match('/Flock/i',$u_agent)) 
{
$ub = 'flock';
}
elseif(preg_match('/Opera/i',$u_agent)) 
{
$ub = 'opera';
}
return $ub;
}
function datethai($data)
{
if ($data == '0000-00-00 00:00:00'){
return '';
}else{
$data = explode(' ',$data);
$date = explode('-',$data[0]);
$time = explode(':',$data[1]);
$thaimonth = $date['1']+0;
$thaiday = $date['2']+0;
$thaiyear = $date['0'];
$thaimonthword = array('1'=>'มกราคม','2'=>'กุมภาพันธ์','3'=>'มีนาคม',
'4'=>'เมษายน','5'=>'พฤษภาคม','6'=>'มิถุนายน',
'7'=>'กรกฎาคม','8'=>'สิงหาคม','9'=>'กันยายน',
'10'=>'ตุลาคม','11'=>'พฤศจิกายน','12'=>'ธันวาคม');
$str = $thaiday.' '.$thaimonthword[$thaimonth].' '.($thaiyear+543);
return $str.' '.$data[1];
}
}
?>
