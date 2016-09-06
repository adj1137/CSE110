<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Allen James
 * Date: 8/27/2016
 * Time: 7:14 PM
 */
include_once '../Model/Lab.php';

$lab = new Lab($_SESSION['resource_link_id']);

$steps = $lab->getSteps();

?>
<HTML>
    <header>
        <title>Instructor View</title>
        <link rel="stylesheet" type="text/css" href="style.css" >
    </header>
    <body>
        <h1><?php echo $_SESSION['context_label'] . ": " . $_SESSION['context_title'] . " Lab System" ?></h1>
        <h2>Welcome <?php echo $_SESSION['lis_person_name_given'];  ?>!</h2>
        <hr />
        <div class="lab-window">
            <div class="lab-window-header">
                <h1 class="lab-title"><?php echo $_SESSION['resource_link_title']; ?> </h1>
            </div>
            <div class="step-window options-window">
                <p>Lab Settings</p>
                <form action="save-lab.php" method="post">
                    <label for="due_date">Due Date</label>
                    <input type="datetime-local" name="due_date" >
                    <label for="open_date">Open Date</label>
                    <input type="datetime-local" name="open_date" >
                </form>
            </div>
            <?php
            foreach ($steps as $step)
            {
                echo "<div class='step-window'><p><a href='edit-step.php?step=" . $step->GetStepID() ."' >Step ". $step->GetStepMask() . "</a></p><p>" . $step->GetStepInstruction() ."</p><div class='delete'><a  href='step-delete.php?step=" . $step->GetStepID() .  "'>X</a></div> </div>";
            }
            ?>
            <div class="step-window add-step">
                <a href="add-step.php">Add Step</a>
            </div>
        </div>
        <ul>

        </ul>
    </body>
</HTML>
