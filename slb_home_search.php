<?php $mobile_b = check_user_agent('mobile');
if ($_REQUEST[xsp] == 'order') {
    $sql = 'update people set ' . " slb_dataorder = '$_REQUEST[slb_dataorder]' " . "where people_id='$_SESSION[userid]' and school_id = '$_SESSION[school_id]' ";
    $dbquery = mysql_db_query($dbname, $sql);
    $sqluserdata = "SELECT * FROM people WHERE people_id = '$_SESSION[userid]' and school_id = '$_SESSION[school_id]'";
    $dbqueryuserdata = mysql_db_query($dbname, $sqluserdata);
    $resultuserdata = mysql_fetch_array($dbqueryuserdata);
}
$_REQUEST[slb_dataorder] = $resultuserdata[slb_dataorder];
if ($_REQUEST[slb_avsearch] == 1) {
    $_SESSION[slb_avsearch] = 1;
} else if ($_REQUEST[slb_avsearch] == 2) {
    $_SESSION[slb_avsearch] = 2;
};
echo '
<p align="right">
';
if ($_SESSION[slb_avsearch] != 1) {;
    echo '<a href="?';
    echo "p=slb_home&slb_avsearch=1&mod=3&txtsearch=$_REQUEST[txtsearch]&startdate_date=$_REQUEST[startdate_date]&startdate_month=$_REQUEST[startdate_month]&startdate_year=$_REQUEST[startdate_year]&enddate_date=$_REQUEST[enddate_date]&enddate_month=$_REQUEST[enddate_month]&enddate_year=$_REQUEST[enddate_year]&slb_booktype_id=$_REQUEST[slb_booktype_id]&bookcenter=$_REQUEST[bookcenter]&slb_comment_id=$_REQUEST[slb_comment_id]";;
    echo '"><img src="img/search.png" width="16" align="center"> <b></b></a>
';
} else {;
    echo '<a href="?';
    echo "p=slb_home&slb_avsearch=2&mod=3&txtsearch=$_REQUEST[txtsearch]&startdate_date=$_REQUEST[startdate_date]&startdate_month=$_REQUEST[startdate_month]&startdate_year=$_REQUEST[startdate_year]&enddate_date=$_REQUEST[enddate_date]&enddate_month=$_REQUEST[enddate_month]&enddate_year=$_REQUEST[enddate_year]&slb_booktype_id=$_REQUEST[slb_booktype_id]&bookcenter=$_REQUEST[bookcenter]&slb_comment_id=$_REQUEST[slb_comment_id]";;
    echo '"><img src="img/search.png" width="16" align="center"> <b></b></a>
';
};
echo ' | 

<a href="?p=slb_home&xsp=slb_clear&mod=3"><img src="slb_report1.png" width="16"> <b></b></a>
 | 
<a href="slb_backup.php?';
echo "&txtsearch=$_REQUEST[txtsearch]&startdate_date=$_REQUEST[startdate_date]&startdate_month=$_REQUEST[startdate_month]&startdate_year=$_REQUEST[startdate_year]&enddate_date=$_REQUEST[enddate_date]&enddate_month=$_REQUEST[enddate_month]&enddate_year=$_REQUEST[enddate_year]&slb_booktype_id=$_REQUEST[slb_booktype_id]&bookcenter=$_REQUEST[bookcenter]&slb_comment_id=$_REQUEST[slb_comment_id]";;
echo '"  title="" class="lightwindow page-options" params="lightwindow_type=external,lightwindow_width=500,lightwindow_height=300"><img src="chk_xls.png" border="0" width="16" align="center"><b> </b></a>

</p>

