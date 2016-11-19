<?php
/**
 * Created by PhpStorm.
 * User: Allen James
 * Date: 9/18/2016
 * Time: 9:55 AM
 */
include_once '../Model/JavaError.php';
include_once '../Model/Database.php';

class ErrorDictionary
{
    private $output;
    private $errors;
    private $error_output;

    public function ErrorDictionary($output)
    {
        $this->output = $output;
        $this->errors = 0;

        $array = explode("\n", $output);

        $upperArray = $array;

        for( $i = 0; $i < count($array) ; $i++)
        {

            $array[$i] = strtolower($array[$i]);

            $offset = strpos($array[$i], "error:");

            if($offset !== false)
            {
                $this->errors++;
                $final = substr($upperArray[$i], $offset + 7, 25);

                $error = new JavaError($final);

                if(strcmp($error->getHint(), "") == 0)
                {
                    $upperArray[$i] = "<a class='tooltip' href=''><span class='tooltiptext'>Sorry, There are no Hints for this Error.</span>" . $upperArray[$i] . "</a>";
                }
                else
                {
                    $upperArray[$i] = "<a class='tooltip' href=''><span class='tooltiptext'>". $error->getHint() ."</span>" . $upperArray[$i] . "</a>";
                }


            }

            $this->error_output = implode("<br />", $upperArray);

        }

    }
    public function GetErrorOutput()
    {
        return $this->error_output;
    }

    public function isError()
    {
        if($this->errors > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

}