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


if(isset($_POST['save']))
{

    $instruction = $_POST['instructions'];

    $step->SetInstructions($instruction);
    echo var_dump($step);

    $step->Save();

    //header( 'Location: index.php' ) ;
    //exit();
}
else
{
    $instruction = $step->GetInstructions();
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


