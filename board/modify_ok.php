<?php include_once("../php/db.php");

$bno = $_GET['id'];
$username = $_POST['name'];
$title = $_POST['title'];
$content = $_POST['content'];

$sql = myquery("select * from boardtable where id='".$bno."'");
$board = $sql->fetch_array();
$pwk = $_POST['pw'];
$bpw = $board['pw'];

if(password_verify($pwk, $bpw)) {
    $sql2 = myquery("update boardtable set name='".$username."', title='".$title."',content='".$content."' where id='".$bno."'"); ?>
    <script type="text/javascript">alert('수정되었습니다.'); location.replace("view.php?id=<?php echo $bno; ?>");</script>
    <meta http-equiv="refresh" content="0 url=./board/view.php?id=<?php echo $bno; ?>">
    <?php
} else { ?>
    <script type="text/javascript">alert('비밀번호가 틀립니다.');history.back();</script>
    <?php 
} ?>