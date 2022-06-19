<?php 
ob_start();
ini_set('memory_limit', '4095M');
ini_set('max_execution_time', '1800');
ini_set('output_buffering', 4096);
if ($_REQUEST[safemode] == '1') {
    session_start();
    $_SESSION[safemode] = '1';
}
if ($_REQUEST[CMD] == 'DLVRREP') {
    include ('sys_connect.php');
    if ($_SESSION[olddb] == '1') {
        mysql_select_db('rms_backup') or die('Can not Connect DB');
        $dbname = 'rms_backup';
    }
    if ($_REQUEST[SMID] != '') {
        $sql = 'update mms_log set ' . " mms_send_status  = '$_REQUEST[DETAIL]' , " . " mms_send_transid  = '$_REQUEST[STATUS]'  " . " where mms_send_transid='$_REQUEST[SMID]' ";
        $dbquery = mysql_db_query($dbname, $sql);
        echo '<XML>
<STATUS>OK</STATUS>
<DETAIL></DETAIL>
</XML>
';
    } else {
        echo '<XML>
<STATUS>ERR</STATUS>
<DETAIL>NO SMID</DETAIL>
</XML>
';
    }
    exit();
} else {
}
if ($_REQUEST['p'] == 'logout') {
    session_start();
    if ($_SESSION[old_userid] != '') {
    } else {
        @setcookie('username_log', '', false);
        @setcookie('password_log', '', false);
        @setcookie('school_id', '', false);
    }
    include 'logout.php';
    exit();
};
echo '<!DOCTYPE html>
<html>
';
if ($_REQUEST[printbtn] == '1' && $_REQUEST[export_xls_page] == '1') {
    header('Content-type: xls');
    header('Content-Disposition: attachment; filename*=UTF-8\'\'' . rawurlencode(iconv('TIS-620', 'UTF-8', 'Export_page.xls')));
    header('Content-Transfer-Encoding: binary');
    header('Pragma: no-cache');
    header('Expires: 0');
}
include ('sys_connect.php');
if ($_SESSION[olddb] == '1') {
    mysql_select_db('rms_backup') or die('Can not Connect DB');
    $dbname = 'rms_backup';
}
include ('sys_core.php');
include ('jquery.php');
include ('sys_session.php');
if ($_COOKIE['username_log'] != '' && $_SESSION[userid] == '') {
    echo '<meta http-equiv="refresh" content="0;URL=check.php" />';
    exit();
}
if ($_REQUEST[p] == '') $_REQUEST[p] = 'login_ok';
if ($_REQUEST[printbtn] != '') $_SESSION[printbtn] = $_REQUEST[printbtn];
if ($_REQUEST[printok] != '') $_SESSION[printok] = $_REQUEST[printok];
if ($_SESSION[printok] == '1') {
    include ('sys_css_print.php');
} else {
    include ('sys_css.php');
}
if ($_REQUEST[printok] == '1' && $_REQUEST[printok] == '1' && $_REQUEST[export_xls_page] == null) {
    echo '
	<script>
	setTimeout(function(){ window.print(); }, 3000);
	
	</script>
	';
};
echo '

';
include ('sys_rescheck.php');;
echo '
<body topmargin="0" leftmargin="0" style="opacity: 0.5;filter:alpha(opacity=50)">

