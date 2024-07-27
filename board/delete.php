<?php include_once("../php/db.php");
    
    $bno = $_POST['b_no'];
    $sql = myquery("select * from boardtable where id='$bno';");
    $board = $sql->fetch_array();

    $pwk = $_POST['pw'];
    $bpw = $board['pw'];

    if(password_verify($pwk, $bpw)) {
        $sql = myquery("delete from boardtable where id='".$bno."'");
        $sql2 = myquery("select * from replytable where con_num='".$bno."' order by id asc"); 
        while ($reply = $sql2->fetch_array()) {
            $sql3 = myquery("delete from replytable where con_num='".$bno."'");
        }
        ?>
        <script type="text/javascript">alert("게시글이 삭제되었습니다.");</script>
        <meta http-equiv="refresh" content="0 url=/board/qna.php" />
        <?php
    } else { ?>
        <script type="text/javascript">alert('비밀번호가 틀립니다.');history.back();</script>
        <?php 
    } ?>