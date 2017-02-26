<?php

class DateModifier
{
    private $firstDate;

    private $secondDate;

    public function __construct($firstDate, $secondDate)
    {
        $this->firstDate = $firstDate;
        $this->secondDate = $secondDate;
    }

    public function getDays()
    {
        $firstDate = explode(' ', $this->firstDate);
        $firstDate = implode('-', $firstDate);
        $endDate = explode(' ', $this->secondDate);
        $endDate = implode('-', $endDate);
        $start = strtotime($firstDate);
        $end = strtotime($endDate);

        $days_between = ceil(abs($end - $start) / 86400);
        return $days_between;
    }
}

$firstDate = trim(fgets(STDIN));
$secondDate = trim(fgets(STDIN));

$dateModifier = new DateModifier($firstDate, $secondDate);
echo $dateModifier->getDays();
?>