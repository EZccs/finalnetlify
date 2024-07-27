<?php include_once("../php/db.php");
      session_start();
      
      $password = $_POST['userpw'];
      $sql = myquery("select * from idtable where userid='".$_POST['userid']."'");
      $user = $sql->fetch_array();
      $hash_pw = $user['pw'];

      if(password_verify($password, $hash_pw)) {
        $_SESSION['userid'] = $user['userid'];
		    $_SESSION['userpw'] = $user['pw'];
        $_SESSION['name'] = $user['name'];
      ?>
      <script type="text/javascript">alert('로그인되었습니다.'); location.href="../index.php";</script> <!-- echo basename($_SERVER['HTTP_REFERER']) 확실히 체크-->
      exit;
      <?php } else {
       ?>
       <script type="text/javascript">alert('아이디 혹은 비밀번호를 확인하세요.'); location.href="../index.php";</script>
      <?php }
 ?>