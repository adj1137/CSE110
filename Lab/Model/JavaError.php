<?php

/**
 * Created by PhpStorm.
 * User: Allen James
 * Date: 9/18/2016
 * Time: 10:20 AM
 */
include_once  "Database.php";

class JavaError
{
    private $error;
    private $hint;

    public function JavaError($error)
    {
        $result = GetError(inputScrubbing($error));

        if(is_null($result))
        {
           $result = NewError(inputScrubbing($error), "");
        }
        $this->error = $result['error'];
        $this->hint = $result['hint'];
    }

    public function getError()
    {
        return $this->error;
    }

    public function getHint()
    {
        return $this->hint;
    }
}

function inputScrubbing($input)
{
    return str_replace("'", "''", $input);
}

function AllErrors()
{
    GetAllErrors();
}