<?php include_once("../php/db.php");
      if(!session_id()) {
        // id가 없을 경우 세션 시작
            session_start();
        }
?>
<!DOCTYPE html>
<html lang="ko">
    <head>
        <title>InjSite</title>
        <meta charset="utf-8">
        <style>
        input[type="text"] {
            border: 1.5px rgb(68, 136, 244) solid;
            width: 500px;
            height: 30px;
            border-radius: 5px;
            padding-left: 10px;
        }
        </style>
    </head>
    <link rel="stylesheet" type="text/css" href="../css/main.css?after">
    <link rel="stylesheet" type="text/css" href="../css/board.css?after">
    <link rel="stylesheet" type="text/css" href="../css/login.css?after">
    <body>
    <div>
        <h1 class="textcss">InjSite</h1>
        </div>
        <div class="container">
        <div id="topmenu">
            <nav>
                <ul>
                    <li><a class="a2" href="../index.php">메인페이지</a></li>
                    <li><a class="a2" href="../Planguage.html">프로그래밍 언어</a></li>
                    <li><a class="a2" href="../faculty.html">학과</a></li>
                    <li><a class="a2" href="../bus.html">버스</a></li>
                    <li><a class="a2" href="../board/qna.php">QnA 게시판</a></li>
                </ul>
            </nav>
        </div>
        </div> 
    <?php    
    if(isset($_SESSION['userid'])){?>
	<script type="text/javascript">alert('이미 로그인상태입니다.'); location.href="../index.php";</script>
    <?php } else { ?>
    <div id="wrap">
	<div id="join_form_in">
		<div id="mem_t" >회원가입</div>
			<form action="reg_ok.php" method="post">
				<div id="join_f">
					<div class="form-group">
						<label for="userid">아이디</label>
						<div class="mb"><input type="text" class="inp" id="userid" name="userid" placeholder="아이디" required/></div>
					</div>
					<div class="form-group">
						<label for="userpw">비밀번호</label>
						<div class="mb"><input type="password" class="inp" id="userpw" name="userpw" placeholder="비밀번호" required/></div>
					</div>
					<div class="form-group">
						<label for="name">이름</label>
						<div class="mb"><input type="text" class="inp" id="name" name="name" placeholder="이름을 입력해 주세요" required/></div>
					</div>
					<div class="form-group">
						<label for="e-mail">이메일</label>
				        <div class="mb"><input type="text" class="inp" id="e-mail" name="email" placeholder="이메일을 입력해주세요" required/></div>
				    </div>
				    <div class="form_btn">
				    	<button type="submit" class="form_bt">회원가입</button>
				       	<button type="reset" class="form_bt2">가입취소</button>
				    </div>
				</div> <!-- join_f end -->
			</form>
		</div>
	</div><!--- wrap end -->
    <?php } ?>
    </body>
</html>