<?php date_default_timezone_set('Asia/Bangkok');
function timeinout($timeinout, $group_id, $eduyear_id, $num_day, $type, $sys_id) {
    @$Query = mysql_query("SELECT * FROM group_config WHERE student_group_id = '$group_id' and eduyear_id = '$eduyear_id' and sys_id = '$sys_id' and school_id = '$_SESSION[school_id]' ");
    @$totalgroup = mysql_num_rows($Query);
    if ($totalgroup == '1') {
        while ($resultgroup = mysql_fetch_array($Query)) {
            if ($num_day == 1) {
                if ($type == 1) {
                    $time_check = $resultgroup[m_in];
                } else {
                    $time_check = $resultgroup[m_out];
                }
            }
            if ($num_day == 2) {
                if ($type == 1) {
                    $time_check = $resultgroup[t_in];
                } else {
                    $time_check = $resultgroup[t_out];
                }
            }
            if ($num_day == 3) {
                if ($type == 1) {
                    $time_check = $resultgroup[w_in];
                } else {
                    $time_check = $resultgroup[w_out];
                }
            }
            if ($num_day == 4) {
                if ($type == 1) {
                    $time_check = $resultgroup[th_in];
                } else {
                    $time_check = $resultgroup[th_out];
                }
            }
            if ($num_day == 5) {
                if ($type == 1) {
                    $time_check = $resultgroup[f_in];
                } else {
                    $time_check = $resultgroup[f_out];
                }
            }
            if ($num_day == 6) {
                if ($type == 1) {
                    $time_check = $resultgroup[s_in];
                } else {
                    $time_check = $resultgroup[s_out];
                }
            }
            if ($num_day == 7) {
                if ($type == 1) {
                    $time_check = $resultgroup[su_in];
                } else {
                    $time_check = $resultgroup[su_out];
                }
            }
            if ($type == 1) {
                if ($timeinout <= $time_check) {
                    return $timeinout;
                } else {
                    return '<font color="red">' . $timeinout . '</font>';
                }
            } else {
                if ($timeinout >= $time_check) {
                    return $timeinout;
                } else {
                    return '<font color="red">' . $timeinout . '</font>';
                }
            }
        }
    } else {
        return $timeinout;
    }
}
function teacher_name($people_id, $dataformat, $to_school_id = null) {
    GLOBAL $dbname;
    GLOBAL $onmouseover;
    GLOBAL $destination_path;
    GLOBAL $browser;
    if ($to_school_id == null) {;
        $school_ii = $_SESSION[school_id];
    } else {
        $school_ii = $to_school_id;
    }
    if ($browser >= 1) {
        $picsize = '100';
    } else {
        $picsize = '140';
    }
    @$Query = mysql_query("SELECT * FROM people WHERE people_id = '$people_id' and school_id = '$school_ii'");
    @$totalpeople = mysql_num_rows($Query);
    while ($resultpeople = mysql_fetch_array($Query)) {
        if ($resultpeople[people_pic] == '') {
            $people_image = '<img src="picture.png" width="' . $picsize . '" border="1">';
            $filename = 'picture.png';
        } else {
            $filename = $destination_path . '/display_' . $resultpeople[people_pic];
            if (file_exists($filename)) {
                $filename = $destination_path . '/display_' . $resultpeople[people_pic];
            } else {
                $filename = $destination_path . '/' . $resultpeople[people_pic];
            }
            $people_image = '<img src="image.php?src=' . $filename . '&x=200&f=0" width="' . $picsize . '" border="1"/>';
        }
        if ($totalpeople == 0) {
            return '<b></b>';
        } else {
            if ($dataformat == 1) {
                return $resultpeople[people_name] . ' ' . $resultpeople[people_surname];
            } else if ($dataformat == 2) {
                if ($_SESSION[userid] == $people_id) {
                    $mystudent = '<b></b>';
                } else {
                    $mystudent = '<font color="red"><b>  </b></font>';
                }
                return '<tr><td colspan="2"><center>' . $people_image . '</center></td>' . '<tr ' . $onmouseover . ' valign="top"><td>  : </td><td><b>' . $resultpeople[people_name] . ' ' . $resultpeople[people_surname] . '</b></td>' . '<tr ' . $onmouseover . ' valign="top"><td> : </td><td>' . $resultpeople[people_tel] . ' <a href="tel:' . $resultpeople[people_tel] . '"><img src="tel.png" width="16"></a></td>' . '<tr ' . $onmouseover . ' valign="top"><td> () : </td><td>' . $resultpeople[people_mobile] . ' <a href="tel:' . $resultpeople[people_mobile] . '"><img src="tel.png" width="16"></a></td>' . '<tr ' . $onmouseover . ' valign="top"><td> : </td><td>' . $resultpeople[people_email] . '</td>' . '<tr ' . $onmouseover . ' valign="top"><td> ID : </td><td>' . $resultpeople[people_lineid] . '</td>' . '<tr ' . $onmouseover . ' valign="top"><td colspan="2"><center><a href="mail_reply.php?replyto=' . $resultpeople[people_id] . '" title="" class="lightwindow page-options" params="lightwindow_type=external,lightwindow_width=600,lightwindow_height=400"><img src="mail_comp.png" border="0" align="center" width="24" ></a></center></td>' . '<tr ' . $onmouseover . ' valign="top"><td colspan="2"><center>' . $mystudent . '</center></td>';
            } else if ($dataformat == 3) {
                return '<tr><td colspan="2"><center>' . $people_image . '</center></td>' . '<tr ' . $onmouseover . ' valign="top"><td>  : </td><td><b>' . $resultpeople[people_name] . ' ' . $resultpeople[people_surname] . '</b></td>' . '<tr ' . $onmouseover . ' valign="top"><td> : </td><td>' . $resultpeople[people_tel] . ' <a href="tel:' . $resultpeople[people_tel] . '"><img src="tel.png" width="16"></a></td>' . '<tr ' . $onmouseover . ' valign="top"><td> () : </td><td>' . $resultpeople[people_mobile] . ' <a href="tel:' . $resultpeople[people_mobile] . '"><img src="tel.png" width="16"></a></td>' . '<tr ' . $onmouseover . ' valign="top"><td> : </td><td>' . $resultpeople[people_email] . '</td>' . '<tr ' . $onmouseover . ' valign="top"><td> ID : </td><td>' . $resultpeople[people_lineid] . '</td>';
            } else if ($dataformat == 5) {
                return '<img src="image.php?src=' . $filename . '&x=200&f=0" width="48" border="1"/>';
            } else if ($dataformat == 6) {
                return '<input type="image" src="image.php?src=' . $filename . '&x=200&f=0" style="border:1px;" width="140" alt="">';
            } else if ($dataformat == 9) {
                return '<tr><td colspan="2"><center>' . $people_image . '</center></td>' . '<tr ' . $onmouseover . ' valign="top"><td>  : </td><td><b>' . $resultpeople[people_name] . ' ' . $resultpeople[people_surname] . '</b></td>';
            } else if ($dataformat == 10) {
                return $resultpeople[std_id] . ' ' . $resultpeople[people_name] . ' ' . $resultpeople[people_surname];
            } else if ($dataformat == 11) {
                return $resultpeople[people_name] . ' ' . $resultpeople[people_surname];
            } else if ($dataformat == 111) {
                return $resultpeople[people_name] . ' ' . $resultpeople[people_surname] . ' (' . $resultpeople[people_nickname] . ')';
            } else if ($dataformat == 12) {
                return $resultpeople[people_name] . ' ' . $resultpeople[people_surname] . ' . ' . $resultpeople[people_mobile];
            } else if ($dataformat == 13) {
                $Querypeople_pro = mysql_query("SELECT * FROM people_pro WHERE people_id = '$people_id' and school_id = '$school_ii' ORDER BY people_dep_id desc");
                $x = 0;
                while ($arrpeople_pro = mysql_fetch_array($Querypeople_pro)) {
                    $people_stagov_id = $arrpeople_pro[people_stagov_id];
                    $people_dep_id = $arrpeople_pro[people_dep_id];
                    $sqlstagov = "SELECT * FROM people_stagov where people_stagov_id = '$people_stagov_id'";
                    $dbquerystagov = mysql_db_query($dbname, $sqlstagov);
                    $resultstagov = mysql_fetch_array($dbquerystagov);
                    $sqldep = "SELECT * FROM people_dep where people_dep_id = '$people_dep_id'";
                    $dbquerydep = mysql_db_query($dbname, $sqldep);
                    $resultdep = mysql_fetch_array($dbquerydep);
                }
                if ($resultdep[people_dep_name] == '') {
                    return '.........................................................';
                } else {
                    return $resultdep[people_dep_name];
                }
            }
        }
    }
}
function sendmailto($people_id) {
    return '<a href="mail_reply.php?replyto=' . $people_id . '" title="" class="lightwindow page-options" params="lightwindow_type=external,lightwindow_width=600,lightwindow_height=400"><img src="mail_comp.png" border="0" align="center" width="16" ></a>';
}
function sendmailtostd($student_id, $subject_id, $addition) {
    return '<a href="sms_data09.php?student_id=' . $student_id . '&subject_id=' . $subject_id . '&addition=' . $addition . '" title="" class="lightwindow page-options" params="lightwindow_type=external,lightwindow_width=600,lightwindow_height=400"><img src="mail_comp.png" border="0" align="center" width="16" ></a> 
				
				<a href="whoami_sms.php?student_id=' . $student_id . '&subject_id=' . $subject_id . '&addition=' . $addition . '" title="" class="lightwindow page-options" params="lightwindow_type=external,lightwindow_width=600,lightwindow_height=400"><img src="myqrcode_black.png" border="0" align="center" width="16" ></a>';
}
function student_name($student_id, $dataformat) {
    GLOBAL $onmouseover;
    GLOBAL $destination_path;
    GLOBAL $browser;
    GLOBAL $config_value;
    GLOBAL $dbname;
    if ($browser >= 1) {
        $picsize = '100';
    } else {
        $picsize = '140';
    }
    @$Query = mysql_query("SELECT * FROM student WHERE student_id = '$student_id' and school_id = '$_SESSION[school_id]' ");
    @$totalstudent = mysql_num_rows($Query);
    while ($resultstudent = mysql_fetch_array($Query)) {
        if ($resultstudent[cov_infected_status_id] == '1' || $resultstudent[cov_infected_status_id] == '2') {
            $sql_cov_infected_status = "SELECT * FROM cov_infected_status where cov_infected_status_id = '" . $resultstudent[cov_infected_status_id] . "' ";
            $dbquery_cov_infected_status = mysql_db_query($dbname, $sql_cov_infected_status);
            $result_cov_infected_status = mysql_fetch_array($dbquery_cov_infected_status);
            $cov_infected_status_name = ' <font color="red">(' . $result_cov_infected_status[cov_infected_status_name] . ')</font>';
        }
        $sex_id = $resultstudent[gender_id];
        $level_id = $resultstudent[grade_id];
        if ($sex_id == '1') {
            if ($level_id == '10' or $level_id == '11' or $level_id == '12') {
                $sex_name = '';
                $sex = '..';
            } else {
                $sex_name = '';
                $sex = '';
            }
        } else {
            if ($level_id == '10' or $level_id == '11' or $level_id == '12') {
                $sex_name = '';
                $sex = '..';
            } else {
                $sex_name = '';
                $sex = '';
            }
        }
        if (substr($resultstudent[stu_fname], 0, 3) == '' && substr($resultstudent[stu_fname], 0, 6) != '' && $resultstudent[stu_fname] != '') {
            $sex = '';
        }
        if ($resultstudent[filepic] == '') {
            $student_image = '<img src="picture.png" width="' . $picsize . '" border="1">';
            $student_image2 = '<img src="picture.png" width="120" border="1">';
            $student_image3 = '<img src="' . $config_value[2] . '/picture.png" width="120" height="120" border="1">';
            $filename = 'picture.png';
        } else {
            $filename = $destination_path . '/display_' . $resultstudent[filepic];
            if (file_exists($filename)) {
                $filename = $destination_path . '/display_' . $resultstudent[filepic];
            } else {
                $filename = $destination_path . '/' . $resultstudent[filepic];
            }
            $student_image3 = '<img src="' . $config_value[2] . '/' . $filename . '" width="120" height="120" border="1">';
            $student_image2 = '<img src="' . $filename . '" width="120" border="1">';
            $student_image = '<img src="image.php?src=' . $filename . '&x=200&f=0" width="' . $picsize . '" border="1"/>';
        }
        if ($dataformat == 0) {
            return $sex . $resultstudent[stu_fname] . ' ' . $resultstudent[stu_lname];
        } else if ($dataformat == 102) {
            if ($resultstudent[status] == '0') {
                return $sex . $resultstudent[stu_fname] . ' ' . $resultstudent[stu_lname];
            } else {
                return '<font color="#CCCCCC">' . $sex . $resultstudent[stu_fname] . ' ' . $resultstudent[stu_lname] . '</font>';
            }
        } else if ($dataformat == 99) {
            return $sex . $resultstudent[stu_fname];
        } else if ($dataformat == 999) {
            return $sex . $resultstudent[stu_fname] . ' ' . $resultstudent[stu_lname];
        } else if ($dataformat == 100) {
            return $sex . $resultstudent[stu_fname];
        } else if ($dataformat == 101) {
            return $resultstudent[stu_lname];
        } else if ($dataformat == 1) {
            return '<tr><td colspan="2"><center>' . $student_image . '</center></td>' . '<tr ' . $onmouseover . '><td> : </td><td><b>' . $resultstudent[student_id] . '</b></td>' . '<tr ' . $onmouseover . '><td>  :</td><td>' . $sex . $resultstudent[stu_fname] . ' ' . $resultstudent[stu_lname] . ' (' . $resultstudent[nickname] . ')</td>';
        } else if ($dataformat == 1111) {
            return '<tr><td colspan="2"><center>' . $student_image . '</center></td>' . '<tr ' . $onmouseover . '><td> : </td><td><b>' . $resultstudent[student_id] . '</b></td>' . '<tr ' . $onmouseover . '><td>  :</td><td>' . $sex . $resultstudent[stu_fname] . ' ' . $resultstudent[stu_lname] . ' (' . $resultstudent[nickname] . ')</td>' . '<tr ' . $onmouseover . '><td> : </td><td>' . $resultstudent[nickname] . '</td>' . '<tr ' . $onmouseover . '><td> : </td><td>' . $resultstudent[people_id] . '</td>';
        } else if ($dataformat == 11111) {
            return '<tr><td colspan="2"><center>' . $student_image . '</center></td>' . '<tr ' . $onmouseover . '><td> : </td><td><b>' . $resultstudent[student_id] . '</b></td>' . '<tr ' . $onmouseover . '><td>  :</td><td>' . $sex . $resultstudent[stu_fname] . ' ' . $resultstudent[stu_lname] . ' (' . $resultstudent[nickname] . ')</td>' . '<tr ' . $onmouseover . '><td> : </td><td>' . $resultstudent[nickname] . '</td>';
        } else if ($dataformat == 2) {
            if ($_REQUEST[mod] != 'report') {
                if ($config_value[88] + 0 == '0' && $_REQUEST[p] == 'sms_home') {
                    $change_status = '';
                } else {
                    $change_status = '<a href="sms_status_change.php?student_id=' . $resultstudent[student_id] . '"  title="" class="lightwindow page-options" params="lightwindow_type=external,lightwindow_width=400,lightwindow_height=200"><img src="img/edit.png" border="0" align="center" width="16"></a>';
                }
                if ($config_value[142] == '0') {
                    $change_pass = '<a href="sms_pass_change.php?student_id=' . $resultstudent[student_id] . '"  title="" class="lightwindow page-options" params="lightwindow_type=external,lightwindow_width=300,lightwindow_height=200"><img src="img/edit.png" border="0" align="center" width="16"></a>';
                }
                if ($config_value[143] == '0') {
                    $change_pass2 = '<a href="sms_pass2_change.php?student_id=' . $resultstudent[student_id] . '"  title="" class="lightwindow page-options" params="lightwindow_type=external,lightwindow_width=300,lightwindow_height=200"><img src="img/edit.png" border="0" align="center" width="16"></a>';
                }
            }
            if ($config_value[87] == '1') {
                $change_pass = '<a href="sms_pass_change.php?student_id=' . $resultstudent[student_id] . '"  title="" class="lightwindow page-options" params="lightwindow_type=external,lightwindow_width=300,lightwindow_height=200"><img src="img/edit.png" border="0" align="center" width="16"></a>';
                $change_pass2 = '<a href="sms_pass2_change.php?student_id=' . $resultstudent[student_id] . '"  title="" class="lightwindow page-options" params="lightwindow_type=external,lightwindow_width=300,lightwindow_height=200"><img src="img/edit.png" border="0" align="center" width="16"></a>';
            }
            if ($resultstudent[status] == '0') {
                $status_change = ' ' . $change_status;
            } else {
                $status_change = '<font color="red">///</font> ' . $change_status;
            }
            return '<tr><td colspan="2"><center>' . $student_image2 . '</center></td>' . '<tr ' . $onmouseover . '><td> : </td><td><b>' . $resultstudent[student_id] . '</b></td>' . '<tr ' . $onmouseover . '><td>  :</td><td>' . $sex . $resultstudent[stu_fname] . ' ' . $resultstudent[stu_lname] . '</td>' . '<tr ' . $onmouseover . '><td> : </td><td>' . $resultstudent[nickname] . '</td>' . '<tr ' . $onmouseover . '><td> : </td><td>' . $resultstudent[people_id] . '</td>' . '<tr ' . $onmouseover . '><td> : </td><td>' . $resultstudent[birthday] . '</td>' . '<tr ' . $onmouseover . '><td> : </td><td>' . datadic('nation', $resultstudent[nation_id]) . '</td>' . '<tr ' . $onmouseover . '><td> : </td><td>' . $resultstudent[religion] . '</td>' . '<tr ' . $onmouseover . '><td> : </td><td>' . datadic('province', $resultstudent[b_provite]) . '</td>' . '<tr ' . $onmouseover . '><td> : </td><td>' . $resultstudent[std_blgr] . '</td>' . '<tr ' . $onmouseover . '><td> RF-ID : </td><td>' . $resultstudent[std_rf_id] . '</td>' . '<tr ' . $onmouseover . '><td> () : </td><td>' . $resultstudent[stdpass] . ' ' . $change_pass . '</td>' . '<tr ' . $onmouseover . '><td> () : </td><td>' . $resultstudent[othpass] . ' ' . $change_pass2 . '</td>' . '<tr ' . $onmouseover . '><td> : </td><td>' . $status_change . '</td>';
        } else if ($dataformat == 3) {
            return '<tr><td colspan="2"><center>' . $student_image2 . '</center></td>' . '<tr ' . $onmouseover . '><td> : </td><td><b>' . $resultstudent[student_id] . '</b></td>' . '<tr ' . $onmouseover . '><td>  :</td><td>' . $sex . $resultstudent[stu_fname] . ' ' . $resultstudent[stu_lname] . '</td>' . '<tr ' . $onmouseover . '><td> : </td><td>' . $resultstudent[nickname] . '</td>' . '<tr ' . $onmouseover . '><td> : </td><td>' . $resultstudent[birthday] . '</td>' . '<tr ' . $onmouseover . '><td> : </td><td>' . datadic('nation', $resultstudent[nation_id]) . '</td>' . '<tr ' . $onmouseover . '><td> : </td><td>' . $resultstudent[religion] . '</td>' . '<tr ' . $onmouseover . '><td> : </td><td>' . datadic('province', $resultstudent[b_provite]) . '</td>' . '<tr ' . $onmouseover . '><td> : </td><td>' . $resultstudent[std_blgr] . '</td>';
        } else if ($dataformat == 4) {
            return '<tr><td colspan="2"><center>' . $student_image . '</center></td>' . '<tr ' . $onmouseover . '><td> : </td><td><b>' . $resultstudent[student_id] . '</b></td>' . '<tr ' . $onmouseover . '><td>  :</td><td>' . $sex . $resultstudent[stu_fname] . ' ' . $resultstudent[stu_lname] . '</td>' . '<tr ' . $onmouseover . '><td> : </td><td>' . $resultstudent[nickname] . '</td>';
        } else if ($dataformat == 5) {
            return $student_image;
        } else if ($dataformat == 55) {
            return '<img src="image.php?src=' . $filename . '&x=80&f=0" width="80" alt="" border="1">';
        } else if ($dataformat == 5555) {
            return $filename;
        } else if ($dataformat == 55555) {
            return 'image.php?src=' . $filename . '&x=50&f=0&max_x=4&max_y=4';
        } else if ($dataformat == 555) {
            return $student_image3;
        } else if ($dataformat == 6) {
            return '<input type="image" src="image.php?src=' . $filename . '&x=200&f=0" style="border:1px;" width="140" alt="">';
        } else if ($dataformat == 7) {
            return '<tr ' . $onmouseover . '><td> : </td><td><b>' . $resultstudent[student_id] . '</b></td>' . '<tr ' . $onmouseover . '><td>  :</td><td>' . $sex . $resultstudent[stu_fname] . ' ' . $resultstudent[stu_lname] . ' (' . $resultstudent[nickname] . ')</td>';
        } else if ($dataformat == 8) {
            echo $sex . $resultstudent[stu_fname] . ' ' . $resultstudent[stu_lname];
        } else if ($dataformat == 88) {
            return $resultstudent[stu_fname] . ' ' . $resultstudent[stu_lname];
        } else if ($dataformat == 888) {
            return $sex . $resultstudent[stu_fname] . ' ' . $resultstudent[stu_lname];
        } else if ($dataformat == 8888) {
            echo $sex . $resultstudent[stu_fname] . ' ' . $resultstudent[stu_lname] . '' . $cov_infected_status_name;
        } else if ($dataformat == 88888) {
            return $sex . $resultstudent[stu_fname] . ' ' . $resultstudent[stu_lname] . '' . $cov_infected_status_name;
        } else if ($dataformat == 9) {
            return '<tr><td colspan="2"><center>' . $student_image . '</center></td>';
        } else if ($dataformat == 10) {
            $arrstudent[province_id] = substr($resultstudent[tumbol_id], 0, 2);
            $arrstudent[amphure_id] = substr($resultstudent[tumbol_id], 0, 4);
            $Query = mysql_query("select * from province where province_id = '$arrstudent[province_id]'");
            while ($arr = mysql_fetch_array($Query)) {
                $province_name = $arr[province_name];
            }
            $Query = mysql_query("select * from amphure where amphure_id = '$arrstudent[amphure_id]'");
            while ($arr = mysql_fetch_array($Query)) {
                $amphure_name = $arr[amphure_name];
            }
            $Query = mysql_query("select * from tumbol where tumbol_id = '$resultstudent[tumbol_id]'");
            while ($arr = mysql_fetch_array($Query)) {
                $tumbol_name = $arr[tumbol_name];
                $post = $arr[post];
            }
            return '<tr ' . $onmouseover . '><td valign="top"> : </td><td> : ' . $resultstudent[home_id] . '</b> .' . $resultstudent[moo] . ' : ' . $resultstudent[street] . ' .' . $tumbol_name . '  .' . $amphure_name . ' .' . $province_name . '  ' . $post . '</td>' . '<tr ' . $onmouseover . '><td> () : </td><td><b>' . $resultstudent[tele_number] . '</b></td>' . '<tr ' . $onmouseover . '><td> () :</td><td>' . $resultstudent[oth_number] . '</td>';
        } else if ($dataformat == 11) {
            $arrstudent[province_id] = substr($resultstudent[tumbol_id], 0, 2);
            $arrstudent[amphure_id] = substr($resultstudent[tumbol_id], 0, 4);
            $Query = mysql_query("select * from province where province_id = '$arrstudent[province_id]'");
            while ($arr = mysql_fetch_array($Query)) {
                $province_name = $arr[province_name];
            }
            $Query = mysql_query("select * from amphure where amphure_id = '$arrstudent[amphure_id]'");
            while ($arr = mysql_fetch_array($Query)) {
                $amphure_name = $arr[amphure_name];
            }
            $Query = mysql_query("select * from tumbol where tumbol_id = '$resultstudent[tumbol_id]'");
            while ($arr = mysql_fetch_array($Query)) {
                $tumbol_name = $arr[tumbol_name];
                $post = $arr[post];
            }
            return ' ' . '<tr><td>  :</td><td>' . $sex . $resultstudent[stu_fname] . ' ' . $resultstudent[stu_lname] . '</td>' . '<tr><td> : </td><td> ' . $resultstudent[home_id] . '  .' . $resultstudent[moo] . ' </td>' . '<tr><td>: </td><td>' . $resultstudent[street] . ' </td>' . '<tr><td> </td><td> ' . $tumbol_name . '  </td>' . '<tr><td> </td><td>' . $amphure_name . ' </td>' . '<tr><td> </td><td>' . $province_name . '  ' . $post . '</td>';
        } else if ($dataformat == 50) {
            return $resultstudent[tele_number];
        } else if ($dataformat == 51) {
            return $resultstudent[oth_number];
        } else if ($dataformat == 1000) {
            if ($resultstudent[mms_block] == '1') {
                $resultstudent[mms_block] = '<font color="red"></font>';
            } else {
                $resultstudent[mms_block] = ' ';
            }
            return '<tr><td colspan="2"><center>' . $student_image2 . '</center></td>' . '<tr ' . $onmouseover . '><td> : </td><td><b>' . $resultstudent[student_id] . '</b></td>' . '<tr ' . $onmouseover . '><td>  :</td><td>' . $sex . $resultstudent[stu_fname] . ' ' . $resultstudent[stu_lname] . '</td>' . '<tr><td> : </td><td>' . $resultstudent[fat_fname] . ' ' . $resultstudent[fat_lname] . '</td>' . '<tr><td> : </td><td>' . $resultstudent[mot_fname] . ' ' . $resultstudent[mot_lname] . '</td>' . '<tr><td> : </td><td>' . $resultstudent[par_fname] . ' ' . $resultstudent[par_lname] . '</td>' . '<tr><td> () () : </td><td>' . $resultstudent[tele_number] . ' <a href="tel:' . $resultstudent[tele_number] . '"><img src="tel.png" width="16"></a></td>' . '<tr><td> () () : </td><td>' . $resultstudent[oth_number] . ' <a href="tel:' . $resultstudent[oth_number] . '"><img src="tel.png" width="16"></a></td>' . '<tr><td> SMS : </td><td>' . $resultstudent[mms_block] . '</td>' . '</td>';
        }
    }
}
function group_name($student_group_id, $dataformat) {
    GLOBAL $onmouseover;
    GLOBAL $config_value;
    if ($student_group_id == '00000000') {
        if ($dataformat == 1) {
            echo '<b> ()</b>';
        } else if ($dataformat == 2) {
            return '<tr ' . $onmouseover . ' valign="top"><td> : </td><td><b> ()</b></td>';
        } else if ($dataformat == 11) {
            return ' ()';
        } else if ($dataformat == 3) {
            return '<b> ()</b>';
        } else if ($dataformat == 4) {
            return ' ()';
        } else if ($dataformat == 5) {
            return '<b> ()</b>';
        } else if ($dataformat == 444) {
            return ' ()';
        } else if ($dataformat == 4444) {
            return ' ()';
        } else {
        }
    }
    @$Query = mysql_query("SELECT * FROM student_group WHERE student_group_id = '$student_group_id' and school_id = '$_SESSION[school_id]' ");
    @$totalgroup = mysql_num_rows($Query);
    while ($resultgroup = mysql_fetch_array($Query)) {
        if ($config_value[0] == 0) {
        } else {
            $resultgroup[level_name] = datadic('level', $resultgroup[level_name]);
        }
        if ($resultgroup[dept_name] != '') {
            $comment_group = '(' . $resultgroup[dept_name] . ')';
        } else {
        }
        if ($resultgroup[student_group_short_name] != '' && $resultgroup[student_group_short_name] != ' ') {
            $result_student_group_short_name = ' (' . $resultgroup[student_group_short_name] . ')';
        }
        if ($dataformat == 1) {
            echo '<b>' . $resultgroup[student_group_id] . '</b><br>' . $resultgroup[major_name] . ' ' . $resultgroup[minor_name] . '/' . ($resultgroup[student_group_no] + 0) . '<br>' . $resultgroup[grade_name] . ' | ' . $resultgroup[student_group_year] . ' ' . $result_student_group_short_name . ' ' . $comment_group;
        } else if ($dataformat == 11) {
            return '' . $resultgroup[student_group_id] . '
' . $resultgroup[major_name] . ' ' . $resultgroup[minor_name] . '/' . ($resultgroup[student_group_no] + 0) . '
' . $resultgroup[grade_name] . ' | ' . $resultgroup[student_group_year] . ' ' . $result_student_group_short_name . ' ' . $comment_group;
        } else if ($dataformat == 111) {
            echo '<b>' . $resultgroup[student_group_id] . '</b><br>' . $resultgroup[major_name] . ' ' . $resultgroup[minor_name] . '/' . ($resultgroup[student_group_no] + 0) . ' ' . $resultgroup[grade_name] . ' | ' . $resultgroup[student_group_year] . ' ' . $result_student_group_short_name . ' ' . $comment_group . ' <br>  : ' . teacher_name($resultgroup[teacher_id1], '1');
        } else if ($dataformat == 1111) {
            echo '<td>' . $resultgroup[student_group_id] . '</td><td>' . $resultgroup[major_name] . ' ' . $resultgroup[minor_name] . '/' . ($resultgroup[student_group_no] + 0) . ' ' . $resultgroup[grade_name] . ' | ' . $resultgroup[student_group_year] . ' ' . $result_student_group_short_name . ' ' . $comment_group . ' </td><td>' . teacher_name($resultgroup[teacher_id1], '1') . '</td>';
        } else if ($dataformat == 2) {
            return '<tr ' . $onmouseover . ' valign="top"><td> : </td><td><b>' . $resultgroup[student_group_id] . '</b></td>' . '<tr ' . $onmouseover . ' valign="top"><td> : </td><td>' . $resultgroup[major_name] . ' ' . $resultgroup[minor_name] . '/' . ($resultgroup[student_group_no] + 0) . '<br>' . $resultgroup[grade_name] . ' | ' . $resultgroup[student_group_year] . ' ' . $result_student_group_short_name . ' ' . $comment_group . '</td>';
        } else if ($dataformat == 22) {
            if ($config_value[111] == 0) {
                if ($resultgroup[student_group_line_other] != '') $line_group_other = '
				<tr><td><img src="line_icon.png" width="16"> </td><td><a href="' . $resultgroup[student_group_line_other] . '" target="_blank">' . $resultgroup[student_group_line_other] . '</a></td>
				<tr><td></td><td><img src="https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl=' . $resultgroup[student_group_line_other] . '&choe=UTF-8" title="student_group_line_other" /></td>';
            } else {
                if ($resultgroup[student_group_line_other] != '') $line_group_other = '
				<tr><td><img src="line_icon.png" width="16"> </td><td><a href="' . $resultgroup[student_group_line_other] . '" target="_blank">' . $resultgroup[student_group_line_other] . '</a></td>
				<tr><td></td><td><img src="genqr.php?data=' . $resultgroup[student_group_line_other] . '" title="student_group_line_other" /></td>';
            }
            if ($config_value[111] == 0) {
                if ($resultgroup[student_group_line_student] != '') $line_group_student = '
				<tr><td><img src="line_icon.png" width="16"> </td><td><a href="' . $resultgroup[student_group_line_student] . '" target="_blank">' . $resultgroup[student_group_line_student] . '</a></td>
				<tr><td></td><td><img src="https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl=' . $resultgroup[student_group_line_student] . '&choe=UTF-8" title="student_group_line_student" /></td>';
            } else {
                if ($resultgroup[student_group_line_student] != '') $line_group_student = '
				<tr><td><img src="line_icon.png" width="16"> </td><td><a href="' . $resultgroup[student_group_line_student] . '" target="_blank">' . $resultgroup[student_group_line_student] . '</a></td>
				<tr><td></td><td><img src="genqr.php?data=<?=$resultgroup[student_group_line_student]?>" title="student_group_line_student" /></td>';
            }
            if ($_SESSION[systemid] == 2) {
                $line_group = $line_group_student;
            } else if ($_SESSION[systemid] == 3) {
                $line_group = $line_group_other;
            }
            return '<tr ' . $onmouseover . ' valign="top"><td> : </td><td><b>' . $resultgroup[student_group_id] . '</b></td>' . '<tr ' . $onmouseover . ' valign="top"><td> : </td><td>' . $resultgroup[major_name] . ' ' . $resultgroup[minor_name] . '/' . ($resultgroup[student_group_no] + 0) . '<br>' . $resultgroup[grade_name] . ' | ' . $resultgroup[student_group_year] . ' ' . $result_student_group_short_name . ' ' . $comment_group . '</td>' . $line_group . '';
        } else if ($dataformat == 3) {
            return ' ' . $resultgroup[student_group_id] . ' | ' . $resultgroup[major_name] . ' ' . $resultgroup[minor_name] . '/' . ($resultgroup[student_group_no] + 0) . ' | ' . $resultgroup[grade_name] . ' | ' . $resultgroup[student_group_year] . ' ' . $result_student_group_short_name . ' ' . $comment_group;
        } else if ($dataformat == 4) {
            return ' ' . $resultgroup[major_name] . ' ' . $resultgroup[minor_name] . '/' . ($resultgroup[student_group_no] + 0) . ' ' . $resultgroup[student_group_year] . ' ' . $result_student_group_short_name . ' ' . $comment_group;
        } else if ($dataformat == 44) {
            return ' ' . $resultgroup[major_name] . ' ' . $resultgroup[minor_name] . '/' . ($resultgroup[student_group_no] + 0) . ' | ' . $resultgroup[grade_name] . ' ' . $result_student_group_short_name . ' ' . $comment_group;
        } else if ($dataformat == 444) {
            return '' . $resultgroup[minor_name] . '/' . ($resultgroup[student_group_no] + 0);
        } else if ($dataformat == 4444) {
            return $resultgroup[grade_name] . ' ' . $resultgroup[minor_name] . '/' . ($resultgroup[student_group_no] + 0) . '';
        } else if ($dataformat == 44444) {
            return '' . $resultgroup[minor_name] . '/' . ($resultgroup[student_group_no] + 0) . ' ' . $result_student_group_short_name . ' ' . $comment_group;
        } else if ($dataformat == 5) {
            return ' ' . $resultgroup[grade_name] . '/' . ($resultgroup[student_group_no] + 0) . ' ';
        } else if ($dataformat == 6) {
            return $resultgroup[grade_name];
        } else if ($dataformat == 99) {
            $pieces = explode('.', $resultgroup[grade_name]);
            $pos = strpos($resultgroup[grade_name], '');
            $pos2 = strpos($resultgroup[grade_name], '');
            if ($pos === false) {
            } else {
                $yy++;
                return ' (.)  ' . $pieces[1];
            }
            if ($pos2 === false) {
            } else {
                $yy++;
                return ' (.)  ' . $pieces[1];
            }
            if ($yy == 0) {
                return $resultgroup[grade_name];
            }
        } else if ($dataformat == 66) {
            return $resultgroup[minor_name];
        } else if ($dataformat == 666) {
            return ($resultgroup[student_group_no] + 0);
        } else if ($dataformat == 6666) {
            return $resultgroup[major_name];
        } else if ($dataformat == 66666) {
            return $resultgroup[student_group_short_name];
        } else if ($dataformat == 666666) {
            return $resultgroup[level_name];
        } else if ($dataformat == 6666666) {
            return $resultgroup[student_group_short_name] . ' ' . $resultgroup[major_name] . ' ' . $resultgroup[minor_name] . ' ' . $resultgroup[grade_name] . '/' . ($resultgroup[student_group_no] + 0) . ' ';
        } else if ($dataformat == 66666666) {
            return ' ' . $result_student_group_short_name . ' ';
        } else if ($dataformat == 7) {
            return teacher_name($resultgroup[teacher_id1], '1');
        } else if ($dataformat == 8) {
            if ($resultgroup[teacher_id2] != '') return ' , ' . teacher_name($resultgroup[teacher_id2], '1');
        } else if ($dataformat == 9) {
            if ($resultgroup[teacher_id3] != '') return ' , ' . teacher_name($resultgroup[teacher_id3], '1');
        } else if ($dataformat == 10) {
            $teacher1 = teacher_name($resultgroup[teacher_id1], '1');
            if ($resultgroup[teacher_id2] != '') $teacher2 = '<br>' . teacher_name($resultgroup[teacher_id2], '1');
            if ($resultgroup[teacher_id3] != '') $teacher3 = '<br>' . teacher_name($resultgroup[teacher_id3], '1');
            $return_data = $teacher1 . '' . $teacher2 . '' . $teacher3;
            return $return_data;
        } else {
        }
    }
}
function group_student($student_id, $dataformat) {
    GLOBAL $onmouseover;
    GLOBAL $config_value;
    @$Query = mysql_query("SELECT * FROM student WHERE student_id = '$student_id' and school_id = '$_SESSION[school_id]' ");
    while ($resultstudent = mysql_fetch_array($Query)) {
        $student_group_id = $resultstudent[group_id];
    }
    if ($student_group_id == '00000000') {
        if ($dataformat == 1) {
            echo '<b> ()</b>';
        } else if ($dataformat == 2) {
            return '<tr ' . $onmouseover . ' valign="top"><td> : </td><td><b> ()</b></td>';
        } else if ($dataformat == 3) {
            return '<b> ()</b>';
        } else if ($dataformat == 4) {
            return '<b> ()</b>';
        } else if ($dataformat == 5) {
            return '<b> ()</b>';
        } else {
        }
    }
    @$Query = mysql_query("SELECT * FROM student_group WHERE student_group_id = '$student_group_id' and school_id = '$_SESSION[school_id]' ");
    @$totalgroup = mysql_num_rows($Query);
    while ($resultgroup = mysql_fetch_array($Query)) {
        if ($config_value[0] == 0) {
        } else {
            $resultgroup[level_name] = datadic('level', $resultgroup[level_name]);
        }
        if ($resultgroup[dept_name] != '') {
            $comment_group = '(' . $resultgroup[dept_name] . ')';
        } else {
        }
        if ($resultgroup[student_group_short_name] != '' && $resultgroup[student_group_short_name] != ' ') {
            $result_student_group_short_name = ' (' . $resultgroup[student_group_short_name] . ')';
        }
        if ($dataformat == 1) {
            echo '<b>' . $resultgroup[student_group_id] . '</b><br>' . $resultgroup[major_name] . ' ' . $resultgroup[minor_name] . '/' . ($resultgroup[student_group_no] + 0) . '<br>' . $resultgroup[grade_name] . ' | ' . $resultgroup[student_group_year] . ' ' . $result_student_group_short_name . ' ' . $comment_group;
        } else if ($dataformat == 11) {
            return '' . $resultgroup[student_group_id] . '
' . $resultgroup[major_name] . ' ' . $resultgroup[minor_name] . '/' . ($resultgroup[student_group_no] + 0) . '
' . $resultgroup[grade_name] . ' | ' . $resultgroup[student_group_year] . ' ' . $result_student_group_short_name . ' ' . $comment_group;
        } else if ($dataformat == 111) {
            echo '<b>' . $resultgroup[student_group_id] . '</b><br>' . $resultgroup[major_name] . ' ' . $resultgroup[minor_name] . '/' . ($resultgroup[student_group_no] + 0) . ' ' . $resultgroup[grade_name] . ' | ' . $resultgroup[student_group_year] . ' ' . $result_student_group_short_name . ' ' . $comment_group . ' <br>  : ' . teacher_name($resultgroup[teacher_id1], '1');
        } else if ($dataformat == 1111) {
            echo '<td>' . $resultgroup[student_group_id] . '</td><td>' . $resultgroup[major_name] . ' ' . $resultgroup[minor_name] . '/' . ($resultgroup[student_group_no] + 0) . ' ' . $resultgroup[grade_name] . ' | ' . $resultgroup[student_group_year] . ' ' . $result_student_group_short_name . ' ' . $comment_group . ' </td><td>' . teacher_name($resultgroup[teacher_id1], '1') . '</td>';
        } else if ($dataformat == 2) {
            return '<tr ' . $onmouseover . ' valign="top"><td> : </td><td><b>' . $resultgroup[student_group_id] . '</b></td>' . '<tr ' . $onmouseover . ' valign="top"><td> : </td><td>' . $resultgroup[major_name] . ' ' . $resultgroup[minor_name] . '/' . ($resultgroup[student_group_no] + 0) . '<br>' . $resultgroup[grade_name] . ' | ' . $resultgroup[student_group_year] . ' ' . $result_student_group_short_name . ' ' . $comment_group . '</td>';
        } else if ($dataformat == 3) {
            return ' ' . $resultgroup[student_group_id] . ' | ' . $resultgroup[major_name] . ' ' . $resultgroup[minor_name] . '/' . ($resultgroup[student_group_no] + 0) . ' | ' . $resultgroup[grade_name] . ' | ' . $resultgroup[student_group_year] . ' ' . $result_student_group_short_name . ' ' . $comment_group;
        } else if ($dataformat == 4) {
            return ' ' . $resultgroup[minor_name] . ' ' . $result_student_group_short_name . ' ' . $comment_group;
        } else if ($dataformat == 44) {
            return ' ' . $resultgroup[major_name] . ' ' . $resultgroup[minor_name] . '/' . ($resultgroup[student_group_no] + 0) . ' | ' . $resultgroup[grade_name] . ' ' . $result_student_group_short_name . ' ' . $comment_group;
        } else if ($dataformat == 444) {
            return '' . $resultgroup[minor_name] . '/' . ($resultgroup[student_group_no] + 0);
        } else if ($dataformat == 4444) {
            return $resultgroup[grade_name] . ' ' . $resultgroup[minor_name] . '/' . ($resultgroup[student_group_no] + 0) . '';
        } else if ($dataformat == 44444) {
            return '' . $resultgroup[minor_name] . '/' . ($resultgroup[student_group_no] + 0) . ' ' . $result_student_group_short_name . ' ' . $comment_group;
        } else if ($dataformat == 5) {
            return ' ' . $resultgroup[grade_name] . '/' . ($resultgroup[student_group_no] + 0) . ' ';
        } else if ($dataformat == 55) {
            return $resultgroup[student_group_id];
        } else if ($dataformat == 6) {
            return $resultgroup[grade_name];
        } else if ($dataformat == 99) {
            $pieces = explode('.', $resultgroup[grade_name]);
            $pos = strpos($resultgroup[grade_name], '');
            $pos2 = strpos($resultgroup[grade_name], '');
            if ($pos === false) {
            } else {
                $yy++;
                return ' (.)  ' . $pieces[1];
            }
            if ($pos2 === false) {
            } else {
                $yy++;
                return ' (.)  ' . $pieces[1];
            }
            if ($yy == 0) {
                return $resultgroup[grade_name];
            }
        } else if ($dataformat == 66) {
            return $resultgroup[minor_name];
        } else if ($dataformat == 666) {
            return ($resultgroup[student_group_no] + 0);
        } else if ($dataformat == 6666) {
            return $resultgroup[major_name];
        } else if ($dataformat == 66666) {
            return $resultgroup[student_group_short_name];
        } else if ($dataformat == 666666) {
            return $resultgroup[level_name];
        } else if ($dataformat == 6666666) {
            return $resultgroup[student_group_short_name] . ' ' . $resultgroup[major_name] . ' ' . $resultgroup[minor_name] . ' ' . $resultgroup[grade_name] . '/' . ($resultgroup[student_group_no] + 0) . ' ';
        } else if ($dataformat == 66666666) {
            return ' ' . $result_student_group_short_name . ' ';
        } else if ($dataformat == 7) {
            return teacher_name($resultgroup[teacher_id1], '1');
        } else if ($dataformat == 8) {
            if ($resultgroup[teacher_id2] != '') return ' , ' . teacher_name($resultgroup[teacher_id2], '1');
        } else if ($dataformat == 9) {
            if ($resultgroup[teacher_id3] != '') return ' , ' . teacher_name($resultgroup[teacher_id3], '1');
        } else if ($dataformat == 10) {
            $teacher1 = teacher_name($resultgroup[teacher_id1], '1');
            if ($resultgroup[teacher_id2] != '') $teacher2 = '<br>' . teacher_name($resultgroup[teacher_id2], '1');
            if ($resultgroup[teacher_id3] != '') $teacher3 = '<br>' . teacher_name($resultgroup[teacher_id3], '1');
            $return_data = $teacher1 . '' . $teacher2 . '' . $teacher3;
            return $return_data;
        } else {
        }
    }
}
function datadic($tableofdata, $id) {
    $Query = mysql_query("SELECT * FROM $tableofdata where " . $tableofdata . "_id = '" . $id . "'");
    @$totalgroup = mysql_num_rows($Query);
    while ($arr = mysql_fetch_array($Query)) {
        if ($arr[$tableofdata . '_name'] == '') {
            return '';
        } else {
            GLOBAL $config_value;
            if ($config_value[0] == '1') {
                $arr[$tableofdata . '_name'] = str_replace('..', '.', $arr[$tableofdata . '_name']);
            } else {
            }
            return $arr[$tableofdata . '_name'];
        }
    }
    if ($totalgroup == '0') {
        return '';
    }
}
function datadic_postcode($tableofdata, $id) {
    $Query = mysql_query("SELECT * FROM $tableofdata where " . $tableofdata . "_id = '" . $id . "'");
    @$totalgroup = mysql_num_rows($Query);
    while ($arr = mysql_fetch_array($Query)) {
        if ($arr[$tableofdata . '_name'] == '') {
            return '';
        } else {
            GLOBAL $config_value;
            if ($config_value[0] == '1') {
                $arr[$tableofdata . '_name'] = str_replace('..', '.', $arr[$tableofdata . '_name']);
            } else {
            }
            return $arr['post'];
        }
    }
    if ($totalgroup == '0') {
        return '';
    }
}
function datadic_no($tableofdata, $id) {
    $Query = mysql_query("SELECT * FROM $tableofdata where " . $tableofdata . "_id = '" . $id . "'");
    @$totalgroup = mysql_num_rows($Query);
    while ($arr = mysql_fetch_array($Query)) {
        if ($arr[$tableofdata . '_name'] == '') {
            return '';
        } else {
            GLOBAL $config_value;
            if ($config_value[0] == '1') {
                $arr[$tableofdata . '_name'] = str_replace('..', '.', $arr[$tableofdata . '_name']);
            } else {
            }
            return $arr[$tableofdata . '_name'];
        }
    }
    if ($totalgroup == '0') {
        return '';
    }
}
function datadic_to_id($tableofdata, $data) {
    $Query = mysql_query("SELECT * FROM $tableofdata where " . $tableofdata . "_name = '" . $data . "'");
    @$totalgroup = mysql_num_rows($Query);
    while ($arr = mysql_fetch_array($Query)) {
        if ($arr[$tableofdata . '_name'] == '') {
            return 'Err';
        } else {
            return $arr[$tableofdata . '_id'];
        }
    }
    if ($totalgroup == '0') {
        return 'Err';
    }
}
function datadicx($tableofdata, $id) {
    $Query = mysql_query("SELECT * FROM $tableofdata where " . $tableofdata . "_id = '" . $id . "'");
    @$totalgroup = mysql_num_rows($Query);
    while ($arr = mysql_fetch_array($Query)) {
        if ($arr[$tableofdata . '_name'] == '') {
            return '';
        } else {
            return $arr[$tableofdata . '_name'];
        }
    }
    if ($totalgroup == '0') {
        return '';
    }
}
function datadic_subject($subject_id, $student_id) {
    $Query = mysql_query("SELECT * FROM student where student_id = '" . $student_id . "'");
    while ($arr = mysql_fetch_array($Query)) {
        $Query2 = mysql_query("SELECT * FROM studing where subject_id = '" . $subject_id . "' and student_group_id = '" . $arr[group_id] . "' limit 0 , 1");
        while ($arr2 = mysql_fetch_array($Query2)) {
            return $arr2[subject_name];
        }
    }
}
function bottoninput($input_name, $input_value, $disabled, $alert) {
    if ($disabled == 1) {
    } else {
        if ($alert == 1) {
            $confirm = 'onClick="Q_confirm();"';
        }
        echo '<tr valign="top"><td colspan="2" align="right"><input type="submit" name="' . $input_name . '" value="' . $input_value . '" class="btn btn-primary" ' . $confirm . '> ';
        if ($disabled == 2) {
        } else {
            echo '<input type="reset" value="" class="btn btn-warning">';
        }
        echo '</td>';
    }
}
function checkboxinput($caption, $input_name, $input_value, $input_if) {
    if ($input_value == $input_if) {
        $checked = 'checked';
    }
    echo '<tr valign="top"><td></td><td><input type="checkbox" name="' . $input_name . '" value="' . $input_value . '" ' . $checked . '> <b>' . $caption . '</b></td>';
}
function checkboxinput_notr($caption, $input_name, $input_value, $input_if) {
    if ($input_value == $input_if) {
        $checked = 'checked';
    }
    echo '<input type="checkbox" name="' . $input_name . '" value="' . $input_value . '" ' . $checked . '> <b>' . $caption . '</b>';
}
function fileinput($caption, $comment = '') {
    echo '<tr><td>' . $caption . ' :</td><td><input type="file" name="uploadfile" class="form-control">' . $comment . '</td>';
}
function timeinput($caption, $hour_name, $min_name, $hour_select, $min_select) {
    if ($hour_select == '') {
        $hour_select = date(H);
    }
    echo '<tr valign="top"><td>' . $caption . ' :</td><td>';
    echo '<select name="' . $hour_name . '" class="form-control-mini">';
    for ($i = 0;$i <= 23;$i++) {
        echo '<option value="' . substr('0' . $i, -2) . '" ' . ($hour_select + 0 == $i ? 'selected="selected"' : '') . '>' . substr('0' . $i, -2) . '</option>';
    }
    echo '</select> : ';
    if ($min_select == '') {
        $min_select = date(i);
    }
    echo '<select name="' . $min_name . '" class="form-control-mini">';
    for ($i = 0;$i <= 59;$i++) {
        echo '<option value="' . substr('0' . $i, -2) . '" ' . ($min_select + 0 == $i ? 'selected="selected"' : '') . '>' . substr('0' . $i, -2) . '</option>';
    }
    echo '</select> ';
}
function textinput($caption, $input_name, $input_value, $input_type, $input_size, $input_max, $disabled) {
    $placeholder_replave = array('<b>', '</b>', '<br>');
    $placeholder = str_replace($placeholder_replave, '', $caption);
    if ($disabled == 1) {
        echo '<tr valign="top"><td>' . $caption . ' :</td><td><input type="hidden" placeholder="' . $placeholder . '" name="' . $input_name . '" size="' . $input_size . '" maxlength="' . $input_max . '" value="' . $input_value . '" class="form-control">' . $input_value . '</td>';
    } else if ($disabled == 2) {
        echo '<tr valign="top"><td></td><td><input type="hidden" placeholder="' . $placeholder . '" name="' . $input_name . '" size="' . $input_size . '" maxlength="' . $input_max . '" value="' . $input_value . '" class="form-control"></td>';
    } else if ($disabled == 3) {
        echo '<tr valign="top"><td>' . $caption . ' :</td><td><input type="' . $input_type . '" name="' . $input_name . '" size="' . $input_size . '" maxlength="' . $input_max . '" value="' . $input_value . '" class="form-control-mini"></td>';
    } else {
        echo '<tr valign="top"><td>' . $caption . ' :</td><td><input type="' . $input_type . '" placeholder="' . $placeholder . '" name="' . $input_name . '" size="' . $input_size . '" maxlength="' . $input_max . '" value="' . $input_value . '" class="form-control"></td>';
    }
}
function textinput_tel($caption, $input_name, $input_value, $input_type, $input_size, $input_max, $disabled) {
    $placeholder_replave = array('<b>', '</b>', '<br>');
    $placeholder = str_replace($placeholder_replave, '', $caption);
    if ($disabled == 1) {
        echo '<tr valign="top"><td>' . $caption . ' :<br><small>*   SMS</td><td><input type="hidden" placeholder="' . $placeholder . '" name="' . $input_name . '" size="' . $input_size . '" maxlength="' . $input_max . '" value="' . $input_value . '" class="form-control"  onkeyup="formatintonly(this);">' . $input_value . ' <a href="tel:' . $input_value . '"><img src="tel.png" width="16"></a></td>';
    } else if ($disabled == 2) {
        echo '<tr valign="top"><td></td><td><input type="hidden" placeholder="' . $placeholder . '" name="' . $input_name . '" size="' . $input_size . '" maxlength="' . $input_max . '" value="' . $input_value . '" class="form-control"  onkeyup="formatintonly(this);"></td>';
    } else {
        echo '<tr valign="top"><td>' . $caption . ' :<br><small>*   SMS</td><td><input type="' . $input_type . '" placeholder="' . $placeholder . '" name="' . $input_name . '" size="' . $input_size . '" maxlength="' . $input_max . '" value="' . $input_value . '" class="form-control"  onkeyup="formatintonly(this);"></td>';
    }
}
function textinputhide($caption, $input_name, $input_value, $input_type, $input_size, $input_max, $disabled) {
    $placeholder_replave = array('<b>', '</b>', '<br>');
    $placeholder = str_replace($placeholder_replave, '', $caption);
    echo '<input type="hidden" placeholder="' . $placeholder . '" name="' . $input_name . '" size="' . $input_size . '" maxlength="' . $input_max . '" value="' . $input_value . '" class="form-control">';
}
function textinput_only($caption, $input_name, $input_value, $input_type, $input_size, $input_max, $disabled) {
    $placeholder_replave = array('<b>', '</b>', '<br>');
    $placeholder = str_replace($placeholder_replave, '', $caption);
    echo '<input type="text" placeholder="' . $placeholder . '" name="' . $input_name . '" size="' . $input_size . '" maxlength="' . $input_max . '" value="' . $input_value . '" class="form-control">';
}
function textareainput($caption, $input_name, $input_value, $input_type = 0, $input_rows, $input_cols, $disabled = 0) {
    if ($disabled == 1) {
        echo '<tr valign="top"><td>' . $caption . ' :</td><td><textarea  class="form-control" name="' . $input_name . '" rows="' . $input_rows . '" cols="' . $input_cols . '" disabled>' . $input_value . '</textarea></td>';
    } else if ($disabled == 2) {
        echo '<tr valign="top"><td colspan="2">' . $caption . ' :<br><textarea  class="form-control" name="' . $input_name . '" rows="' . $input_rows . '" cols="' . $input_cols . '">' . $input_value . '</textarea></td>';
    } else if ($disabled == 3) {
        echo '<tr valign="top"><td>' . $caption . ' :</td><td colspan="2"><textarea  class="form-control" name="' . $input_name . '" rows="' . $input_rows . '" cols="' . $input_cols . '">' . $input_value . '</textarea></td>';
    } else {
        echo '<tr valign="top"><td>' . $caption . ' :</td><td><textarea  class="form-control" name="' . $input_name . '" rows="' . $input_rows . '" cols="' . $input_cols . '">' . $input_value . '</textarea></td>';
    }
}
function selectinput_only($caption, $input_name, $input_table, $input_order, $option_value, $option_name, $option_select, $disabled) {
    echo '' . $caption . '<select name="' . $input_name . '" class="form-control">';
    if ($disabled == 1) {
        echo '<option value=""></option>';
    }
    $Query = mysql_query('select * from ' . $input_table . ' order by ' . $input_order . '');
    while ($arr = mysql_fetch_array($Query)) {
        if ($arr[$option_value] == $option_select) {
            $selected = 'selected';
        } else {
            $selected = '';
        }
        GLOBAL $config_value;
        if ($config_value[0] == '1') {
            $arr[$option_name] = str_replace('..', '.', $arr[$option_name]);
        } else {
        }
        echo '<option value="' . $arr[$option_value] . '" ' . $selected . '>' . $arr[$option_name] . '</option>';
    }
    echo '</select>';
}
function selectinput_only_mini($caption, $input_name, $input_table, $input_order, $option_value, $option_name, $option_select, $disabled) {
    echo '' . $caption . '<select name="' . $input_name . '" class="form-control-mini">';
    if ($disabled == 1) {
        echo '<option value=""></option>';
    }
    $Query = mysql_query('select * from ' . $input_table . ' order by ' . $input_order . '');
    while ($arr = mysql_fetch_array($Query)) {
        if ($arr[$option_value] == $option_select) {
            $selected = 'selected';
        } else {
            $selected = '';
        }
        GLOBAL $config_value;
        if ($config_value[0] == '1') {
            $arr[$option_name] = str_replace('..', '.', $arr[$option_name]);
        } else {
        }
        echo '<option value="' . $arr[$option_value] . '" ' . $selected . '>' . $arr[$option_name] . '</option>';
    }
    echo '</select>';
}
function selectinput_only_skip($caption, $input_name, $input_table, $input_order, $option_value, $option_name, $option_select, $disabled) {
    echo '' . $caption . '<select name="' . $input_name . '" class="form-control" onchange="SubmitForm(\'formskip\');">';
    if ($disabled == 1) {
        echo '<option value="">---  ---</option>';
    }
    $Query = mysql_query('select * from ' . $input_table . ' order by ' . $input_order . '');
    while ($arr = mysql_fetch_array($Query)) {
        if ($arr[$option_value] == $option_select) {
            $selected = 'selected';
        } else {
            $selected = '';
        }
        GLOBAL $config_value;
        if ($config_value[0] == '1') {
            $arr[$option_name] = str_replace('..', '.', $arr[$option_name]);
        } else {
        }
        echo '<option value="' . $arr[$option_value] . '" ' . $selected . '>' . $arr[$option_name] . '</option>';
    }
    echo '</select>';
}
function selectinput($caption, $input_name, $input_table, $input_order, $option_value, $option_name, $option_select, $disabled) {
    echo '<tr valign="top"><td>' . $caption . ' :</td><td><select name="' . $input_name . '" class="form-control">';
    if ($disabled == 1) {
        echo '<option value=""></option>';
    }
    $Query = mysql_query('select * from ' . $input_table . ' order by ' . $input_order . '');
    while ($arr = mysql_fetch_array($Query)) {
        if ($arr[$option_value] == $option_select) {
            $selected = 'selected';
        } else {
            $selected = '';
        }
        GLOBAL $config_value;
        if ($config_value[0] == '1') {
            $arr[$option_name] = str_replace('..', '.', $arr[$option_name]);
        } else {
        }
        echo '<option value="' . $arr[$option_value] . '" ' . $selected . '>' . $arr[$option_name] . '</option>';
    }
    echo '</select></td>';
}
function selectinput_show($caption, $input_name, $input_table, $input_order, $option_value, $option_name, $option_select, $disabled) {
    echo '<tr valign="top"><td>' . $caption . ' :</td><td><select name="' . $input_name . '" class="form-control">';
    if ($disabled == 1) {
        echo '<option value=""></option>';
    }
    $Query = mysql_query('select * from ' . $input_table . ' where ' . $input_table . "_show = '1' order by " . $input_order . '');
    while ($arr = mysql_fetch_array($Query)) {
        if ($arr[$option_value] == $option_select) {
            $selected = 'selected';
        } else {
            $selected = '';
        }
        GLOBAL $config_value;
        if ($config_value[0] == '1') {
            $arr[$option_name] = str_replace('..', '.', $arr[$option_name]);
        } else {
        }
        echo '<option value="' . $arr[$option_value] . '" ' . $selected . '>' . $arr[$option_name] . '</option>';
    }
    echo '</select></td>';
}
function selectinput_id($caption, $input_name, $input_table, $input_order, $option_value, $option_name, $option_select, $disabled) {
    echo '<tr valign="top"><td>' . $caption . ' :</td><td><select name="' . $input_name . '" class="form-control">';
    if ($disabled == 1) {
        echo '<option value=""></option>';
    }
    $Query = mysql_query('select * from ' . $input_table . ' order by ' . $input_order . '');
    while ($arr = mysql_fetch_array($Query)) {
        if ($arr[$option_value] == $option_select) {
            $selected = 'selected';
        } else {
            $selected = '';
        }
        GLOBAL $config_value;
        if ($config_value[0] == '1') {
            $arr[$option_name] = str_replace('..', '.', $arr[$option_name]);
        } else {
        }
        echo '<option value="' . $arr[$option_value] . '" ' . $selected . '>' . $arr[$option_value] . ' - ' . $arr[$option_name] . '</option>';
    }
    echo '</select></td>';
}
function schoolinput($school_select = null, $notrtd = null) {
    if ($school_select == null) {
        $school_select = $_SESSION[school_id];
    }
    if ($notrtd == null) echo '<tr><td align="right"></td><td>';
    $Query = mysql_query('SELECT * FROM school ORDER BY school_id ');
    $num_rows = mysql_num_rows($Query);
    if ($num_rows >= 2) {
        echo '<select name="school_id" class="form-control">';
        while ($arr = mysql_fetch_array($Query)) {
            if ($school_select == $arr[school_id]) {
                $check = 'selected';
            } else {
                $check = '';
            }
            echo '<option value="' . $arr[school_id] . '" ' . $check . '>' . $arr[school_name] . '</option>';
        }
        echo '</select>';
    } else {
        while ($arr = mysql_fetch_array($Query)) {
            echo '' . $arr[school_name] . '<input type="hidden" name="school_id" value="' . $arr[school_id] . '" class="form-control">';
        }
    }
    if ($notrtd == null) echo '</td>';
}
function schoolinput2($school_select = null, $notrtd = null) {
    if ($school_select == null) {
        $school_select = $_SESSION[school_id];
    }
    if ($notrtd == null) echo '<tr><td align="right"></td><td>';
    $Query = mysql_query('SELECT * FROM school ORDER BY school_id ');
    $num_rows = mysql_num_rows($Query);
    if ($num_rows >= 2) {
        echo '<select name="school_id" class="form-control">';
        while ($arr = mysql_fetch_array($Query)) {
            if ($school_select == $arr[school_id]) {
                $check = 'selected';
            } else {
                $check = '';
            }
            echo '<option value="' . $arr[school_id] . '" ' . $check . '>' . $arr[school_name] . '</option>';
        }
        echo '</select>';
    } else {
        while ($arr = mysql_fetch_array($Query)) {
            echo '<input type="hidden" name="school_id" value="' . $arr[school_id] . '" class="form-control">';
        }
    }
    if ($notrtd == null) echo '</td>';
}
function radioinput($caption, $input_name, $input_table, $input_order, $option_value, $option_name, $option_select, $disabled) {
    echo '<tr valign="top"><td>' . $caption . ' :</td><td>';
    $Query = mysql_query('select * from ' . $input_table . ' order by ' . $input_order . '');
    while ($arr = mysql_fetch_array($Query)) {
        if ($arr[$option_value] == $option_select) {
            $selected = 'checked';
        } else {
            $selected = '';
        }
        echo '<input type="radio" name="' . $input_name . '" value="' . $arr[$option_value] . '" ' . $selected . '> ' . $arr[$option_name] . ' ';
    }
    echo '</td>';
}
function dateinput($caption, $date_name, $month_name, $year_name, $date_select, $month_select, $year_select, $year_count, $year_thai, $disabled) {
    if ($date_select == '') {
        $date_select = date(d);
    }
    echo '<tr valign="top"><td>' . $caption . ' :</td><td>';
    echo '<select name="' . $date_name . '" class="form-control-mini">';
    for ($i = 1;$i <= 31;$i++) {
        echo '<option value="' . substr('0' . $i, -2) . '" ' . ($date_select + 0 == $i ? 'selected="selected"' : '') . '>' . $i . '</option>';
    }
    echo '</select> ';
    if ($month_select == '') {
        $month_select = date(m);
    }
    echo '<select name="' . $month_name . '" class="form-control-mini">';;
    echo '		<option value="1" ';
    if ($month_select == 1) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="2" ';
    if ($month_select == 2) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="3" ';
    if ($month_select == 3) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="4" ';
    if ($month_select == 4) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="5" ';
    if ($month_select == 5) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="6" ';
    if ($month_select == 6) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="7" ';
    if ($month_select == 7) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="8" ';
    if ($month_select == 8) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="9" ';
    if ($month_select == 9) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="10" ';
    if ($month_select == 10) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="11" ';
    if ($month_select == 11) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="12" ';
    if ($month_select == 12) {
        echo 'selected';
    } else {
    };
    echo '></option>
	</select>
	';
    if ($year_select == '') {
        $year_select = date(Y);
    }
    $thisyear = date(Y);
    echo '<select name="' . $year_name . '" class="form-control-mini">';
    for ($i = $thisyear + 5;$i >= $thisyear - $year_count;$i--) {
        if ($year_thai == 1) {
            $yname = $i + 543;
        } else {
            $yname = $i;
        }
        $years = $i;
        echo '<option value="' . $years . '" ' . ($year_select + 0 == $i ? 'selected="selected"' : '') . '>' . $yname . '</option>';
    }
    echo '</select>';
    echo '<br>';
    echo holidayecho($year_select . '-' . $month_select . '-' . $date_select);
    echo '</td>';
}
function dateinput_zero($caption, $date_name, $month_name, $year_name, $date_select, $month_select, $year_select, $year_count, $year_thai, $disabled) {
    if ($date_select == '') {
        $date_select = date(d);
    }
    echo '<tr valign="top"><td>' . $caption . ' :</td><td>';
    echo '<select name="' . $date_name . '" class="form-control-mini">';
    for ($i = 1;$i <= 31;$i++) {
        echo '<option value="' . substr('0' . $i, -2) . '" ' . ($date_select + 0 == $i ? 'selected="selected"' : '') . '>' . $i . '</option>';
    }
    echo '</select> ';
    if ($month_select == '') {
        $month_select = date(m);
    }
    echo '<select name="' . $month_name . '" class="form-control-mini">';;
    echo '		<option value="01" ';
    if ($month_select == 1) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="02" ';
    if ($month_select == 2) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="03" ';
    if ($month_select == 3) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="04" ';
    if ($month_select == 4) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="05" ';
    if ($month_select == 5) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="06" ';
    if ($month_select == 6) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="07" ';
    if ($month_select == 7) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="08" ';
    if ($month_select == 8) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="09" ';
    if ($month_select == 9) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="10" ';
    if ($month_select == 10) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="11" ';
    if ($month_select == 11) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="12" ';
    if ($month_select == 12) {
        echo 'selected';
    } else {
    };
    echo '></option>
	</select>
	';
    if ($year_select == '') {
        $year_select = date(Y);
    }
    $thisyear = date(Y);
    echo '<select name="' . $year_name . '" class="form-control-mini">';
    for ($i = $thisyear + 2;$i >= $thisyear - $year_count;$i--) {
        if ($year_thai == 1) {
            $yname = $i + 543;
        } else {
            $yname = $i;
        }
        $years = $i;
        echo '<option value="' . $years . '" ' . ($year_select + 0 == $i ? 'selected="selected"' : '') . '>' . $yname . '</option>';
    }
    echo '</select>';
    echo '<br>';
    echo holidayecho($year_select . '-' . $month_select . '-' . $date_select);
    echo '</td>';
}
function dateinput_auto($caption, $date_name, $month_name, $year_name, $date_select, $month_select, $year_select, $year_count, $year_thai, $disabled) {
    if ($date_select == '') {
        $date_select = date(d);
    }
    echo '<tr valign="top"><td>' . $caption . ' :</td><td>';
    echo '<select name="' . $date_name . '" class="form-control-mini" onchange="SubmitForm(\'formxx\');">  ';
    for ($i = 1;$i <= 31;$i++) {
        echo '<option   value="' . substr('0' . $i, -2) . '" ' . ($date_select + 0 == $i ? 'selected="selected"' : '') . '>' . $i . '</option>';
    }
    echo '</select> ';
    if ($month_select == '') {
        $month_select = date(m);
    }
    echo '<select name="' . $month_name . '" class="form-control-mini" onchange="SubmitForm(\'formxx\');">  ';;
    echo '		<option  value="1" ';
    if ($month_select == 1) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option   value="2" ';
    if ($month_select == 2) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option   value="3" ';
    if ($month_select == 3) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option   value="4" ';
    if ($month_select == 4) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option   value="5" ';
    if ($month_select == 5) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option   value="6" ';
    if ($month_select == 6) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option   value="7" ';
    if ($month_select == 7) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option   value="8" ';
    if ($month_select == 8) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option   value="9" ';
    if ($month_select == 9) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option   value="10" ';
    if ($month_select == 10) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option   value="11" ';
    if ($month_select == 11) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option   value="12" ';
    if ($month_select == 12) {
        echo 'selected';
    } else {
    };
    echo '></option>
	</select>
	';
    if ($year_select == '') {
        $year_select = date(Y);
    }
    $thisyear = date(Y);
    echo '<select name="' . $year_name . '" class="form-control-mini" onchange="SubmitForm(\'formxx\');">  ';
    for ($i = $thisyear + 1;$i >= $thisyear - $year_count;$i--) {
        if ($year_thai == 1) {
            $yname = $i + 543;
        } else {
            $yname = $i;
        }
        $years = $i;
        echo '<option   value="' . $years . '" ' . ($year_select + 0 == $i ? 'selected="selected"' : '') . '>' . $yname . '</option>';
    }
    echo '</select>';
    echo '<br>';
    echo holidayecho($year_select . '-' . $month_select . '-' . $date_select);
    echo '</td>';
}
function yearinput($caption, $year_name, $year_select, $year_count, $year_thai, $plus) {
    echo '<tr valign="top"><td>' . $caption . '</td><td>';
    $thisyear = date(Y) + $plus;
    echo '<select name="' . $year_name . '"  class="form-control">';
    if ($plus != '') {
        if ($plus != '3') {
            echo '<option value=""></option>';
        }
    }
    for ($i = $thisyear;$i >= $thisyear - $year_count;$i--) {
        if ($year_thai == 1) {
            $yname = $i + 543;
        } else {
            $yname = $i;
        }
        $years = $i;
        echo '<option value="' . $years . '" ' . ($year_select + 0 == $i ? 'selected="selected"' : '') . '>' . $yname . '</option>';
    }
    echo '</select>';
    echo '</td>';
}
function eduyearinput($caption, $eduyear_name, $eduyear_select, $eduyear_count, $plus) {
    echo '<tr valign="top"><td>' . $caption . '</td><td>';
    $eduyear = explode('/', $eduyear_select);
    $semester = $eduyear[0];
    $eduyear = $eduyear[1];
    echo '<select name="' . $eduyear_name . '_semester" class="form-control-mini">';
    if ($plus != '') {
        echo '<option value=""></option>';
    }
    if ($semester == 1) {
        $semester1 = 'selected';
    }
    echo '  <option value="1" ' . $semester1 . '>1</option> ';
    if ($semester == 2) {
        $semester2 = 'selected';
    }
    echo '  <option value="2" ' . $semester2 . '>2</option> ';
    if ($semester == 3) {
        $semester3 = 'selected';
    }
    echo '  <option value="3" ' . $semester3 . '>3</option> ';
    if ($semester == 4) {
        $semester4 = 'selected';
    }
    echo '  <option value="4" ' . $semester4 . '>4</option> ';
    echo ' </select>';
    echo '/';
    $thisyear = date(Y) + 543;
    echo '<select name="' . $eduyear_name . '_year" class="form-control-mini">';
    if ($plus != '') {
        echo '<option value=""></option>';
    }
    for ($i = $thisyear;$i >= $thisyear - $eduyear_count;$i--) {
        $yname = $i;
        $years = $i;
        echo '<option value="' . $years . '" ' . ($eduyear + 0 == $i ? 'selected="selected"' : '') . '>' . $yname . '</option>';
    }
    echo '</select>';
    echo '</td>';
}
function datethai_full($datedata, $monthtype = null) {
    $datedataex = explode('-', $datedata);
    $date = $datedataex[2];
    $month = $datedataex[1];
    $year = $datedataex[0];
    if ($monthtype == null) {
        switch ($month) {
            case '1':
                $printmonth = '';
            break;
            case '2':
                $printmonth = '';
            break;
            case '3':
                $printmonth = '';
            break;
            case '4':
                $printmonth = '';
            break;
            case '5':
                $printmonth = '';
            break;
            case '6':
                $printmonth = '';
            break;
            case '7':
                $printmonth = '';
            break;
            case '8':
                $printmonth = '';
            break;
            case '9':
                $printmonth = '';
            break;
            case '10':
                $printmonth = '';
            break;
            case '11':
                $printmonth = '';
            break;
            case '12':
                $printmonth = '';
            break;
        }
    } else {
        switch ($month) {
            case '1':
                $printmonth = '..';
            break;
            case '2':
                $printmonth = '..';
            break;
            case '3':
                $printmonth = '..';
            break;
            case '4':
                $printmonth = '.';
            break;
            case '5':
                $printmonth = '..';
            break;
            case '6':
                $printmonth = '..';
            break;
            case '7':
                $printmonth = '..';
            break;
            case '8':
                $printmonth = '..';
            break;
            case '9':
                $printmonth = '..';
            break;
            case '10':
                $printmonth = '..';
            break;
            case '11':
                $printmonth = '..';
            break;
            case '12':
                $printmonth = '..';
            break;
        }
    }
    $Ythai = $year + 543;
    if ($monthtype != null) $Ythai = substr($Ythai, 2, 2);
    return ($date + 0) . '  ' . $printmonth . ' .. ' . $Ythai;
}
function datethai2($datedata, $monthtype = null) {
    $datedataex = explode('-', $datedata);
    $date = $datedataex[2];
    $month = $datedataex[1];
    $year = $datedataex[0];
    if ($monthtype == null) {
        switch ($month) {
            case '1':
                $printmonth = '';
            break;
            case '2':
                $printmonth = '';
            break;
            case '3':
                $printmonth = '';
            break;
            case '4':
                $printmonth = '';
            break;
            case '5':
                $printmonth = '';
            break;
            case '6':
                $printmonth = '';
            break;
            case '7':
                $printmonth = '';
            break;
            case '8':
                $printmonth = '';
            break;
            case '9':
                $printmonth = '';
            break;
            case '10':
                $printmonth = '';
            break;
            case '11':
                $printmonth = '';
            break;
            case '12':
                $printmonth = '';
            break;
        }
    } else {
        switch ($month) {
            case '1':
                $printmonth = '..';
            break;
            case '2':
                $printmonth = '..';
            break;
            case '3':
                $printmonth = '..';
            break;
            case '4':
                $printmonth = '.';
            break;
            case '5':
                $printmonth = '..';
            break;
            case '6':
                $printmonth = '..';
            break;
            case '7':
                $printmonth = '..';
            break;
            case '8':
                $printmonth = '..';
            break;
            case '9':
                $printmonth = '..';
            break;
            case '10':
                $printmonth = '..';
            break;
            case '11':
                $printmonth = '..';
            break;
            case '12':
                $printmonth = '..';
            break;
        }
    }
    $Ythai = $year + 543;
    if ($monthtype != null) $Ythai = substr($Ythai, 2, 2);
    echo ($date + 0) . ' ' . $printmonth . ' ' . $Ythai;
}
function datethai3($datedata, $monthtype = null) {
    $datedataex = explode('-', $datedata);
    $date = $datedataex[2];
    $month = $datedataex[1];
    $year = $datedataex[0];
    if ($monthtype == null) {
        switch ($month) {
            case '1':
                $printmonth = '';
            break;
            case '2':
                $printmonth = '';
            break;
            case '3':
                $printmonth = '';
            break;
            case '4':
                $printmonth = '';
            break;
            case '5':
                $printmonth = '';
            break;
            case '6':
                $printmonth = '';
            break;
            case '7':
                $printmonth = '';
            break;
            case '8':
                $printmonth = '';
            break;
            case '9':
                $printmonth = '';
            break;
            case '10':
                $printmonth = '';
            break;
            case '11':
                $printmonth = '';
            break;
            case '12':
                $printmonth = '';
            break;
        }
    } else {
        switch ($month) {
            case '1':
                $printmonth = '..';
            break;
            case '2':
                $printmonth = '..';
            break;
            case '3':
                $printmonth = '..';
            break;
            case '4':
                $printmonth = '.';
            break;
            case '5':
                $printmonth = '..';
            break;
            case '6':
                $printmonth = '..';
            break;
            case '7':
                $printmonth = '..';
            break;
            case '8':
                $printmonth = '..';
            break;
            case '9':
                $printmonth = '..';
            break;
            case '10':
                $printmonth = '..';
            break;
            case '11':
                $printmonth = '..';
            break;
            case '12':
                $printmonth = '..';
            break;
        }
    }
    $Ythai = $year + 543;
    if ($monthtype != null) $Ythai = substr($Ythai, 2, 2);
    echo $printmonth . ' ' . $Ythai;
}
function datethai4($datedata, $monthtype = null) {
    $datedataex = explode('-', $datedata);
    $date = $datedataex[2];
    $month = $datedataex[1];
    $year = $datedataex[0];
    if ($monthtype == null) {
        switch ($month) {
            case '1':
                $printmonth = '';
            break;
            case '2':
                $printmonth = '';
            break;
            case '3':
                $printmonth = '';
            break;
            case '4':
                $printmonth = '';
            break;
            case '5':
                $printmonth = '';
            break;
            case '6':
                $printmonth = '';
            break;
            case '7':
                $printmonth = '';
            break;
            case '8':
                $printmonth = '';
            break;
            case '9':
                $printmonth = '';
            break;
            case '10':
                $printmonth = '';
            break;
            case '11':
                $printmonth = '';
            break;
            case '12':
                $printmonth = '';
            break;
        }
    } else {
        switch ($month) {
            case '1':
                $printmonth = '..';
            break;
            case '2':
                $printmonth = '..';
            break;
            case '3':
                $printmonth = '..';
            break;
            case '4':
                $printmonth = '.';
            break;
            case '5':
                $printmonth = '..';
            break;
            case '6':
                $printmonth = '..';
            break;
            case '7':
                $printmonth = '..';
            break;
            case '8':
                $printmonth = '..';
            break;
            case '9':
                $printmonth = '..';
            break;
            case '10':
                $printmonth = '..';
            break;
            case '11':
                $printmonth = '..';
            break;
            case '12':
                $printmonth = '..';
            break;
        }
    }
    $Ythai = $year + 543;
    if ($monthtype != null) $Ythai = substr($Ythai, 2, 2);
    return ($date + 0) . ' ' . $printmonth . ' ' . $Ythai;
}
function split_datestd($datedata) {
    $datedataex = explode(' ', $datedata);
    $date = $datedataex[0];
    $month = $datedataex[1];
    $year = $datedataex[2];
    if ($monthtype == null) {
        switch ($month) {
            case '':
                $printmonth = '01';
            break;
            case 'January':
                $printmonth = '01';
            break;
            case '..':
                $printmonth = '01';
            break;
            case '':
                $printmonth = '02';
            break;
            case 'February':
                $printmonth = '02';
            break;
            case '..':
                $printmonth = '02';
            break;
            case '':
                $printmonth = '03';
            break;
            case 'March':
                $printmonth = '03';
            break;
            case '..':
                $printmonth = '03';
            break;
            case '':
                $printmonth = '04';
            break;
            case 'April':
                $printmonth = '04';
            break;
            case '..':
                $printmonth = '04';
            break;
            case '':
                $printmonth = '05';
            break;
            case 'May':
                $printmonth = '05';
            break;
            case '..':
                $printmonth = '05';
            break;
            case '':
                $printmonth = '06';
            break;
            case 'June':
                $printmonth = '06';
            break;
            case '..':
                $printmonth = '06';
            break;
            case '':
                $printmonth = '07';
            break;
            case 'July':
                $printmonth = '07';
            break;
            case '..':
                $printmonth = '07';
            break;
            case '':
                $printmonth = '08';
            break;
            case 'August':
                $printmonth = '08';
            break;
            case '..':
                $printmonth = '08';
            break;
            case '':
                $printmonth = '09';
            break;
            case 'September':
                $printmonth = '09';
            break;
            case '..':
                $printmonth = '09';
            break;
            case '':
                $printmonth = '10';
            break;
            case 'October':
                $printmonth = '10';
            break;
            case '..':
                $printmonth = '10';
            break;
            case '':
                $printmonth = '11';
            break;
            case 'November':
                $printmonth = '11';
            break;
            case '..':
                $printmonth = '11';
            break;
            case '':
                $printmonth = '12';
            break;
            case 'December':
                $printmonth = '12';
            break;
            case '..':
                $printmonth = '12';
            break;
        }
    } else {
    }
    $Ythai = $year;
    $num_padded = sprintf('%02d', ($date + 0));
    return $num_padded . '/' . $printmonth . '/' . $Ythai;
}
function datediff($startdate, $enddate) {
    if (($startdate = strtotime($startdate)) === false) {
        return false;
    }
    if (($enddate = strtotime($enddate)) === false) {
        return false;
    }
    $startdate = strftime('%Y-%m-%d %H:%M:%S', $startdate);
    $enddate = strftime('%Y-%m-%d %H:%M:%S', $enddate);
    if (preg_match("/^([\d]{4})-([\d]{2})-([\d]{2}) ([\d]{2}):([\d]{2}):([\d]{2})$/", $startdate, $startdate)) {
        if (preg_match("/^([\d]{4})-([\d]{2})-([\d]{2}) ([\d]{2}):([\d]{2}):([\d]{2})$/", $enddate, $enddate)) {
            $date_start = mktime($startdate[4], $startdate[5], $startdate[6], $startdate[2], $startdate[3], $startdate[1]);
            $date_end = mktime($enddate[4], $enddate[5], $enddate[6], $enddate[2], $enddate[3], $enddate[1]);
            if ($date_start > $date_end) {
                $start = $date_end;
                $end = $date_start;
                $__startdate = $startdate;
                $__enddate = $enddate;
                $startdate = $__enddate;
                $enddate = $__startdate;
                $negative = true;
            } else {
                $end = $date_end;
                $start = $date_start;
            }
            $year_diff = date('y', $end) - date('y', $start);
            $day_diff = date('z', $end) - date('z', $start) + (((int)date('L', $start)) ? ($year_diff * 366) : ($year_diff * 365));
            $days = $day_diff;
            $month_diff = 0;
            while (mktime(0, 0, 0, $startdate[2] + $i, $startdate[3], $startdate[1]) <= $end) {
                $daysinmonth = date('t', mktime(0, 0, 0, $startdate[2] + $i, $startdate[3], $startdate[1]));
                if ($days - $daysinmonth >= 0) {
                    $days = $days - $daysinmonth;
                    $month_diff++;
                }
                $i++;
            }
            $quarter_diff = floor($month_diff / 3);
            $week_diff = floor($day_diff / 7);
            $hour_diff = date('H', $end) - date('H', $start) + ($day_diff * 24);
            $min_diff = date('i', $end) - date('i', $start) + ($hour_diff * 60);
            $sec_diff = date('s', $end) - date('s', $start) + ($min_diff * 60);
            $year_diff = floor($month_diff / 12);
            if ($negative) {
                $year_diff = $year_diff - ($year_diff * 2);
                $quarter_diff = $quarter_diff - ($quarter_diff * 2);
                $month_diff = $month_diff - ($month_diff * 2);
                $week_diff = $week_diff - ($week_diff * 2);
                $day_diff = $day_diff - ($day_diff * 2);
                $hour_diff = $hour_diff - ($hour_diff * 2);
                $min_diff = $min_diff - ($min_diff * 2);
                $sec_diff = $sec_diff - ($sec_diff * 2);
            }
            return array('year' => $year_diff, 'quarter' => $quarter_diff, 'month' => $month_diff, 'week' => $week_diff, 'day' => $day_diff, 'hour' => $hour_diff, 'minute' => $min_diff, 'second' => $sec_diff);
        } else {
            return false;
        }
    } else {
        return false;
    }
}
function cureduyearinput($caption, $eduyear_name, $eduyear_select, $eduyear_count, $plus) {
    GLOBAL $todate;
    echo '<tr valign="top"><td>' . $caption . ' :</td><td><select name="' . $eduyear_name . '" class="form-control">';
    $Query = mysql_query("select * from dateedu where dateedu_start<='$todate' and dateedu_end>='$todate' limit 0 , 1");
    while ($arr = mysql_fetch_array($Query)) {
        if ($arr[dateedu_eduyear] == $eduyear_select) {
            $selected = 'checked';
        } else {
            $selected = '';
        }
        echo '<option value="' . $arr[dateedu_eduyear] . '" ' . $selected . '>' . $arr[dateedu_eduyear] . '</option>';
    }
    echo '</select></td>';
}
function pms_warning($pms_warning_type_id, $pms_warning_text, $people_id, $send_id, $pms_warning_url, $to_school_id = null, $target_id = null, $to_systemid = 1) {
    $thistime = date('Y-m-d H:i:s');
    $dbname = $GLOBALS[dbname];
    $config_value = $GLOBALS[config_value];
    if ($to_school_id == null) $to_school_id = $_SESSION[school_id];
    $sql = "select * FROM pms_warning WHERE pms_warning_type_id='$pms_warning_type_id' and people_id = '$people_id' and school_id = '$to_school_id' and send_id = '$send_id' and pms_warning_url = '$pms_warning_url' and pms_warning_text = '$pms_warning_text' and to_school_id = '$_SESSION[school_id]' and to_systemid = '$to_systemid' ";
    $dbquery = mysql_db_query($dbname, $sql);
    $num_rows = mysql_num_rows($dbquery);
    if ($num_rows >= '1') {
    } else {
        $sql = 'insert into pms_warning  (`pms_warning_type_id` , `people_id` , `school_id` , `send_id` , `pms_warning_url` , `pms_warning_date` ,`pms_warning_text` ,`to_school_id` ,`target_id` ,`to_systemid`) ' . " values ('$pms_warning_type_id', '$people_id', '$to_school_id', '$send_id', '$pms_warning_url', '$thistime', '$pms_warning_text', '$_SESSION[school_id]', '$target_id', '$to_systemid') ";
        $dbquery = mysql_db_query($dbname, $sql);
        $sql_modulename = "SELECT * FROM module where module_id = '$pms_warning_type_id' ";
        $dbquery_modulename = mysql_db_query($dbname, $sql_modulename);
        $result_modulename = mysql_fetch_array($dbquery_modulename);
        if ($to_systemid == 1) {
            if ($pms_warning_type_id == '3' && $target_id != '') {
                $sqlslb_booktopeople = "SELECT * FROM slb_book where slb_book_id = '$target_id' and school_id = '$_SESSION[school_id]' ";
                $dbqueryslb_booktopeople = mysql_db_query($dbname, $sqlslb_booktopeople);
                $resultslb_booktopeople = mysql_fetch_array($dbqueryslb_booktopeople);
                if ($resultslb_booktopeople[slb_book_id] == '') {
                    $sql_deletebook = "delete from pms_warning where pms_warning_id='$arr[pms_warning_id]' and people_id='$people_id' and school_id = '$_SESSION[school_id]' ";
                    $dbquery_deletebook = mysql_db_query($dbname, $sql_deletebook);
                } else {
                    $pms_warning_url = 'slb_open.php?slb_book_id=' . $resultslb_booktopeople[slb_book_id] . ' ';
                }
            } else if ($pms_warning_type_id == '10' && $target_id != '') {
                $sqlpm = "SELECT * FROM pm where pm_id = '$target_id' and people_send = '$people_id' and school_id = '$_SESSION[school_id]' ";
                $dbquerypm = mysql_db_query($dbname, $sqlpm);
                $resultpm = mysql_fetch_array($dbquerypm);
                $pms_warning_url = 'mail_read.php?pm_id=' . $resultpm[pm_id] . '';
            }
            if ($config_value[201] == 0) {
                $Query_token = mysql_query("select * from myrms_token where userid = '$people_id' and systemid = '1' and school_id = '$_SESSION[school_id]'");
                while ($arr_token = mysql_fetch_array($Query_token)) {
                    sendPushNotification(iconv('TIS-620', 'UTF-8', $pms_warning_text), iconv('TIS-620', 'UTF-8', $result_modulename[module_name]), $arr_token[token]);
                }
            }
            $sqlpeople = "SELECT * FROM people WHERE people_id = '$people_id' and school_id = '$_SESSION[school_id]'";
            $dbquerypeople = mysql_db_query($dbname, $sqlpeople);
            $resultpeople = mysql_fetch_array($dbquerypeople);
            if ($resultpeople[linetoken] != '') {
                if ($config_value[601] == '1') {
                    line_notify($resultpeople[linetoken], iconv('TIS-620', 'UTF-8', $pms_warning_text . ' ' . $config_value[2] . '/' . $pms_warning_url));
                }
            }
        } else if ($to_systemid == 2) {
            if ($config_value[201] == 0) {
                $Query_token = mysql_query("select * from myrms_token where userid = '$people_id' and systemid = '2' and school_id = '$_SESSION[school_id]' ");
                while ($arr_token = mysql_fetch_array($Query_token)) {
                    sendPushNotification(iconv('TIS-620', 'UTF-8', $pms_warning_text), iconv('TIS-620', 'UTF-8', $result_modulename[module_name]), $arr_token[token]);
                }
            }
            $sqlpeople = "SELECT * FROM student WHERE student_id = '$people_id' and school_id = '$_SESSION[school_id]' ";
            $dbquerypeople = mysql_db_query($dbname, $sqlpeople);
            $resultpeople = mysql_fetch_array($dbquerypeople);
            if ($resultpeople[std_linetoken] != '') {
                if ($config_value[601] == '1') {
                    line_notify($resultpeople[std_linetoken], iconv('TIS-620', 'UTF-8', $pms_warning_text));
                }
            }
        } else if ($to_systemid == 3) {
            if ($config_value[201] == 0) {
                $Query_token = mysql_query("select * from myrms_token where userid = '$people_id' and systemid = '3' and school_id = '$_SESSION[school_id]' ");
                while ($arr_token = mysql_fetch_array($Query_token)) {
                    sendPushNotification(iconv('TIS-620', 'UTF-8', $pms_warning_text), iconv('TIS-620', 'UTF-8', $result_modulename[module_name]), $arr_token[token]);
                }
            }
            $sqlpeople = "SELECT * FROM student WHERE student_id = '$people_id' and school_id = '$_SESSION[school_id]' ";
            $dbquerypeople = mysql_db_query($dbname, $sqlpeople);
            $resultpeople = mysql_fetch_array($dbquerypeople);
            if ($resultpeople[oth_linetoken] != '') {
                if ($config_value[601] == '1') {
                    line_notify($resultpeople[oth_linetoken], iconv('TIS-620', 'UTF-8', $pms_warning_text));
                }
            }
        }
    }
    return $sql;
}
function line_notify($Token, $message) {
    GLOBAL $dbname;
    $lineapi = $Token;
    $message = str_replace("'", '', $message);
    $message = str_replace('"', '', $message);
    $mms = trim($message);
    date_default_timezone_set('Asia/Bangkok');
    $chOne = curl_init();
    curl_setopt($chOne, CURLOPT_URL, 'https://notify-api.line.me/api/notify');
    curl_setopt($chOne, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($chOne, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($chOne, CURLOPT_POST, 1);
    curl_setopt($chOne, CURLOPT_POSTFIELDS, "message=$mms");
    curl_setopt($chOne, CURLOPT_FOLLOWLOCATION, 1);
    $headers = array('Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer ' . $lineapi . '',);
    curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($chOne, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($chOne);
    if (curl_error($chOne)) {
    } else {
        $result_ = json_decode($result, true);
        if ($result_['status'] == '401') {
            $sql = 'update people set ' . " linetoken='' " . " where linetoken='" . $Token . "' ";
            $dbquery = mysql_db_query($dbname, $sql);
            $sql = 'update student set ' . " std_linetoken='' " . " where std_linetoken='" . $Token . "' ";
            $dbquery = mysql_db_query($dbname, $sql);
            $sql = 'update student set ' . " oth_linetoken='' " . " where oth_linetoken='" . $Token . "' ";
            $dbquery = mysql_db_query($dbname, $sql);
        }
    }
    curl_close($chOne);
}
function nicetime($date) {
    GLOBAL $todate;
    if (empty($date)) {
        return '';
    }
    $periods = array('', '', '', '', '', '', '', 'decade');
    $lengths = array('60', '60', '24', '7', '4.35', '12', '10');
    $now = time();
    $unix_date = strtotime($date);
    if (empty($unix_date) || $date == '0000-00-00 00:00:00') {
        return '';
    }
    if ($now > $unix_date) {
        $difference = $now - $unix_date;
        $tense = '';
    } else {
        $difference = $unix_date - $now;
        $tense = '';
    }
    for ($j = 0;$difference >= $lengths[$j] && $j < count($lengths) - 1;$j++) {
        $difference/= $lengths[$j];
    }
    $difference = round($difference);
    if ($difference != 1) {
    }
    if ($date == $todate) {
        return '';
    } else {
        return "$difference $periods[$j] {$tense}";
    }
}
function monthinput($caption, $date_name, $month_name, $year_name, $date_select, $month_select, $year_select, $year_count, $year_thai, $disabled) {
    echo '<tr valign="top"><td>' . $caption . ' :</td><td>';
    if ($month_select == '') {
        $month_select = date(m);
    }
    echo '<select name="' . $month_name . '" class="form-control-mini">';;
    echo '		<option value="1" ';
    if ($month_select == 1) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="2" ';
    if ($month_select == 2) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="3" ';
    if ($month_select == 3) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="4" ';
    if ($month_select == 4) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="5" ';
    if ($month_select == 5) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="6" ';
    if ($month_select == 6) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="7" ';
    if ($month_select == 7) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="8" ';
    if ($month_select == 8) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="9" ';
    if ($month_select == 9) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="10" ';
    if ($month_select == 10) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="11" ';
    if ($month_select == 11) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="12" ';
    if ($month_select == 12) {
        echo 'selected';
    } else {
    };
    echo '></option>
	</select>
	';
    if ($year_select == '') {
        $year_select = date(Y);
    }
    $thisyear = date(Y);
    echo '<select name="' . $year_name . '" class="form-control-mini">';
    for ($i = $thisyear;$i >= $thisyear - $year_count;$i--) {
        if ($year_thai == 1) {
            $yname = $i + 543;
        } else {
            $yname = $i;
        }
        $years = $i;
        echo '<option value="' . $years . '" ' . ($year_select + 0 == $i ? 'selected="selected"' : '') . '>' . $yname . '</option>';
    }
    echo '</select>';
    echo '</td>';
}
function dateinput2($caption, $date_name, $month_name, $year_name, $date_select, $month_select, $year_select, $year_count, $year_thai, $disabled) {
    if ($date_select == '') {
        $date_select = date(d);
    }
    echo '<tr valign="top"><td>' . $caption . ' :</td><td>';
    echo '<select name="' . $date_name . '" class="form-control-mini">';
    for ($i = 1;$i <= 31;$i++) {
        echo '<option value="' . substr('0' . $i, -2) . '" ' . ($date_select + 0 == $i ? 'selected="selected"' : '') . '>' . $i . '</option>';
    }
    echo '</select> ';
    if ($month_select == '') {
        $month_select = date(m);
    }
    echo '<select name="' . $month_name . '" class="form-control-mini">';;
    echo '		<option value="1" ';
    if ($month_select == 1) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="2" ';
    if ($month_select == 2) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="3" ';
    if ($month_select == 3) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="4" ';
    if ($month_select == 4) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="5" ';
    if ($month_select == 5) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="6" ';
    if ($month_select == 6) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="7" ';
    if ($month_select == 7) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="8" ';
    if ($month_select == 8) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="9" ';
    if ($month_select == 9) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="10" ';
    if ($month_select == 10) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="11" ';
    if ($month_select == 11) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="12" ';
    if ($month_select == 12) {
        echo 'selected';
    } else {
    };
    echo '></option>
	</select>
	';
    if ($year_select == '') {
        $year_select = date(Y);
    }
    $thisyear = date(Y);
    echo '<select name="' . $year_name . '" class="form-control-mini">';
    $thisyear++;
    for ($i = $thisyear;$i >= ($thisyear - 2);$i--) {
        if ($year_thai == 1) {
            $yname = $i + 543;
        } else {
            $yname = $i;
        }
        $years = $i;
        echo '<option value="' . $years . '" ' . ($year_select + 0 == $i ? 'selected="selected"' : '') . '>' . $yname . '</option>';
    }
    echo '</select>';
    echo '</td>';
}
function dateinput2_notr($caption, $date_name, $month_name, $year_name, $date_select, $month_select, $year_select, $year_count, $year_thai, $disabled) {
    if ($date_select == '') {
        $date_select = date(d);
    }
    echo '<select name="' . $date_name . '" class="form-control-mini">';
    for ($i = 1;$i <= 31;$i++) {
        echo '<option value="' . substr('0' . $i, -2) . '" ' . ($date_select + 0 == $i ? 'selected="selected"' : '') . '>' . $i . '</option>';
    }
    echo '</select> ';
    if ($month_select == '') {
        $month_select = date(m);
    }
    echo '<select name="' . $month_name . '" class="form-control-mini">';;
    echo '		<option value="1" ';
    if ($month_select == 1) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="2" ';
    if ($month_select == 2) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="3" ';
    if ($month_select == 3) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="4" ';
    if ($month_select == 4) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="5" ';
    if ($month_select == 5) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="6" ';
    if ($month_select == 6) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="7" ';
    if ($month_select == 7) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="8" ';
    if ($month_select == 8) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="9" ';
    if ($month_select == 9) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="10" ';
    if ($month_select == 10) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="11" ';
    if ($month_select == 11) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="12" ';
    if ($month_select == 12) {
        echo 'selected';
    } else {
    };
    echo '></option>
	</select>
	';
    if ($year_select == '') {
        $year_select = date(Y);
    }
    $thisyear = date(Y);
    echo '<select name="' . $year_name . '" class="form-control-mini">';
    $thisyear++;
    for ($i = $thisyear;$i >= ($thisyear - $year_count);$i--) {
        if ($year_thai == 1) {
            $yname = $i + 543;
        } else {
            $yname = $i;
        }
        $years = $i;
        echo '<option value="' . $years . '" ' . ($year_select + 0 == $i ? 'selected="selected"' : '') . '>' . $yname . '</option>';
    }
    echo '</select>';
}
function incor_student($student_id, $semes = NULL, $size = NULL) {
    GLOBAL $dbname;
    GLOBAL $config_value;
    $todate = date('Y') . '-' . (date('m') + 0) . '-' . (date('d') + 0);
    if ($semes == NULL) {
        @$Queryxx = mysql_query("select * from dateedu where dateedu_start<='$todate' and dateedu_end>='$todate' limit 0 , 1");
        while ($arrxx = mysql_fetch_array($Queryxx)) {
            $semes = $arrxx[dateedu_eduyear];
        }
    }
    $year_semes = substr($semes, -4, 4);
    if ($config_value[83] == '1') {
        if ($config_value[48] == '0') {
            $year_search = " and right(student_eduyear,4) = '$year_semes' ";
        } else {
            $year_search = " and student_eduyear = '$semes' ";
        }
    }
    @$Query = mysql_query("SELECT * FROM student_incor where student_id = '$student_id' and school_id = '$_SESSION[school_id]' $year_search  ");
    while ($resultstudent = mysql_fetch_array($Query)) {
        $sqlincor = "SELECT * FROM incor where incor_id = '$resultstudent[incor_id]'";
        $dbqueryincor = mysql_db_query($dbname, $sqlincor);
        $resultincor = mysql_fetch_array($dbqueryincor);
        $total_value = $resultincor[incor_value] + $total_value;
    }
    @$Query = mysql_query("SELECT * FROM student_incor_type where student_id = '$student_id' and school_id = '$_SESSION[school_id]' $year_search ");
    while ($resultstudent = mysql_fetch_array($Query)) {
        $sqlgood = "SELECT * FROM good where good_id = '$resultstudent[good_id]'";
        $dbquerygood = mysql_db_query($dbname, $sqlgood);
        $resultgood = mysql_fetch_array($dbquerygood);
        $total_good_value = $resultgood[good_value] + $total_good_value;
    }
    if ($config_value[44] - $total_value + $total_good_value + 0 <= - 1) {
        $redicon = '<font color="red">';
    } else {
        $redicon = '<font>';
    }
    if ($size != '') {
        $redicon.= '<strong>';
    }
    return $redicon . ' ' . ($config_value[44] - $total_value + $total_good_value + 0) . '</font>';
}
function complete_student($student_id) {
    GLOBAL $dbname;
    @$Query = mysql_query("SELECT * FROM student WHERE student_id = '$student_id' and school_id = '$_SESSION[school_id]' ");
    @$totalstudent = mysql_num_rows($Query);
    while ($resultstudent = mysql_fetch_array($Query)) {
        $complete = '50';
        if ($resultstudent[tele_number] != '') $complete = $complete + 5;
        if ($resultstudent[oth_number] != '') $complete = $complete + 5;
        if ($resultstudent[location] != '') $complete = $complete + 5;
        if ($resultstudent[host] != '') $complete = $complete + 5;
        if ($resultstudent[travel] != '') $complete = $complete + 5;
        if ($resultstudent[longitude] != '') $complete = $complete + 5;
        if ($resultstudent[latitude] != '') $complete = $complete + 5;
        if ($resultstudent[instractor_name] != '') $complete = $complete + 5;
        if ($resultstudent[friend_name] != '') $complete = $complete + 5;
        if ($resultstudent[neiborhood_name] != '') $complete = $complete + 5;
        $sql = 'update student set ' . " complete='$complete' " . " where student_id='$student_id' and school_id = '$_SESSION[school_id]' ";
        $dbquery = mysql_db_query($dbname, $sql);
        return $complete;
    }
}
function selectinput_notr($caption, $input_name, $input_table, $input_order, $option_value, $option_name, $option_select, $disabled) {
    echo '<td>' . $caption . ' :</td><td><select name="' . $input_name . '" class="form-control">';
    if ($disabled == 1) {
        echo '<option value=""></option>';
    }
    $Query = mysql_query('select * from ' . $input_table . ' order by ' . $input_order . '');
    while ($arr = mysql_fetch_array($Query)) {
        if ($arr[$option_value] == $option_select) {
            $selected = 'selected';
        } else {
            $selected = '';
        }
        GLOBAL $config_value;
        if ($config_value[0] == '1') {
            $arr[$option_name] = str_replace('..', '.', $arr[$option_name]);
        } else {
        }
        echo '<option value="' . $arr[$option_value] . '" ' . $selected . '>' . $arr[$option_name] . '</option>';
    }
    echo '</select></td>';
}
function mms_send($people_send, $people_send_type, $mobile_number, $mms_send_status, $mms_log_message, $to_school_id = null) {
    if (ereg('^0[0-9]{9}$', $mobile_number)) {
        $thistime = $GLOBALS[thistime];
        $dbname = $GLOBALS[dbname];
        $id_count = strlen($people_send);
        if ($to_school_id == null) $to_school_id = $_SESSION[school_id];
        $sql = "select * FROM mms_log WHERE people_send='$people_send' and mobile_number = '$mobile_number' and school_id = '$to_school_id' and people_send_type = '$people_send_type' and mms_log_message = '$mms_log_message' and to_school_id = '$_SESSION[school_id]' ";
        $dbquery = mysql_db_query($dbname, $sql);
        $num_rows = mysql_num_rows($dbquery);
        if ($num_rows >= '1') {
        } else {
            if ($id_count == '13') {
                $this_time = date('Y-m-d H:i:s');
                $sql = 'insert into mms_log  (`school_id` , `userid` , `people_send` , `people_send_type` , `mobile_number` , `mms_send_date` , `mms_send_status`, `mms_log_message`, `to_school_id`) ' . " values ('$to_school_id', '$_SESSION[userid]', '$people_send', '$people_send_type', '$mobile_number', '$this_time', '$mms_send_status' , '$mms_log_message' , '$_SESSION[school_id]') ";
                $dbquery = mysql_db_query($dbname, $sql);
            } else {
                $sql = "select * FROM student WHERE student_id = '$people_send' and school_id = '$to_school_id' and mms_block = '1' ";
                $dbquery = mysql_db_query($dbname, $sql);
                $num_rows = mysql_num_rows($dbquery);
                if ($num_rows == '1') {
                } else {
                    $this_time = date('Y-m-d H:i:s');
                    $sql = 'insert into mms_log  (`school_id` , `userid` , `people_send` , `people_send_type` , `mobile_number` , `mms_send_date` , `mms_send_status`, `mms_log_message`, `to_school_id`) ' . " values ('$to_school_id', '$_SESSION[userid]', '$people_send', '$people_send_type', '$mobile_number', '$this_time', '$mms_send_status' , '$mms_log_message' , '$_SESSION[school_id]') ";
                    $dbquery = mysql_db_query($dbname, $sql);
                }
            }
        }
        if ($id_count == '13') {
            $sql = "select * from people where people_id = '$people_send' and  school_id = '$to_school_id'";
            $dbquery = mysql_db_query($dbname, $sql);
            $mms = mysql_fetch_array($dbquery);
            $mms[mms_counter]++;
            $sql = 'update people set ' . " mms_counter = '$mms[mms_counter]' " . " where people_id = '$people_send' and  school_id = '$to_school_id'";
            $dbquery = mysql_db_query($dbname, $sql);
        } else {
            $sql = "select * from student where student_id = '$people_send' and  school_id = '$to_school_id'";
            $dbquery = mysql_db_query($dbname, $sql);
            $mms = mysql_fetch_array($dbquery);
            $mms[mms_counter]++;
            $sql = 'update student set ' . " mms_counter = '$mms[mms_counter]' " . " where student_id = '$people_send' and  school_id = '$to_school_id'";
            $dbquery = mysql_db_query($dbname, $sql);
        }
        return $sql;
    } else {
        return $sql;
    }
}
function mms_send2($people_send, $people_send_type, $mobile_number, $mms_send_status, $mms_log_message, $to_school_id = null) {
    if (ereg('^0[0-9]{9}$', $mobile_number)) {
        $thistime = $GLOBALS[thistime];
        $dbname = $GLOBALS[dbname];
        $school_id = $_REQUEST[school_id];
        $id_count = strlen($people_send);
        if ($to_school_id == null) $to_school_id = $_SESSION[school_id];
        $sql = "select * FROM mms_log WHERE people_send='$people_send' and mobile_number = '$mobile_number' and school_id = '$to_school_id' and people_send_type = '$people_send_type' and mms_log_message = '$mms_log_message' and to_school_id = '$school_id'";
        $dbquery = mysql_db_query($dbname, $sql);
        $num_rows = mysql_num_rows($dbquery);
        if ($num_rows >= '1') {
        } else {
            if ($id_count == '13') {
                $this_time = date('Y-m-d H:i:s');
                $sql = 'insert into mms_log  (`school_id` , `userid` , `people_send` , `people_send_type` , `mobile_number` , `mms_send_date` , `mms_send_status`, `mms_log_message`, `to_school_id`) ' . " values ('$to_school_id', '0000000000000', '$people_send', '$people_send_type', '$mobile_number', '$this_time', '$mms_send_status' , '$mms_log_message' , '$school_id') ";
                $dbquery = mysql_db_query($dbname, $sql);
            } else {
                $sql = "select * FROM student WHERE student_id = '$people_send' and school_id = '$to_school_id' and mms_block = '1' ";
                $dbquery = mysql_db_query($dbname, $sql);
                $num_rows = mysql_num_rows($dbquery);
                if ($num_rows == '1') {
                } else {
                    $this_time = date('Y-m-d H:i:s');
                    $sql = 'insert into mms_log  (`school_id` , `userid` , `people_send` , `people_send_type` , `mobile_number` , `mms_send_date` , `mms_send_status`, `mms_log_message`, `to_school_id`) ' . " values ('$to_school_id', '0000000000000', '$people_send', '$people_send_type', '$mobile_number', '$this_time', '$mms_send_status' , '$mms_log_message' , '$school_id') ";
                    $dbquery = mysql_db_query($dbname, $sql);
                }
            }
        }
        if ($id_count == '13') {
            $sql = "select * from people where people_id = '$people_send' and  school_id = '$to_school_id'";
            $dbquery = mysql_db_query($dbname, $sql);
            $mms = mysql_fetch_array($dbquery);
            $mms[mms_counter]++;
            $sql = 'update people set ' . " mms_counter = '$mms[mms_counter]' " . " where people_id = '$people_send' and  school_id = '$to_school_id'";
            $dbquery = mysql_db_query($dbname, $sql);
        } else {
            $sql = "select * from student where student_id = '$people_send' and  school_id = '$to_school_id'";
            $dbquery = mysql_db_query($dbname, $sql);
            $mms = mysql_fetch_array($dbquery);
            $mms[mms_counter]++;
            $sql = 'update student set ' . " mms_counter = '$mms[mms_counter]' " . " where student_id = '$people_send' and  school_id = '$to_school_id'";
            $dbquery = mysql_db_query($dbname, $sql);
        }
        return $sql;
    } else {
        return $sql;
    }
}
function datethai_sm($datedata) {
    $datedataex = explode('-', $datedata);
    $date = $datedataex[2];
    $month = $datedataex[1];
    $year = $datedataex[0];
    switch ($month) {
        case '1':
            $printmonth = '..';
        break;
        case '2':
            $printmonth = '..';
        break;
        case '3':
            $printmonth = '..';
        break;
        case '4':
            $printmonth = '..';
        break;
        case '5':
            $printmonth = '..';
        break;
        case '6':
            $printmonth = '..';
        break;
        case '7':
            $printmonth = '..';
        break;
        case '8':
            $printmonth = '..';
        break;
        case '9':
            $printmonth = '..';
        break;
        case '10':
            $printmonth = '..';
        break;
        case '11':
            $printmonth = '..';
        break;
        case '12':
            $printmonth = '..';
        break;
    }
    $Ythai = $year + 543;
    return $date . ' ' . $printmonth . ' ' . $Ythai;
}
function dateeng_sm($datedata) {
    $datedataex = explode('-', $datedata);
    $date = $datedataex[2];
    $month = $datedataex[1];
    $year = $datedataex[0];
    switch ($month) {
        case '1':
            $printmonth = 'JAN';
        break;
        case '2':
            $printmonth = 'FEB';
        break;
        case '3':
            $printmonth = 'MAR';
        break;
        case '4':
            $printmonth = 'APR';
        break;
        case '5':
            $printmonth = 'MAY';
        break;
        case '6':
            $printmonth = 'JUN';
        break;
        case '7':
            $printmonth = 'JUL';
        break;
        case '8':
            $printmonth = 'AUG';
        break;
        case '9':
            $printmonth = 'SEP';
        break;
        case '10':
            $printmonth = 'OCT';
        break;
        case '11':
            $printmonth = 'NOV';
        break;
        case '12':
            $printmonth = 'DEC';
        break;
    }
    $Ythai = $year + 0;
    return $date . ' ' . $printmonth . ' ' . $Ythai;
}
function encodedpr1($dpr1) {
    $dpr = explode('-', $dpr1);
    $hour1 = substr($dpr[1], 0, 2);
    $hour2 = substr($dpr[1], 2, 2);
    $room = '<small>' . datadic('dpr', $hour1) . ' - ' . datadic('dpr', $hour2);
    $room.= ' : ' . $dpr[2] . '</small>';
    return $room;
}
function decodedpr1($dpr1) {
    $dpr = explode('-', $dpr1);
    $hour1 = substr($dpr[1], 0, 2);
    $hour2 = substr($dpr[1], 2, 2);
    $room = datadic('dpr', $hour1) . ' - ' . datadic('dpr', $hour2);
    return $room;
}
function holidayecho($todate) {
    GLOBAL $dbname;
    $sql = "select * FROM stopday WHERE stopday_date='$todate' ";
    $dbquery = mysql_db_query($dbname, $sql);
    $num_rows = mysql_num_rows($dbquery);
    $resultstatus = mysql_fetch_array($dbquery);
    if ($num_rows == '1') {
        return '<b><font color="red"> : ' . $resultstatus[stopday_name] . '</font></b>';
    } else {
        return '';
    }
}
function holidayname($todate) {
    GLOBAL $dbname;
    $sql = "select * FROM stopday WHERE stopday_date='$todate' ";
    $dbquery = mysql_db_query($dbname, $sql);
    $resultstatus = mysql_fetch_array($dbquery);
    $num_rows = mysql_num_rows($dbquery);
    if ($resultstatus[stopday_name] != '') {
        return ' : ' . $resultstatus[stopday_name];
    } else {
        return '';
    }
}
function howdays($from, $to) {
    $first_date = strtotime($from);
    $second_date = strtotime($to);
    $offset = $second_date - $first_date;
    return floor($offset / 60 / 60 / 24);
}
function curPageURL() {
    $pageURL = 'http';
    if ($_SERVER['HTTPS'] == 'on') {
        $pageURL.= 's';
    }
    $pageURL.= '://';
    if ($_SERVER['SERVER_PORT'] != '80') {
        $pageURL.= $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . $_SERVER['REQUEST_URI'];
    } else {
        $pageURL.= $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    }
    return $pageURL;
}
function gengraph($percent = NULL, $min = NULL, $max = NULL, $color = NULL, $width = '300', $height = '30') {
    if ($percent >= 100) $percent = '100';
    if ($percent == NULL) {
        if ($min == 0 || $max == 0) {
            $i = 0;
        } else {
            $i = ($min + 0) / ($max + 0) * 100;
        }
    } else {
        $i = $percent;
    }
    if ($color != '') {
    } else {
        $grapcolor = $color;
        if ($i >= 80) {
            $grapcolor = 'aqua';
        } elseif ($i >= 75) {
            $grapcolor = 'green';
        } elseif ($i >= 50) {
            $grapcolor = 'yellow';
        } elseif ($i >= 0) {
            $grapcolor = 'red';
        }
    }
    $i = @number_format($i, 0, '.', ' ');
    return '<div class="progress sm">
				<div class="progress-bar progress-bar-' . $grapcolor . '" style="width: ' . $i . '%"><font color="black">' . $i . '%</font></div>
			</div>';
}
function scoretograde($score = 0) {
    if ($score >= 0) $grade = '0.0';
    if ($score >= 50) $grade = '1.0';
    if ($score >= 55) $grade = '1.5';
    if ($score >= 60) $grade = '2.0';
    if ($score >= 65) $grade = '2.5';
    if ($score >= 70) $grade = '3.0';
    if ($score >= 75) $grade = '3.5';
    if ($score >= 80) $grade = '4.0';
    return $grade;
}
function couter_hour($student_id, $semes, $subject_id, $real_teacher_id, $school_id) {
    GLOBAL $dbname;
    $resultchk_count[mycount] = 0;
    $xx = '1';
    $Queryhour = mysql_query("select * from chk where student_id = '" . $student_id . "' and semes = '" . $semes . "' and subject_id = '" . $subject_id . "' and teacher_id = '$real_teacher_id'  and school_id = '$school_id' order by datetime ");
    while ($arrhour = mysql_fetch_array($Queryhour)) {
        $sqlstuhour = "select * from studing where student_group_id = '$arrhour[student_group_id]' and teacher_id = '$real_teacher_id' and semes = '$semes' and subject_id = '$subject_id'  and school_id = '$school_id' and dpr1 = '$arrhour[dpr1]' ";
        $dbquerystuhour = mysql_db_query($dbname, $sqlstuhour);
        $resultstuhour = mysql_fetch_array($dbquerystuhour);
        $sqlstatus = "select * from status where status_id = '$arrhour[status_id]' ";
        $dbquerystatus = mysql_db_query($dbname, $sqlstatus);
        $resultstatus = mysql_fetch_array($dbquerystatus);
        if ($resultstatus[status_count] != '0') $resultchk_count[mycount] = $resultchk_count[mycount] + (1 / $resultstatus[status_count]);
        $resultchk_count[mycount] = number_format($resultchk_count[mycount], 1, '.', '');
        if ($resultstatus[status_count] == '3') {
            $xx++;
            if ($xx == '3') {
                $resultchk_count[mycount] = $resultchk_count[mycount] + 0.1;
                $xx = '1';
            }
        }
        if ($resultstatus[status_count] != '0' && $arrhour[status_fix_time] == '') $hour_total = $hour_total + ($resultstuhour[dpr4] / $resultstatus[status_count]);
        if ($resultstatus[status_count] != '0' && $arrhour[status_fix_time] != '') $hour_total = $hour_total + ($arrhour[status_fix_time] / 60);
        $hour_total = number_format($hour_total, 2, '.', '');
    }
    if ($resultchk_count[mycount] == '0') $resultchk_count[mycount] = '';
    return $hour_total;
}
function dateinput_min($caption, $date_name, $month_name, $year_name, $hour_name, $min_name, $date_select, $month_select, $year_select, $hour_select, $min_select, $year_count, $year_thai, $disabled) {
    if ($date_select == '') {
        $date_select = date(d);
    }
    echo '<tr valign="top"><td>' . $caption . ' :</td><td>';
    echo '<select name="' . $date_name . '" class="form-control-mini">';
    for ($i = 1;$i <= 31;$i++) {
        echo '<option value="' . substr('0' . $i, -2) . '" ' . ($date_select + 0 == $i ? 'selected="selected"' : '') . '>' . $i . '</option>';
    }
    echo '</select> ';
    if ($month_select == '') {
        $month_select = date(m);
    }
    echo '<select name="' . $month_name . '" class="form-control-mini">';;
    echo '		<option value="1" ';
    if ($month_select == 1) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="2" ';
    if ($month_select == 2) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="3" ';
    if ($month_select == 3) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="4" ';
    if ($month_select == 4) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="5" ';
    if ($month_select == 5) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="6" ';
    if ($month_select == 6) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="7" ';
    if ($month_select == 7) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="8" ';
    if ($month_select == 8) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="9" ';
    if ($month_select == 9) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="10" ';
    if ($month_select == 10) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="11" ';
    if ($month_select == 11) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="12" ';
    if ($month_select == 12) {
        echo 'selected';
    } else {
    };
    echo '></option>
	</select>
	';
    if ($year_select == '') {
        $year_select = date(Y);
    }
    $thisyear = date(Y);
    echo '<select name="' . $year_name . '" class="form-control-mini">';
    for ($i = $thisyear + 1;$i >= $thisyear - $year_count;$i--) {
        if ($year_thai == 1) {
            $yname = $i + 543;
        } else {
            $yname = $i;
        }
        $years = $i;
        echo '<option value="' . $years . '" ' . ($year_select + 0 == $i ? 'selected="selected"' : '') . '>' . $yname . '</option>';
    }
    echo '</select>';
    if ($hour_select == '') {
        $hour_select = sprintf('%02d', date(H));
    }
    echo '  <select name="' . $hour_name . '" class="form-control-mini">';;
    echo '			<option value="01" ';
    if ($hour_select == '01') {
        echo 'selected';
    } else {
    };
    echo '>01</option>
			<option value="02" ';
    if ($hour_select == '02') {
        echo 'selected';
    } else {
    };
    echo '>02</option>
			<option value="03" ';
    if ($hour_select == '03') {
        echo 'selected';
    } else {
    };
    echo '>03</option>
			<option value="04" ';
    if ($hour_select == '04') {
        echo 'selected';
    } else {
    };
    echo '>04</option>
			<option value="05" ';
    if ($hour_select == '05') {
        echo 'selected';
    } else {
    };
    echo '>05</option>
			<option value="06" ';
    if ($hour_select == '06') {
        echo 'selected';
    } else {
    };
    echo '>06</option>
			<option value="07" ';
    if ($hour_select == '07') {
        echo 'selected';
    } else {
    };
    echo '>07</option>
			<option value="08" ';
    if ($hour_select == '08') {
        echo 'selected';
    } else {
    };
    echo '>08</option>
			<option value="09" ';
    if ($hour_select == '09') {
        echo 'selected';
    } else {
    };
    echo '>09</option>
			<option value="10" ';
    if ($hour_select == '10') {
        echo 'selected';
    } else {
    };
    echo '>10</option>
			<option value="11" ';
    if ($hour_select == '11') {
        echo 'selected';
    } else {
    };
    echo '>11</option>
			<option value="12" ';
    if ($hour_select == '12') {
        echo 'selected';
    } else {
    };
    echo '>12</option>
			<option value="13" ';
    if ($hour_select == '13') {
        echo 'selected';
    } else {
    };
    echo '>13</option>
			<option value="14" ';
    if ($hour_select == '14') {
        echo 'selected';
    } else {
    };
    echo '>14</option>
			<option value="15" ';
    if ($hour_select == '15') {
        echo 'selected';
    } else {
    };
    echo '>15</option>
			<option value="16" ';
    if ($hour_select == '16') {
        echo 'selected';
    } else {
    };
    echo '>16</option>
			<option value="17" ';
    if ($hour_select == '17') {
        echo 'selected';
    } else {
    };
    echo '>17</option>
			<option value="18" ';
    if ($hour_select == '18') {
        echo 'selected';
    } else {
    };
    echo '>18</option>
			<option value="19" ';
    if ($hour_select == '19') {
        echo 'selected';
    } else {
    };
    echo '>19</option>
			<option value="20" ';
    if ($hour_select == '20') {
        echo 'selected';
    } else {
    };
    echo '>20</option>
			<option value="21" ';
    if ($hour_select == '21') {
        echo 'selected';
    } else {
    };
    echo '>21</option>
			<option value="22" ';
    if ($hour_select == '22') {
        echo 'selected';
    } else {
    };
    echo '>22</option>
			<option value="23" ';
    if ($hour_select == '23') {
        echo 'selected';
    } else {
    };
    echo '>23</option>
			<option value="00" ';
    if ($hour_select == '00') {
        echo 'selected';
    } else {
    };
    echo '>00</option>
	</select> : 
	';
    if ($min_select == '') {
        $min_select = sprintf('%02d', date(i));
    }
    echo '<select name="' . $min_name . '" class="form-control-mini">';;
    echo '			<option value="00" ';
    if ($min_select == '00') {
        echo 'selected';
    } else {
    };
    echo '>00</option>
			<option value="15" ';
    if ($min_select == '15') {
        echo 'selected';
    } else {
    };
    echo '>15</option>
			<option value="30" ';
    if ($min_select == '30') {
        echo 'selected';
    } else {
    };
    echo '>30</option>
			<option value="45" ';
    if ($min_select == '45') {
        echo 'selected';
    } else {
    };
    echo '>45</option>
	</select>
	';
    echo '<br>';
    echo holidayecho($year_select . '-' . $month_select . '-' . $date_select);
    echo '</td>';
}
function dateinput_mins($caption, $date_name, $month_name, $year_name, $hour_name, $min_name, $date_select, $month_select, $year_select, $hour_select, $min_select, $year_count, $year_thai, $disabled) {
    if ($date_select == '') {
        $date_select = date(d);
    }
    echo '<tr valign="top"><td>' . $caption . ' :</td><td>';
    echo '<select name="' . $date_name . '" class="form-control-mini">';
    for ($i = 1;$i <= 31;$i++) {
        echo '<option value="' . substr('0' . $i, -2) . '" ' . ($date_select + 0 == $i ? 'selected="selected"' : '') . '>' . $i . '</option>';
    }
    echo '</select> ';
    if ($month_select == '') {
        $month_select = date(m);
    }
    echo '<select name="' . $month_name . '" class="form-control-mini">';;
    echo '		<option value="1" ';
    if ($month_select == 1) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="2" ';
    if ($month_select == 2) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="3" ';
    if ($month_select == 3) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="4" ';
    if ($month_select == 4) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="5" ';
    if ($month_select == 5) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="6" ';
    if ($month_select == 6) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="7" ';
    if ($month_select == 7) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="8" ';
    if ($month_select == 8) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="9" ';
    if ($month_select == 9) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="10" ';
    if ($month_select == 10) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="11" ';
    if ($month_select == 11) {
        echo 'selected';
    } else {
    };
    echo '></option>
		<option value="12" ';
    if ($month_select == 12) {
        echo 'selected';
    } else {
    };
    echo '></option>
	</select>
	';
    if ($year_select == '') {
        $year_select = date(Y);
    }
    $thisyear = date(Y);
    echo '<select name="' . $year_name . '" class="form-control-mini">';
    for ($i = $thisyear + 1;$i >= $thisyear - $year_count;$i--) {
        if ($year_thai == 1) {
            $yname = $i + 543;
        } else {
            $yname = $i;
        }
        $years = $i;
        echo '<option value="' . $years . '" ' . ($year_select + 0 == $i ? 'selected="selected"' : '') . '>' . $yname . '</option>';
    }
    echo '</select>';
    if ($hour_select == '') {
        $hour_select = sprintf('%02d', date(H));
    }
    echo '  <select name="' . $hour_name . '" class="form-control-mini">';;
    echo '			<option value="01" ';
    if ($hour_select == '01') {
        echo 'selected';
    } else {
    };
    echo '>01</option>
			<option value="02" ';
    if ($hour_select == '02') {
        echo 'selected';
    } else {
    };
    echo '>02</option>
			<option value="03" ';
    if ($hour_select == '03') {
        echo 'selected';
    } else {
    };
    echo '>03</option>
			<option value="04" ';
    if ($hour_select == '04') {
        echo 'selected';
    } else {
    };
    echo '>04</option>
			<option value="05" ';
    if ($hour_select == '05') {
        echo 'selected';
    } else {
    };
    echo '>05</option>
			<option value="06" ';
    if ($hour_select == '06') {
        echo 'selected';
    } else {
    };
    echo '>06</option>
			<option value="07" ';
    if ($hour_select == '07') {
        echo 'selected';
    } else {
    };
    echo '>07</option>
			<option value="08" ';
    if ($hour_select == '08') {
        echo 'selected';
    } else {
    };
    echo '>08</option>
			<option value="09" ';
    if ($hour_select == '09') {
        echo 'selected';
    } else {
    };
    echo '>09</option>
			<option value="10" ';
    if ($hour_select == '10') {
        echo 'selected';
    } else {
    };
    echo '>10</option>
			<option value="11" ';
    if ($hour_select == '11') {
        echo 'selected';
    } else {
    };
    echo '>11</option>
			<option value="12" ';
    if ($hour_select == '12') {
        echo 'selected';
    } else {
    };
    echo '>12</option>
			<option value="13" ';
    if ($hour_select == '13') {
        echo 'selected';
    } else {
    };
    echo '>13</option>
			<option value="14" ';
    if ($hour_select == '14') {
        echo 'selected';
    } else {
    };
    echo '>14</option>
			<option value="15" ';
    if ($hour_select == '15') {
        echo 'selected';
    } else {
    };
    echo '>15</option>
			<option value="16" ';
    if ($hour_select == '16') {
        echo 'selected';
    } else {
    };
    echo '>16</option>
			<option value="17" ';
    if ($hour_select == '17') {
        echo 'selected';
    } else {
    };
    echo '>17</option>
			<option value="18" ';
    if ($hour_select == '18') {
        echo 'selected';
    } else {
    };
    echo '>18</option>
			<option value="19" ';
    if ($hour_select == '19') {
        echo 'selected';
    } else {
    };
    echo '>19</option>
			<option value="20" ';
    if ($hour_select == '20') {
        echo 'selected';
    } else {
    };
    echo '>20</option>
			<option value="21" ';
    if ($hour_select == '21') {
        echo 'selected';
    } else {
    };
    echo '>21</option>
			<option value="22" ';
    if ($hour_select == '22') {
        echo 'selected';
    } else {
    };
    echo '>22</option>
			<option value="23" ';
    if ($hour_select == '23') {
        echo 'selected';
    } else {
    };
    echo '>23</option>
			<option value="00" ';
    if ($hour_select == '00') {
        echo 'selected';
    } else {
    };
    echo '>00</option>
	</select> : 
	';
    if ($min_select == '') {
        $min_select = date(i);
    }
    echo '<select name="' . $min_name . '" class="form-control-mini">';
    for ($i = 0;$i <= 59;$i++) {
        echo '<option value="' . sprintf('%02d', $i) . '" ' . ($min_select + 0 == $i ? 'selected="selected"' : '') . '>' . sprintf('%02d', $i) . '</option>';
    };
    echo '	</select>
	';
    echo '<br>';
    echo holidayecho($year_select . '-' . $month_select . '-' . $date_select);
    echo '</td>';
}
function check_user_agent($type = NULL) {
    require_once 'mdetect.php';
    $detect = new Mobile_Detect;
    $user_agent = strtolower($_SERVER['HTTP_USER_AGENT']);
    if ($type == 'mobile') {
        if ($detect->isMobile() && !$detect->isTablet()) {
            return true;
        }
    }
    return false;
}
function array_mode($array, $justMode = 0) {
    $count = array();
    foreach ($array as $item) {
        if (isset($count[$item])) {
            $count[$item]++;
        } else {
            $count[$item] = 1;
        };
    };
    $mostcommon = '';
    $iter = 0;
    foreach ($count as $k => $v) {
        if ($v > $iter) {
            $mostcommon = $k;
            $iter = $v;
        };
    };
    if ($justMode == 0) {
        return $mostcommon;
    } else {
        return array('mode' => $mostcommon, 'count' => $iter);
    }
}
function checkusername($usernew) {
    @$Query = mysql_query("select * FROM people WHERE people_user='$usernew' and school_id = '$_SESSION[school_id]' limit 0 , 1");
    @$total_11 = mysql_num_rows($Query);
    @$Query = mysql_query("select * FROM student WHERE student_id='$usernew' and school_id = '$_SESSION[school_id]'  limit 0 , 1  ");
    @$total_21 = mysql_num_rows($Query);
    @$Query = mysql_query("select * FROM othaccount  WHERE people_user='$usernew'  limit 0 , 1 ");
    @$total_31 = mysql_num_rows($Query);
    @$Query = mysql_query("select * FROM people WHERE people_user='$usernew' and school_id = '$_SESSION[school_id]' limit 0 , 1");
    @$total_12 = mysql_num_rows($Query);
    @$Query = mysql_query("select * FROM othaccount  WHERE people_user='$usernew'  limit 0 , 1 ");
    @$total_32 = mysql_num_rows($Query);
    if ($total_11 == '0' && $total_21 == '0' && $total_31 == '0') {
        $output = '1';
    } else if ($total_12 == '1' && $total_32 == '0' && $_SESSION[systemid] == '1' && $_REQUEST[p] != 'ath_import') {
        $output = '1';
    } else if ($total_12 == '0' && $total_32 == '1' && $_SESSION[systemid] == '1' && $_REQUEST[p] == 'ath_edit') {
        $output = '1';
    } else if ($total_12 == '0' && $total_32 == '1' && $_SESSION[systemid] == '5') {
        $output = '1';
    } else {
        $output = '0';
    }
    return $output;
}
function checkstudentid($usernew) {
    @$Query = mysql_query("select * FROM student WHERE student_id='$usernew' and school_id = '$_SESSION[school_id]'  limit 0 , 1  ");
    @$total_21 = mysql_num_rows($Query);
    if ($total_21 + 0 == '0') {
        $output = '0';
    } else {
        $output = '1';
    }
    return $output;
}
function student_study($student_id, $student_group_id, $semes, $subject_id, $teacher_id, $tem, $koon) {
    $Query = mysql_query("SELECT * FROM chk where student_id = '" . $student_id . "' and student_group_id ='" . $student_group_id . "' and semes = '" . $semes . "' and subject_id = '" . $subject_id . "' and teacher_id = '" . $teacher_id . "' and school_id = '" . $_SESSION[school_id] . "'");
    @$totalgroup = mysql_num_rows($Query);
    $totalgroup = $totalgroup * $koon;
    if ($totalgroup == '0') {
        return $tem - 0;
    } else {
        return $tem - $totalgroup;
    }
}
function counter_kap($student_group_id, $semes, $subject_id, $real_teacher_id, $school_id) {
    GLOBAL $dbname;
    $sqlstuhour = "select sum(dpr4) as sumkap from studing where semes = '" . $semes . "' and school_id = '" . $school_id . "' and student_group_id = '" . $student_group_id . "' and subject_id='" . $subject_id . "' and teacher_id = '" . $real_teacher_id . "' ";
    $dbquerystuhour = mysql_db_query($dbname, $sqlstuhour);
    $resultstuhour = mysql_fetch_array($dbquerystuhour);
    if ($resultstuhour[sumkap] == '0') {
        return 0;
    } else {
        return $resultstuhour[sumkap];
    }
}
function xml2array($xml) {
    $opened = array();
    $xml_parser = xml_parser_create();
    xml_parse_into_struct($xml_parser, $xml, $xmlarray);
    $array = array();
    $arrsize = sizeof($xmlarray);
    for ($j = 0;$j < $arrsize;$j++) {
        $val = $xmlarray[$j];
        switch ($val['type']) {
            case 'open':
                $opened[$val['tag']] = $array;
                unset($array);
            break;
            case 'complete':
                $array[$val['tag']][] = $val['value'];
            break;
            case 'close':
                $opened[$val['tag']] = $array;
                $array = $opened;
            break;
        }
    }
    return $array;
}
function business_name($business_id, $dataformat) {
    GLOBAL $onmouseover;
    GLOBAL $destination_path;
    GLOBAL $browser;
    GLOBAL $config_value;
    @$Query = mysql_query("SELECT * FROM business WHERE business_id = '$business_id' ");
    @$totalstudent = mysql_num_rows($Query);
    while ($resultstudent = mysql_fetch_array($Query)) {
        if ($dataformat == 1) {
            return ' ' . '<tr><td> () : </td><td>' . $resultstudent[business_id] . ' </td>' . '<tr><td> () : </td><td> ' . $resultstudent[business_name] . '</td>' . '<tr><td> : </td><td>' . $resultstudent[business_contact] . ' </td>' . '<tr><td> </td><td>' . $resultstudent[business_tel] . '</td>' . '<tr><td> </td><td>' . $resultstudent[business_region] . '</td>';
        }
    }
}
function ThaiBahtConversion($amount_number) {
    $amount_number = number_format($amount_number, 2, '.', '');
    $pt = strpos($amount_number, '.');
    $number = $fraction = '';
    if ($pt === false) $number = $amount_number;
    else {
        $number = substr($amount_number, 0, $pt);
        $fraction = substr($amount_number, $pt + 1);
    }
    $ret = '';
    $baht = ReadNumber($number);
    if ($baht != '') $ret.= $baht . '';
    $satang = ReadNumber($fraction);
    if ($satang != '') {
        $ret.= $satang . '';
    } else {
        if ($baht != '') $ret.= '';
    }
    return $ret;
}
function ReadNumber($number) {
    $position_call = array('', '', '', '', '', '');
    $number_call = array('', '', '', '', '', '', '', '', '', '');
    $number = $number + 0;
    $ret = '';
    if ($number == 0) return $ret;
    if ($number > 1000000) {
        $ret.= ReadNumber(intval($number / 1000000)) . '';
        $number = intval(fmod($number, 1000000));
    }
    $divider = 100000;
    $pos = 0;
    while ($number > 0) {
        $d = intval($number / $divider);
        $ret.= (($divider == 10) && ($d == 2)) ? '' : ((($divider == 10) && ($d == 1)) ? '' : ((($divider == 1) && ($d == 1) && ($ret != '')) ? '' : $number_call[$d]));
        $ret.= ($d ? $position_call[$pos] : '');
        $number = $number % $divider;
        $divider = $divider / 10;
        $pos++;
    }
    return $ret;
}
$thai_day_arr = array('', '', '', '', '', '', '');
$thai_month_arr = array('0' => '', '1' => '', '2' => '', '3' => '', '4' => '', '5' => '', '6' => '', '7' => '', '8' => '', '9' => '', '10' => '', '11' => '', '12' => '');
function thai_date($time) {
    global $thai_day_arr, $thai_month_arr;
    $time = strtotime($time);
    $thai_date_return = '' . $thai_day_arr[date('w', $time) ];
    $thai_date_return.= ' ' . date('j', $time);
    $thai_date_return.= ' ' . $thai_month_arr[date('n', $time) ];
    $thai_date_return.= ' ..' . (date('Y', $time) + 543);
    return $thai_date_return;
}
function callAPISTD2018($method, $url, $data, $SchoolCode, $AcademicYear, $Semester, $TimeTableID = null, $TimeTableSubID = null, $CheckDate = null, $GroupCode = null, $ClassRoomID = null, $AllData = null) {
    $curl = curl_init();
    switch ($method) {
        case 'POST':
            curl_setopt($curl, CURLOPT_POST, 1);
            if ($data) curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        case 'PUT':
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
            if ($data) curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        default:
            if ($data) $url = sprintf('%s?%s', $url, http_build_query($data));
        }
        curl_setopt($curl, CURLOPT_URL, $url);
        if ($Semester >= 3) {
            $Semester = 'S';
        }
        if ($AllData == 1) {
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'X-Office-Request: RMS', 'X-Office-Key: ToYQnJ1H92g1e24szVSGyVHz39T5hTj065EhEtMC', 'SchoolCode: ' . $SchoolCode . '', 'AcademicYear: ' . $AcademicYear . '', 'Semester: ' . $Semester . '', 'TimeTableID: ' . $TimeTableID . '', 'TimeTableSubID: ' . $TimeTableSubID . '', 'GroupCode: ' . $GroupCode . '', 'CheckDate: ' . $CheckDate . '', 'ClassRoomID: ' . $ClassRoomID . '',));
        } else {
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'X-Office-Request: RMS', 'X-Office-Key: ToYQnJ1H92g1e24szVSGyVHz39T5hTj065EhEtMC', 'SchoolCode: ' . $SchoolCode . '', 'AcademicYear: ' . $AcademicYear . '', 'Semester: ' . $Semester . '', 'TimeTableID: ' . $TimeTableID . '', 'TimeTableSubID: ' . $TimeTableSubID . '', 'GroupCode: ' . $GroupCode . '', 'CheckDate: ' . $CheckDate . '', 'ClassRoomID: ' . $ClassRoomID . '', 'StudentStatus: 3',));
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($curl, CURLOPT_TIMEOUT, 120);
        $result = curl_exec($curl);
        curl_close($curl);
        return $result;
    }
    function dataconvertor($datedata) {
        $datedataex1 = explode(' ', $datedata);
        $datedataex = explode('-', $datedataex1[0]);
        $date = $datedataex[2];
        $month = $datedataex[1];
        $year = $datedataex[0];
        switch ($month) {
            case '1':
                $printmonth = 'Jan';
            break;
            case '2':
                $printmonth = 'Feb';
            break;
            case '3':
                $printmonth = 'Mar';
            break;
            case '4':
                $printmonth = 'Apr';
            break;
            case '5':
                $printmonth = 'May';
            break;
            case '6':
                $printmonth = 'Jun';
            break;
            case '7':
                $printmonth = 'Jul';
            break;
            case '8':
                $printmonth = 'Aug';
            break;
            case '9':
                $printmonth = 'Sep';
            break;
            case '10':
                $printmonth = 'Oct';
            break;
            case '11':
                $printmonth = 'Nov';
            break;
            case '12':
                $printmonth = 'Dec';
            break;
        }
        $Ythai = $year;
        return ($date + 0) . ' ' . $printmonth . ' ' . $Ythai . ' 00:00:00';
    }
    function disable_ob() {
        ini_set('output_buffering', 'off');
        ini_set('zlib.output_compression', false);
        ini_set('implicit_flush', true);
        ob_implicit_flush(true);
        while (ob_get_level() > 0) {
            $level = ob_get_level();
            ob_end_clean();
            if (ob_get_level() == $level) break;
        }
        if (function_exists('apache_setenv')) {
            apache_setenv('no-gzip', '1');
            apache_setenv('dont-vary', '1');
        }
    }
    function checkmydate($date) {
        $tempDate = explode('-', $date);
        return checkdate($tempDate[1], $tempDate[2], $tempDate[0]);
    }
    function datadic_std2018($tableofdata, $id) {
        $Query = mysql_query("SELECT * FROM $tableofdata where " . $tableofdata . "_std2018 = '" . $id . "'");
        @$totalgroup = mysql_num_rows($Query);
        while ($arr = mysql_fetch_array($Query)) {
            if ($arr[$tableofdata . '_name'] == '') {
                return '';
            } else {
                GLOBAL $config_value;
                if ($config_value[0] == '1') {
                    $arr[$tableofdata . '_name'] = str_replace('..', '.', $arr[$tableofdata . '_name']);
                } else {
                }
                return $arr[$tableofdata . '_name'];
            }
        }
        if ($totalgroup == '0') {
            return '';
        }
    }
    function distance($lat1, $lon1, $lat2, $lon2, $unit) {
        if (($lat1 == $lat2) && ($lon1 == $lon2)) {
            return 0;
        } else {
            $theta = $lon1 - $lon2;
            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            $unit = strtoupper($unit);
            if ($unit == 'K') {
                return (round(($miles * 1.609344), 2));
            } else if ($unit == 'N') {
                return (round(($miles * 0.8684), 2));
            } else {
                return (round($miles, 2));
            }
        }
    }
    function tempinput($caption, $temp_name, $min_temp, $high_temp, $temp_select) {
        echo '<td align="right">' . $caption . '</td><td>';
        echo '<select name="' . $temp_name . '" class="form-control" onchange="update_session_value(this.value)">';
        if ($temp_select + 0 == 0) $temp_select = '36.5';
        for ($i = $min_temp;$i <= $high_temp;$i = $i + 0.1) {
            echo '<option value="' . $i . '" ' . (round($temp_select, 2) == round($i, 2) ? 'selected="selected"' : '') . '>' . $i . ' &deg;C</option>';
        }
        echo '</select></td>';
    }
    function search_array($value, $array) {
        return (array_search($value, $array, false));
    }
    function betweendatecount($datadate) {
        $now = time();
        $your_date = strtotime("$datadate");
        $datediff = $your_date - $now;
        return round($datediff / (60 * 60 * 24));
    }
    function decode_subject_id($subject_id) {
        if (strpos($subject_id, '00-11') !== false) {
            return '';
        } else if (strpos($subject_id, '00-12') !== false) {
            return '';
        } else if (strpos($subject_id, '00-13') !== false) {
            return '';
        } else if (strpos($subject_id, '00-14') !== false) {
            return '';
        } else if (strpos($subject_id, '00-15') !== false) {
            return '';
        } else if (strpos($subject_id, '00-16') !== false) {
            return '';
        } else if (strpos($subject_id, '00-17') !== false) {
            return '';
        } else if (strpos($subject_id, '00-9') !== false) {
            return '';
        } else if (strpos($subject_id, '00-9') !== false) {
            return '';
        } else if (strpos($subject_id, '0001-10') !== false) {
            return ' ()';
        } else if (strpos($subject_id, '0001-20') !== false) {
            return ' ()';
        } else if (strpos($subject_id, '01-10') !== false && strpos($subject_id, '0001-') !== true && strpos($subject_id, '0000-') !== true) {
            return '';
        } else if (strpos($subject_id, '0001-') !== true && strpos($subject_id, '0000-') !== true) {
            return '';
        } else {
            return '';
        }
    }
    function convert_thai($data) {
        $data = str_replace('0', '', $data);
        $data = str_replace('1', '', $data);
        $data = str_replace('2', '', $data);
        $data = str_replace('3', '', $data);
        $data = str_replace('4', '', $data);
        $data = str_replace('5', '', $data);
        $data = str_replace('6', '', $data);
        $data = str_replace('7', '', $data);
        $data = str_replace('8', '', $data);
        $data = str_replace('9', '', $data);
        return $data;
    }
    function semes_thai($data) {
        GLOBAL $config_value;
        if ($config_value[180] == 1) {
            $mystring = $data;
            $findme = '3/';
            $pos = strpos($mystring, $findme);
            if ($pos === false) {
                $findme = '4/';
                $pos = strpos($mystring, $findme);
                if ($pos === false) {
                    $data = '';
                } else {
                    $data = ' ()';
                }
            } else {
                $data = ' ()';
            }
        } else {
            $data = '';
        }
        return $data;
    }
    function dateinput_auto5($caption, $date_name, $month_name, $year_name, $date_select, $month_select, $year_select, $year_count, $year_thai, $disabled) {
        GLOBAL $strings;
        if ($date_select == '') {
            $date_select = date(d);
        }
        echo '<tr valign="top"><td>' . $caption . ' :</td><td>';
        echo '<input type="hidden" name="' . $date_name . '" value="1">';
        echo '  ';
        if ($month_select == '') {
            $month_select = date(m);
        }
        echo '<select name="' . $month_name . '" class="form-control-mini" onchange="SubmitForm(\'formxx\');">  ';;
        echo '		<option  value="0" ';
        if ($month_select == 0) {
            echo 'selected';
        } else {
        };
        echo '></option>	
		<option  value="1" ';
        if ($month_select == 1) {
            echo 'selected';
        } else {
        };
        echo '></option>
		<option   value="2" ';
        if ($month_select == 2) {
            echo 'selected';
        } else {
        };
        echo '></option>
		<option   value="3" ';
        if ($month_select == 3) {
            echo 'selected';
        } else {
        };
        echo '></option>
		<option   value="4" ';
        if ($month_select == 4) {
            echo 'selected';
        } else {
        };
        echo '></option>
		<option   value="5" ';
        if ($month_select == 5) {
            echo 'selected';
        } else {
        };
        echo '></option>
		<option   value="6" ';
        if ($month_select == 6) {
            echo 'selected';
        } else {
        };
        echo '></option>
		<option   value="7" ';
        if ($month_select == 7) {
            echo 'selected';
        } else {
        };
        echo '></option>
		<option   value="8" ';
        if ($month_select == 8) {
            echo 'selected';
        } else {
        };
        echo '></option>
		<option   value="9" ';
        if ($month_select == 9) {
            echo 'selected';
        } else {
        };
        echo '></option>
		<option   value="10" ';
        if ($month_select == 10) {
            echo 'selected';
        } else {
        };
        echo '></option>
		<option   value="11" ';
        if ($month_select == 11) {
            echo 'selected';
        } else {
        };
        echo '></option>
		<option   value="12" ';
        if ($month_select == 12) {
            echo 'selected';
        } else {
        };
        echo '></option>
	</select>
	';
        if ($year_select == '') {
            $year_select = date(Y);
        }
        $thisyear = date(Y);
        echo '<select name="' . $year_name . '" class="form-control-mini" onchange="SubmitForm(\'formxx\');">  ';
        for ($i = $thisyear;$i >= $thisyear - $year_count;$i--) {
            if ($year_thai == 1) {
                $yname = $i + 543;
            } else {
                $yname = $i;
            }
            $years = $i;
            echo '<option   value="' . $years . '" ' . ($year_select + 0 == $i ? 'selected="selected"' : '') . '>' . $yname . '</option>';
        }
        echo '</select>';
        echo '<br>';
        echo holidayecho($year_select . '-' . $month_select . '-' . $date_select);
        echo '</td>';
    }
    function poll_alert($id) {
        GLOBAL $strings;
        GLOBAL $dbname;
        GLOBAL $todate;
        GLOBAL $config_value;
        if ($_SESSION[systemid] == 1) {
            $sql = "select * from poll WHERE school_id = '$_SESSION[school_id]' and poll_active = '1' and poll_type2 = '1' and poll_end >= '$todate'  ";
        } else if ($_SESSION[systemid] == 2) {
            $sql = "select * from poll WHERE school_id = '$_SESSION[school_id]' and poll_active = '1' and poll_type = '1' and poll_end >= '$todate'  ";
        } else if ($_SESSION[systemid] == 3) {
            $sql = "select * from poll WHERE school_id = '$_SESSION[school_id]' and poll_active = '1' and poll_type3 = '1' and poll_end >= '$todate'  ";
        }
        $Query = mysql_query($sql);
        while ($arr = mysql_fetch_array($Query)) {
            $x++;
            $sqlalert = "select * from poll_ans WHERE school_id = '$_SESSION[school_id]' and poll_id = '$arr[poll_id]' and userid = '$id' ";
            $dbqueryalert = mysql_db_query($dbname, $sqlalert);
            $num_rows2 = mysql_num_rows($dbqueryalert);
            $x = $x - $num_rows2;
        }
        $num_rows = $x;
        if ($num_rows >= 1) return $num_rows;
    }
    function autoahref($s) {
        return preg_replace('/https?:\/\/[\w\-\.!~#?&=+\*\'"(),\/]+/', '<a href="$0" target="_blank">$0</a>', $s);
    }
    function sendPushNotification($body, $title, $token) {
        $dbname = $GLOBALS[dbname];
        define('API_ACCESS_KEY', 'AAAAFZdvvLI:APA91bFW2LSyVqW8B-ebfSh4JyYfl9u-EM-KxhoBwfCEOT76a9R63OvaHClrAFmb25t1n92SGpt1CqQ5mfUu2gUPJMJtxqAxN2qxZUK8FWgYXi4CXDxqHxwoCw_4lNp8ug63PgB15pyy');
        $msg = array('body' => $body, 'title' => $title, 'sound' => 'default',);
        $data = array('click_action' => 'FLUTTER_NOTIFICATION_CLICK',);
        $fields = array('to' => $token, 'notification' => $msg, 'data' => $data);
        $headers = array('Authorization: key=' . API_ACCESS_KEY, 'Content-Type: application/json');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);
        if (strpos($result, '"failure":1') !== false) {
            $sql = "delete from myrms_token where token = '" . $token . "'  ";
            $dbqueryalert = mysql_db_query($dbname, $sql);
        }
        return $result;
    };