';
if ($_REQUEST[p] == 'login') {
} else {
    include 'common_function.php';;
    echo '
	<body class="skin sidebar-collapse ';
    if ($_SESSION[printbtn] == '1') {
        echo 'sidebar-hide';
    } else {
        echo 'sidebar-mini';
    };
    echo '">
		<div class="wrapper">
			';
    if ($_SESSION[printbtn] == '1') {
        $Querypeople_pro = mysql_query("SELECT * FROM people_pro WHERE people_id = '$_SESSION[userid]' and school_id = '$_SESSION[school_id]'");
        while ($arrpeople_pro = mysql_fetch_array($Querypeople_pro)) {
            $Querymodule_control = mysql_query("SELECT * FROM module_control WHERE people_dep_id = '$arrpeople_pro[people_dep_id]' and people_stagov_id = '$arrpeople_pro[people_stagov_id]' ");
            while ($arrmodule_control = mysql_fetch_array($Querymodule_control)) {
                $module_id = $arrmodule_control[module_id];
                if ($module_icon[$module_id] < $arrmodule_control[module_type_id]) {
                    $module_icon[$module_id] = $arrmodule_control[module_type_id];
                } else {
                }
            }
        }
    } else {
        include ('header.php');
    };
    echo '			
			';
    if ($_SESSION[printbtn] == '1') {
    } else {
        include ('menu-sidebar.php');
    };
    echo '			<!-- content-wrapper -->
			<div class="content-wrapper">
				';
    if ($_SESSION[printbtn] == '1') {
    } else {
        include ('page-header.php');
    };
    echo '				<!-- Main content -->
				<section class="content">
					<!-- Small boxes -->
					<div class="row">

';
}
if ($config_value[999] == '1') {
    if (preg_match('/(?i)msie [1-8]/', $_SERVER['HTTP_USER_AGENT'])) {
    } else {;
        echo '	<table border="0" cellpadding="0" cellspacing="0" width="';
        echo $config_value[8];
        echo '" align="center">
		  <tr>
			  <td>
	<div id="google_translate_element" align="right"></div><script type="text/javascript">
	function googleTranslateElementInit() {
	  new google.translate.TranslateElement({pageLanguage: \'th\', includedLanguages: \'en,th\', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, \'google_translate_element\');
	}
	</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
				</td>
	</table>
	';
    }
};
echo ' <!--     <table border="0" cellpadding="0" cellspacing="0" width="';
echo $config_value[8];
echo '" align="center">
        <tr>
          <td width="100%" valign="top"> -->

		  ';;
echo '
			';
if ($_SESSION[systemid] == '1') {
    $sqlicon = "SELECT * FROM icon WHERE icon_sys = '$_REQUEST[p]' and icon_disable != '1'";
    $dbqueryicon = mysql_db_query($dbname, $sqlicon);
    $num_rowsicon = mysql_num_rows($dbqueryicon);
    $resulticon = mysql_fetch_array($dbqueryicon);
    if ($num_rowsicon == '1') {
        $sqlmodule = "SELECT * FROM module where module_id = '$resulticon[module_id]'";
        $dbquerymodule = mysql_db_query($dbname, $sqlmodule);
        $resultimodule = mysql_fetch_array($dbquerymodule);
        $_SESSION[mod] = $resultimodule[module_id];
        if ($_REQUEST[mod] != '') {
            $mod = $_REQUEST[mod];
        } else {
            $mod = $_SESSION[mod];
        }
        $printbtn_array = '';
        foreach ($_REQUEST as $key => $value) {
            if ($key != 'users_resolution' && $key != 'PHPSESSID' && $key != 'p' && $key != 'PHPSESSID' && $key != 'rep_icon_config_name' && $key != 'printbtn' && $key != 'mod' && $key != 'username_log' && $key != 'password_log') {
                if (is_array($value)) {
                    $printbtn_array.= '&' . http_build_query(array($key => $value));
                } else {
                    $printbtn_array.= '&' . $key . '=' . $value . '';
                }
            }
        }
        $printbtn = '';
        if ($_SESSION[printok] == '1') {
            $printbtn.= '<p align="right">';
        }
        if ($_SESSION[printbtn] == '1') {
            $printbtn.= $resizer . '<a href="?p=' . $_REQUEST[p] . '' . $printbtn_array . '&mod=' . $mod . '&printok=0&printbtn=0#1"><img src="img/print.png" border="0" align="center" title="/"></a> 
						<!-- <a href="?p=login_ok&mod=' . $mod . '#1"><img src="back.png" width="24" border="0" align="center" title=""></a> -->';
            $main_scale = '12';
        }
        if ($_SESSION[printok] == '1') {
            $printbtn.= '<a href="?p=' . $_REQUEST[p] . '' . $printbtn_array . '&mod=' . $mod . '&printok=0&printbtn=0#1"><img src="print.png" width="24" border="0" align="center" title=""></a>';
        }
        if (($_SESSION[printbtn] == '' || $_SESSION[printbtn] == '0')) {
            $printbtn = $resizer . '<a href="?p=' . $_REQUEST[p] . '' . $printbtn_array . '&mod=' . $mod . '&printbtn=1#1"><img src="img/print.png" border="0" align="center" title="/"></a>
						<!-- <a href="?p=login_ok&mod=' . $mod . '#1"><img src="back.png" width="24" border="0" align="center" title=""></a>&nbsp; -->';
            $main_scale = '9';
        }
        if (($_SESSION[printok] == '' || $_SESSION[printok] == '0')) {
            $printbtn.= '<a href="?p=' . $_REQUEST[p] . '' . $printbtn_array . '&mod=' . $mod . '&printok=1&printbtn=1#1"><img src="print.png" width="24" border="0" align="center" title=""></a>
						
						<a href="?p=' . $_REQUEST[p] . '' . $printbtn_array . '&mod=' . $mod . '&printok=1&export_xls_page=1&printbtn=1#1"><img src="chk_xls.png" width="24" border="0" align="center" title="Export   Excel"></a>
						';
        }
        if ($_SESSION[printok] == '1') {
            $printbtn.= '</p>';
        }
    }
};
echo '			
			
			';
if ($_REQUEST[p] == 'login') {
    if ($resultmms[mms_config_01] == '3') {
        include 'login_ais.php';
    } else {
        include 'login.php';
    }
} else if ($_REQUEST[p] == 'logout') {
    include 'logout.php';
    exit();
} else if ($_REQUEST[p] == 'operadmin') {
    include 'operadmin.php';
} else {
}
if ($_SESSION[systemid] == '1') {
    if (poll_alert($_SESSION[userid]) + 0 != 0) {
        echo '<div class="col-lg-12">
								<div class="alert small-box bg-purple">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<font color="white"><center><a href="sms_poll_answer.php" class="lightwindow page-options" params="lightwindow_type=external,lightwindow_width=700,lightwindow_height=500"><font color="white"><b><big><img src="sms_poll.png">  <span class="label label-danger">' . poll_alert($_SESSION[userid]) . '</span> </big></font></b></a></font>
								</div>
							</div>';
    }
    $sql = 'update people set ' . " lastlogin = '$thistime' " . "where people_id='$_SESSION[userid]' and school_id = '$_SESSION[school_id]' ";
    $dbquery = mysql_db_query($dbname, $sql);
    if ($_REQUEST[p] != 'login_ok' && $browser == 0) {
        if ($_REQUEST[p] != 'mail') {
            if ($_SESSION[printbtn] == '1') {
            } else {
                include 'pms_menu.php';
            }
        }
    }
    if ($_REQUEST[p] == 'login_ok') {
        include 'pms_home.php';
    } else {
        if ($num_rowsicon == '1') {
            echo '<a name="ok"></a>';
            echo '<div class="col-md-' . $main_scale . '">
							<div class="box box-primary">
								<div class="box-header with-border">
									<h3 class="box-title">' . $resulticon[icon_name] . '</h3>
									<div class="box-tools pull-right">';
            if ($_SESSION[printok] == '1') {
            } else {
                echo '<button class="btn btn-box-tool" data-widget="collapse"><img src="minus.png"></button>';
            }
            if ($_REQUEST[printbtn] == '1' && $_REQUEST[export_xls_page] == '1') {
            } else {
                echo '	' . $printbtn . ' ';
            }
            echo '</div>
								</div>
								<div class="box-body">';
            if ($_SESSION[printbtn] == '1') {
                if ($_REQUEST[p] == 'chk_home') {
                    echo '<div>';
                } else if ($_REQUEST[p] == 'chk_score' && $_REQUEST[sp] == '') {
                    echo '<div>';
                } else if ($_REQUEST[p] == 'pms_note') {
                    echo '<div>';
                } else if ($_REQUEST[p] == 'sms_home') {
                    echo '<div>';
                } else if ($_REQUEST[p] == 'sms_poll') {
                    echo '<div>';
                } else if ($_REQUEST[p] == 'sms_poll_report') {
                    echo '<div>';
                } else if ($_REQUEST[p] == 'slb_home') {
                    echo '<div>';
                } else if ($_REQUEST[p] == 'mail_inbox') {
                    echo '<div>';
                } else if ($_REQUEST[p] == 'slb_manage') {
                    echo '<div>';
                } else {
                    echo '<div class="table-responsive">';
                }
            } else {
                if ($_REQUEST[p] == 'chk_home') {
                    echo '<div>';
                } else if ($_REQUEST[p] == 'chk_score' && $_REQUEST[sp] == '') {
                    echo '<div>';
                } else if ($_REQUEST[p] == 'pms_note') {
                    echo '<div>';
                } else if ($_REQUEST[p] == 'sms_home') {
                    echo '<div>';
                } else if ($_REQUEST[p] == 'sms_poll') {
                    echo '<div>';
                } else if ($_REQUEST[p] == 'sms_poll_report') {
                    echo '<div>';
                } else if ($_REQUEST[p] == 'slb_home') {
                    echo '<div>';
                } else if ($_REQUEST[p] == 'mail_inbox') {
                    echo '<div>';
                } else if ($_REQUEST[p] == 'slb_manage') {
                    echo '<div>';
                } else {
                    echo '<div class="table-responsive">';
                }
            }
            include $_REQUEST[p] . '.php';
            echo '<br><br>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>';
        }
    }
    if ($_REQUEST[p] != 'login_ok' && $browser == 0) {
        if ($_REQUEST[p] != 'mail') {
            echo '</td></table>';
        }
    }
} else if ($_SESSION[systemid] == '2' || $_SESSION[systemid] == '3') {
    if ($_SESSION[printbtn] == '1') {
        $sqluserdata = "SELECT * FROM student WHERE student_id = '$_SESSION[userid]' and school_id = '$_SESSION[school_id]' ";
        $dbqueryuserdata = mysql_db_query($dbname, $sqluserdata);
        $resultuserdata = mysql_fetch_array($dbqueryuserdata);
        if ($resultuserdata[filepic] == '') {
            $student_image = '<img src="picture.png" height="21" border="0">';
        } else {
            $filename = $destination_path . '/display_' . $resultuserdata[filepic];
            if (file_exists($filename)) {
                $filename = $destination_path . '/display_' . $resultuserdata[filepic];
            } else {
                $filename = $destination_path . '/' . $resultuserdata[filepic];
            }
            $student_image = '<img src="' . $filename . '" height="21" border="0">';
        }
    }
    if (poll_alert($_SESSION[userid]) + 0 != 0) {
        echo '<div class="col-lg-12">
								<div class="alert small-box bg-purple">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<font color="white"><center><a href="sms_poll_answer.php" class="lightwindow page-options" params="lightwindow_type=external,lightwindow_width=700,lightwindow_height=500"><font color="white"><b><big><img src="sms_poll.png">  <span class="label label-danger">' . poll_alert($_SESSION[userid]) . '</span> </big></font></b></a></font>
								</div>
							</div>';
    }
    if ($_REQUEST[p] == 'login_ok') {
        include 'sms_home_login.php';
    } else if ($_REQUEST[p] == 'assess') {
        include 'sms_home_assess.php';
    } else if ($_REQUEST[p] == 'download') {
        include 'sms_home_download.php';
    } else if ($_REQUEST[p] == 'assess_room') {
        include 'sms_home_assess_room.php';
    } else if ($_REQUEST[p] == 'assess_dep') {
        include 'sms_home_assess_dep.php';
    } else if ($_REQUEST[p] == 'edit') {
        include 'sms_home_edit.php';
    } else if ($_REQUEST[p] == 'caution') {
        include 'sms_home_caution.php';
    } else if ($_REQUEST[p] == 'homework') {
        include 'sms_home_homework.php';
    } else if ($_REQUEST[p] == 'mailbox') {
        include 'sms_home_mailbox.php';
    } else if ($_REQUEST[p] == 'sms_note') {
        include 'sms_home_note.php';
    } else if ($_REQUEST[p] == 'budget') {
        include 'sms_home_budget.php';
    } else if ($_REQUEST[p] == 'project') {
        echo '<div class="col-md-12">
<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title">' . $resultuserdata[stu_fname] . ' ' . $resultuserdata[stu_lname] . '</h3>
		<div class="box-tools pull-right">';
        if ($_SESSION[printok] == '1') {
        } else {
            echo '<button class="btn btn-box-tool" data-widget="collapse"><img src="minus.png"></button>';
        }
        echo '	' . $printbtn . '
		</div>
	</div>
	<div class="box-body">
		<div class="table-responsive">';
        include 'pjt_projectsearch.php';
    } else {
        include 'sms_home_login.php';
    }
} else if ($_SESSION[systemid] == '4') {
    if ($_REQUEST[p] == 'login_ok') {
        include 'alunmi_home_login.php';
    } else if ($_REQUEST[p] == 'follow') {
        include 'alunmi_home_follow.php';
    } else {
        include 'alunmi_home_login.php';
    }
} else if ($_SESSION[systemid] == '5') {
    if ($_REQUEST[p] == 'login_ok') {
        include 'authen_home_login.php';
    } else {
        include 'authen_home_login.php';
    }
} else {
};
echo '
          </td>
        </tr>
        <tr>

';
if ($_REQUEST[p] == 'login') {
} else {
    if ($_SESSION[printbtn] == '1') {
    } else {;
        echo '					</div>
				<!-- Main content -->
				';
    };
    echo '				</section>
			</div>
			<!-- content-wrapper -->
		';
    include ('footer.php');;
    echo '    	</div><!-- wrapper -->

<!--		  <td width="100%" valign="bottom">
			';
    include ('bottom.php');;
    echo '          </td>
-->
';
};
echo ' <!--       </tr>
      </table>
-->

';
if ($_REQUEST[printbtn] == '1' && $_REQUEST[export_xls_page] == '1') {
    $_REQUEST[printbtn] = '';
    $_SESSION[printbtn] = '';
    $_SESSION[printok] = '';
};
echo '
</body>
<script>
//$("body").css({"opacity": "0.5"});
//$(\'body\').append(\'<div style="" id="loadingDiv"><div class="loader">Loading...</div></div>\');
//$(\'body\').append(\'<div style="" id="loadingDiv">Loading...</div>\');
$(window).on(\'load\', function(){
  setTimeout(removeLoader, 100); //wait for page load PLUS two seconds.
});
function removeLoader(){
  	//$(\'body\').show();
    $( "#loadingDiv" ).fadeOut(100, function() {
      // fadeOut complete. Remove the loading div
      $( "#loadingDiv" ).remove(); //makes page more lightweight 
  });  
  $("body").css({"opacity": "1"});
}
</script>
</html>';