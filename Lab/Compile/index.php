<?php
include_once("JavaHandler.php");
session_start();
/**
 * Created by PhpStorm.
 * User: Allen James
 * Date: 8/31/2016
 * Time: 6:27 PM
 */
$input;
$output;

if(isset($_POST['submit']))
{
    $Java = new JavaHandler($_POST['input']);
    $input = $Java->GetInput();
    $output = $Java->GetOutput();
}
else
{
    $input = "";
    $output = "";
}

?>
<HTML>
<header>
    <title>Java Parse Tester</title>
    <link rel="stylesheet" type="text/css" href="../style.css">
    <!-- Create a Code Mirror instance -->

    <link rel="stylesheet" href="codemirror/lib/codemirror.css">
    <link rel=stylesheet" href="codemirror/theme/colorforth.css">
    <script src="codemirror/lib/codemirror.js"></script>
    <link rel="stylesheet" href="codemirror/addon/hint/show-hint.css">
    <script src="codemirror/mode/clike/clike.js"></script>

</header>
<body>
<h1>Welcome, This is the Java Tester!</h1>
<form action="index.php" method="post" >
    <h3>Input:</h3>
    <textarea name="input" id="input" class="java-window"><?php echo $input; ?></textarea>
    <br />
    <input name="submit" type="submit" value="Compile & Run" />
    <hr>
    <br />
    <h3>Output:</h3>
    <textarea readonly name="output" class="java-window"><?php echo $output; ?></textarea>
</form>
</body>
<script>
    var javaEditor = CodeMirror.fromTextArea(document.getElementById("input"), {
        lineNumbers: true,
        matchBrackets: true,
        mode: "text/x-java",
        theme: "default"
    });

</script>
</HTML>

