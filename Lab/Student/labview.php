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
include_once '../Model/Database.php';


//TODO: Timer: Get current time (start time) and save to DB, Retrieve alotted time from instructor
// check if (current time > alottedTime + startTime) *need to call time() for current time again
//      then close lab echo message


$lab = new Lab($_SESSION['resource_link_id']);

$steps = $lab->getSteps();


if(isset($_POST['save']))
{
    $java = new JavaHandler($_POST['code_window']);
    $java->setResourceLinkID($_SESSION['resource_link_id']);
    $java->setUserID($_SESSION['user_id']);
    $java->Compile();
    $current_step = $_POST['current_step'];
    $code_window = $_POST['code_window'];

    $current_time = $date = date('Y-m-d H:i:s');
    $start_time = DateTime::createFromFormat('Y-m-d H:i:s', checkTimer($_SESSION['resource_link_id'], $_SESSION['user_id'])[0]);

    $interval = date_diff($start_time, $current_time);

    $output = $java->GetOutput();

    $error = new ErrorDictionary($output);

    $output = $error->GetErrorOutput();

    if($error->isError())
    {

    }
    else
    {
        if($current_step < $lab->getNumberSteps())
        {
            $current_step++;
        }
        elseif($current_step == $lab->getNumberSteps())
        {
            header( 'Location: exit.php' ) ;
            exit();
        }
        else
        {
            echo "<h1>There was an error.</h1>";
        }
    }
}
else {
    startTimer($_SESSION['resource_link_id'], $_SESSION['user_id']);
    $current_time = DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));
    $start_time = DateTime::createFromFormat('Y-m-d H:i:s', checkTimer($_SESSION['resource_link_id'], $_SESSION['user_id'])[0]);

    $interval = date_diff($start_time, $current_time);
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

        <link rel="stylesheet" type="text/css" href="../Style/css/bootstrap.css' ?>">
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" href="../Include/codemirror/lib/codemirror.css">
        <link rel=stylesheet" href="../Include/codemirror/theme/colorforth.css">
        <script src="../Include/codemirror/lib/codemirror.js"></script>
        <link rel="stylesheet" href="../Include/codemirror/addon/hint/show-hint.css">
        <script src="../Include/codemirror/mode/clike/clike.js"></script>
    </header>
    <body>
        <div class="main">
            <form action="" method="post">
            <div class="header">
                <div class="instructions">
                    <textarea id="instructions" name="instructions" class=""><?php echo $instruction ?></textarea>
                </div>
                <div class="info">
                    <h1><?php echo $_SESSION['resource_link_title']; ?></h1>
                    <h1 id="timer"><?php echo $interval->format('%h:%i:%s'); ?></h1>
                    <input type="hidden" name="current_step" value="<?php echo $current_step ?>">
                </div>
            </div>
            <div class="coding-window" id="coding-window" onresize="resizeWindow()">
                <textarea name="code_window" id="code_window" class=""><?php echo $code_window ?></textarea>
            </div>
            <div class="navigation">
                <input type="submit" value="Continue" name="save" />
            </div>
            <div class="footer">
                <div class="output-area">
                    <?php echo $output ?></textarea>
                </div>
                <div class="output-help">

                </div>
            </div>
            </form>
        </div>

            </form>

        </div>
        <script>
            var javaEditor = CodeMirror.fromTextArea(document.getElementById("code_window"), {
                lineNumbers: true,
                matchBrackets: true,
                mode: "text/x-java",
                theme: "default"
            });
            var clientHeight = document.getElementById('coding-window').clientHeight;
            var clientWidth = document.getElementById('coding-window').clientWidth;

            javaEditor.setSize(clientWidth, clientHeight);

            function resizeWindow()
            {
                var clientHeight = document.getElementById('coding-window').clientHeight;
                var clientWidth = document.getElementById('coding-window').clientWidth;

                javaEditor.setSize(clientWidth, clientHeight);
            }
        </script>
    </body>
</HTML>
