<?php 
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
    <link rel="stylesheet" type="text/css" href="../css/board.css?after">
    <link rel="stylesheet" type="text/css" href="../css/qna.css?after">
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
                    <li><a class="a2" href="./qna.php">QnA 게시판</a></li>
                </ul>
            </nav>
        </div>
        </div> 
        <form action="./write_ok.php" method="post">
            <table class="table2"> 
                <tr><td><h2>글쓰기</h2></td></tr>
                <tr><td class="header2">제목</td></tr>
                <tr><td><input type="text" placeholder="제목을 입력하세요" name="title" id="utitle"required class = "intext"></td></tr>
                <tr><td class="header2">이름</td></tr>
                <?php if(!isset($_SESSION['name'])) {
                    echo "<tr><td><input type='text' placeholder='이름을 입력하세요' name='name' id='uname'required class = 'intext2'></td></tr>";
                } else { ?>
                      <tr><td><input type="text" value=<?php echo $_SESSION['name']; ?> name="name" id="uname"required class = "intext2" readonly></td></tr>
                      <?php
                }
                ?>      
                <tr><td class="header2">비밀번호</tr>
                <tr><td><input type="password" placeholder="비밀번호를 입력하세요" name="pw" id="upw"required class = "intext2" maxlength="10"></td></tr>
                <tr><td class="header2">내용</td></tr>
                <tr><td><textarea placeholder="내용을 입력하세요" name="content" id="ucontent" class="textarea2" required class = "intext"></textarea></td></tr>
                <tr><td><input type="submit" value="등록" class = "submit_bt"></td></tr>
            </table>
            </form>
    </body>
</html>