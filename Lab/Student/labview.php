<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Allen James
 * Date: 8/27/2016
 * Time: 7:14 PM
 */
include_once '../Model/Lab.php';
include_once '../Model/Step.php';
include_once '../Compile/JavaHandler.php';
include_once '../Compile/ErrorDictionary.php';
include_once '../Model/Database.php';
include_once  '../Include/functions.php';



$lab = new Lab($_SESSION['resource_link_id']);

$steps = $lab->getSteps();

$timer = Timer($_SESSION['resource_link_id'], $_SESSION['user_id'], $lab->getTimerVal());

$action = "";

if(!$timer)
{
   Redirect("time-up.php");
}
else
{

}


if(isset($_POST['save']))
{
    $java = new JavaHandler($_POST['code_window']);
    $java->setResourceLinkID($_SESSION['resource_link_id']);
    $java->setUserID($_SESSION['user_id']);
    $java->Compile();
    $current_step = $_POST['current_step'];
    $code_window = $_POST['code_window'];

    $output = $java->GetOutput();

    $error = new ErrorDictionary($output);

    $output = $error->GetErrorOutput();

    if(!$error->isError())
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
        <title>Student View</title>

        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" href="../Include/codemirror/lib/codemirror.css">
        <link rel=stylesheet" href="../Include/codemirror/theme/colorforth.css">
        <script src="../Include/codemirror/lib/codemirror.js"></script>
        <link rel="stylesheet" href="../Include/codemirror/addon/hint/show-hint.css">
        <script src="../Include/codemirror/mode/clike/clike.js"></script>
    </header>
    <body onload="">
        <div class="main">
            <form id="form" action="" method="post">
            <div class="header">
                <div class="instructions">
                    <textarea readonly id="instructions" name="instructions" class=""><?php echo $instruction ?></textarea>
                </div>
                <div class="info">
                    <h1><?php echo $_SESSION['resource_link_title']; ?></h1>
                    <h2>Time Remaining</h2>
                    <h1 id="timer"><?php echo $timer->format("%H:%I:%S") ?></h1>
                    <input type="hidden" name="current_step" value="<?php echo $current_step ?>">
                </div>
            </div>
            <div class="coding-window" id="coding-window" onresize="resizeWindow()">
                <textarea name="code_window" id="code_window" class=""><?php echo $code_window ?></textarea>
            </div>
            <div class="navigation">
                <input type="submit" value="Continue" id="save" name="save" />
            </div>
            <div class="footer">
                <div class="output-area">
                    <?php echo $output ?>
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
        <script type="text/javascript">
            function count() {

                var startTime = document.getElementById('timer').innerHTML;
                var pieces = startTime.split(":");
                var time = new Date();    time.setHours(pieces[0]);
                time.setMinutes(pieces[1]);
                time.setSeconds(pieces[2]);
                var timedif = new Date(time.valueOf() - 1000);
                if(timedif.getHours() == 0 && timedif.getMinutes() == 0 && timedif.getSeconds() == 0)
                {
                    timeUpFormLaunch("time-up.php");
                   //window.location ="time-up.php";
                }
                else
                {
                    var newtime = timedif.toTimeString().split(" ")[0];
                    document.getElementById('timer').innerHTML=newtime;
                    setTimeout(count, 1000);
                }

            }
            count();

            function timeUpFormLaunch(timeUpPage)
            {
                var form = document.getElementById("form");
                form.setAttribute("action", timeUpPage)

                document.getElementById("save").click();
            }

        </script>
    </body>
</HTML>
<script>

</script>
