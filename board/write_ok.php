<?php include_once("../php/db.php");
      if(!session_id()) {
        // id가 없을 경우 세션 시작
            session_start();
        }

$username = $_POST['name'];
$title = $_POST['title'];
$userpw = password_hash($_POST['pw'], PASSWORD_DEFAULT);
$content = $_POST['content'];
$date = date('Y-m-d');
if(!isset($_SESSION['userid'])) {
    if($username && $title && $userpw && $content) {
    $mqq = myquery("alter table boardtable auto_increment =1");
    $sql = myquery("insert into boardtable(title, name, pw, content, writedate) values('".$title."','".$username."','".$userpw."','".$content."','".$date."')");
    echo "<script>
    alert('글쓰기 완료되었습니다.');
    location.href='/board/qna.php';</script>";
    }
    else {
    echo "<script>
    alert('글쓰기에 실패했습니다.');
    history.back();</script>";
    }
} else {
    if($username && $title && $userpw && $content) {
        $mqq = myquery("alter table boardtable auto_increment =1");
        $sql = myquery("insert into boardtable(title, name, pw, content, writedate, logcheck) values('".$title."','".$username."','".$userpw."','".$content."','".$date."',1)");
        echo "<script>
        alert('글쓰기 완료되었습니다.');
        location.href='/board/qna.php';</script>";
        }
        else {
        echo "<script>
        alert('글쓰기에 실패했습니다.');
        history.back();</script>";
        }
}


 ?>