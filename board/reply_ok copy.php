<?php include_once("../php/db.php");
    
    $bno = $_GET['id'];
    $userpw = password_hash($_POST['dat_pw'], PASSWORD_DEFAULT);

    if($bno && $_POST['dat_user'] && $userpw && $_POST['content']) {
        $sql = myquery("insert into replytable(con_num,name,pw,content) values('".$bno."', '".$_POST['dat_user']."', '".$userpw."', '".$_POST['content']."')");
        echo "<script>alert('댓글이 작성되었습니다.');
        location.href='./view.php?id=$bno';</script>";   
    } else {
        echo "<script>alert('댓글 작성에 실패했습니다.');
        history.back();</script>";
    }
?>