<?php

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2006 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

if (!defined('ADMIN_FILE')) {
  die ("Access Denied");
}

global $prefix, $db, $admin_file;
$aid = substr($aid, 0,25);
$row = $db->sql_fetchrow($db->sql_query("SELECT title, admins FROM ".$prefix."_modules WHERE title='XMoreOption'"));
$row2 = $db->sql_fetchrow($db->sql_query("SELECT name, radminsuper FROM ".$prefix."_authors WHERE aid='$aid'"));
$admins = explode(",", $row['admins']);
$auth_user = 0;
for ($i=0; $i < sizeof($admins); $i++) {
  if ($row2['name'] == "$admins[$i]" AND !empty($row['admins'])) {
    $auth_user = 1;
  }
}

if ($row2['radminsuper'] == 1 || $auth_user == 1) {
function get_latest_xmoreoptionverj($mode=''){
	if (extension_loaded('sockets') && function_exists('fsockopen') ){
		if ($fsock = @fsockopen("www.xstar.ir", 80, $errno, $errstr, 10))
		{
			@fputs($fsock, "GET /xmoreoptionverj.txt HTTP/1.1\r\n");
			@fputs($fsock, "HOST: www.xstar.ir\r\n");
			@fputs($fsock, "Connection: close\r\n\r\n");

			$file_info = '';
			$get_info = false;

			while (!@feof($fsock))
			{
				if ($get_info)
				{
					$file_info .= @fread($fsock, 1024);
				}
				else
				{
					$line = @fgets($fsock, 1024);
					if ($line == "\r\n")
					{
						$get_info = true;
					}
					else if (stripos($line, '404 not found') !== false)
					{
						$errstr = 'FILE_NOT_FOUND : version.html';
						return false;
					}
				}
			}
			@fclose($fsock);
		}
		else
		{
			if ($errstr)
			{
				return false;
			}
			else
			{
				$errstr = "The operation could not be completed because the <var>fsockopen</var> function has been disabled or the server being queried could not be found.";
				return false;
			}
		}

		return $file_info;
	}else{
		if(isset($mode) && $mode == "adminmain"){
			die("Beta2");
		}
		return "Beta2";
	}
}
function massaggex($text){
?>		<div id="message-green">
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
		<tr><td class="green-right"><a class="close-green"><img src="admin/template/images/table/icon_close_green.gif"   alt="" /></a></td>
		<td class="green-left"><?php echo $text; ?></a></td>
		</tr>
		</table>
		</div>
<?php
}
function massagrex($text){
?>		<div id="message-red">
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
		<tr><td class="red-right"><a class="close-red"><img src="admin/template/images/table/icon_close_red.gif"   alt="" /></a></td>
		<td class="red-left"><?php echo $text; ?></a></td>
		</tr>
		</table>
		</div>
<?php
}
function xlbitems($item1,$item2,$item3,$item4,$item5,$item6,$item7,$item8,$item9,$item10,$item11,$item12,$item13){
	global $prefix,$db,$dbname;
?>
<tr><td>جعبه برای ماژول : </td><td><select name="xlbmod" class="styledselect-select">
<option value="News" <?php if($item13=="News"){ ?>selected<?php } ?>>News</option>
<option value="Contact" disabled<?php if($item13=="Contact"){ ?>selected<?php } ?>>Contact</option>
</select></td></tr>
<tr><th>جعبه برای مطلب : </th><td><select name="xlbmid" class="styledselect-select">
<?php	$result = $db->sql_query("SELECT * FROM `" . $prefix . "_stories` ORDER BY `" . $prefix . "_stories`.`sid` DESC LIMIT 0 , 9999");
	while ($row = $db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$sid = intval($row['sid']);
	$title = check_html($row['title'], "nohtml");
?><option value="<?php echo $sid; ?>" <?php if($item12==$sid){ ?>selected<?php } ?>><?php echo $title; ?></option>
<?php } ?>
</select></td></tr>
<tr><td>عنوان فایل : </td><td><input name='xlbti' value='<?php echo $item1; ?>' class="inp-form-ltr"></td></tr>
<tr><td>لینک دانلود : </td><td><input name='xlbdl' value='<?php echo $item2; ?>' class="inp-form-ltr"></td></tr>
<tr><td>لینک کمکی : </td><td><input name='xlbmrdl' value='<?php echo $item3; ?>' class="inp-form-ltr"></td></tr>
<tr><td>حجم فایل : </td><td><input name='xlbmb' value='<?php echo $item4; ?>' class="inp-form-ltr"></td></tr>
<tr><td>md5 : </td><td><input name='xlbmd' value='<?php echo $item5; ?>' class="inp-form-ltr"></td></tr>
<tr><td>ارزش فایل : </td><td><input name='xlbdolar' value='<?php echo $item6; ?>' class="inp-form-ltr"></td></tr>
<tr><td>مجوز : </td><td><input name='xlbgemu' value='<?php echo $item7; ?>' class="inp-form-ltr"></td></tr>
<tr><td>اسکرین شات : </td><td><input name='xlbscsh' value='<?php echo $item8; ?>' class="inp-form-ltr"></td></tr>
<tr><td>به روز رسانی : </td><td><input name='xlbup' value='<?php echo $item9; ?>' class="inp-form-ltr"></td></tr>
<tr><td>منبع : </td><td><input name='xlbref' value='<?php echo $item10; ?>' class="inp-form-ltr"></td></tr>
<tr><td>رمز فایل : </td><td><input name='xlbpw' value='<?php echo $item11; ?>' class="inp-form-ltr"></td></tr>
<?php
}
function xaitems($item1,$item2,$item12,$item13){
	global $prefix,$db,$dbname;
?>
<tr><td>جعبه آپارات برای ماژول : </td><td><select name="xamod" class="styledselect-select">
<option value="News" <?php if($item13=="News"){ ?>selected<?php } ?>>News</option>
<option value="Contact" disabled<?php if($item13=="Contact"){ ?>selected<?php } ?>>Contact</option>
</select></td></tr>
<tr><th>جعبه آپارات برای مطلب : </th><td><select name="xamid" class="styledselect-select">
<?php	$result = $db->sql_query("SELECT * FROM `" . $prefix . "_stories` ORDER BY `" . $prefix . "_stories`.`sid` DESC LIMIT 0 , 9999");
	while ($row = $db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$sid = intval($row['sid']);
	$title = check_html($row['title'], "nohtml");
?><option value="<?php echo $sid; ?>" <?php if($item12==$sid){ ?>selected<?php } ?>><?php echo $title; ?></option>
<?php } ?>
</select></td></tr>
<tr><td>نام ویدئو : </td><td><input name='xatitle' value='<?php echo $item2; ?>' class="inp-form-ltr"></td></tr>
<tr><td>تگ آپارات : </td><td><input name='xatag' value='<?php echo $item1; ?>' class="inp-form-ltr"></td></tr>
<?php
}
function xpitems($item1,$item2,$item12,$item13){
	global $prefix,$db,$dbname;
?>
<tr><td>جعبه تصویر برای ماژول : </td><td><select name="xpmod" class="styledselect-select">
<option value="News" <?php if($item13=="News"){ ?>selected<?php } ?>>News</option>
<option value="Contact" disabled<?php if($item13=="Contact"){ ?>selected<?php } ?>>Contact</option>
</select></td></tr>
<tr><th>جعبه تصویر برای مطلب : </th><td><select name="xpmid" class="styledselect-select">
<?php	$result = $db->sql_query("SELECT * FROM `" . $prefix . "_stories` ORDER BY `" . $prefix . "_stories`.`sid` DESC LIMIT 0 , 9999");
	while ($row = $db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$sid = intval($row['sid']);
	$title = check_html($row['title'], "nohtml");
?><option value="<?php echo $sid; ?>" <?php if($item12==$sid){ ?>selected<?php } ?>><?php echo $title; ?></option>
<?php } ?>
</select></td></tr>
<tr><td>نام تصویر : </td><td><input name='xptitle' value='<?php echo $item2; ?>' class="inp-form-ltr"></td></tr>
<tr><td>آدرس تصویر : </td><td><input name='xptag' value='<?php echo $item1; ?>' class="inp-form-ltr"></td></tr>
<?php
}
function xsitems($item1,$item2,$item12,$item13){
	global $prefix,$db,$dbname;
?>
<tr><td style="width:250px">جعبه صوت برای ماژول : </td><td><select name="xsmod" class="styledselect-select">
<option value="News" <?php if($item13=="News"){ ?>selected<?php } ?>>News</option>
<option value="Contact" disabled<?php if($item13=="Contact"){ ?>selected<?php } ?>>Contact</option>
</select></td></tr>
<tr><th>جعبه صوت برای مطلب : </th><td><select name="xsmid" class="styledselect-select">
<?php	$result = $db->sql_query("SELECT * FROM `" . $prefix . "_stories` ORDER BY `" . $prefix . "_stories`.`sid` DESC LIMIT 0 , 9999");
	while ($row = $db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$sid = intval($row['sid']);
	$title = check_html($row['title'], "nohtml");
?><option value="<?php echo $sid; ?>" <?php if($item12==$sid){ ?>selected<?php } ?>><?php echo $title; ?></option>
<?php } ?>
</select></td></tr>
<tr><td>نام فایل صوتی : </td><td><input name='xstitle' value='<?php echo $item2; ?>' class="inp-form-ltr"></td></tr>
<tr><td>آدرس فایل صوتی : </td><td><input name='xstag' value='<?php echo $item1; ?>' class="inp-form-ltr"></td></tr>
<?php
}
function gettibyb($nuim, $nim){
global $prefix, $db, $dbname;
if($nim=="News"){
$nuim=intval($nuim);
$result = $db->sql_query("SELECT *
FROM `" . $prefix . "_stories`
WHERE `sid` =$nuim
LIMIT 0 , 1");
	while ($row = $db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$title = $row['title'];
}
}
if($nim=="Contact"){}
return $title;
}
function xlbsetv($nuim){
global $prefix, $db, $dbname;
$nuim=intval($nuim);
$result = $db->sql_query("SELECT * FROM `" . $prefix . "_xlbset` WHERE `xlb` =$nuim LIMIT 0 , 1");
	while ($row = $db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$xlbvalue = $row['xlbvalue'];
}
return $xlbvalue;
}
function xasetv($nuim){
global $prefix, $db, $dbname;
$nuim=intval($nuim);
$result = $db->sql_query("SELECT * FROM `" . $prefix . "_xaset` WHERE `xasid` =$nuim LIMIT 0 , 1");
	while ($row = $db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$xasvalue = $row['xasvalue'];
}
return $xasvalue;
}
function xpsetv($nuim){
global $prefix, $db, $dbname;
$nuim=intval($nuim);
$result = $db->sql_query("SELECT * FROM `" . $prefix . "_xpset` WHERE `xpsid` =$nuim LIMIT 0 , 1");
	while ($row = $db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$xasvalue = $row['xpsvalue'];
}
return $xasvalue;
}
function xssetv($nuim){
global $prefix, $db, $dbname;
$nuim=intval($nuim);
$result = $db->sql_query("SELECT * FROM `" . $prefix . "_xsset` WHERE `xssid` =$nuim LIMIT 0 , 1");
	while ($row = $db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$xasvalue = $row['xssvalue'];
}
return $xasvalue;
}
function xlbsetedit($nuim,$xxvalue){
global $prefix, $db, $dbname;
$nuim=intval($nuim);
$db->sql_query("UPDATE `$dbname`.`" . $prefix . "_xlbset` SET `xlbvalue` = '$xxvalue' WHERE `" . $prefix . "_xlbset`.`xlb` =$nuim;");
}
function xasetedit($nuim,$xxvalue){
global $prefix, $db, $dbname;
$nuim=intval($nuim);
$db->sql_query("UPDATE `$dbname`.`" . $prefix . "_xaset` SET `xasvalue` = '$xxvalue' WHERE `" . $prefix . "_xaset`.`xasid` =$nuim;");
}
function xpsetedit($nuim,$xxvalue){
global $prefix, $db, $dbname;
$nuim=intval($nuim);
$db->sql_query("UPDATE `$dbname`.`" . $prefix . "_xpset` SET `xpsvalue` = '$xxvalue' WHERE `" . $prefix . "_xpset`.`xpsid` =$nuim;");
}
function xssetedit($nuim,$xxvalue){
global $prefix, $db, $dbname;
$nuim=intval($nuim);
$db->sql_query("UPDATE `$dbname`.`" . $prefix . "_xsset` SET `xssvalue` = '$xxvalue' WHERE `" . $prefix . "_xsset`.`xssid` =$nuim;");
}
function xmoreoption() {
	global $prefix, $db, $admin_file, $dbname, $sitename, $xset;
include ("header.php");
GraphicAdmin();
OpenAdminTable();
if (extension_loaded('sockets') && function_exists('fsockopen') ){ $xmnvaa=get_latest_xmoreoptionverj(); } 
if($xmnvaa==""){$xmnvaa=="Beta2";}
if($xmnvaa=="Beta2"){}else{massaggex("<a href=\"http://www.phpnuke.ir/Forum/forum-f9/xmoreoption-t70999.html\">نسخه جدید سیستم XMoreOption به ورژن $xmnvaa انتشار یافت !!!</a>");}
?><center><font class="title"><b>آپشن های ادامه مطلب</b></font></center><br>
<style type="text/css">
.xmoreopt{text-align:center;height:270px;width:100%;}
.xmoabj{margin-left:20px;width:200px;height:250px;float:right;}
.xmoabj a{width:200px;height:200px;float:right;}
.xmoabj span{width:200px;height:50px;float:right;text-align:center;}
.xmoabj a:hover{background-position:0 100%;}
.selected span{background:url(modules/XMoreOption/images/selected.png) bottom center no-repeat;}
</style>
<div class="xmoreopt">
<div class="xmoabj <?php if($xset=="xlinksbox"){ ?>selected<?php } ?>">
<a href="<?php echo $admin_file; ?>.php?op=xmoreoption&xset=xlinksbox" style="background-image:url(modules/XMoreOption/images/xlinksbox.png)"></a>
<span>جعبه دانلود</span>
</div>
<div class="xmoabj <?php if($xset=="xaparat"){ ?>selected<?php } ?>">
<a href="<?php echo $admin_file; ?>.php?op=xmoreoption&xset=xaparat" style="background-image:url(modules/XMoreOption/images/xaparat.png)"></a>
<span>آپارات</span>
</div>
<div class="xmoabj <?php if($xset=="xsound"){ ?>selected<?php } ?>">
<a href="<?php echo $admin_file; ?>.php?op=xmoreoption&xset=xsound" style="background-image:url(modules/XMoreOption/images/xsound.png)"></a>
<span>جعبه صوت</span>
</div>
<div class="xmoabj <?php if($xset=="xpshpt"){ ?>selected<?php } ?>">
<a href="<?php echo $admin_file; ?>.php?op=xmoreoption&xset=xpshpt" style="background-image:url(modules/XMoreOption/images/xpshpt.png)"></a>
<span>جعبه تصاویر</span>
</div>
</div>
<br>
<?php
CloseAdminTable();
if(isset($xset) AND $xset!==""){
$xset();
}
include ("footer.php");
}
function xpshpt() {
	global $prefix, $db, $admin_file, $dbname, $sitename, $xniniki, $xpmod, $xpmid, $xptag, $xpid, $xptrue, $xptemp, $xptitle, $xpwidth, $xpheight, $xpcustp;
OpenAdminTable();
$dfsdfsd = $db->sql_numrows($db->sql_query("SELECT *
FROM `" . $prefix . "_xpset`
LIMIT 0 , 3"));
if($dfsdfsd>0){}else{
$db->sql_query("CREATE TABLE IF NOT EXISTS `" . $prefix . "_xpshpt` (
  `xpid` int(11) NOT NULL AUTO_INCREMENT,
  `xpmid` int(11) NOT NULL,
  `xpmod` text NOT NULL,
  `xptitle` text NOT NULL,
  `xptag` text NOT NULL,
  PRIMARY KEY (`xpid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");
$db->sql_query("CREATE TABLE IF NOT EXISTS `" . $prefix . "_xpset` (
  `xpsid` int(11) NOT NULL AUTO_INCREMENT,
  `xpsname` text NOT NULL,
  `xpsvalue` text NOT NULL,
  PRIMARY KEY (`xpsid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;");
$db->sql_query("INSERT INTO `" . $prefix . "_xpset` (`xpsid`, `xpsname`, `xpsvalue`) VALUES
(1, 'xptrue', '0'),
(2, 'xptemp', 'Simple'),
(3, 'xpcustp', '0'),
(4, 'xpwidth', '100'),
(5, 'xpheight', '60');");
massaggex("نصب آپشن تصویر با موفقیت انجام شد.");
}
if(isset($xniniki) AND $xniniki=="setting" AND isset($xptrue) AND isset($xptemp) AND isset($xpwidth) AND isset($xpheight) AND isset($xpcustp)){
xpsetedit(1,$xptrue);
xpsetedit(2,$xptemp);
xpsetedit(3,$xpcustp);
xpsetedit(4,$xpwidth);
xpsetedit(5,$xpheight);
massaggex("تنظیمات جعبه تصاویر بروز شد.");
}
if(isset($xniniki) AND $xniniki=="send" AND isset($xptag) AND isset($xpmod) AND isset($xpmid) AND isset($xptitle)){
if($xptag==""){
massagrex("آدرس تصویر حتما باید پر شود!!!");
}else{
$db->sql_query("INSERT INTO `$dbname`.`" . $prefix . "_xpshpt` (
`xpid` ,
`xpmid` ,
`xpmod` ,
`xptitle` ,
`xptag`
)
VALUES (
NULL , '$xpmid', '$xpmod', '$xptitle', '$xptag'
);");
massaggex("جعبه تصویر با موفقیت ارسال شد.");
}
}
if(isset($xniniki) AND $xniniki=="edit" AND isset($xpid)){
$result = $db->sql_query("SELECT *
FROM `" . $prefix . "_xpshpt`
WHERE `xpid` =$xpid
LIMIT 0 , 1");
	while ($row = $db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$xpid = intval($row['xpid']);
	$xpmid = intval($row['xpmid']);
	$xpmod = $row['xpmod'];
	$xptitle = $row['xptitle'];
	$xptag = $row['xptag'];
?><center><font class="title"><b>ویرایش جعبه تصاویر</b></font></center><br>
<form action="<?php echo $admin_file; ?>.php" method="post">
<table align="center" border="0" cellpadding="4" cellspacing="4" width="100%" id="id-form">
<?php  xpitems($xptag,$xptitle,$xpmid,$xpmod); ?>
<tr><td><input class="form-submit" type='submit' value='ارسال'>
</td></tr>
<input type="hidden" name="xniniki" value="xedit">
<input type="hidden" name="xpid" value="<?php echo $xpid; ?>">
<input type="hidden" name="op" value="xmoreoption">
<input type="hidden" name="xset" value="xpshpt">
</table>
</form>
<?php
die();
	}
}
if(isset($xniniki) AND $xniniki=="xedit" AND isset($xpid) AND isset($xptag) AND isset($xpmod) AND isset($xpmid) AND isset($xptitle)){
$db->sql_query("UPDATE `$dbname`.`" . $prefix . "_xpshpt` SET `xpmid` = '$xpmid',
`xpmod` = '$xpmod',
`xptitle` = '$xptitle',
`xptag` = '$xptag' WHERE `" . $prefix . "_xpshpt`.`xpid` =$xpid;");
massaggex("جعبه تصویر با موفقیت ویرایش شد.");
}
if($xniniki=="dele" AND isset($xpid)){
$db->sql_query("DELETE FROM `$dbname`.`" . $prefix . "_xpshpt` WHERE `" . $prefix . "_xpshpt`.`xpid` = $xpid");
massaggex("جعبه تصویر با موفقیت حذف شد.");
}
?>
<link rel="stylesheet" href="includes/Ajax/jquery/jquery.tabs.css" type="text/css" media="print, projection, screen" />
<script src="includes/Ajax/jquery/jquery.tabs.pack.js" type="text/javascript"></script>
<script type="text/javascript">
$(function() {
$('#container-4').tabs({ fxFade: true, fxSpeed: 'fast' });                              
});
</script>
<br><div class="Table">
<div class="Contents">
<div id="container-4">
<ul>
	<li><a href="#sendbox"><span>ارسال جعبه تصویر</span></a></li>
	<li><a href="#managbox"><span>مدیریت جعبه های تصاویر</span></a></li>
	<li><a href="#xlbhelp"><span>مدیریت آپشن</span></a></li>
	<li><a href="#xlbfhelp"><span>راهنمای آپشن</span></a></li>
</ul>
<div id="sendbox">
<form action="<?php echo $admin_file; ?>.php" method="post">
<table align="center" border="0" cellpadding="4" cellspacing="4" width="100%" id="id-form">
<?php  xpitems("","","","News"); ?>
<tr><td><input class="form-submit" type='submit' value='ارسال'>
</td></tr>
<input type="hidden" name="xniniki" value="send">
<input type="hidden" name="op" value="xmoreoption">
<input type="hidden" name="xset" value="xpshpt">
</table>
</form>
</div>
<div id="managbox">
<table id="product-table" border="0" width="100%"><tr>
<th class="table-header-repeat line-left" style="text-align:center;width:40px;"><a>شمارنده</a></th>
<th class="table-header-repeat line-left" style="text-align:center;"><a>برای ماژول</a></th>
<th class="table-header-repeat line-left" style="text-align:center;"><a>برای مطلب</a></th>
<th class="table-header-repeat line-left" style="text-align:center;"><a>عنوان</a></th>
<th class="table-header-repeat line-left" style="text-align:center;"><a>آدرس تصاویر</a></th>
<th class="table-header-repeat line-left" style="text-align:center;width:90px;"><a>امکانات</a></th>
</tr><?php
$result = $db->sql_query("SELECT *
FROM `" . $prefix . "_xpshpt`
ORDER BY `" . $prefix . "_xpshpt`.`xpid` DESC
LIMIT 0 , 99999");
	while ($row = $db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$xpid = intval($row['xpid']);
	$xpmid = intval($row['xpmid']);
	$xpmod = $row['xpmod'];
	$xptitle = $row['xptitle'];
	$xptag = $row['xptag'];
	?><tr>
<td align="center" width="40"><?php echo $xpid; ?></td>
<td align="center" width="auto"><?php echo $xpmod; ?></td>
<td align="center" width="auto"><?php echo gettibyb($xpmid, $xpmod); ?></td>
<td align="center" width="auto"><?php echo $xptitle; ?></td>
<td align="center" width="auto"><a href="<?php echo $xptag; ?>"><?php echo $xptag; ?></a></td>
<td align="center" width="auto">
	<a href="<?php echo $admin_file; ?>.php?op=xmoreoption&xset=xpshpt&xniniki=dele&xpid=<?php echo $xpid ; ?>" title="حذف آیتم" class="icon-2 info-tooltip"></a>
	<a href="<?php echo $admin_file; ?>.php?op=xmoreoption&xset=xpshpt&xniniki=edit&xpid=<?php echo $xpid ; ?>" title="ویرایش آیتم" class="icon-6 info-tooltip"></a>
</td><?php } ?>
</tr></table>
</div>
<div id="xlbhelp">
<form action="<?php echo $admin_file; ?>.php" method="post">
<table align="center" border="0" cellpadding="4" cellspacing="4" width="100%" id="id-form">
<tr><th style="width:250px">غیر فعال کردن جعبه های تصاویر</th><td>بلی <input name="xptrue" type="radio" class="styled" value="1" <?php if(xpsetv(1)==1){ ?>checked<?php } ?>> &nbsp;&nbsp; خیر <input name="xptrue" type="radio" class="styled" value="0" <?php if(xpsetv(1)==0){ ?>checked<?php } ?>></td></tr>
<tr><th>فعال بودن اندازه دستی thump</th><td>بلی <input name="xpcustp" type="radio" class="styled" value="1" <?php if(xpsetv(3)==1){ ?>checked<?php } ?>> &nbsp;&nbsp; خیر <input name="xpcustp" type="radio" class="styled" value="0" <?php if(xpsetv(3)==0){ ?>checked<?php } ?>> - در صورت غیر فعال بودن اندازه بر اساس اندازه درخواستی قالب خواهد بود.</td></tr>
<tr><td>عرض تصویر thumb : </td><td><input name='xpwidth' value='<?php echo xpsetv(4); ?>' class="inp-form-ltr"></td></tr>
<tr><td>ارتفاع تصویر thumb : </td><td><input name='xpheight' value='<?php echo xpsetv(5); ?>' class="inp-form-ltr"></td></tr>
<tr><th>پوسته های جعبه نمایشی تصاویر</th><td><select name="xptemp" class="styledselect-select">
	<option value="default" titile="(باید تابع xp_theme در theme.php وجود داشته باشد)" <?php if(xpsetv(2)=="default"){ echo"selected"; } ?>>استفاده از تابع پوسته سایت </option>
<?php
		$handle=opendir("modules/XMoreOption/theme/Xpshpt/");
		while ($file = readdir($handle)) {
			if ( (!@ereg("[.]",$file)) ) {
				$themelist .= "$file ";
			}
		}
		closedir($handle);
		$themelist = explode(" ", $themelist);
		sort($themelist);
		for ($i=0; $i < sizeof($themelist); $i++) {
			if(!empty($themelist[$i])) {
				echo "	<option value='$themelist[$i]' "; if(xpsetv(2)==$themelist[$i]){ echo"selected"; } echo">$themelist[$i]</option>\n";
			}
		}
?>
</select></td></tr>
<tr><td><input class="form-submit" type='submit' value='ارسال'>
</td></tr>
<input type="hidden" name="xniniki" value="setting">
<input type="hidden" name="op" value="xmoreoption">
<input type="hidden" name="xset" value="xpshpt">
</table>
</form>
</div>
<div id="xlbfhelp">
<p>
	به نام خدا</p>
<p>راهنمای آپشن تصاویر برای نیوک</p>
<br><p style="font:bold 13px tahoma;">چگونه یک جعبه تصویر بسازم ؟</p>
<p>بعد از ورود به بخش مدیریت آپارات در تب ارسال جعبه تصویر ، فید ها پر کرده و بر submit کلیک کنید.</p>
<br><p style="font:bold 13px tahoma;">
	چگونه جعبه را نمایش دهم ؟</p>
<p>
	شما می توانید به صورت زیر در هر جای تابع themearticle جعبه را نمایش دهید.</p>
<p style="direction:ltr;text-align:left;"><pre style="direction:ltr;text-align:left;">&lt;?php require_once(&quot;XMO.lib.php&quot;); xp_theme($sid,&#39;News&#39;); ?&gt;</pre></p>
<br><p>به طور مثال در پوسته پیشفرض نیوک به صورت زیر عمل می کنیم :</p>
<p style="direction:ltr;text-align:left;"><pre style="direction:ltr;text-align:left;">function themearticle($aid, ... , $topic_link){
...
&lt;?php require_once(&quot;XMO.lib.php&quot;); xp_theme($sid,&#39;News&#39;); ?&gt;
}
</pre></p>
<p>به دلیل حجم زیاد کد ها با ... خلاصه شد.</p>
<br><p style="font:bold 13px tahoma;">
	چگونه جعبه با پوسته اختصاصی بسازم ؟</p>
<p>
	طراحان پوسته نیوک می توانند با ایجاد تابع xp_theme برای theme.php خود جعبه اختصاصی تعریف کنند.</p>
<p>
	همچنین می توانند به صورت مسقل به نشانی modules/XMoreOption/theme/xpshpt/ برای نیوک جعبه با پوسته مستقل بسازند.</p>
<br><p style="font:bold 13px tahoma;">چگونه از جعبه تصاویر عکس انتخاب کنم ؟</p>
<br><p>شما برای انتخاب یک تصویر از دیتا بیس جعبه تصاویر برای استفاده در هرجایی مانند فراخوانی تصاویر برای اسلادشو می توانید به روش زیر عمل کنید :</p>
<p style="direction:ltr;text-align:left;"><pre style="direction:ltr;text-align:left;">
require_once(&quot;XMO.lib.php&quot;);
echo xp_fpics(&quot;5&quot;,&quot;News&quot;,&quot;DESC&quot;,&quot;url&quot;); // your module item id, your module select, Sort[DESC,ASC], return[url,title]
</pre></p>
</div>
</div>
</div>
</div><?php
CloseAdminTable();
}
function xaparat() {
	global $prefix, $db, $admin_file, $dbname, $sitename, $xniniki, $xamod, $xamid, $xatag, $xaid, $xatrue, $xatemp, $xacanal, $xatitle;
OpenAdminTable();
$dfsdfsd = $db->sql_numrows($db->sql_query("SELECT *
FROM `" . $prefix . "_xaset`
LIMIT 0 , 3"));
if($dfsdfsd>0){}else{
$db->sql_query("CREATE TABLE IF NOT EXISTS `" . $prefix . "_xaparat` (
  `xaid` int(11) NOT NULL AUTO_INCREMENT,
  `xamid` int(11) NOT NULL,
  `xamod` text NOT NULL,
  `xatitle` text NOT NULL,
  `xatag` text NOT NULL,
  PRIMARY KEY (`xaid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");
$db->sql_query("CREATE TABLE IF NOT EXISTS `" . $prefix . "_xaset` (
  `xasid` int(11) NOT NULL AUTO_INCREMENT,
  `xasname` text NOT NULL,
  `xasvalue` text NOT NULL,
  PRIMARY KEY (`xasid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;");
$db->sql_query("INSERT INTO `" . $prefix . "_xaset` (`xasid`, `xasname`, `xasvalue`) VALUES
(1, 'xatrue', '0'),
(2, 'xatemp', 'Simple'),
(3, 'xacanel', 'none');");
massaggex("نصب آپشن آپارات با موفقیت انجام شد.");
}
if(isset($xniniki) AND $xniniki=="setting" AND isset($xatrue) AND isset($xatemp) AND isset($xacanal)){
xasetedit(1,$xatrue);
xasetedit(2,$xatemp);
xasetedit(3,$xacanal);
massaggex("تنظیمات اپارات بروز شد.");
}
if(isset($xniniki) AND $xniniki=="send" AND isset($xatag) AND isset($xamod) AND isset($xamid) AND isset($xatitle)){
if($xatag==""){
massagrex("تک آپارات حتما باید پر شود!!!");
}else{
$db->sql_query("INSERT INTO `$dbname`.`" . $prefix . "_xaparat` (
`xaid` ,
`xamid` ,
`xamod` ,
`xatitle` ,
`xatag`
)
VALUES (
NULL , '$xamid', '$xamod', '$xatitle', '$xatag'
);");
massaggex("جعبه آپارات با موفقیت ارسال شد.");
}
}
if(isset($xniniki) AND $xniniki=="edit" AND isset($xaid)){
$result = $db->sql_query("SELECT *
FROM `" . $prefix . "_xaparat`
WHERE `xaid` =$xaid
LIMIT 0 , 1");
	while ($row = $db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$xaid = intval($row['xaid']);
	$xamid = intval($row['xamid']);
	$xamod = $row['xamod'];
	$xatitle = $row['xatitle'];
	$xatag = $row['xatag'];
?><center><font class="title"><b>ویرایش جعبه آپارات</b></font></center><br>
<form action="<?php echo $admin_file; ?>.php" method="post">
<table align="center" border="0" cellpadding="4" cellspacing="4" width="100%" id="id-form">
<?php  xaitems($xatag,$xatitle,$xamid,$xamod); ?>
<tr><td><input class="form-submit" type='submit' value='ارسال'>
</td></tr>
<input type="hidden" name="xniniki" value="xedit">
<input type="hidden" name="xaid" value="<?php echo $xaid; ?>">
<input type="hidden" name="op" value="xmoreoption">
<input type="hidden" name="xset" value="xaparat">
</table>
</form>
<?php
die();
	}
}
if(isset($xniniki) AND $xniniki=="xedit" AND isset($xaid) AND isset($xatag) AND isset($xamod) AND isset($xamid) AND isset($xatitle)){
$db->sql_query("UPDATE `$dbname`.`" . $prefix . "_xaparat` SET `xamid` = '$xamid',
`xamod` = '$xamod',
`xatitle` = '$xatitle',
`xatag` = '$xatag' WHERE `" . $prefix . "_xaparat`.`xaid` =$xaid;");
massaggex("جعبه آپارات با موفقیت ویرایش شد.");
}
if($xniniki=="dele" AND isset($xaid)){
$db->sql_query("DELETE FROM `$dbname`.`" . $prefix . "_xaparat` WHERE `" . $prefix . "_xaparat`.`xaid` = $xaid");
massaggex("جعبه آپارات با موفقیت حذف شد.");
}
?>
<link rel="stylesheet" href="includes/Ajax/jquery/jquery.tabs.css" type="text/css" media="print, projection, screen" />
<script src="includes/Ajax/jquery/jquery.tabs.pack.js" type="text/javascript"></script>
<script type="text/javascript">
$(function() {
$('#container-4').tabs({ fxFade: true, fxSpeed: 'fast' });                              
});
</script>
<br><div class="Table">
<div class="Contents">
<div id="container-4">
<ul>
	<li><a href="#sendbox"><span>ارسال جعبه آپارت</span></a></li>
	<li><a href="#managbox"><span>مدیریت جعبه های آپارات</span></a></li>
	<li><a href="#xlbhelp"><span>مدیریت آپشن</span></a></li>
	<li><a href="#xlbfhelp"><span>راهنمای آپشن</span></a></li>
</ul>
<div id="sendbox">
<form action="<?php echo $admin_file; ?>.php" method="post">
<table align="center" border="0" cellpadding="4" cellspacing="4" width="100%" id="id-form">
<?php  xaitems("","","","News"); ?>
<tr><td><input class="form-submit" type='submit' value='ارسال'>
</td></tr>
<input type="hidden" name="xniniki" value="send">
<input type="hidden" name="op" value="xmoreoption">
<input type="hidden" name="xset" value="xaparat">
</table>
</form>
</div>
<div id="managbox">
<table id="product-table" border="0" width="100%"><tr>
<th class="table-header-repeat line-left" style="text-align:center;width:40px;"><a>شمارنده</a></th>
<th class="table-header-repeat line-left" style="text-align:center;"><a>برای ماژول</a></th>
<th class="table-header-repeat line-left" style="text-align:center;"><a>برای مطلب</a></th>
<th class="table-header-repeat line-left" style="text-align:center;"><a>عنوان</a></th>
<th class="table-header-repeat line-left" style="text-align:center;"><a>تگ آپارات</a></th>
<th class="table-header-repeat line-left" style="text-align:center;width:90px;"><a>امکانات</a></th>
</tr><?php
$result = $db->sql_query("SELECT *
FROM `" . $prefix . "_xaparat`
ORDER BY `" . $prefix . "_xaparat`.`xaid` DESC
LIMIT 0 , 99999");
	while ($row = $db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$xaid = intval($row['xaid']);
	$xamid = intval($row['xamid']);
	$xamod = $row['xamod'];
	$xatitle = $row['xatitle'];
	$xatag = $row['xatag'];
	?><tr>
<td align="center" width="40"><?php echo $xaid; ?></td>
<td align="center" width="auto"><?php echo $xamod; ?></td>
<td align="center" width="auto"><?php echo gettibyb($xamid, $xamod); ?></td>
<td align="center" width="auto"><?php echo $xatitle; ?></td>
<td align="center" width="auto"><a href="http://www.aparat.com/v/<?php echo $xatag; ?>"><?php echo $xatag; ?></a></td>
<td align="center" width="auto">
	<a href="<?php echo $admin_file; ?>.php?op=xmoreoption&xset=xaparat&xniniki=dele&xaid=<?php echo $xaid ; ?>" title="حذف آیتم" class="icon-2 info-tooltip"></a>
	<a href="<?php echo $admin_file; ?>.php?op=xmoreoption&xset=xaparat&xniniki=edit&xaid=<?php echo $xaid ; ?>" title="ویرایش آیتم" class="icon-6 info-tooltip"></a>
</td><?php } ?>
</tr></table>
</div>
<div id="xlbhelp">
<form action="<?php echo $admin_file; ?>.php" method="post">
<table align="center" border="0" cellpadding="4" cellspacing="4" width="100%" id="id-form">
<tr><th style="width:250px">غیر فعال کردن جعبه های آپارات</th><td>بلی <input name="xatrue" type="radio" class="styled" value="1" <?php if(xasetv(1)==1){ ?>checked<?php } ?>> &nbsp;&nbsp; خیر <input name="xatrue" type="radio" class="styled" value="0" <?php if(xasetv(1)==0){ ?>checked<?php } ?>></td></tr>
<tr><td>کانال آپارات شما : </td><td><input name='xacanal' value='<?php echo xasetv(3); ?>' class="inp-form-ltr"></td></tr>
<tr><th>پوسته های جعبه نمایشی آپارات</th><td><select name="xatemp" class="styledselect-select">
	<option value="default" titile="(باید تابع xa_theme در theme.php وجود داشته باشد)" <?php if(xasetv(2)=="default"){ echo"selected"; } ?>>استفاده از تابع پوسته سایت </option>
<?php
		$handle=opendir("modules/XMoreOption/theme/Xaparat/");
		while ($file = readdir($handle)) {
			if ( (!@ereg("[.]",$file)) ) {
				$themelist .= "$file ";
			}
		}
		closedir($handle);
		$themelist = explode(" ", $themelist);
		sort($themelist);
		for ($i=0; $i < sizeof($themelist); $i++) {
			if(!empty($themelist[$i])) {
				echo "	<option value='$themelist[$i]' "; if(xasetv(2)==$themelist[$i]){ echo"selected"; } echo">$themelist[$i]</option>\n";
			}
		}
?>
</select></td></tr>
<tr><td><input class="form-submit" type='submit' value='ارسال'>
</td></tr>
<input type="hidden" name="xniniki" value="setting">
<input type="hidden" name="op" value="xmoreoption">
<input type="hidden" name="xset" value="xaparat">
</table>
</form>
</div>
<div id="xlbfhelp">
<p>
	به نام خدا</p>
<p>راهنمای آپشن آپارات برای نیوک</p>
<br><p style="font:bold 13px tahoma;">تگ آپارات چیست؟</p>
<p>اگر لینک ویدئو شما به صورت زیر باشد : </p>
<p style="direction:ltr;text-align:left;"><pre style="direction:ltr;text-align:left;">http://www.aparat.com/v/CF4Mb</pre></p>
<p>تگ آپارات ویدئو شما CF4Mb خواهد بود.</p>
<br><p style="font:bold 13px tahoma;">چگونه یک جعبه آپارات بسازم ؟</p>
<p>بعد از ورود به بخش مدیریت آپارات در تب ارسال جعبه اپارات ، فید ها پر کرده و بر submit کلیک کنید.</p>
<br><p style="font:bold 13px tahoma;">
	چگونه جعبه را نمایش دهم ؟</p>
<p>
	شما می توانید به صورت زیر در هر جای تابع themearticle جعبه را نمایش دهید.</p>
<p style="direction:ltr;text-align:left;"><pre style="direction:ltr;text-align:left;">&lt;?php require_once(&quot;XMO.lib.php&quot;); xa_theme($sid,&#39;News&#39;); ?&gt;</pre></p>
<br><p>به طور مثال در پوسته پیشفرض نیوک به صورت زیر عمل می کنیم :</p>
<p style="direction:ltr;text-align:left;"><pre style="direction:ltr;text-align:left;">function themearticle($aid, ... , $topic_link){
...
&lt;?php require_once(&quot;XMO.lib.php&quot;); xa_theme($sid,&#39;News&#39;); ?&gt;
}
</pre></p>
<p>به دلیل حجم زیاد کد ها با ... خلاصه شد.</p>
<br><p style="font:bold 13px tahoma;">
	چگونه جعبه با پوسته اختصاصی بسازم ؟</p>
<p>
	طراحان پوسته نیوک می توانند با ایجاد تابع xa_theme برای theme.php خود جعبه اختصاصی تعریف کنند.</p>
<p>
	همچنین می توانند به صورت مسقل به نشانی modules/XMoreOption/theme/Xaparat/ برای نیوک جعبه با پوسته مستقل بسازند.</p>
</div>
</div>
</div>
</div><?php
CloseAdminTable();
}
function xsound() {
	global $prefix, $db, $admin_file, $dbname, $sitename, $xniniki, $xsmod, $xsmid, $xstag, $xsid, $xstrue, $xstemp, $xstitle;
OpenAdminTable();
$dfsdfsd = $db->sql_numrows($db->sql_query("SELECT *
FROM `" . $prefix . "_xsset`
LIMIT 0 , 3"));
if($dfsdfsd>0){}else{
$db->sql_query("CREATE TABLE IF NOT EXISTS `" . $prefix . "_xsound` (
  `xsid` int(11) NOT NULL AUTO_INCREMENT,
  `xsmid` int(11) NOT NULL,
  `xsmod` text NOT NULL,
  `xstitle` text NOT NULL,
  `xstag` text NOT NULL,
  PRIMARY KEY (`xsid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");
$db->sql_query("CREATE TABLE IF NOT EXISTS `" . $prefix . "_xsset` (
  `xssid` int(11) NOT NULL AUTO_INCREMENT,
  `xssname` text NOT NULL,
  `xssvalue` text NOT NULL,
  PRIMARY KEY (`xssid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;");
$db->sql_query("INSERT INTO `" . $prefix . "_xsset` (`xssid`, `xssname`, `xssvalue`) VALUES
(1, 'xstrue', '0'),
(2, 'xstemp', 'Simple');");
massaggex("نصب آپشن صوت با موفقیت انجام شد.");
}
if(isset($xniniki) AND $xniniki=="setting" AND isset($xstrue) AND isset($xstemp)){
xssetedit(1,$xstrue);
xssetedit(2,$xstemp);
massaggex("تنظیمات صوت بروز شد.");
}
if(isset($xniniki) AND $xniniki=="send" AND isset($xstag) AND isset($xsmod) AND isset($xsmid) AND isset($xstitle)){
if($xstag==""){
massagrex("آدرس فایل صوتی حتما باید پر شود.");
}else{
$db->sql_query("INSERT INTO `$dbname`.`" . $prefix . "_xsound` (
`xsid` ,
`xsmid` ,
`xsmod` ,
`xstitle` ,
`xstag`
)
VALUES (
NULL , '$xsmid', '$xsmod', '$xstitle', '$xstag'
);");
massaggex("جعبه صوت با موفقیت ارسال شد.");
}
}
if(isset($xniniki) AND $xniniki=="edit" AND isset($xsid)){
$result = $db->sql_query("SELECT *
FROM `" . $prefix . "_xsound`
WHERE `xsid` =$xsid
LIMIT 0 , 1");
	while ($row = $db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$xsid = intval($row['xsid']);
	$xsmid = intval($row['xsmid']);
	$xsmod = $row['xsmod'];
	$xstitle = $row['xstitle'];
	$xstag = $row['xstag'];
?><center><font class="title"><b>ویرایش جعبه صوت</b></font></center><br>
<form action="<?php echo $admin_file; ?>.php" method="post">
<table align="center" border="0" cellpadding="4" cellspacing="4" width="100%" id="id-form">
<?php  xsitems($xstag,$xstitle,$xsmid,$xsmod); ?>
<tr><td><input class="form-submit" type='submit' value='ارسال'>
</td></tr>
<input type="hidden" name="xniniki" value="xedit">
<input type="hidden" name="xsid" value="<?php echo $xsid; ?>">
<input type="hidden" name="op" value="xmoreoption">
<input type="hidden" name="xset" value="xsound">
</table>
</form>
<?php
die();
	}
}
if(isset($xniniki) AND $xniniki=="xedit" AND isset($xsid) AND isset($xstag) AND isset($xsmod) AND isset($xsmid) AND isset($xstitle)){
$db->sql_query("UPDATE `$dbname`.`" . $prefix . "_xsound` SET `xsmid` = '$xsmid',
`xsmod` = '$xsmod',
`xstitle` = '$xstitle',
`xstag` = '$xstag' WHERE `" . $prefix . "_xsound`.`xsid` =$xsid;");
massaggex("جعبه صوت با موفقیت ویرایش شد.");
}
if($xniniki=="dele" AND isset($xsid)){
$db->sql_query("DELETE FROM `$dbname`.`" . $prefix . "_xsound` WHERE `" . $prefix . "_xsound`.`xsid` = $xsid");
massaggex("جعبه صوت با موفقیت حذف شد.");
}
?>
<link rel="stylesheet" href="includes/Ajax/jquery/jquery.tabs.css" type="text/css" media="print, projection, screen" />
<script src="includes/Ajax/jquery/jquery.tabs.pack.js" type="text/javascript"></script>
<script type="text/javascript">
$(function() {
$('#container-4').tabs({ fxFade: true, fxSpeed: 'fast' });                              
});
</script>
<br><div class="Table">
<div class="Contents">
<div id="container-4">
<ul>
	<li><a href="#sendbox"><span>ارسال جعبه صوت</span></a></li>
	<li><a href="#managbox"><span>مدیریت جعبه های صوت</span></a></li>
	<li><a href="#xlbhelp"><span>مدیریت آپشن</span></a></li>
	<li><a href="#xlbfhelp"><span>راهنمای آپشن</span></a></li>
</ul>
<div id="sendbox">
<form action="<?php echo $admin_file; ?>.php" method="post">
<table align="center" border="0" cellpadding="4" cellspacing="4" width="100%" id="id-form">
<?php  xsitems("","","","News"); ?>
<tr><td><input class="form-submit" type='submit' value='ارسال'>
</td></tr>
<input type="hidden" name="xniniki" value="send">
<input type="hidden" name="op" value="xmoreoption">
<input type="hidden" name="xset" value="xsound">
</table>
</form>
</div>
<div id="managbox">
<table id="product-table" border="0" width="100%"><tr>
<th class="table-header-repeat line-left" style="text-align:center;width:40px;"><a>شمارنده</a></th>
<th class="table-header-repeat line-left" style="text-align:center;"><a>برای ماژول</a></th>
<th class="table-header-repeat line-left" style="text-align:center;"><a>برای مطلب</a></th>
<th class="table-header-repeat line-left" style="text-align:center;"><a>عنوان</a></th>
<th class="table-header-repeat line-left" style="text-align:center;"><a>تگ صوت</a></th>
<th class="table-header-repeat line-left" style="text-align:center;width:90px;"><a>امکانات</a></th>
</tr><?php
$result = $db->sql_query("SELECT *
FROM `" . $prefix . "_xsound`
ORDER BY `" . $prefix . "_xsound`.`xsid` DESC
LIMIT 0 , 99999");
	while ($row = $db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$xsid = intval($row['xsid']);
	$xsmid = intval($row['xsmid']);
	$xsmod = $row['xsmod'];
	$xstitle = $row['xstitle'];
	$xstag = $row['xstag'];
	?><tr>
<td align="center" width="40"><?php echo $xsid; ?></td>
<td align="center" width="auto"><?php echo $xsmod; ?></td>
<td align="center" width="auto"><?php echo gettibyb($xsmid, $xsmod); ?></td>
<td align="center" width="auto"><?php echo $xstitle; ?></td>
<td align="center" width="auto"><a href="<?php echo $xstag; ?>"><?php echo $xstag; ?></a></td>
<td align="center" width="auto">
	<a href="<?php echo $admin_file; ?>.php?op=xmoreoption&xset=xsound&xniniki=dele&xsid=<?php echo $xsid ; ?>" title="حذف آیتم" class="icon-2 info-tooltip"></a>
	<a href="<?php echo $admin_file; ?>.php?op=xmoreoption&xset=xsound&xniniki=edit&xsid=<?php echo $xsid ; ?>" title="ویرایش آیتم" class="icon-6 info-tooltip"></a>
</td><?php } ?>
</tr></table>
</div>
<div id="xlbhelp">
<form action="<?php echo $admin_file; ?>.php" method="post">
<table align="center" border="0" cellpadding="4" cellspacing="4" width="100%" id="id-form">
<tr><th style="width:250px">غیر فعال کردن جعبه های صوت</th><td>بلی <input name="xstrue" type="radio" class="styled" value="1" <?php if(xssetv(1)==1){ ?>checked<?php } ?>> &nbsp;&nbsp; خیر <input name="xstrue" type="radio" class="styled" value="0" <?php if(xssetv(1)==0){ ?>checked<?php } ?>></td></tr>
<tr><th>پوسته های جعبه نمایشی صوت</th><td><select name="xstemp" class="styledselect-select">
	<option value="default" titile="(باید تابع xs_theme در theme.php وجود داشته باشد)" <?php if(xssetv(2)=="default"){ echo"selected"; } ?>>استفاده از تابع پوسته سایت </option>
<?php
		$handle=opendir("modules/XMoreOption/theme/Xsound/");
		while ($file = readdir($handle)) {
			if ( (!@ereg("[.]",$file)) ) {
				$themelist .= "$file ";
			}
		}
		closedir($handle);
		$themelist = explode(" ", $themelist);
		sort($themelist);
		for ($i=0; $i < sizeof($themelist); $i++) {
			if(!empty($themelist[$i])) {
				echo "	<option value='$themelist[$i]' "; if(xssetv(2)==$themelist[$i]){ echo"selected"; } echo">$themelist[$i]</option>\n";
			}
		}
?>
</select></td></tr>
<tr><td><input class="form-submit" type='submit' value='ارسال'>
</td></tr>
<input type="hidden" name="xniniki" value="setting">
<input type="hidden" name="op" value="xmoreoption">
<input type="hidden" name="xset" value="xsound">
</table>
</form>
</div>
<div id="xlbfhelp">
<p>
	به نام خدا</p>
<p>راهنمای آپشن صوت برای نیوک</p>
<br><p style="font:bold 13px tahoma;">چگونه یک جعبه صوت بسازم ؟</p>
<p>بعد از ورود به بخش مدیریت صوت در تب ارسال جعبه صوت ، فید ها پر کرده و بر submit کلیک کنید.</p>
<br><p style="font:bold 13px tahoma;">
	چگونه جعبه را نمایش دهم ؟</p>
<p>
	شما می توانید به صورت زیر در هر جای تابع themearticle جعبه را نمایش دهید.</p>
<p style="direction:ltr;text-align:left;"><pre style="direction:ltr;text-align:left;">&lt;?php require_once(&quot;XMO.lib.php&quot;); xs_theme($sid,&#39;News&#39;); ?&gt;</pre></p>
<br><p>به طور مثال در پوسته پیشفرض نیوک به صورت زیر عمل می کنیم :</p>
<p style="direction:ltr;text-align:left;"><pre style="direction:ltr;text-align:left;">function themearticle($aid, ... , $topic_link){
...
&lt;?php require_once(&quot;XMO.lib.php&quot;); xs_theme($sid,&#39;News&#39;); ?&gt;
}
</pre></p>
<p>به دلیل حجم زیاد کد ها با ... خلاصه شد.</p>
<br><p style="font:bold 13px tahoma;">
	چگونه جعبه با پوسته اختصاصی بسازم ؟</p>
<p>
	طراحان پوسته نیوک می توانند با ایجاد تابع xs_theme برای theme.php خود جعبه اختصاصی تعریف کنند.</p>
<p>
	همچنین می توانند به صورت مسقل به نشانی modules/XMoreOption/theme/Xsound/ برای نیوک جعبه با پوسته مستقل بسازند.</p>
</div>
</div>
</div>
</div><?php
CloseAdminTable();
}
function xlinksbox() {
	global $prefix, $db, $admin_file, $dbname, $sitename, $xlbdlgra, $xlbhelpmorei, $xlbdlpass, $xlbdptrue, $xniniki, $xlbid, $xlbmod, $xlbmid, $xlbti, $xlbdl, $xlbmrdl, $xlbmb, $xlbmd, $xlbdolar, $xlbgemu, $xlbscsh, $xlbup, $xlbref, $xlbpw, $xlbtrue, $xlbview, $xlbtemp;
OpenAdminTable();
$dfsdfsd = $db->sql_numrows($db->sql_query("SELECT *
FROM `" . $prefix . "_xlbset`
LIMIT 0 , 7"));
if($dfsdfsd>0){
if($dfsdfsd==6){
$xlbimporthelping="<ul>
	<li>برای دانلود، به روی عبارت \"دانلود\" کلیک کنید و منتظر بمانید تا پنجره مربوطه ظاهر شود سپس محل ذخیره شدن فایل را انتخاب کنید و منتظر بمانید تا دانلود تمام شود.</li>
	<li>اگر نرم افزار مدیریت دانلود ندارید، پیشنهاد می شود برای دانلود فایل ها حتماً از یک نرم افزار مدیریت دانلود و مخصوصاً <a href=\"http://p30download.com/fa/entry/566/\" target=\"_blank\"><b>FlashGet</b></a> استفاده کنید.</li>
	<li>چنانچه قادر به دانلود از سرور دانلود مستقیم نیستید، از لینک های کمکی استفاده کنید.<br /><i>( لینک کمکی چیست؟ لینک کمکی، یک کپی مشابه از فایل است که بر روی یک سایت دیگر جهت دانلود قرار داده می شود و در مواقعی که یک سرور قادر به سرویس دهی نباشد شما می توانید فایل مورد نظر خود را از یک سرور دیگر دانلود نمائید)</i></li>
	<li>فایل های قرار داده شده برای دانلود به منظور کاهش حجم و دریافت سریعتر فشرده شده اند، برای خارج سازی فایل ها از حالت فشرده از نرم افزار <a href=\"http://p30download.com/fa/entry/268/\" target=\"_blank\"><b>Winrar</b></a> و یا مشابه آن استفاده کنید.</li>
	<li>چنانچه در هنگام خارج سازی فایل از حالت فشرده با پیغام <b>CRC</b> مواجه شدید، در صورتی که کلمه رمز را درست وارد کرده باشید. فایل به صورت خراب دانلود شده است و می بایستی مجدداً آن را دانلود کنید.</li>
	<li>فایل های کرک به دلیل ماهیت عملکرد در هنگام استفاده ممکن است توسط آنتی ویروس ها به عنوان فایل خطرناک شناسایی شوند در این گونه مواقع به صورت موقت آنتی ویروس خود را غیر فعال کنید.</li>
</ul>";
$db->sql_query("INSERT INTO `$dbname`.`" . $prefix . "_xlbset` (`xlb`, `xlbname`, `xlbvalue`) VALUES (7, 'xlbmorehelp', '$xlbimporthelping');");
massaggex("جعبه دانلود با موفقیت آپدیت شد.");
}
}else{
$db->sql_query("CREATE TABLE IF NOT EXISTS `" . $prefix . "_xlbset` (
  `xlb` int(11) NOT NULL AUTO_INCREMENT,
  `xlbname` text NOT NULL,
  `xlbvalue` text NOT NULL,
  PRIMARY KEY (`xlb`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;");
$db->sql_query("INSERT INTO `" . $prefix . "_xlbset` (`xlb`, `xlbname`, `xlbvalue`) VALUES
(1, 'xlbtrue', '0'),
(2, 'xlbvo', '1'),
(3, 'xlbtheme', 'Simple'),
(4, 'xlbdptrue', '1'),
(6, 'directdl', '0'),
(5, 'xlbdlpass', 'Arshen');");
$db->sql_query("CREATE TABLE IF NOT EXISTS `" . $prefix . "_xlinksbox` (
  `xlbid` int(11) NOT NULL AUTO_INCREMENT,
  `xlbmid` int(11) NOT NULL,
  `xlbvi` int(11) NOT NULL,
  `xlbmod` text NOT NULL,
  `xlbti` text NOT NULL,
  `xlbdl` text NOT NULL,
  `xlbmrdl` text NOT NULL,
  `xlbmb` text NOT NULL,
  `xlbmd` text NOT NULL,
  `xlbdolar` text NOT NULL,
  `xlbgemu` text NOT NULL,
  `xlbscsh` text NOT NULL,
  `xlbup` text NOT NULL,
  `xlbref` text NOT NULL,
  `xlbpw` text NOT NULL,
  PRIMARY KEY (`xlbid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");
massaggex("نصب آپشن جعبه دانلود با موفقیت انجام شد.");
}
if($xniniki=="send" AND isset($xlbmod) AND isset($xlbmid) AND isset($xlbti) AND isset($xlbdl) AND isset($xlbmrdl) AND isset($xlbmb) AND isset($xlbmd) AND isset($xlbdolar) AND isset($xlbgemu) AND isset($xlbscsh) AND isset($xlbup) AND isset($xlbref) AND isset($xlbpw)){
$db->sql_query("INSERT INTO `$dbname`.`" . $prefix . "_xlinksbox` (
`xlbid` ,
`xlbmid` ,
`xlbvi` ,
`xlbmod` ,
`xlbti` ,
`xlbdl` ,
`xlbmrdl` ,
`xlbmb` ,
`xlbmd` ,
`xlbdolar` ,
`xlbgemu` ,
`xlbscsh` ,
`xlbup` ,
`xlbref` ,
`xlbpw`
)
VALUES (
NULL , '$xlbmid', '0', '$xlbmod', '$xlbti', '$xlbdl', '$xlbmrdl', '$xlbmb', '$xlbmd', '$xlbdolar', '$xlbgemu', '$xlbscsh', '$xlbup', '$xlbref', '$xlbpw'
);");
massaggex("جعبه با موفقیت ارسال شد.");
}
if($xniniki=="setting" AND isset($xlbtrue) AND isset($xlbview) AND isset($xlbtemp) AND isset($xlbdlpass) AND isset($xlbdptrue) AND isset($xlbdlgra) AND isset($xlbhelpmorei)){
xlbsetedit(1,$xlbtrue);
xlbsetedit(2,$xlbview);
xlbsetedit(3,$xlbtemp);
xlbsetedit(4,$xlbdptrue);
xlbsetedit(5,$xlbdlpass);
xlbsetedit(6,$xlbdlgra);
xlbsetedit(7,$xlbhelpmorei);
massaggex("تغییرات با موفقیت ویرایش شد.");
}
if($xniniki=="xedit" AND isset($xlbid)){
$db->sql_query("UPDATE `$dbname`.`" . $prefix . "_xlinksbox` SET `xlbmid` = '$xlbmid',
`xlbmod` = '$xlbmod',
`xlbti` = '$xlbti',
`xlbdl` = '$xlbdl',
`xlbmrdl` = '$xlbmrdl',
`xlbmb` = '$xlbmb',
`xlbmd` = '$xlbmd',
`xlbdolar` = '$xlbdolar',
`xlbgemu` = '$xlbgemu',
`xlbscsh` = '$xlbscsh',
`xlbup` = '$xlbup',
`xlbref` = '$xlbref',
`xlbpw` = '$xlbpw' WHERE `" . $prefix . "_xlinksbox`.`xlbid` =$xlbid;");
massaggex("جعبه با موفقیت ویرایش شد.");
}
if($xniniki=="edit" AND isset($xlbid)){
$result = $db->sql_query("SELECT *
FROM `" . $prefix . "_xlinksbox`
WHERE `xlbid` =$xlbid
LIMIT 0 , 1");
	while ($row = $db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
$xlbid= $row['xlbid'];
$xlbmod= $row['xlbmod'];
$xlbmid= $row['xlbmid'];
$xlbti= $row['xlbti'];
$xlbdl= $row['xlbdl'];
$xlbmrdl= $row['xlbmrdl'];
$xlbmb= $row['xlbmb'];
$xlbmd= $row['xlbmd'];
$xlbdolar= $row['xlbdolar'];
$xlbgemu= $row['xlbgemu'];
$xlbscsh= $row['xlbscsh'];
$xlbup= $row['xlbup'];
$xlbref= $row['xlbref'];
$xlbpw= $row['xlbpw'];
	}
?><center><font class="title"><b>ویرایش جعبه لینک مطالب</b></font></center><br>
<form action="<?php echo $admin_file; ?>.php" method="post">
<table align="center" border="0" cellpadding="4" cellspacing="4" width="100%" id="id-form">
<?php  xlbitems($xlbti,$xlbdl,$xlbmrdl,$xlbmb,$xlbmd,$xlbdolar,$xlbgemu,$xlbscsh,$xlbup,$xlbref,$xlbpw,$xlbmid,$xlbmod); ?>
<tr><td><input class="form-submit" type='submit' value='ارسال'>
</td></tr>
<input type="hidden" name="xniniki" value="xedit">
<input type="hidden" name="xlbid" value="<?php echo $xlbid; ?>">
<input type="hidden" name="op" value="xmoreoption">
<input type="hidden" name="xset" value="xlinksbox">
</table>
</form>
<?php
die();
}
if($xniniki=="dele" AND isset($xlbid)){
$db->sql_query("DELETE FROM `$dbname`.`" . $prefix . "_xlinksbox` WHERE `" . $prefix . "_xlinksbox`.`xlbid` = $xlbid");
massaggex("جعبه با موفقیت حذف شد.");
}
?>
<link rel="stylesheet" href="includes/Ajax/jquery/jquery.tabs.css" type="text/css" media="print, projection, screen" />
<script src="includes/Ajax/jquery/jquery.tabs.pack.js" type="text/javascript"></script>
<script type="text/javascript">
$(function() {
$('#container-4').tabs({ fxFade: true, fxSpeed: 'fast' });                              
});
</script>
<br><div class="Table">
<div class="Contents">
<div id="container-4">
<ul>
	<li><a href="#sendbox"><span>ارسال جعبه</span></a></li>
	<li><a href="#managbox"><span>مدیریت جعبه ها</span></a></li>
	<li><a href="#xlbhelp"><span>مدیریت آپشن</span></a></li>
	<li><a href="#xlbfhelp"><span>راهنمای آپشن</span></a></li>
</ul>
<div id="sendbox">
<form action="<?php echo $admin_file; ?>.php" method="post">
<table align="center" border="0" cellpadding="4" cellspacing="4" width="100%" id="id-form">
<?php  xlbitems("","","","","","","","","","","","","News"); ?>
<tr><td><input class="form-submit" type='submit' value='ارسال'>
</td></tr>
<input type="hidden" name="xniniki" value="send">
<input type="hidden" name="op" value="xmoreoption">
<input type="hidden" name="xset" value="xlinksbox">
</table>
</form>
</div>
<div id="managbox">
<table id="product-table" border="0" width="100%"><tr>
<th class="table-header-repeat line-left" style="text-align:center;width:40px;"><a>شمارنده</a></th>
<th class="table-header-repeat line-left" style="text-align:center;"><a>عنوان لینک</a></th>
<th class="table-header-repeat line-left" style="text-align:center;"><a>در مطلب</a></th>
<th class="table-header-repeat line-left" style="text-align:center;"><a>در ماژول</a></th>
<th class="table-header-repeat line-left" style="text-align:center;width:90px;"><a>آمار دانلود</a></th>
<th class="table-header-repeat line-left" style="text-align:center;width:90px;"><a>امکانات</a></th>
</tr><?php
$result = $db->sql_query("SELECT *
FROM `" . $prefix . "_xlinksbox`
ORDER BY `" . $prefix . "_xlinksbox`.`xlbid` DESC
LIMIT 0 , 99999");
	while ($row = $db->sql_fetchrow($result)) {
	mb_internal_encoding('UTF-8');
	$xlbmid = intval($row['xlbmid']);
	$xlbid = intval($row['xlbid']);
	$xlbmod = $row['xlbmod'];
	$xlbti = $row['xlbti'];
	$xlbdl = $row['xlbdl'];
	$xlbvi = $row['xlbvi'];
	?><tr>
<td align="center" width="40"><?php echo $xlbid; ?></td>
<td align="center" width="auto"><a href="<?php echo $xlbdl; ?>"><?php echo $xlbti; ?></a></td>
<td align="center" width="auto"><?php echo gettibyb($xlbmid, $xlbmod); ?></td>
<td align="center" width="auto"><?php echo $xlbmod; ?></td>
<td align="center" width="auto"><?php echo $xlbvi; ?></td>
<td align="center" width="auto">
	<a href="<?php echo $admin_file; ?>.php?op=xmoreoption&xset=xlinksbox&xniniki=dele&xlbid=<?php echo $xlbid ; ?>" title="حذف منو" class="icon-2 info-tooltip"></a>
	<a href="<?php echo $admin_file; ?>.php?op=xmoreoption&xset=xlinksbox&xniniki=edit&xlbid=<?php echo $xlbid ; ?>" title="ویرایش منو" class="icon-6 info-tooltip"></a>
</td><?php } ?>
</tr></table>
</div>
<div id="xlbhelp">
<form action="<?php echo $admin_file; ?>.php" method="post">
<table align="center" border="0" cellpadding="4" cellspacing="4" width="100%" id="id-form">
<tr><th style="width:250px">غیر فعال کردن جعبه ها</th><td>بلی <input name="xlbtrue" type="radio" class="styled" value="1" <?php if(xlbsetv(1)==1){ ?>checked<?php } ?>> &nbsp;&nbsp; خیر <input name="xlbtrue" type="radio" class="styled" value="0" <?php if(xlbsetv(1)==0){ ?>checked<?php } ?>></td></tr>
<tr><th>نمایش آمار دانلود</th><td>بلی <input name="xlbview" type="radio" class="styled" value="1" <?php if(xlbsetv(2)==1){ ?>checked<?php } ?>> &nbsp;&nbsp; خیر <input name="xlbview" type="radio" class="styled" value="0" <?php if(xlbsetv(2)==0){ ?>checked<?php } ?>></td></tr>
<tr><th>استفاده از تابع header()</th><td>بلی <input name="xlbdlgra" type="radio" class="styled" value="1" <?php if(xlbsetv(6)==1){ ?>checked<?php } ?>> &nbsp;&nbsp; خیر <input name="xlbdlgra" type="radio" class="styled" value="0" <?php if(xlbsetv(6)==0){ ?>checked<?php } ?>></td></tr>
<tr><th>فعال بودن رمز برای دانلود</th><td>بلی <input name="xlbdptrue" type="radio" class="styled" value="1" <?php if(xlbsetv(4)==1){ ?>checked<?php } ?>> &nbsp;&nbsp; خیر <input name="xlbdptrue" type="radio" class="styled" value="0" <?php if(xlbsetv(4)==0){ ?>checked<?php } ?>></td></tr>
<tr><td>رمز برای دانلود : </td><td><input name='xlbdlpass' value='<?php echo xlbsetv(5); ?>' class="inp-form-ltr"></td></tr>
<tr><th>پوسته جعبه ها</th><td><select name="xlbtemp" class="styledselect-select">
	<option value="default" titile="(باید تابع xlb_theme در theme.php وجود داشته باشد)" <?php if(xlbsetv(3)=="default"){ echo"selected"; } ?>>استفاده از تابع پوسته سایت </option>
<?php
		$handle=opendir("modules/XMoreOption/theme/XlinksBox/");
		while ($file = readdir($handle)) {
			if ( (!@ereg("[.]",$file)) ) {
				$themelist .= "$file ";
			}
		}
		closedir($handle);
		$themelist = explode(" ", $themelist);
		sort($themelist);
		for ($i=0; $i < sizeof($themelist); $i++) {
			if(!empty($themelist[$i])) {
				echo "	<option value='$themelist[$i]' "; if(xlbsetv(3)==$themelist[$i]){ echo"selected"; } echo">$themelist[$i]</option>\n";
			}
		}
?>
</select></td></tr>
<tr><th>متن راهنمای دانلود : </th><td><?php wysiwyg_textarea('xlbhelpmorei',xlbsetv(7), 'Comments', 50, 15); ?></td></tr>
<tr><td><input class="form-submit" type='submit' value='ارسال'>
</td></tr>
<input type="hidden" name="xniniki" value="setting">
<input type="hidden" name="op" value="xmoreoption">
<input type="hidden" name="xset" value="xlinksbox">
</table>
</form>
</div>
<div id="xlbfhelp">
<p>به نام خدا</p>
<p>راهنمای آپشن جعبه دانلود</p>
<br><p style="font:bold 13px tahoma;">
	چگونه یک جعبه بسازم ؟</p>
<p>
	بعد ورود به مدیریت ماژول XlinksBox در اولین تب ، امکان تعریف جعبه برای کاربران فراهم شده است و شما می توانید بعد پر کردن فیدها با زدن دکمه submit جعبه را ارسال کنید.</p>
<br><p style="font:bold 13px tahoma;">
	چگونه بعضی از فید ها را تعریف نکنم ؟</p>
<p>
	برای این امر ، کافیست فید های مربوطه را خالی بگذارید.</p>
<br><p style="font:bold 13px tahoma;">
	چگونه چند فایل را در یک جعبه قرار دهم ؟</p>
<p>
	شما بعد ارسال فایل اول ، کافیست با پر کردن فید های جعبه برای ماژول ، جعبه برای مطلب ، عنوان فایل ، لینک دانلود ، لینک کمکی ، حجم فایل ، فایل دوم را در جعبه مربوطه قرار دهید.</p>
<br><p style="font:bold 13px tahoma;">
	چگونه جعبه را نمایش دهم ؟</p>
<p>
	شما می توانید به صورت زیر در هر جای تابع themearticle جعبه را نمایش دهید.</p>
<p style="direction:ltr;text-align:left;"><pre style="direction:ltr;text-align:left;">&lt;?php require_once(&quot;XMO.lib.php&quot;); xlb_theme($sid,&#39;News&#39;); ?&gt;</pre></p>
<br><p>به طور مثال در پوسته پیشفرض نیوک به صورت زیر عمل می کنیم :</p>
<p style="direction:ltr;text-align:left;"><pre style="direction:ltr;text-align:left;">
function themearticle($aid, ... , $topic_link){
...
&lt;?php require_once(&quot;XMO.lib.php&quot;); xlb_theme($sid,&#39;News&#39;); ?&gt;
}
</pre></p>
<p>به دلیل حجم زیاد کد ها با ... خلاصه شد.</p>
<br><p style="font:bold 13px tahoma;">
	چگونه جعبه با پوسته اختصاصی بسازم ؟</p>
<p>
	طراحان پوسته نیوک می توانند با ایجاد تابع xlb_theme برای theme.php خود جعبه اختصاصی تعریف کنند.</p>
<p>
	همچنین می توانند به صورت مسقل به نشانی modules/XMoreOption/theme/XlinksBox/ برای نیوک جعبه با پوسته مستقل بسازند.</p>
<br><p style="font:bold 13px tahoma;">
	موقع کلیک بر روی دانلود ، ارور 404 می دهد ؟</p>
<p>
	کد های زیر را در انتهای فایل .htaccess قرار دهید.</p>
<p style="direction:ltr;text-align:left;"><pre style="direction:ltr;text-align:left;">#XlinksBox
RewriteRule ^XMoreOption/XlinksBox/Download/([0-9]*)/ modules.php?name=XMoreOption&xset=XlinksBox&com=xlbdl&xlbid=$1
RewriteRule ^XMoreOption/XlinksBox/Download/Mirror/([0-9]*)/ modules.php?name=XMoreOption&xset=XlinksBox&com=xlbmdl&xlbid=$1
RewriteRule ^XMoreOption/XlinksBox/ScreenShot/([0-9]*)/ modules.php?name=XMoreOption&xset=XlinksBox&com=xlbsc&xlbid=$1
RewriteRule ^XMoreOption/XlinksBox/ modules.php?name=XMoreOption&xset=XlinksBox</pre></p>
</div>
</div>
</div>
</div><?php
CloseAdminTable();
}
switch ($op){
		default:
		xmoreoption();
		break;
}
} else {
  include("header.php");
  GraphicAdmin();
  OpenAdminTable();
  echo "<center><b>"._ERROR."</b><br><br>You do not have administration permission for module \"$module_name\"</center>";
  CloseAdminTable();
  include("footer.php");
}

?>