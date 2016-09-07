<?php

/**
 * Created by PhpStorm.
 * User: Allen James
 * Date: 9/1/2016
 * Time: 2:35 PM
 */
include_once "Database.php";

class Step
{
    private $instruction;
    private $correct_answer;
    private $expected_output;
    private $step_id;
    private $step_mask;
    private $resource_link_id;

    /**
     * Step constructor.
     * @param $resource_link_id
     * @param int $id
     * @param int $step_mask
     */
    public function Step($resource_link_id, $id = 0, $step_mask = 0)
    {
        if($id == 0)
        {
            $result = NewStep($resource_link_id, $step_mask);

            $this->resource_link_id = $result['resource_link_id'];
            $this->step_id = $result['id'];
            $this->step_mask = $result['step_mask'];
        }
        else
        {
            $result = GetStep($id);

            $this->instruction = $result['instruction'];
            $this->correct_answer = $result['correct_answer'];
            $this->expected_output = $result['expected_output'];
            $this->step_id = $result['id'];
            $this->step_mask = $result['step_mask'];
        }
        return $this;
    }

    public function Save()
    {
        SaveStep($this->instruction, $this->correct_answer, $this->expected_output, $this->step_id, $this->step_mask);
    }

    public function DeleteStep($step_id)
    {
        RemoveStep($step_id);
    }

    public function GetStepMask()
    {
        return $this->step_mask;
    }

    public function GetStepID()
    {
        return $this->step_id;
    }

    public function GetInstructions()
    {
        return $this->instruction;
    }

    public function GetCorrectAnswer()
    {
        return $this->correct_answer;
    }

    public function GetExpectedOutput()
    {
        return $this->expected_output;
    }
}

