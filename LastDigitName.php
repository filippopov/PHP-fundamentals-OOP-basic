<?php

class Number
{
    private $number;

    public function __construct($number)
    {
        $this->number = $number;
    }

    private function getLastDigit() : int
    {
        $numberCount = strlen($this->number);

        return (int) $this->number[$numberCount - 1];
    }

    public function getNumberWord()
    {
        $digit = $this->getLastDigit();

        switch ($digit) {
            case 1 : {
                return 'one';
            }
            case 2 : {
                return 'two';
            }
            case 3 : {
                return 'three';
            }
            case 4 : {
                return 'four';
            }
            case 5 : {
                return 'five';
            }
            case 6 : {
                return 'six';
            }
            case 7 : {
                return 'seven';
            }
            case 8 : {
                return 'eight';
            }
            case 9 : {
                return 'nine';
            }
            default : {
                return 'zero';
            }
        }
    }
}

$number = trim(fgets(STDIN));

$number = new Number($number);
echo $number->getNumberWord();
?>