';
if ($_SESSION[slb_avsearch] == 1) {;
    echo '<form name="form" method="post" enctype="multipart/form-data" action="';
    echo '?p=' . $_REQUEST[p] . '&sp=search';;
    echo '#ok">
<table align="center"  class="table table-striped table-hover" width="95%" border="0" style="border-collapse: collapse">
	';
    echo '<tr><td colspan="2"><b><big><img src="img/search.png" align="center"> </big></b></td>';
    textinput('', 'txtsearch', $_REQUEST[txtsearch], 'text', '', '', '');
    echo '<tr><td colspan="2">*        </td>';
    selectinput('', 'slb_booktype_id', 'slb_booktype', 'slb_booktype_id', 'slb_booktype_id', 'slb_booktype_name', $_REQUEST[slb_booktype_id], '1');
    $date_select = $_REQUEST[startdate_date];
    $month_select = $_REQUEST[startdate_month];
    $year_select = $_REQUEST[startdate_year];
    dateinput('', 'startdate_date', 'startdate_month', 'startdate_year', $date_select, $month_select, $year_select, '100', '1', '');
    $date_select = $_REQUEST[enddate_date];
    $month_select = $_REQUEST[enddate_month];
    $year_select = $_REQUEST[enddate_year];
    dateinput('', 'enddate_date', 'enddate_month', 'enddate_year', $date_select, $month_select, $year_select, '100', '1', '');
    checkboxinput('', 'bookcenter', '1', $_REQUEST[bookcenter]);
    selectinput('', 'slb_comment_id', 'slb_comment', 'slb_comment_id', 'slb_comment_id', 'slb_comment_name', $_REQUEST[slb_comment_id], '0');
    bottoninput('submit', '', '', '');;
    echo '</table>
</form>
';
}
if ($_SESSION[slb_avsearch] != 1) {;
    echo '<form name="form1" method="post" action="';
    echo '?p=' . $_REQUEST[p] . '&sp=search';;
    echo '#ok">
<table class="table table-striped table-hover">
<tr><td align="right"><input type="checkbox" name="bookcenter" value="1" ';
    if ($_REQUEST[bookcenter] == 1) {
        echo 'checked';
    };
    echo '> 

';
    if ($_REQUEST[bookcenter] + 0 == '0') {;
        echo '<a href="?';
        echo "p=slb_home&slb_avsearch=$_REQUEST[slb_avsearch]&mod=3&txtsearch=$_REQUEST[txtsearch]&startdate_date=$_REQUEST[startdate_date]&startdate_month=$_REQUEST[startdate_month]&startdate_year=$_REQUEST[startdate_year]&enddate_date=$_REQUEST[enddate_date]&enddate_month=$_REQUEST[enddate_month]&enddate_year=$_REQUEST[enddate_year]&slb_booktype_id=$_REQUEST[slb_booktype_id]&bookcenter=1&slb_comment_id=$_REQUEST[slb_comment_id]";;
        echo '">
';
    } else {;
        echo '<a href="?';
        echo "p=slb_home&slb_avsearch=$_REQUEST[slb_avsearch]&mod=3&txtsearch=$_REQUEST[txtsearch]&startdate_date=$_REQUEST[startdate_date]&startdate_month=$_REQUEST[startdate_month]&startdate_year=$_REQUEST[startdate_year]&enddate_date=$_REQUEST[enddate_date]&enddate_month=$_REQUEST[enddate_month]&enddate_year=$_REQUEST[enddate_year]&slb_booktype_id=$_REQUEST[slb_booktype_id]&bookcenter=0&slb_comment_id=$_REQUEST[slb_comment_id]";;
        echo '">
';
    };
    echo '<b></b></a> <img src="img/search.png" width="16" align="center"> <input type="text" name="txtsearch" size="20" class="form-control-mini" value="';
    echo $_REQUEST[txtsearch];
    echo '"> <input type="submit" name="Submit" value="" class="btn btn-primary"></td>
</table>
</form>
';
};
echo '';
$startdate = $_REQUEST[startdate_year] . '-' . ($_REQUEST[startdate_month] + 0) . '-' . ($_REQUEST[startdate_date] + 0);
$enddate = $_REQUEST[enddate_year] . '-' . $_REQUEST[enddate_month] . '-' . $_REQUEST[enddate_date];
if ($startdate == $todate) {
} else {
    if ($startdate != '-0-0') {
        if ($startdate != '--') {
            $datesearch = "AND slb_book.bookindate >= '$startdate' AND slb_book.bookindate <= '$enddate' ";
        }
    }
}
if ($_REQUEST[slb_booktype_id] != '') {
    $slb_booktype_search = "AND slb_book.slb_booktype_id = '$_REQUEST[slb_booktype_id]' ";
}
if ($_REQUEST[slb_comment_id] + 0 != '0') {
    $slb_comment_search = "AND slb_booktopeople.slb_comment_id = '$_REQUEST[slb_comment_id]' ";
    $slb_comment_order = ' slb_booktopeople.slb_comment_date desc , ';
}
if ($_REQUEST[bookcenter] == '1') {
    $sql = "SELECT * FROM slb_book WHERE (slb_book.booktitle like '%$_REQUEST[txtsearch]%' or slb_book.bookid like '%$_REQUEST[txtsearch]%' or slb_book.bookinid like '%$_REQUEST[txtsearch]%' or slb_book.bookcomment like '$_REQUEST[txtsearch]%' or slb_book.bookfrom like '$_REQUEST[txtsearch]%' or slb_book.bookto like '$_REQUEST[txtsearch]%') $datesearch $slb_booktype_search AND slb_book.bookcenter = '1' ORDER BY  slb_book_id desc ";
} else {
    if ($_REQUEST[slb_dataorder] == 1) {
        $sql = "SELECT *,slb_booktopeople.slb_book_id FROM slb_book , slb_booktopeople WHERE (slb_book.booktitle like '%$_REQUEST[txtsearch]%' or slb_book.bookid like '%$_REQUEST[txtsearch]%' or slb_book.bookinid like '%$_REQUEST[txtsearch]%' or slb_book.bookcomment like '$_REQUEST[txtsearch]%' or slb_book.bookfrom like '$_REQUEST[txtsearch]%' or slb_book.bookto like '$_REQUEST[txtsearch]%') $datesearch $slb_booktype_search $slb_comment_search AND slb_booktopeople.slb_book_id = slb_book.slb_book_id AND slb_booktopeople.people_id = '$_SESSION[userid]' AND slb_booktopeople.hiddenbook='0' and slb_booktopeople.school_id = '$_SESSION[school_id]' AND slb_booktopeople.completebook = '1'  
GROUP BY slb_booktopeople.slb_book_id  
ORDER BY pinbook desc , $slb_comment_order slb_book.slb_book_id desc";
    } else {
        $sql = "SELECT *,slb_booktopeople.slb_book_id FROM slb_book , slb_booktopeople WHERE (slb_book.booktitle like '%$_REQUEST[txtsearch]%' or slb_book.bookid like '%$_REQUEST[txtsearch]%' or slb_book.bookinid like '%$_REQUEST[txtsearch]%' or slb_book.bookcomment like '$_REQUEST[txtsearch]%' or slb_book.bookfrom like '$_REQUEST[txtsearch]%' or slb_book.bookto like '$_REQUEST[txtsearch]%') $datesearch $slb_booktype_search $slb_comment_search AND slb_booktopeople.slb_book_id = slb_book.slb_book_id AND slb_booktopeople.people_id = '$_SESSION[userid]' AND slb_booktopeople.hiddenbook='0' and slb_booktopeople.school_id = '$_SESSION[school_id]' AND slb_booktopeople.completebook = '1'  
GROUP BY slb_booktopeople.slb_book_id  
ORDER BY pinbook desc , $slb_comment_order slb_booktopeople.readstatus desc , slb_book.slb_book_id desc";
    }
}

