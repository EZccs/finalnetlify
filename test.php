<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $code = $_POST['code']; // 사용자가 입력한 코드
    $language = $_POST['language']; // 사용자가 선택한 언어 (Java, C++ 등)

    $filename = 'temp.' . ($language === 'java' ? 'java' : 'cpp');
    file_put_contents($filename, $code);

    if ($language === 'java') {
        $output = shell_exec("javac $filename 2>&1"); // Java 컴파일
        if (!$output) {
            $output = shell_exec("java " . pathinfo($filename, PATHINFO_FILENAME) . " 2>&1"); // Java 실행
        }
    } elseif ($language === 'cpp') {
        $output = shell_exec("c++ $filename -o temp.out 2>&1"); // C++ 컴파일
        if (!$output) {
            $output = shell_exec("./temp.out 2>&1"); // C++ 실행
        }
    }

    echo "<pre>$output</pre>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>InjSite - Java</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/java.css">
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
    <form method="post">
        <textarea name="code" rows="10" cols="50"></textarea><br>
        <select name="language">
            <option value="java">Java</option>
            <option value="cpp">C++</option>
        </select><br>
        <input type="submit" value="Run">
    </form>
</body>
</html>

