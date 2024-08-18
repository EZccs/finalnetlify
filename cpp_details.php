<?php
putenv("PATH=C:\MinGW\bin;" . getenv("PATH"));
$cppCode = "";
$runOutput = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cppCode = $_POST["cpp_code"];
    
    // C++ 코드를 임시 파일로 저장
    $filename = "TempProgram.cpp";
    $outputFile = "TempProgram.out";

    // 이전에 생성된 파일이 있다면 삭제
    if (file_exists($filename)) {
        unlink($filename);
    }
    if (file_exists($outputFile)) {
        unlink($outputFile);
    }

    file_put_contents($filename, $cppCode);

    // C++ 컴파일
    $compileOutput = shell_exec("g++ $filename -o $outputFile 2>&1");

    if ($compileOutput) {
        $compileOutput = iconv("EUC-KR", "UTF-8", $compileOutput);
        $runOutput = "Compilation Error: \n$compileOutput";
    } else {
        // 컴파일된 C++ 프로그램 실행
        $runOutput = shell_exec("$outputFile 2>&1");
    }

    // 사용 후 생성된 파일 삭제
    unlink($filename);
    if (file_exists($outputFile)) {
        unlink($outputFile);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>InjSite</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/cpp.css">
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
    <div class="cpp-container">
        <section class="cpp-language">
            <h2>
                <img src="./image/cpplogo.png" height="250" width="250">
            </h2>
            <h2>C++ 언어</h2>
        <p>C 언어를 기반으로 만들어진 고성능 프로그래밍 언어로, 시스템 소프트웨어 및 응용 프로그램 개발에 널리 사용됨</p>
        <hr>
        <h3>C++ 언어 특징</h3>
        <p>
            장점 1. C++은 <span class="cpp-highlight">객체 지향 프로그래밍</span>을 지원하여 코드의 재사용성과 유지보수성이 뛰어남<br>
            장점 2. C++은 <span class="cpp-highlight">저수준 언어의 특징</span>을 가져 시스템 프로그래밍에 적합<br>
            장점 3. C++은 <span class="cpp-highlight">높은 성능</span>을 제공하여 게임 개발 및 실시간 시스템에 적합<br>
            장점 4. C++은 <span class="cpp-highlight">표준 라이브러리</span>를 통해 다양한 기능을 제공<br>
            단점 1. C++은 <span class="cpp-highlight">복잡한 문법</span>을 가지고 있어 배우기 어려울 수 있음<br>
            단점 2. C++은 <span class="cpp-highlight">메모리 관리</span>를 수동으로 해야 하여 오류가 발생할 수 있음<br>
        </p>
        <hr>
        <h3>C++ 언어 활용분야</h3>
        <p>
            시스템 소프트웨어<br>
            게임 개발<br>
            임베디드 시스템<br>
            금융 시스템<br>
            데이터베이스 관리 시스템<br>
            네트워크 프로그래밍<br>
            고성능 애플리케이션<br>
        </p>
        <hr>
        <h3>C++ 언어 활용 기본예제</h3>
        <p style="text-align:center">
            <img src="./image/cppcode.png">
        </p>
        <form method="post">
        <div class="container2">
            <!-- C code input -->
            <textarea name="cpp_code"><?php echo htmlspecialchars($cppCode, ENT_QUOTES, 'UTF-8', false) ?: htmlspecialchars("
#include <iostream>

int main() {
    std::cout &lt;&lt; \"Hello, World!\" &lt;&lt; std::endl;
    return 0;
}", ENT_QUOTES, 'UTF-8', false);?>
            </textarea>
            <!-- Output display -->
            <textarea readonly><?php echo htmlspecialchars($runOutput, ENT_SUBSTITUTE, 'UTF-8', false); ?></textarea>
        </div>
        <br>
        <input type="submit" value="Run C++ Code">
    </form>
        </section> 
    </div>
</body>
</html>
