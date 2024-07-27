<?php

include_once("../php/db.php");

$userid = $_POST['userid'];
$userpw = password_hash($_POST['userpw'], PASSWORD_DEFAULT);
$username = $_POST['name'];
$email = $_POST['email'];

$id_check = myquery("select * from idtable where userid='$userid'");
	$id_check = $id_check->fetch_array();
	if($id_check >= 1){?>
	<script type="text/javascript">alert('아이디가 중복됩니다.'); history.back();</script>
<?php }else{

$sql = myquery("insert into idtable (userid,pw,name,email) values('".$userid."','".$userpw."','".$username."','".$email."')"); ?>
<script type="text/javascript">alert('회원가입이 완료되었습니다.');</script>
<meta http-equiv="refresh" content="0 url=/">
<?php } ?>