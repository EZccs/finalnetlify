<?php include_once("../php/db.php")
 ?>
<!DOCTYPE html>
<html lang="ko">
    <head>
        <title>InjSite</title>
        <meta charset="utf-8">
        <script type="text/javascript" src="../js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="../js/jquery-ui.js"></script>
        <script type="text/javascript" src="../js/common.js?after"></script>
    </head>
    <link rel="stylesheet" type="text/css" href="../css/board.css?after">
    <link rel="stylesheet" type="text/css" href="../css/jquery-ui.css?after">
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
        <?php 
            $bno = $_GET['id'];
            $sql = myquery("select * from boardtable where id ='".$bno."'");
            $board = $sql->fetch_array();
        ?>
        <div class="board_wrap">
            <div class="board_title">
                <h2>내가 쓴 게시글</h2>
            </div>
            <div class="board_view_wrap">
                <div class="board_view">
                    <div class="title">
                        <?php echo $board['title']; ?>
                    </div>
                    <div class="info">
                        <dl>
                            <dt>번호</dt>
                            <dd><?php echo $board['id']; ?></dd>
                        </dl>
                        <dl>
                            <dt>작성자</dt>
                            <dd><?php echo $board['name']; ?></dd>
                        </dl>
                        <dl>
                            <dt>작성일</dt>
                            <dd><?php echo $board['writedate']; ?></dd>
                        </dl>
                    </div>
                    <div class="cont">
                        <?php echo nl2br("$board[content]"); ?>
                    </div>
                </div>
                <div class="bod_lo"> 
                    <ul>           
                        <li class="lis"><a id="del" href="#" class="as">[삭제]</a></li>
                        <li class="lis"><a id="mod" href="modify.php?id=<?php echo $board['id']; ?>" class="as">[수정]</a></li>
                    </ul>
                    <div class='board_del'>
                        <form action="./delete.php" method="post">
                            <input type="hidden" name="b_no" value="<?php echo $bno; ?>">
                            <p>비밀번호&nbsp;<input type="password" name="pw" /> <input type="submit" value="확인"></p>
                        </form>
			        </div>
                </div>
                <div class="bt_wrap">
                    <button class="bt" onclick="location.href='myboard.php'">목록</button>
                </div>
        </div>
        <div class="reply_view">
                    <h3>댓글</h3>
                        <?php
                          $sql3 = myquery("select * from replytable where con_num='".$bno."' order by id asc");
                          while($reply = $sql3->fetch_array()) {
                        ?>
                       <div class="dap_lo">
                          <div><b><?php echo $reply['name'];?></b></div>
                          <div class="dap_to comt_edit"><?php echo nl2br("$reply[content]"); ?></div>
                          <div class="rep_me dap_to"><?php echo $reply['date']; ?></div>
                          <div class="rep_me rep_menu">
                               <a class="dat_edit_bt" href="#">수정</a>
                               <a class="dat_delete_bt" href="#">삭제</a>
                        </div>
                        <div class="dat_edit">
                               <form action="./rep_mod_ok.php" method="post">
                                    <input type="hidden" name = "rno" value="<?php echo $reply['id']; ?>" /><input type="hidden" name="b_no" value="<?php echo $bno; ?>">
                                    <input type="password" name = "pw" class="dap_sm" placeholder="비밀번호" />
                                    <textarea name="content" class="dap_edit_t"><?php echo $reply['content']; ?></textarea>
                                    <input type="submit" value="수정하기" class="re_mo_bt">
                               </form>
                        </div>
                        <div class="dat_delete">
                               <form action="./reply_del.php" method="post">
                                     <input type="hidden" name="rno" value="<?php echo $reply['id']; ?>" /><input type="hidden" name="b_no" value="<?php echo $bno; ?>">
                                     <p>비밀번호&nbsp;<input type="password" name="pw" /> <input type="submit" value="확인"></p>
                               </form>
                          </div> 
                          
                        </div>
                        <?php } ?>   
                        <div class="dap_ins">
                               <input type="hidden" name="bno" class="bno" value="<?php echo $bno; ?>">
                               <input type="text" name="dat_user" id="dat_user" class="dat_user" size="15" placeholder="닉네임" required>
                               <input type="password" name="dat_pw" id="dat_pw" class="dat_pw" size="15" placeholder="비밀번호" required>
                               <div style="margin-top:10px;">
                                    <textarea name="content" id="re_content" class="reply_content" required></textarea>
                                    <button type = "submit" id="rep_bt" class="re_bt">작성</button>
                               </div>      
                        </div>        
                </div>
        <div id="foot_box"></div>
    </body>
</html>