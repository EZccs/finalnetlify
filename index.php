<?php include_once("./php/db.php");
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
    <link rel="stylesheet" type="text/css" href="css/main.css?after">
    <link rel="stylesheet" type="text/css" href="css/board.css?after">
    <link rel="stylesheet" type="text/css" href="css/login.css?after">
    <script>
        var quizzes = [
            { question: "객체지향 프로그래밍에서 데이터와 메서드를 하나의 클래스 또는 객체로 묶는것은 무엇일까요?", answer: "캡슐화" },
            { question: "함수형 프로그래밍에서 동일한 입력에 대해 항상 동일한 출력을 반환하고 부작용이 없는 함수는?", answer: "순수 함수" },
            { question: "알고리즘의 시간 복잡도와 공간 복잡도를 나타내는 표기법은?", answer: "빅오 표기법" },
            { question: "자료구조 스택의 주요 연산 두 가지는 무엇일까요? ex)00와0",answer:"푸시와 팝"},
            { question: "부분 문제의 결과를 저장해 동일한 부분 문제를 다시 계산하지 않도록 하는 방법은?",answer:"동적 계획법"},
            { question: "자기 자신을 호출하는 함수는 무엇일까요?",answer:"재귀 함수"},
            { question: "다른 함수에 인수로 전달되는 함수는 무엇일까요?",answer:"콜백 함수"}
        ];

        function closePopup() {
            var popup = document.querySelector('.popup');
            popup.style.display = 'none';
        }

        function showRandomQuiz() {
            var randomQuiz = quizzes[Math.floor(Math.random() * quizzes.length)];
            var popup = document.querySelector('.popup');
            var textArea = document.querySelector('.text_area');
            var question = "<strong class='title'>Quiz!!!</strong><p>" + randomQuiz.question + "</p>";
            var answerInput = "<input type='text' id='userAnswer' placeholder='Enter your answer'>";
            var btnArea = "<div class='btn_area'><button onclick='checkAnswer(\"" + randomQuiz.answer + "\")' class='btn'>Submit</button><button onclick='closePopup()' class='btn-no'>Close</button></div>";
            
            textArea.innerHTML = question + answerInput + btnArea;

            popup.style.display = 'flex';
            document.getElementById('userAnswer').focus();
        }

        function checkAnswer(correctAnswer) {  
            var userAnswer = document.getElementById('userAnswer').value.toLowerCase();
            var cleanedCorrectAnswer = correctAnswer.toLowerCase().replace(/\s+/g, ''); // 정답에서 공백 제거

            // 사용자 답안에서 공백을 제거한 후, 정답과 비교
            if (userAnswer.replace(/\s+/g, '') === cleanedCorrectAnswer) { 
                alert("정답!");
            } else {
                alert("오답입니다. 정답은: " + correctAnswer);
            }
            closePopup();
        }
        async function loadNews() {
        const response = await fetch('./news.json'); // JSON 파일 경로
        if (!response.ok) {
            console.error("Failed to load news.json");
            return;
        }
        const newsItems = await response.json();
        const newsContainer = document.getElementById('news-container');
        
        newsItems.forEach(item => {
            const newsItem = document.createElement('div');
            newsItem.className = 'news-item';
            
            const title = document.createElement('h3');
            const link = document.createElement('a');
            link.href = item.link;
            link.textContent = item.title;
            title.appendChild(link);
            
            // 이미지 추가
            if (item.image) {
                const img = document.createElement('img');
                img.src = item.image;
                img.alt = item.title; // 대체 텍스트
                img.style.width = '100px'; // 이미지 크기 조정 (필요에 따라 조정 가능)
                img.style.height = 'auto'; // 비율 유지
                newsItem.appendChild(img);
            }
            
            newsItem.appendChild(title);
            newsContainer.appendChild(newsItem);
        });
    }
        
        window.onload = function() {
            showRandomQuiz();
        };
    </script>
