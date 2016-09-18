<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Allen James
 * Date: 8/27/2016
 * Time: 7:14 PM
 */
include_once '../Model/Lab.php';
include_once '../Compile/JavaHandler.php';
include_once '../Compile/ErrorDictionary.php';

$lab = new Lab($_SESSION['resource_link_id']);

$steps = $lab->getSteps();

if(isset($_POST['compile']))
{
    $java = new JavaHandler($_POST['code_window']);
    $current_step = $_POST['current_step'];
    $code_window = $_POST['code_window'];

    $output = $java->GetOutput();

    $error = new ErrorDictionary($output);

    $output = $error->GetErrorOutput();
}
elseif(isset($_POST['save']))
{
    $current_step = $_POST['current_step'];
    $code_window = "";
    $current_step++;

    echo count($steps);
    echo $current_step;

    if($current_step < count($steps))
    {
        $output = "";
    }
    else
    {
        header( 'Location: exit.php' ) ;
        exit();
    }
}
else
{
    $code_window = "";
    $current_step = 0;
    $output = "";
}

$step = $steps[$current_step];

$instruction = $step->GetInstructions();





//TODO: Implement AJAX to Create "Delete" Buttons on Client Side for Steps

?>
<HTML>
    <header>
        <title>Instructor View</title>
        <link rel="stylesheet" type="text/css" href="style.css" >
        <link rel="stylesheet" href="../Include/codemirror/lib/codemirror.css">
        <link rel=stylesheet" href="../Include/codemirror/theme/colorforth.css">
        <script src="../Include/codemirror/lib/codemirror.js"></script>
        <link rel="stylesheet" href="../Include/codemirror/addon/hint/show-hint.css">
        <script src="../Include/codemirror/mode/clike/clike.js"></script>
    </header>
    <body>
        <h1><?php echo $_SESSION['context_label'] . ": " . $_SESSION['context_title'] . " Lab System" ?></h1>
        <h2>Welcome <?php echo $_SESSION['lis_person_name_given'];  ?>!</h2>
        <hr />
        <div class="lab-window">
            <form action="" method="post">
                <label for="instructions">Instructions</label>
                <br>
                <textarea id="instructions" name="instructions" class=""><?php echo $instruction ?></textarea>
                <br>
                <label for="code_window">Code</label>
                <br>
                <textarea name="code_window" id="code_window" class=""><?php echo $code_window ?></textarea>
                <input type="submit" value="Compile & Run" name="compile" />
                <br>
                <label for="output">Output</label>
                <br>
                <div name="output" id="output" class="output"><?php echo $output ?></div>
                <input type="hidden" name="current_step" value="<?php echo $current_step ?>" />
                <input type="submit" value="Continue" name="save" />
            </form>
        </div>
        <script>
            var javaEditor = CodeMirror.fromTextArea(document.getElementById("code_window"), {
                lineNumbers: true,
                matchBrackets: true,
                mode: "text/x-java",
                theme: "default"
            });
        </script>
    </body>
</HTML>
