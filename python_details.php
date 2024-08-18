<?php
$pythonCode = "";
$runOutput = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pythonCode = $_POST["python_code"];
    
    // Python 코드를 임시 파일로 저장
    $filename = "TempProgram.py";

    // 이전에 생성된 파일이 있다면 삭제
    if (file_exists($filename)) {
        unlink($filename);
    }

    file_put_contents($filename, $pythonCode);

    // Python 실행 명령어 설정 (python3 대신 python 사용)
    $pythonPath = 'C:\\Users\\azx20\\AppData\\Local\\Programs\\Python\\Python312\\python.exe'; // 또는 'python3'
    $runCommand = "$pythonPath \"$filename\" 2>&1";

    // Python 프로그램 실행
    $runOutput = shell_exec($runCommand);
    $runOutput = mb_convert_encoding($runOutput, 'UTF-8', 'cp949');

    // 사용 후 생성된 파일 삭제
    unlink($filename);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>InjSite</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/python.css">
    <style>
        .container2 {
            display: flex;
            gap: 20px;
        }
        textarea {
            width: 45%;
            height: 300px;
            font-family: monospace;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div>
        <h1 style="text-align:center; font-family: sans-serif">InjSite</h1>
    </div>
    <div class="container">
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
    </div>
    <div class="python-container">
        <section class="python-language">
            <h2>
                <img src="./image/pythonlogo.png" height="250" width="250">
            </h2>
            <h2>Python 언어</h2>
        <p>파이썬은 범용 프로그래밍 언어로, 코드가 간결하고 읽기 쉬우며 다양한 분야에서 널리 사용됨</p>
        <hr>
        <h3>Python 언어 특징</h3>
        <p>
            장점 1. Python은 <span class="python-highlight">문법이 간결</span>하고 읽기 쉬워서 초보자에게 적합<br>
            장점 2. Python은 <span class="python-highlight">다양한 라이브러리와 프레임워크</span>를 제공하여 생산성을 높임<br>
            장점 3. Python은 <span class="python-highlight">다중 패러다임</span>을 지원하여 다양한 프로그래밍 스타일을 적용 가능<br>
            장점 4. Python은 <span class="python-highlight">인터프리터 언어</span>로서 즉시 실행 및 테스트가 가능<br>
            단점 1. Python은 <span class="python-highlight">느린 실행 속도</span>를 가질 수 있음<br>
            단점 2. Python은 <span class="python-highlight">모바일 컴퓨팅</span>에서의 활용이 제한적일 수 있음<br>
        </p>
        <hr>
        <h3>Python 언어 활용분야</h3>
        <p>
            웹 애플리케이션 개발<br>
            데이터 분석 및 과학<br>
            인공지능 및 머신러닝<br>
            자동화 스크립트<br>
            게임 개발<br>
            데스크탑 애플리케이션<br>
            네트워크 서버<br>
        </p>
        <hr>
        <h3>Python 언어 활용 기본예제</h3>
        <p style="text-align:center">
            <img src="./image/pythoncode.png">
        </p>
        <form method="post">
        <div class="container2">
            <!-- Python code input -->
            <textarea name="python_code"><?php echo htmlspecialchars($pythonCode, ENT_QUOTES, 'UTF-8', false) ?: htmlspecialchars("print(\"Hello, World!\")", ENT_QUOTES, 'UTF-8', false);?>
            </textarea>
            <!-- Output display -->
            <textarea readonly><?php echo htmlspecialchars($runOutput, ENT_SUBSTITUTE, 'UTF-8', false); ?></textarea>
        </div>
        <br>
        <input type="submit" value="Run Python Code">
    </form>
        </section>      
    </div>
</body>
</html>
