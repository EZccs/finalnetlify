<?php
$csCode = "";
$runOutput = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $csCode = $_POST["cs_code"];
    
    // C# 코드를 임시 파일로 저장
    $filename = "TempProgram.cs";
    $exeFile = "TempProgram.exe";

    // 이전에 생성된 파일이 있다면 삭제
    if (file_exists($filename)) {
        unlink($filename);
    }
    if (file_exists($exeFile)) {
        unlink($exeFile);
    }

    file_put_contents($filename, $csCode);
    $monoPath = '"C:\Program Files\Mono\bin\mono.exe"';
    $compilerPath = '"C:\Program Files\Mono\bin\mcs"';
    $compileCommand = "$compilerPath \"$filename\" -out:\"$exeFile\" 2>&1";

    // C# 컴파일
    $compileOutput = shell_exec($compileCommand);

    if ($compileOutput) {
        $compileOutput = iconv("EUC-KR", "UTF-8", $compileOutput);
        $runOutput = "Compilation Error: \n$compileOutput";
    } else {
        // 컴파일된 C# 프로그램 실행
        $runCommand = "$monoPath $exeFile 2>&1";
        $runOutput = shell_exec($runCommand);
    }

    // 사용 후 생성된 파일 삭제
    unlink($filename);
    if (file_exists($exeFile)) {
        unlink($exeFile);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>InjSite</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/csharp.css">
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
    <div class="csharp-container">
        <section class="csharp-language">
            <h2>
                <img src="./image/csharplogo.png" height="250" width="250">
            </h2>
            <h2>C# 언어</h2>
            <p>마이크로소프트가 개발한 다목적 프로그래밍 언어로, 주로 .NET 프레임워크와 함께 사용되며 다양한 응용 프로그램을 개발할 수 있음</p>
            <hr>
            <h3>C# 언어 특징</h3>
            <p>
                장점 1. C#은 <span class="csharp-highlight">객체 지향 프로그래밍</span>을 지원하여 코드 재사용성과 유지보수성이 뛰어남<br>
                장점 2. C#은 <span class="csharp-highlight">강력한 타입 시스템</span>을 갖추고 있어 개발 과정에서 오류를 줄일 수 있음<br>
                장점 3. C#은 <span class="csharp-highlight">가비지 컬렉션</span>을 지원하여 메모리 관리를 자동으로 처리함<br>
                장점 4. C#은 <span class="csharp-highlight">다양한 라이브러리와 프레임워크</span>를 제공하여 생산성을 높임<br>
                단점 1. C#은 NET 프레임워크에 의존적이어서 <span class="csharp-highlight">운영체제와 플랫폼</span>에 대한 종속성이 있을 수 있음<br>
                단점 2. C#은 <span class="csharp-highlight">상대적으로 무거운 실행 파일</span>을 생성할 수 있음<br>
            </p>
            <hr>
            <h3>C# 언어 활용분야</h3>
            <p>
                데스크탑 애플리케이션<br>
                웹 애플리케이션<br>
                모바일 애플리케이션<br>
                게임 개발<br>
                클라우드 서비스<br>
                데이터베이스 어플리케이션<br>
                인공지능 및 머신러닝<br>
                사물 인터넷 (IoT) 어플리케이션<br>
            </p>
            <hr>
            <h3>C# 언어 활용 기본예제</h3>
            <p style="text-align:center">
                <img src="./image/csharpcode.png">
            </p>
            <form method="post">
        <div class="container2">
            <!-- C code input -->
            <textarea name="cs_code"><?php echo htmlspecialchars($csCode, ENT_QUOTES, 'UTF-8', false) ?: htmlspecialchars("
using System;

class Program{
     static void Main(){
          Console.WriteLine(\"Hello, World!\");
     }
}", ENT_QUOTES, 'UTF-8', false);?>
            </textarea>
            <!-- Output display -->
            <textarea readonly><?php echo htmlspecialchars($runOutput, ENT_QUOTES, 'UTF-8', false); ?></textarea>
        </div>
        <br>
        <input type="submit" value="Run C# Code">
    </form>
        </section>        
    </div>
</body>
</html>
