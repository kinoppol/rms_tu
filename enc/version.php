<?php
$info = array();
$info['id'] = 'rms';
$info['name'] = 'RMS2011';
$info['version'] = '20220041'; 
if ($_GET['s'] != '')
echo serialize($info[$_GET['s']]);