<?php include_once("../php/db.php");
      if(!session_id()) {
        // id가 없을 경우 세션 시작
            session_start();
        }
 ?>
<!DOCTYPE html>
<html>
    <head>
        <title>InjSite</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="../css/board.css?after">
        <link rel="stylesheet" type="text/css" href="../css/qna.css?after">
        <link rel="stylesheet" type="text/css" href="../css/login.css?after">
        <style>
            a {
                text-decoration: none;
                color: black;
            }
        </style>
    </head>
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
        <div class="childlog">
                <?php
                    if(!isset($_SESSION['userid'])) {
                        echo "
                        <form action='../login/login.php' method='post'>
                            <table class='slogtable'> 
                                <tr><td class='header2'>아이디</td></tr>
                                <tr><td><input type='text' placeholder='ID를 입력하세요' name='userid' required class = 'intext2' maxlength='20'></td></tr>
                                <tr><td class='header2'>비밀번호</tr>
                                <tr><td><input type='password' placeholder='비밀번호를 입력하세요' name='userpw' required class = 'intext2' maxlength='20'></td></tr>
                            </table>
                            <input type='submit' value='로그인' class = 'sloginbt'>
                            <p class='sregp'><a href='../login/register.php'>회원 가입</a></p>
                        </form>
                        ";
                    } else { ?>
                        <p><b><?php echo $_SESSION['name']; ?></b>님, 반갑습니다.</p>  
                        <p><a href="./myboard.php">내가 쓴 게시글</a></p> 
                        <p><button onclick="location.href='../login/logout.php'" class="logoutbt">로그아웃</button></p>
                    <?php    
                    }
                ?>               
        </div>
        <table class="table">
            <tr><td colspan="2"><h2>QNA 게시판</h2></td></tr>
            <tr class="header">
                <td class="num">번호</td>
                <td class="title">제목</td>
                <td>작성자</td>
                <td>작성날짜</td>
            </tr>
            <?php
               if(isset($_GET['page'])) {
                  $page = $_GET['page'];
               } else {
                  $page = 1;
               }
                $sql = myquery("select * from boardtable");
                $row_num = mysqli_num_rows($sql);
                $list = 10;
                $block_ct = 5;

                $block_num = ceil($page/$block_ct);
                $block_start = (($block_num - 1) * $block_ct) + 1;
                $block_end = $block_start + $block_ct - 1;

                $total_page = ceil($row_num / $list);
                if($block_end > $total_page) $block_end = $total_page;
                $total_block = ceil($total_page/$block_ct);
                $start_num = ($page-1) * $list;

                $sql2 = myquery("select * from boardtable order by id desc limit $start_num, $list");
                while($board = $sql2->fetch_array()) 
                {
                    $title=$board["title"];
                    if(strlen($title)>30) 
                    {
                        $title = str_replace($board["title"],mb_substr($board["title"],0,30,"utf-8")."...",$board["title"]);                  
                    }
                  $sql3 = myquery("select * from replytable where con_num='".$board['id']."'");
                  $rep_count = mysqli_num_rows($sql3);
            ?>
            <tr>
                <td class="center"><?php echo $board['id']; ?></td> 
                <td><a href="/board/view.php?id=<?php echo $board["id"];?>"><?php echo $title; ?><span class="re_ct">
                    <?php if ($rep_count > 0) {
                        echo "<span class='re_ct'>&nbsp;[$rep_count]</span>";
                    }?></a>
                </td>
                <td class="center"><?php echo $board['name']; ?></td> 
                <td class="center"><?php echo $board['writedate']; ?></td>
            </tr>
            <?php } ?>    
        </table>
        <div class="page_num">
            <ul>
                <?php
                   if($page <= 1) {
                      echo "<li class='fo_re'>처음</li>";
                   } else {
                      echo "<li><a href='?page=1'>처음</a></li>";
                   }
                   if($page <= 1) {

                   } else {
                      $pre = $page-1;
                      echo "<li><a href='?page=$pre'>이전</a></li>";
                   }
                   for($i=$block_start; $i<=$block_end;$i++) {
                      if($page == $i) {
                          echo "<li class='fo_re'>[$i]</li>";
                      } else {
                          echo "<li><a href='?page=$i'>[$i]</a><li>";
                      }
                   }
                   if($block_num >= $total_block) {    
                   } else {
                       $next = $page + 1;
                       echo "<li><a href='?page=$next'>다음</a></li>";
                   }
                   if($page >= $total_page) {
                       echo "<li class='fo_re'>마지막</li>";
                   } else {
                       echo "<li><a href='?page=$total_page'>마지막</a></li>";
                   }
                ?>   
            </ul>    
        </div>
        <br>
        <table>
            <tr>
                <td><button class="bt" onclick="location.href='write.php'">글쓰기</button></td>
            </tr>
        </table>
    </body>
</html>