$result = mysql_db_query($dbname, $sql);
//$num_rows = mysql_num_rows($result);
$slb_c_data=mysql_fetsh_array($result);
$num_rows=$slb_c_data['c'];

$result = pu_query($dbname, $sql, 20);;
echo '

<table width=\'100%\' align=\'center\' class="table table-hover" style="border-collapse: collapse">
';
if (($mobile_b + 0) == 0) {
    echo '<tr><td colspan="3"><b><big>  ' . $num_rows . '  </big></b></td><td colspan="1" align="right">';
} else {
    echo '<tr><td colspan="2"><b><big>  ' . $num_rows . '  </big></b></td><td colspan="1" align="right">';
};
echo '<form id="formorder" name="formorder" method="post" enctype="multipart/form-data" action="';
echo '?p=' . $_REQUEST[p] . '&xsp=order';;
echo '">
		<select size="1" name="slb_dataorder" class="form-control"  onchange="SubmitForms(\'formorder\');">
		<option value="" disabled selected></option>
		';
if ($_REQUEST[slb_dataorder] == 0) {
    $check = 'selected';
} else {
    $check = '';
}
echo '<option value="0" ' . $check . '></option>';
if ($_REQUEST[slb_dataorder] == 1) {
    $check = 'selected';
} else {
    $check = '';
}
echo '<option value="1" ' . $check . '></option>';;
echo '		</select>
</form>

