<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Allen James
 * Date: 8/27/2016
 * Time: 7:14 PM
 */
include_once '../Compile/ErrorDictionary.php';
include_once '../Model/JavaError.php';

$errors = GetAllErrors();

//TODO: Implement AJAX to Create "Delete" Buttons on Client Side for Steps

?>
<HTML>
<header>
    <title>Instructor View</title>
    <link rel="stylesheet" type="text/css" href="style.css" >
</header>
<body>
<div class="lab-window">
    <div class="lab-window-header">
        <h1 class="lab-title">Error Console</h1>
    </div>
    <div class="step-window options-window">

    </div>
    <?php
    if(!is_null($errors))
    {
        foreach ($errors as $error)
        {
            echo "<div class='step-window'>" . $error[1] ."<textarea>" . $error[2] . "</textarea></div>";
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
