<?php


namespace App;


class Budget
{

    public $date;
    public $value;
    /**
     * Budget constructor.
     */
    public function __construct($date, $value)
    {
        $this->date = $date;
        $this->value = $value;
    }


}