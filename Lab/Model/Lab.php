<?php
/**
 * Created by PhpStorm.
 * User: Allen James
 * Date: 8/27/2016
 * Time: 8:12 PM
 */
include_once "Step.php";

class Lab
{
    private $resource_link_id;
    private $due_date;
    private $open_date;
    private $steps;
    private $step_count;

    public function Lab($resource_link_id)
    {
        $Lab = GetLab($resource_link_id);
        if(is_null($Lab))
        {
            $Lab = NewLab($resource_link_id);

            $this->resource_link_id = $resource_link_id;

        }
        else
        {
            $this->resource_link_id = $Lab['resource_link_id'];
            $this->due_date = $Lab['due_date'];
            $this->open_date = $Lab['open_date'];
            $this->steps = $Lab['steps'];
        }

    }
    public function addStep()
    {
        $step = new Step($this->resource_link_id, 0, $this->step_count);

        if(strcmp($this->steps, "") == 0)
        {
            $this->steps .=  $step->GetStepID();
        }
        else
        {
            $this->steps .= ",". $step->GetStepID();
        }

        SaveLab($this->resource_link_id, $this->steps, $this->due_date, $this->open_date);

        return $step;
    }

    public function removeStep($step_id)
    {

    }

    public function getSteps()
    {
        $step_numbers = explode(",", $this->steps);

        if(strcmp($step_numbers[0], "") != 0)
        {
            $result = Array();
            foreach($step_numbers as $id)
            {
                $this->step_count = $this->step_count + 1;
                $result[count($result)] = new Step($this->resource_link_id, $id, $this->step_count);

            }

            return $result;
        }
        else
        {
            return null;
        }

    }



}