<?php 
$page=$_REQUEST[page];
;echo '';
function pu_query($dbname,$sql,$ListPerPage=500)
{
global $page;
global $totalpage;
$result=mysql_db_query($dbname,$sql);
if (empty($page))	$page=1;
$num=mysql_num_rows($result);
$rt = $num%$ListPerPage;
$totalpage = ($rt!=0) ?floor($num/$ListPerPage)+1 : floor($num/$ListPerPage);
$goto = ($page-1)*$ListPerPage;
$sql .= " LIMIT $goto,$ListPerPage";
$result=mysql_db_query($dbname,$sql);
return $result;
}
function pu_pageloop($option='',$align='center')
{
global $page;
global $totalpage;
global $cssstyle;
global $text;
echo '				<div class="box-footer clearfix">
			<ul class="pagination pagination-sm no-margin pull-right"> ';
$current = 'กำลังแสดงผลหน้า ';
if($page>1 &&$page<=$totalpage) {
$prevpage = $page-1;
$back = "<li><a href='".$_SERVER['PHP_SELF']."?page=$prevpage&$option' title='Back'><-</a></li>";
}
$current .= " <b>$page/$totalpage</b>";
if($page!=$totalpage &&$totalpage != 0) {
$nextpage = $page+1;
$next = "<li><a href='".$_SERVER['PHP_SELF']."?page=$nextpage&$option' title='Next'>-></a></li>";
}
$b=floor($page/10);
$c=(($b*10));
if($c>1) {
$prevpage = $c-1;
echo "<li><a href='".$_SERVER['PHP_SELF']."?page=$prevpage&$option' title='10 Back'><<</a></li>";
}
else{
}
echo $back;
for($i=$c;$i<$page ;$i++) {
if($i>0)
echo "<li><a href='".$_SERVER['PHP_SELF']."?page=$i&$option'>$i</a></li>";
}
echo "<li  class='active'><a href='#'><b>$page</b></a></li>";
for($i=($page+1);$i<($c+10) ;$i++) {
if($i<=$totalpage)
echo "<li><a href='".$_SERVER['PHP_SELF']."?page=$i&$option'>$i</a></li>";
}
echo $next;
if($c>=0) {
if(($c+10)<$totalpage){
$nextpage = $c+10;
echo "<li><a href='".$_SERVER['PHP_SELF']."?page=$nextpage&$option' title='10 Next'>>></a></li>";
}else{
}
}else{
}
echo '</ul>
</div>
';
}
?>
