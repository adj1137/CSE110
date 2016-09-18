<?php
session_start();

include_once '../Lab/Include/functions.php';


//Collect All Connection Info into Session
//$_SESSION['user_data'] = $_POST;

$_SESSION['user_id'] = $_POST['user_id'];
$_SESSION['roles'] = $_POST['roles'];
$_SESSION['resource_link_id'] = $_POST['resource_link_id'];
$_SESSION['resource_link_title'] = $_POST['resource_link_title'];
$_SESSION['resource_link_description'] = $_POST['resource_link_description'];
$_SESSION['context_title'] = $_POST['context_title'];
$_SESSION['context_label'] = $_POST['context_label'];
$_SESSION['lis_person_name_given'] = $_POST['lis_person_name_given'];
$_SESSION['user_id'] = $_POST['user_id'];


//TODO: Add OAuth Authentication to verify connection



if(strcmp($_SESSION['roles'], 'Learner') == 0)
{
    Redirect('../Lab/Student/index.php');
}
elseif(strcmp($_SESSION['roles'], 'Instructor') == 0)
{
    Redirect('../Lab/Instructor/index.php');
}
else
{

}



echo '<pre>';
echo var_dump($_SESSION['user_data']);
echo '</pre>';
?>