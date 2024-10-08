<?php
putenv("PATH=C:\MinGW\bin;" . getenv("PATH"));
$cCode = "";
$runOutput = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cCode = $_POST["c_code"];
    
    $filename = "TempProgram.c";
    $executable = "TempProgram";

    // C 코드를 파일에 저장
    file_put_contents($filename, mb_convert_encoding($cCode, 'UTF-8'));

    // C 코드 컴파일
    $compileOutput = shell_exec("gcc $filename -o $executable 2>&1");

    if ($compileOutput) {
        // 인코딩을 UTF-8로 변환 (필요한 경우)
        $compileOutput = iconv("EUC-KR", "UTF-8", $compileOutput);
        $runOutput = "Compilation Error: \n$compileOutput";
    } else {
        $runOutput = shell_exec("TempProgram.exe 2>&1");
    }

    // 사용 후 생성된 파일 삭제
    unlink($filename);
    if (file_exists($executable)) {
        unlink($executable);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>InjSite</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/c.css">
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
    <div class="c-container">
        <section class="c-language">
            <h2>
                <img src="./image/clogo.png" height="250" width="250">
            </h2>
            <h2>C 언어</h2>
            <p>이식성이 좋고 어셈블리어보다 쉬운 언어가 필요해 개발된 언어로 현재 널리 사용되는 모든 운영체의 커널은 대부분 C 언어를 이용해 구현</p>
            <hr>
            <h3>C 언어 특징</h3>
            <p>
                장점 1. C 언어는 <span class="c-highlight">이식성</span>이 좋아 다양한 하드웨어에서 실행 가능<br>
                장점 2. C 언어는 <span class="c-highlight">절차 지향 프로그래밍</span> 언어로, 코드가 복잡하지 않아 상대적으로 유지보수가 쉬움<br>
                장점 3. C 언어는 <span class="c-highlight">저급 언어의 특징</span>을 갖고 있어 어셈블리어 수준으로 하드웨어 제어 가능<br>
                장점 4. C 언어는 <span class="c-highlight">코드가 간결</span>하여, 완성된 프로그램의 크기가 작고 실행 속도가 빠름<br>
                단점 1. C 언어는 <span class="c-highlight">저급 언어의 특징</span>을 갖고 있어 자바와 같은 다른 고급 언어보다 배우기 힘듦<br>
                단점 2. C 언어는 <span class="c-highlight">시스템 자원 직접 제어</span>로 인해 프로그래밍 시 세심한 주의가 필요함<br>
            </p>
            <hr>
            <h3>C 언어 활용분야</h3>
            <p>
                운영체제 및 디바이스 드라이버<br>
                마이크로컨트롤러<br>
                임베디드 시스템<br>
                암호학 라이브러리<br>
                프로그래밍 언어 인터프리터<br>
                웹 서버<br>
                데이터베이스<br>
                애플리케이션<br>
            </p>
            <hr>
            <h3>C 언어 활용 기본예제</h3>
            <p style="text-align:center">
                <img src="./image/ccode.png">
            </p>
            <form method="post">
        <div class="container2">
            <!-- C code input -->
            <textarea name="c_code"><?php echo htmlspecialchars($cCode, ENT_QUOTES, 'UTF-8', false) ?: htmlspecialchars("
#include <stdio.h>

int main() {
    printf(\"Hello, World!\");
    return 0;
}", ENT_QUOTES, 'UTF-8', false);?>
            </textarea>
            <!-- Output display -->
            <textarea readonly><?php echo htmlspecialchars($runOutput, ENT_SUBSTITUTE, 'UTF-8', false); ?></textarea>
        </div>
        <br>
        <input type="submit" value="Run C Code">
    </form>
        </section>
    </div>
</body>
</html>
