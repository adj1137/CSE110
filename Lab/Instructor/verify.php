<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Allen James
 * Date: 8/27/2016
 * Time: 9:10 PM
 */
include_once '../Include/database.php';
include_once '../Model/Lab.php';

//$java = new Java();

//$answer = $java->CompileJavaCode('1234', 'Noop', $_POST['correct_answer']);

//echo $answer;

$Lab =  CheckResourceLinkID("124324342894629834629864");
$Lab->setInstruction($_POST['instruction']);
$Lab->setCorrectAnswer($_POST['answer']);

echo UpdateLab($Lab);