</head>
<body>
    <div class="container">
        <h1 style="text-align:center; font-family: sans-serif">InjSite</h1>
        <div id="topmenu">
            <nav>
                <ul>
                    <li><a href="./index.php">메인페이지</a></li>
                    <li><a href="./Planguage.html">프로그래밍 언어</a></li>
                    <li><a href="./faculty.html">학과</a></li>
                    <li><a href="./bus.html">버스</a></li>
                    <li><a href="./board/qna.php">QnA 게시판</a></li>
                </ul>
            </nav>
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
                        <p><a href="./board/myboard.php">내가 쓴 게시글</a></p> 
                        <p><button onclick="location.href='../login/logout.php'" class="logoutbt">로그아웃</button></p>
                    <?php    
                    }
                ?>               
        </div>
        <div class="detail">
            <div class="child">
                <h2>인제 컴퓨터 공학과<br>공지사항 & 금주의 식단</h2>
                <p>
                    <a href="https://cs.inje.ac.kr/%EA%B3%B5%EC%A7%80%EC%82%AC%ED%95%AD/">공지사항 바로가기<br></a>
                    <a href="https://www.inje.ac.kr/kor/Template/Bsub_page.asp?Ltype=5&Ltype2=3&Ltype3=3&Tname=S_Food&Ldir=board/S_Food&Lpage=s_food_view&d1n=5&d2n=4&d3n=4&d4n=0">
                        금주의 식단 바로가기
                    </a>
                </p>
            </div>
            <div class="child">
                <h2>인제 컴퓨터 공학과<br>Tel&open kakaoTalk</h2>
                <p>
                    055-320-3269<br>
                    <a href="https://open.kakao.com/o/gZbgx36e">@kakaotalk</a>
                </p>
            </div>
            <div class="child">
                <h2>학부 이메일 & 교수진 이메일</h2>
                <p>
                    학부 : cshouse@inje.ac.kr<br>
                    김태공 교수 : sun@inje.ac.kr<br>
                    박세명 교수 : cssmpark@inje.ac.kr<br>
                    서재현 교수 : jaiseu@inje.ac.kr<br>
                    김상균 교수 : skkim@inje.ac.kr<br>
                    김태완 교수 : twkim@inje.ac.kr<br>
                    김평 교수 : pkim@inje.ac.kr<br>
                </p>
            </div>           
        </div>   
        <div class="detail">
            <h3>
                <button type="button" class="logo-button" onclick="location.href='./c_details.php'"><img src="./image/clogo.png" height="150" width="150"></button>
                <button type="button" class="logo-button" onclick="location.href='./cpp_details.php'"><img src="./image/cpplogo.png" height="150" width="150"></button>
                <button type="button" class="logo-button" onclick="location.href='./csharp_details.php'"><img src="./image/csharplogo.png" height="150" width="150"></button>
                <button type="button" class="logo-button" onclick="location.href='./java_details.php'"><img src="./image/javalogo.png" height="150" width="150"></button>
                <button type="button" class="logo-button" onclick="location.href='./python_details.php'"><img src="./image/pythonlogo.png" height="150" width="150"></button>
            </h3>
        </div>
        
        <div class="detail">
            <table class="table_small">
            <tr><th><h3 class="h3_qna">QNA 게시판</h3></th></tr>
            <?php
                $sql = myquery("select * from boardtable order by id desc limit 0, 5");
                while($board = $sql->fetch_array()) 
                {
                    $title=$board["title"];
                    if(strlen($title)>15) 
                    {
                        $title = str_replace($board["title"],mb_substr($board["title"],0,15,"utf-8")."...",$board["title"]);                  
                    }
                
            ?>
            <tr>
                <td><a class="a_qna" href="./board/view.php?id=<?php echo $board['id'];?>"><?php echo $title; ?></a></td>
            </tr>    
            <?php } ?>
            </table>
            <div id="news-container">
                <h3> IT News </h3>
                <?php 
                    $jsonFilePath = './news.json';

                    $jsonData = file_get_contents($jsonFilePath);
                    $newsItems = json_decode($jsonData, true);
                    if ($newsItems === null) {
                        echo "Failed to load news.json";
                        exit;
                    }
                ?>
                <?php foreach($newsItems as $item): ?>
                <div class="news-item">
                    <?php if (!empty($item['image'])): ?>
                        <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['title']) ?>">
                    <?php endif; ?>
                    <h3>
                        <a href="<?= htmlspecialchars($item['link']) ?>"><?= htmlspecialchars($item['title']) ?></a>
                    </h3>
                </div>
                <?php endforeach; ?>
            </div>          
        </div>
        <div class="popup-container">
            <div class="popup">
                <div class="popup_layer">
                    <div class="text_area">
                        <!-- 퀴즈 내용이 여기에 동적으로 추가됨 -->
                    </div>
                </div>
            </div>
        </div>
        <div id="banner-container" class="banner-container">
            <div class="banner-item">
                <a href="https://codeup.kr" target="_blank">
                    <img src="./image/codeup.png" alt="코드업" class="banner-img">
                </a>
            </div>
            <div class="banner-item">
                <a href="https://www.acmicpc.net" target="_blank">
                    <img src="./image/baekjoon.png" alt="백준" class="banner-img">
                </a>
            </div>
            <div class="banner-item">
                <a href="https://codingdojang.com" target="_blank">
                    <img src="./image/codingdojang.png" alt="코딩도장" class="banner-img">
                </a>
        </div>
    </div>
    </div>
</body>
</html>
