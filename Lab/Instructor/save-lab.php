<?php
session_start();
include_once "../Model/Lab.php";
include_once "../Include/functions.php";

if(isset($_POST['save']))
{
    $Lab = new Lab($_SESSION['resource_link_id']);

    $Lab->setOpenDate($_POST['open_date']);

    $Lab->setDueDate($_POST['due_date']);

    $Lab->setTimerVal($_POST['alotted_time']);

    $Lab->save();

    Redirect("index.php");

    $input = $_FILES['inputFile'];
    $output = $_FILES['outputFile'];


    //Traverse inputs and if not empty store input and corresponding output in compile folder
    $i = 0;
    while(strcmp($input['name'][$i], "") != 0){
        $path_in = $_SERVER['DOCUMENT_ROOT'] . "/CSE110/Lab/Compile/" . $_SESSION['resource_link_id'] . "/" . "input/";
        $path_out = $_SERVER['DOCUMENT_ROOT'] . "/CSE110/Lab/Compile/" . $_SESSION['resource_link_id'] . "/" . "output/";
        if (!file_exists($path_in)) {
            mkdir($path_in, 0777, true);
        }
        if (!file_exists($path_out)) {
            mkdir($path_out, 0777, true);
        }
        move_uploaded_file($input['tmp_name'][$i], $path_in . "in". $i . ".txt");
        move_uploaded_file($output['tmp_name'][$i], $path_out . "out". $i . ".txt");
        $i++;
    }
}

function reArrayFiles($file)
{
    $file_ary = array();
    $file_count = count($file['name']);
    $file_key = array_keys($file);

    for($i=0;$i<$file_count;$i++)
    {
        foreach($file_key as $val)
        {
            $file_ary[$i][$val] = $file[$val][$i];
        }
    }
    return $file_ary;
}

?>