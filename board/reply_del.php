<?php include_once("../php/db.php"); 
    $rno = $_POST['rno'];
    $sql = myquery("select * from replytable where id='".$rno."'");
    $reply = $sql->fetch_array();

    $bno = $_POST['b_no'];
    $sql2 = myquery("select * from boardtable where id='".$bno."'");
    $board = $sql2->fetch_array();

    $pwk = $_POST['pw'];
    $bpw = $reply['pw'];

    if(password_verify($pwk, $bpw)) {
        $sql = myquery("delete from replytable where id='".$rno."'"); ?>
        <script type="text/javascript">alert('댓글이 삭제되었습니다.'); location.replace("view.php?id=<?php echo $board["id"]; ?>"); </script>
        <?php
    } else { ?>
        <script type="text/javascript">alert('비밀번호가 틀립니다.');history.back();</script>
        <?php 
    } ?>
