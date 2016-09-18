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

        $array = explode("\n", $output);

        echo "<pre>";
        echo var_dump($array);
        echo "</pre>";

        for( $i = 0; $i < count($array) ; $i++)
        {
            $array[$i] = strtolower($array[$i]);

            $offset = strpos($array[$i], "error:");

            if($offset !== false)
            {

                $final = substr($array[$i], $offset + 7, 25);

                $error = new JavaError($final);

                echo "<pre>";
                echo var_dump($error);
                echo "</pre>";

                if(strcmp($error->getHint(), "") == 0)
                {
                    $array[$i] = "<a class='tooltip' href=''><span class='tooltiptext'>Sorry, There are no Hints for this Error.</span>" . $array[$i] . "</a>";
                }
                else
                {
                    $array[$i] = "<a class='tooltip' href=''><span class='tooltiptext'>". $error->getHint() ."</span>" . $array[$i] . "</a>";
                }


            }


            $this->error_output = implode("<br />", $array);

        }

    }
    public function GetErrorOutput()
    {
        return $this->error_output;
    }

}