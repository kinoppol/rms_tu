<?php $sql = "delete from slb_booktopeople WHERE slb_book_id='' ";
$dbquery = mysql_db_query($dbname, $sql);
if ($_REQUEST[sp] == 'del_select') {
    for ($x = 0;$x <= $_REQUEST[countno];$x++) {
        $Cx = $_POST['C' . $x];
        if ($Cx != '') {
            $sql = "update slb_booktopeople set hiddenbook='1' where people_id='$_SESSION[userid]' and slb_book_id='$Cx' and school_id = '$_SESSION[school_id]' ";
            $dbquery = mysql_db_query($dbname, $sql);
        }
    }
    echo '<br><center><b><big></big></b></center>';
    echo '<hr size="1">';
    $_REQUEST[sp] = 'search';
}
if ($_REQUEST[sp] == 'del') {
    $sql = "update slb_booktopeople set hiddenbook='1' where people_id='$_SESSION[userid]' and slb_book_id='$_REQUEST[slb_book_id]' and school_id = '$_SESSION[school_id]' ";
    $dbquery = mysql_db_query($dbname, $sql);
    echo '<br><center><b><big></big></b></center>';
    echo '<hr size="1">';
    $_REQUEST[sp] = 'search';
}
if ($_REQUEST[sp] == 'pin') {
    $sql = "update slb_booktopeople set pinbook='1' where people_id='$_SESSION[userid]' and slb_book_id='$_REQUEST[slb_book_id]' and school_id = '$_SESSION[school_id]' ";
    $dbquery = mysql_db_query($dbname, $sql);
    echo '<br><center><b><big></big></b></center>';
    echo '<hr size="1">';
    $_REQUEST[sp] = 'search';
}
if ($_REQUEST[sp] == 'unpin') {
    $sql = "update slb_booktopeople set pinbook='0' where people_id='$_SESSION[userid]' and slb_book_id='$_REQUEST[slb_book_id]' and school_id = '$_SESSION[school_id]' ";
    $dbquery = mysql_db_query($dbname, $sql);
    echo '<br><center><b><big></big></b></center>';
    echo '<hr size="1">';
    $_REQUEST[sp] = 'search';
}
if ($_REQUEST[xsp] == 'slb_clear') {
    $sql = "update slb_booktopeople set openreaddate='$thistime' , readstatus='1' where people_id = '$_SESSION[userid]' and school_id = '$_SESSION[school_id]' and readstatus = '2' ";
    $dbquery = mysql_db_query($dbname, $sql);
    echo '<br><center><b><big></big></b></center>';
    echo '<hr size="1">';
}
if ($_REQUEST[sp] == '' || $_REQUEST[sp] == 'search') {
    include 'slb_home_search.php';
} else if ($_REQUEST[sp] == 'send' || $_REQUEST[sp] == 'temp' || $_REQUEST[sp] == 'accept' || $_REQUEST[sp] == 'deaccept') {
    if ($_REQUEST[school_id] != '') {
        $people_school_id = $_REQUEST[school_id];
    } else {
        $people_school_id = $_SESSION[school_id];
    }
    if ($_REQUEST[sp] == 'temp') {
        for ($x = 0;$x <= $_REQUEST[countno];$x++) {
            $Cx = $_POST['C' . $x];
            if ($Cx != '') {
                $sql = "select * from slb_booktopeople where slb_book_id='$_REQUEST[slb_book_id]' and people_id='$Cx' and school_id = '$people_school_id' and to_school_id = '$_SESSION[school_id]' ";
                $dbquery = mysql_db_query($dbname, $sql);
                $num_rows = mysql_num_rows($dbquery);
                $result = mysql_fetch_array($dbquery);
                if ($num_rows == 1) {
                } else {
                    $sql = "insert into slb_booktopeople (slb_book_id, people_id , incomdate, readstatus , people_id_fw, school_id, to_school_id) values ('$_REQUEST[slb_book_id]', '$Cx', '$thistime', '2' , '$_SESSION[userid]','$people_school_id','$_SESSION[school_id]')";
                    $dbquery = mysql_db_query($dbname, $sql);
                }
            }
        }
    }
    if ($_REQUEST[sp] == 'deaccept') {
        if ($_REQUEST[school_id] != '') {
            $people_school_id = $_REQUEST[school_id];
        } else {
            $people_school_id = $_SESSION[school_id];
        }
        $sql = "delete from slb_booktopeople where slb_book_id='$_REQUEST[slb_book_id]' and people_id='$_REQUEST[people_id]' and school_id = '$people_school_id'  ";
        $dbquery = mysql_db_query($dbname, $sql);
    }
    if ($_REQUEST[sp] == 'accept') {
        if ($_REQUEST[school_id] != '') {
            $people_school_id = $_REQUEST[school_id];
        } else {
            $people_school_id = $_SESSION[school_id];
        }
        $sql = "update slb_booktopeople set completebook='1' , people_id_fw='$_SESSION[userid]' , last_comment = '$_REQUEST[last_comment]' where slb_book_id='$_REQUEST[slb_book_id]' and people_id_fw = '$_SESSION[userid]' and to_school_id = '$_SESSION[school_id]' and completebook = '0' ";
        $dbquery = mysql_db_query($dbname, $sql);
        $sql = "SELECT * FROM slb_booktopeople WHERE completebook='1' and slb_book_id = '$_REQUEST[slb_book_id]'  ";
        $result = mysql_db_query($dbname, $sql);
        while ($arr = mysql_fetch_array($result)) {
            $sqlslbbook = "SELECT * FROM slb_book where slb_book_id = '$_REQUEST[slb_book_id]' and school_id = '$_SESSION[school_id]'  ";
            $dbqueryslbbook = mysql_db_query($dbname, $sqlslbbook);
            $arrslbbook = mysql_fetch_array($dbqueryslbbook);
            pms_warning($_SESSION[mod], ' : ' . $arrslbbook[booktitle] . '', $arr[people_id], $arr[people_id_fw], '?p=slb_home&mod=3', $people_school_id, $_REQUEST[slb_book_id]);
            if ($resultmms[mms_config_16] == '0' && $resultmms[mms_config_01] != '0') {
                if ($arrslbbook[slb_bookcation_id] >= $resultmms[mms_config_07]) {
                    $sqlpeople_tel = "SELECT * FROM people where people_id = '$arr[people_id]' and  people_mobile != '' and school_id = '$arr[school_id]' and people_exit != '1' ";
                    $dbquerypeople_tel = mysql_db_query($dbname, $sqlpeople_tel);
                    $arrpeople_tel = mysql_fetch_array($dbquerypeople_tel);
                    $num_rows_data = mysql_num_rows($dbquerypeople_tel);
                    if ($num_rows_data == '1') {
                        $textsmssend = substr($resultmms[mms_text_02] . ' : ' . $arrslbbook[booktitle], 0, $config_value[55]);
                        mms_send($arrpeople_tel[people_id], '1', $arrpeople_tel[people_mobile], $mms_send_status, $textsmssend, $arr[school_id]);
                    }
                }
            }
        }
        echo '<center><b><big></big></b></center>';
        echo '<hr size="1">';
    }
    $sql = "SELECT * FROM slb_book where slb_book_id = '$_REQUEST[slb_book_id]' ";
    $dbquery = mysql_db_query($dbname, $sql);
    $result = mysql_fetch_array($dbquery);;
    echo '		<table align="center" class="table table-striped table-hover" width="95%" border="0" style="border-collapse: collapse">
			';
    echo '<tr><td colspan="2"><b><big><a href="?p=' . $_REQUEST[p] . '#ok"></a> > </big></b></td>';
    textinput('', 'booktitle', $result[booktitle], 'text', '50', '', '1');
    textinput('', 'bookid', $result[bookid], 'text', '', '', '1');;
    echo '		</table>
';
    $commoninput_name = 'slb_book_id';
    $commoninput_value = $_REQUEST[slb_book_id];
    include 'slb_function_people.php';;
    echo '
</td><td width="50%">

		<a name="ok2"></a>
		<form name="frm2"  enctype="multipart/form-data" method="post" action="';
    echo '?p=' . $_REQUEST[p] . '&sp=accept&page=' . $_REQUEST[page] . '#ok';;
    echo '">
		<table width=\'95%\'  class="table table-striped table-hover" align=\'center\'>
		';
    echo '<tr><td colspan="4"><b><big></big></b><br><small>*  </small></td>';;
    echo '		  <tr>
			<td width="80%"><b> </b></td>
			<td width="20%" align="center"><b></b></td>

			<!-- <td width="20%" align="center"><b></b></td>-->

		';
        
        $sqldep = "SELECT * FROM people_dep";
        $dbquerydep = mysql_db_query($dbname, $sqldep);
        $resultdep =array();
        while($row= mysql_fetch_array($dbquerydep)){
            $resultdep[$row['people_dep_id']]=$row;
        }

    $sql = "SELECT people.* , slb_booktopeople.* FROM people , slb_booktopeople WHERE slb_booktopeople.slb_book_id='$_REQUEST[slb_book_id]' AND people.people_id = slb_booktopeople.people_id and slb_booktopeople.people_id_fw='$_SESSION[userid]' GROUP BY slb_booktopeople.people_id ORDER BY slb_booktopeople.completebook";
    $result = mysql_db_query($dbname, $sql);
    $num_rows = mysql_num_rows($result);
    while ($arr = mysql_fetch_array($result)) {
        if ($arr[completebook] == '1') {
            $arr[completebook] = '';
            $arr[delbook] = '';
        } else {
            $arr[completebook] = '<font color="red"></font>';
            $arr[delbook] = '<a href="?p=' . $_REQUEST[p] . '&sp=deaccept&slb_book_id=' . $arr[slb_book_id] . '&people_id=' . $arr[people_id] . '&page=' . $_REQUEST[page] . '&school_id=' . $arr[school_id] . '#ok2" onClick="return Q_confirm();"><img src="img/del.png" border="0" title=""></a>';
            $zzz++;
        }
        $yy++;
        echo '<tr ' . $onmouseover . '><td valign="top"><b>' . $yy . '. ' . $arr[people_name] . ' ' . $arr[people_surname] . ' (' . $arr[people_nickname] . ') ';
        if ($arr[linetoken] != '') echo '<img src="line_icon.png" width="16" title=" Line">';
        echo '</b>';
        echo '<br><small>';
        $Querypeople_pro = mysql_query("SELECT * FROM people_pro where people_id = '$arr[people_id]' and people_stagov_id like '%$_REQUEST[people_stagov_id]%' and people_dep_id like '%$_REQUEST[people_dep_id]%' and school_id = '$people_school_id' ORDER BY people_stagov_id , people_dep_id");
            

        while ($arrpeople_pro = mysql_fetch_array($Querypeople_pro)) {
            $people_stagov_id = $arrpeople_pro[people_stagov_id];
            $people_dep_id = $arrpeople_pro[people_dep_id];
            $sqlstagov = "SELECT * FROM people_stagov where people_stagov_id = '$people_stagov_id'";
            $dbquerystagov = mysql_db_query($dbname, $sqlstagov);
            $resultstagov = mysql_fetch_array($dbquerystagov);
            /*
            $sqldep = "SELECT * FROM people_dep where people_dep_id = '$people_dep_id'";
            $dbquerydep = mysql_db_query($dbname, $sqldep);
            $resultdep = mysql_fetch_array($dbquerydep);
            */
            echo '- ' . $resultstagov[people_stagov_name] . ' ' . $resultdep[$people_dep_id][people_dep_name] . ' <br>';
        }
        echo '</small>';
        echo '</td>';
        echo '<td valign="top"><center>' . $arr[completebook] . '<br>' . $arr[delbook] . '</center></td>';
    }
    textareainput('', 'last_comment', '', '', '3', '75', '2');;
    echo '		</table>
		<input name="';
    echo $commoninput_name;
    echo '" type="hidden" value="';
    echo $commoninput_value;
    echo '">
		<br>
		';
    textinputhide('', 'school_id', $_REQUEST[school_id], 'text', '', '', '1');;
    echo '
		<center><input type="submit" value="" class="btn btn-primary"></center>
		</form>

';
    if ($zzz + 0 != 0) {
        echo '<center><font color="red"><b>***   ""  ***</b></font></center>';
    };
    echo '</td>
</table>
';
} else {
};
echo '   ';