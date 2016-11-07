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

//TODO: Implement AJAX to Create "Delete" Buttons on Client Side for Steps

//TODO: Add a 3 X 10 table, create input and output test cases

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
        <form action="save-lab.php" method="post" enctype="multipart/form-data">
            <label for="open_date">Open Date:</label>
            <input type="datetime-local" name="open_date" >
            <label for="due_date">Due Date:</label>
            <input type="datetime-local" name="due_date" >
            <label for="alotted_time">Time Allowed:</label>
            <input type="time" name="alotted_time" >
            <table style="margin-top: 0.8rem">
                <tr>
                    <th><!-- to be left blank as placeholder --></th>
                    <th>Input Test Cases (.txt)</th>
                    <th>Output Test Cases (.txt)</th>
                </tr>
                <tr>
                    <td>1: </td>
                    <td><input type= "file" name = "inputFile[]"/></td>
                    <td><input type= "file" name = "outputFile[]"/></td>
                </tr>
                <tr>
                    <td>2: </td>
                    <td><input type= "file" name = "inputFile[]"/></td>
                    <td><input type= "file" name = "outputFile[]"/></td>
                </tr>
                <tr>
                    <td>3: </td>
                    <td><input type= "file" name = "inputFile[]"/></td>
                    <td><input type= "file" name = "outputFile[]"/></td>
                </tr>
                <tr>
                    <td>4: </td>
                    <td><input type= "file" name = "inputFile[]"/></td>
                    <td><input type= "file" name = "outputFile[]"/></td>
                </tr>
                <tr>
                    <td>5: </td>
                    <td><input type= "file" name = "inputFile[]"/></td>
                    <td><input type= "file" name = "outputFile[]"/></td>
                </tr>
                <tr>
                    <td>6: </td>
                    <td><input type= "file" name = "inputFile[]"/></td>
                    <td><input type= "file" name = "outputFile[]"/></td>
                </tr>
                <tr>
                    <td>7: </td>
                    <td><input type= "file" name = "inputFile[]"/></td>
                    <td><input type= "file" name = "outputFile[]"/></td>
                </tr>
                <tr>
                    <td>8: </td>
                    <td><input type= "file" name = "inputFile[]"/></td>
                    <td><input type= "file" name = "outputFile[]"/></td>
                </tr>
                <tr>
                    <td>9: </td>
                    <td><input type= "file" name = "inputFile[]"/></td>
                    <td><input type= "file" name = "outputFile[]"/></td>
                </tr>
                <tr>
                    <td>10: </td>
                    <td><input type= "file" name = "inputFile[]"/></td>
                    <td><input type= "file" name = "outputFile[]"/></td>
                </tr>
            </table>
            <input type="submit" value ="Save Lab" style="margin-top: 0.8rem">
        </form>
    </div>
    <?php
    if(!is_null($steps))
    {
        foreach ($steps as $step)
        {
            echo "<div class='step-window'><p><a href='edit-step.php?step=" . $step->GetStepID() ."'>Step ". $step->GetStepMask() . "</a></p><p>" . $step->GetInstructions() ."</p><div class='delete'><a  href='step-delete.php?step=" . $step->GetStepID() .  "'>X</a></div> </div>";
        }
    }
    if(isset($_FILES['inputFile'])){
        //Example: script to grab for first file of input files array; can be used for outputFile array
        //
        //$file_name = $_FILES['inputFile']['name'][0];
        //$file_size =$_FILES['inputFile']['size'][0];
        //$file_type=$_FILES['inputFile']['type'][0];
        //$file_ext=strtolower(end(explode('.',$_FILES['inputFile']['name'][0])));

        $errors= array();
        $extensions= array("txt");

        if(in_array($file_ext,$extensions)=== false){
            $errors[]="extension not allowed, please choose a .txt file.";
        }

        if(empty($errors)==true){
            //This is where we can upload to database
            //move_uploaded_file($file_tmp,"files/".$file_name);
            echo "Success";
        }else{
            print_r($errors);
        }
    }

    ?>
    <div class="step-window add-step">
        <a href="add-step.php">Add Step</a>
    </div>
    <a href="error-console.php">Error Console</a>
</div>
</body>
</HTML>
