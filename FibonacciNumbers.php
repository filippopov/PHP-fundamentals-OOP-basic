<?php

class Fibonacci
{
    private $start;
    private $end;
    private $fib = [];

    public function __construct($start, $end)
    {
        $this->start = $start;
        $this->end = $end;
    }

    private function fibonacci()
    {
        $first = 0;
        $second = 1;
        $this->fib = [$first, $second];
        for($i = 1; $i < $this->end; $i++)
        {
            $this->fib[] = $this->fib[$i] + $this->fib[$i - 1];
        }
    }


    public function getFibonacciNumbers() {
        $this->fibonacci();
        $result = [];
        for ($i = $this->start; $i < $this->end; $i++) {
            $result[] = $this->fib[$i];
        }

        echo implode(', ', $result);
    }
}

$start = trim(fgets(STDIN));
$end = trim(fgets(STDIN));
$fibonacci = new Fibonacci($start,$end);
$fibonacci->getFibonacciNumbers();
?>