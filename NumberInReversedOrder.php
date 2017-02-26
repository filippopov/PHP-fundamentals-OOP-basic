<?php

class Number
{
    private $number;

    public function __construct($number)
    {
        $this->number = $number;
    }

    public function reverseNumbers()
    {
        $result = strrev($this->number);
        return $result;
    }


}

$number = trim(fgets(STDIN));

$number = new Number($number);
echo $number->reverseNumbers();
?>