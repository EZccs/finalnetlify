<?php
$javaCode = "";
$runOutput = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $javaCode = $_POST["java_code"];
    
    $filename = "TempProgram.java";
    $classFilename = "TempProgram.class";

    file_put_contents($filename, mb_convert_encoding($javaCode, 'UTF-8'));

    if (file_exists($classFilename)) {
        unlink($classFilename);
    }
    
    $compileOutput = shell_exec("javac -encoding UTF-8 $filename 2>&1");
    
    if ($compileOutput) {
        $runOutput = "Compilation Error: \n$compileOutput";
    } else {
        $runOutput = shell_exec("java -Dfile.encoding=UTF-8 TempProgram 2>&1");
        $runOutput = mb_convert_encoding($runOutput, 'UTF-8', 'auto');
    }

    unlink($filename);
    if (file_exists($classFilename)) {
        unlink($classFilename);
    }
}
?>
?>
<!DOCTYPE html>
<html>
<head>
    <title>InjSite - Java</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/java.css">
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
        <h1>InjSite</h1>
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
    <div class="java-container">
        <section class="java-language">
            <h2>
                <img src="./image/javalogo.png" height="250" width="250">
            </h2>
            <h2>Java 언어</h2>
            <p>오라클이 개발하고 유지보수하는 고수준의 프로그래밍 언어로, 플랫폼 독립적이며 다양한 응용 프로그램 개발에 사용됨</p>
            <hr>
            <h3>Java 언어 특징</h3>
            <p>
                장점 1. Java는 <span class="java-highlight">플랫폼 독립성</span>을 제공하여 다양한 환경에서 실행 가능<br>
                장점 2. Java는 <span class="java-highlight">객체 지향 프로그래밍</span>을 지원하여 코드의 재사용성과 유지보수성이 뛰어남<br>
                장점 3. Java는 <span class="java-highlight">자동 메모리 관리</span>(가비지 컬렉션)를 통해 메모리 누수를 방지<br>
                장점 4. Java는 <span class="java-highlight">강력한 보안 기능</span>을 제공하여 안전한 프로그램을 개발 가능<br>
                단점 1. Java는 <span class="java-highlight">상대적으로 느린 실행 속도</span>를 가질 수 있음<br>
                단점 2. Java는 <span class="java-highlight">상당한 메모리</span>를 요구할 수 있음<br>
            </p>
            <hr>
            <h3>Java 언어 활용분야</h3>
            <p>
                웹 애플리케이션<br>
                모바일 애플리케이션 (특히 안드로이드)<br>
                서버 애플리케이션<br>
                금융 서비스<br>
                대규모 시스템 개발<br>
                데이터베이스 연동 어플리케이션<br>
            </p>
            <hr>
            <h3>Java 언어 활용 기본예제</h3>
            <p style="text-align:center">
                <img src="./image/javacode.png">
            </p>
            <form method="post">
            <div class="container2">
            <!-- Java code input -->
            <textarea name="java_code"><?php echo htmlspecialchars($javaCode, ENT_QUOTES, 'UTF-8', false) ?: htmlspecialchars("
public class TempProgram {
    public static void main(String[] args) {
        System.out.println(\"Hello, World!\");
    }
}
", ENT_QUOTES, 'UTF-8', false); ?></textarea>
            <!-- Output display -->
            <textarea readonly><?php echo htmlspecialchars($runOutput, ENT_SUBSTITUTE, 'UTF-8', false); ?></textarea>
                </div>
                <br>
                <input type="submit" value="Run Java Code">
            </form>
        </section>
    </div>
</body>
</html>
