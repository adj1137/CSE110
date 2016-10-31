<?php
include_once '../Model/Step.php';
include_once '../Model/Lab.php';
include_once '../Compile/JavaHandler.php';

session_start();
/**
 * Created by PhpStorm.
 * User: Allen James
 * Date: 9/2/2016
 * Time: 3:17 PM
 */

$step = new Step($_SESSION['resource_link_id'] , $_GET['step']);

$instruction;
$expected_output;
$correct_answer;

if(isset($_POST['compile'])) //Compile and Run have been set
{
    $java = new JavaHandler($_POST['correct_answer']);

    $java->Compile();
    $java->Run();

    $expected_output = $java->GetOutput();

    $instruction = $_POST['instructions'];

    $correct_answer = $_POST['correct_answer'];

}
elseif(isset($_POST['save']))
{

    $instruction = $_POST['instructions'];

    $correct_answer = $_POST['correct_answer'];

    $expected_output = $_POST['expected_output'];

    $step->SetInstructions($instruction);
    $step->SetCorrectAnswer($correct_answer);
    $step->SetExpectedOutput($expected_output);

    var_dump($step);

    $step->Save();

    header( 'Location: index.php' ) ;
    exit();
}
else
{
    $instruction = $step->GetInstructions();

    $correct_answer = $step->GetCorrectAnswer();

    $expected_output = $step->GetExpectedOutput();
}

?>
<HTML>
<header>
    <title>Instructor View</title>
    <link rel="stylesheet" type="text/css" href="style.css" >

    <!-- Create a Code Mirror instance -->

    <link rel="stylesheet" href="../Include/codemirror/lib/codemirror.css">
    <link rel=stylesheet" href="../Include/codemirror/theme/colorforth.css">
    <script src="../Include/codemirror/lib/codemirror.js"></script>
    <link rel="stylesheet" href="../Include/codemirror/addon/hint/show-hint.css">
    <script src="../Include/codemirror/mode/clike/clike.js"></script>
</header>
<body>
<div class="lab-window">
    <div class="lab-window-header">
        <h1 class="lab-title"><?php echo $_SESSION['resource_link_title']; ?>: Step <?php echo $step->GetStepMask() ?> </h1>
    </div>
    <form action="edit-step.php?step=<?php echo $_GET['step']; ?>" method="post">
        <label for="instructions">Instructions</label>
        <br>
        <textarea id="instructions" name="instructions" class=""><?php echo $instruction ?></textarea>
        <br>
        <label for="correct_answer">Correct Answer</label>
        <br>
        <textarea name="correct_answer" id="correct_answer" class=""><?php echo $correct_answer ?></textarea>
        <input type="submit" value="Compile & Run" name="compile" />
        <br>
        <label for="instructions">Expected Output</label>
        <br>
        <textarea name="expected_output" id="expected_output" class=""><?php echo $expected_output ?></textarea>
        <input type="submit" value="Save Step" name="save" />
    </form>
</div>
</body>
<script>
    var javaEditor = CodeMirror.fromTextArea(document.getElementById("correct_answer"), {
        lineNumbers: true,
        matchBrackets: true,
        mode: "text/x-java",
        theme: "default"
    });
</script>
</HTML>