<script>
function SubmitForms(formId) {
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
echo '</td>';;
echo '<form name="frm"  enctype="multipart/form-data" method="post" action="';
echo '?p=' . $_REQUEST[p] . '&sp=del_select&page=' . $_REQUEST[page] . '#ok';;
echo '">
  <tr>
    <td width="5%" align="center">
	<input type="image" src="img/del.png" value="" name="B1" title="" onClick=\'return Q_confirm("");\'>
	</td>

';
if (($mobile_b + 0) == 0) {
    echo '<td width="5%" align="center"></td>';
} else {
    echo ' ';
};
echo '	
	
    <!-- <td width="5%" align="center"></td>-->
    <td width="80%"><b></font></b></td>
    <!-- <td width="30%" align="center"><b></font></b></td>-->
    <td width="10%" align="center"><b></font></b></td>

';
$x = 0;
while ($arr = mysql_fetch_array($result)) {
    $x++;
    $sqlslb_booktype = "SELECT * FROM slb_booktype where slb_booktype_id = '$arr[slb_booktype_id]'";
    $dbqueryslb_booktype = mysql_db_query($dbname, $sqlslb_booktype);
    $resultslb_booktype = mysql_fetch_array($dbqueryslb_booktype);
    $bgc = ($bgc == '#FFFFFF') ? '#F9F9F9' : '#FFFFFF';
    if ($arr[readstatus] == '2') {
        $readdate = '';
        $arr[readstatus] = "<img src='slb_mail.png' width='16' border='0' align='center' alt=''> ";
        $bgc = '#FFCCCC';
        $input_box_del = '';
    } else {
        $readdate = datethai($arr[openreaddate]);
        $arr[readstatus] = "<img src='slb_report1.png' width='16' border='0' align='center' alt=''> ";
        $input_box_del = "<input type='checkbox' name='C" . $x . "' value='" . $arr[slb_book_id] . "'>";
        $bgc = '';
    }
    if ($_REQUEST[bookcenter] == '1') {
    } else {
        $bookfw = '<a href="?p=' . $_REQUEST[p] . '&sp=send&slb_book_id=' . $arr[slb_book_id] . '&page=' . $_REQUEST[page] . '#ok"><img src="img/docsend.png" align="center" border="0" title=""></a>';
    }
    if ($arr[pinbook] == '1') {
        $pinbook = '<a href="?p=' . $_REQUEST[p] . '&sp=unpin&slb_book_id=' . $arr[slb_book_id] . '&page=' . $_REQUEST[page] . '&startdate_date=' . $_REQUEST[startdate_date] . '&startdate_month=' . $_REQUEST[startdate_month] . '&startdate_year=' . $_REQUEST[startdate_year] . '&enddate_date=' . $_REQUEST[enddate_date] . '&enddate_month=' . $_REQUEST[enddate_month] . '&slb_booktype_id=' . $_REQUEST[slb_booktype_id] . '&bookcenter=' . $_REQUEST[bookcenter] . '#ok" onClick="return Q_confirm();"><img src="redpin.png" width="16" align="center" border="0" title=""></a>';
    } else {
        $pinbook = '<a href="?p=' . $_REQUEST[p] . '&sp=pin&slb_book_id=' . $arr[slb_book_id] . '&page=' . $_REQUEST[page] . '&startdate_date=' . $_REQUEST[startdate_date] . '&startdate_month=' . $_REQUEST[startdate_month] . '&startdate_year=' . $_REQUEST[startdate_year] . '&enddate_date=' . $_REQUEST[enddate_date] . '&enddate_month=' . $_REQUEST[enddate_month] . '&slb_booktype_id=' . $_REQUEST[slb_booktype_id] . '&bookcenter=' . $_REQUEST[bookcenter] . '#ok" onClick="return Q_confirm();"><img src="unpin.png" width="16" align="center" border="0" title=""></a>';
    }
    echo '<tr bgcolor="' . $bgc . '" ' . $onmouseover . '>';
    if (($mobile_b + 0) == 0) {
        echo '<td valign="top" align="center">' . $input_box_del . '</td><td align="center">' . $pinbook . '</td>';
    } else {
        echo '<td valign="top" align="center">' . $pinbook . '<br>' . $input_box_del . '</td>';
    }
    echo '<td valign="top">' . $arr[readstatus] . '<b><a href="slb_open.php?slb_book_id=' . $arr[slb_book_id] . '" target="_blank" title=" : ' . teacher_name($arr[people_id_fw], '1', $arr[to_school_id]) . '">' . $arr[booktitle] . ' [' . $resultslb_booktype[slb_booktype_name] . '] ';
    if ($arr[slb_bookcation_id] != '0') {
        echo ' <font color="red">[' . datadic('slb_bookcation', $arr[slb_bookcation_id]) . ']</font>';
    }
    if ($arr[bookcenter] != '') echo ' [] ';
    echo '</b></a><small>';
    if ($arr[bookid] != '') echo '<br> : ' . $arr[bookid] . ' ';
    if ($arr[bookindate2] != '0000-00-00') echo '<br> : ' . datethai($arr[bookindate2]) . ' (' . nicetime($arr[bookindate2]) . ')';
    if ($arr[bookinid] != '') echo '<br> : ' . $arr[bookinid] . ' ';
    if ($arr[bookindate] != '') echo '<br> : ' . datethai($arr[bookindate]) . ' (' . nicetime($arr[bookindate]) . ')';
    if ($arr[incomdate] != '') echo '<br> : ' . datethai($arr[incomdate]) . ' (' . nicetime($arr[incomdate]) . ')';
    if ($arr[last_comment] != '') echo '<br><font color="red"> : ' . $arr[last_comment] . '</font>';
    if ($arr[bookurlphoto] != '') echo '<br><a href="' . $arr[bookurlphoto] . '" target="_blank"></a>';
    if ($arr[bookcomment] != '') {
        $arr[bookcomment] = autoahref($arr[bookcomment]);
        echo '<br> : ' . $arr[bookcomment] . '';
    }
    if ($arr[bookto] != '') {
        $arr[bookto] = autoahref($arr[bookto]);
        echo '<br> : ' . $arr[bookto] . '';
    }
    if ($arr[bookfrom] != '') {
        $arr[bookfrom] = autoahref($arr[bookfrom]);
        echo '<br> : ' . $arr[bookfrom] . '';
    }
    if ($arr[slb_comment_id] + 0 != '0') echo '<br><b>  : ' . datadic('slb_comment', $arr[slb_comment_id]) . '</b>';
    if ($arr[slb_comment_id] + 0 != '0') {
        $detail = $arr[slb_bookcomment];
        $detail = htmlspecialchars($detail, ENT_COMPAT, 'ISO-8859-1');
        $detail = str_replace(Array("
", "
", "
"), '<br>', $detail);
        $detail = autoahref($detail);
        echo '<br> : ' . $detail . '';
    }
    if ($arr[slb_comment_id] + 0 != '0') echo '<br> : ' . datethai($arr[slb_comment_date]) . ' (' . nicetime($arr[slb_comment_date]) . ')';
    echo '</small>';
    echo '</td>';
    echo '<td valign="top"><center><a href="slb_comment.php?slb_book_id=' . $arr[slb_book_id] . '" title="   " class="lightwindow page-options" params="lightwindow_type=external,lightwindow_width=500,lightwindow_height=300"><img src="chk_view.png" width="24" border="0" title="   "></a><br><br> ' . $bookfw . ' ' . $bookdelete . '</td>';
};
echo '  <tr>
    <td align="center">
	<input type="image" src="img/del.png" value="" name="B1" title="" onClick=\'return Q_confirm("");\'>
	<input name="countno" type="hidden" value="';
echo $x;;
echo '">
	</td>
	
    
	';
if (($mobile_b + 0) == 0) {
    echo '<td align="center"></td>';
} else {
    echo '';
};
echo '    <td></td>
    <!-- <td></td> -->
    <td></td>
</table>
</form>

';
pu_pageloop("p=$_REQUEST[p]&sp=$_REQUEST[sp]&txtsearch=$_REQUEST[txtsearch]&startdate_date=$_REQUEST[startdate_date]&startdate_month=$_REQUEST[startdate_month]&startdate_year=$_REQUEST[startdate_year]&enddate_date=$_REQUEST[enddate_date]&enddate_month=$_REQUEST[enddate_month]&enddate_year=$_REQUEST[enddate_year]&slb_booktype_id=$_REQUEST[slb_booktype_id]&bookcenter=$_REQUEST[bookcenter]&slb_comment_id=$_REQUEST[slb_comment_id]#ok");;
echo '
<!--
<p align="right"><a href="slb_backup.php?';
echo "&txtsearch=$_REQUEST[txtsearch]&startdate_date=$_REQUEST[startdate_date]&startdate_month=$_REQUEST[startdate_month]&startdate_year=$_REQUEST[startdate_year]&enddate_date=$_REQUEST[enddate_date]&enddate_month=$_REQUEST[enddate_month]&enddate_year=$_REQUEST[enddate_year]&slb_booktype_id=$_REQUEST[slb_booktype_id]&bookcenter=$_REQUEST[bookcenter]&slb_comment_id=$_REQUEST[slb_comment_id]";;
echo '"  title="" class="lightwindow page-options" params="lightwindow_type=external,lightwindow_width=500,lightwindow_height=300"><img src="chk_xls.png" border="0" align="center"><br><b><br></b></a></p>
<br> -->';