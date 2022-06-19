<?php
$host="localhost";
$user="root";
$password="bncc2019!";
$database="rms2012";

$charset='utf8';
  $db = mysqli_connect($host, $user, $password, $database);
if (mysqli_connect_error())
    die("!Error : " . mysqli_connect_error());
mysqli_set_charset($db, $charset);

$username=$_GET['username'];
$password=$_GET['password'];
$act=$_GET['act'];
$id=$_GET['id'];

$set=$_GET['set'];
$limit=$_GET['limit'];


$query="select * from people where people_user='$username' AND people_pass='".md5($password)."'";
$result=mysqli_query($db,$query);

//print $query;

if(mysqli_num_rows($result)!=1){
	print("error_auth");
print json_encode($_GET);
	exit();
}else{
	$userdata=mysqli_fetch_array($result);
	$res=array();	

	$pid=$userdata['people_id'];;
	if(!$act){
		$res['pid']=$pid;
		$res['name']=$userdata['people_name'];
		$res['surname']=$userdata['people_surname'];
	}

	if($act=="showUnReadBook")$res['unread']=showBook(2);
	if($act=="getUnReadBook"){if(!$limit)$limit=50; if(!$set)$set=0; $res=showListBook(2,$limit,$set);}
	if($act=="getReadedBook"){if(!$limit)$limit=50; if(!$set)$set=0; $res=showListBook(1,$limit,$set);}
	if($act=="getBook")$res=getBookUri($id);
	print json_encode($res);
}

function showBook($status=1){//status 1=readed 2=unread

	global $pid;
	global $db;
	$query="select count(*) from slb_booktopeople where people_id='".$pid."' AND readstatus=".$status." AND completebook=1";
//print $query;
	$result=mysqli_query($db,$query);
	$data=mysqli_fetch_array($result);
	return $data['count(*)'];
	
}

function showListBook($status=1,$limit=50,$set=0){//status 1=readed 2=unread

	global $pid;
	global $db;
	
	$limitQuery=" limit ".($set*$limit).",".$limit;

	$query="select slb_book_id from slb_booktopeople where people_id='".$pid."' AND readstatus=".$status." AND completebook=1 order by incomdate desc".$limitQuery;
//print $query;
	$result=mysqli_query($db,$query);
	$i=0;
	while($data_r=mysqli_fetch_array($result)){
		$query="select booktitle from slb_book where slb_book_id=".$data_r['slb_book_id']." limit 1";
//print $query;
		$resultBook=mysqli_query($db,$query);
		$dataBook=mysqli_fetch_array($resultBook);
$data[$data_r['slb_book_id']]=$dataBook['booktitle'];

	$i++;
	}

	return $data;
	
}

function getBookUri($bookId){

	global $pid;
	global $db;
	$query="select bookfiles from slb_book where slb_book_id=".$bookId." limit 1";
//print $query;
	$result=mysqli_query($db,$query);
	
	$data=mysqli_fetch_array($result);	
	$data=$data['bookfiles'];

	$query="update slb_booktopeople set readstatus=1,openreaddate=NOW() where people_id='".$pid."' AND slb_book_id=".$bookId." limit 1";
	$result=mysqli_query($db,$query);
//print $query;
	return $data;
	
}
