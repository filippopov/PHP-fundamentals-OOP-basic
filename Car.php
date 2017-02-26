<?php

class Car
{
    private $speed;

    private $fuel;

    private $fuelEconomy;

    private $distance;

    public function __construct($speed, $fuel, $fuelEconomy)
    {
        $this->speed = $speed;
        $this->fuel = $fuel;
        $this->fuelEconomy = $fuelEconomy;
        $this->distance = 0;
    }

    public function getSpeed()
    {
        return $this->speed;
    }

    public function getFuel()
    {
        return $this->fuel;
    }

    public function getFuelEconomy()
    {
        return $this->fuelEconomy;
    }

    public function getDistance(): int
    {
        return $this->distance;
    }

    public function travel($distance)
    {
        $coef = $this->fuelEconomy / 100;
        $needFuel = $coef * $distance;
        if ($this->fuel >= $needFuel) {
            $this->distance += $distance;
            $this->fuel -= $needFuel;
        } else {
            $distance = $needFuel / $coef;
            $this->distance += $distance;
            $this->fuel = 0;
        }
    }

    public function distance()
    {
        return $this->distance();
    }

    public function refuel($fuel)
    {
        $this->fuel += $fuel;
    }

    public function getTime()
    {
        return $this->getDistance() / $this->speed;
    }

    public function distanceCommand()
    {
        $distance = number_format($this->distance, 1);
        $result = "Total Distance: {$distance}";
        return $result;
    }

    public function timeCommand()
    {
        $hours = intval($this->getTime());
        $minutes = $this->getTime() - $hours;
        $minutes = intval(60 * $minutes);

        $result = "Total Time: {$hours} hours and {$minutes} minutes";
        return $result;
    }

    public function fuelCommand()
    {
        $fuel = number_format($this->getFuel(), 1);
        $result = "Fuel left: {$fuel} liters";
        return $result;
    }

    public function __toString()
    {
        $distance = number_format($this->distance, 1);
        $fuel = number_format($this->getFuel(), 1);
        $hours = intval($this->getTime());
        $minutes = $this->getTime() - $hours;
        $minutes = intval(60 * $minutes);

        $result = "Total Distance: {$distance} kilometers" . PHP_EOL;
        $result .= "Total Time: {$hours} hours and {$minutes} minutes" . PHP_EOL;
        $result .= "Fuel left: {$fuel} liters";

        return $result;
    }
}

$carData = trim(fgets(STDIN));
$carDataArray = explode(' ', $carData);
$speed = $carDataArray[0];
$fuel = $carDataArray[1];
$fuelEconomy = $carDataArray[2];
$car = new Car($speed, $fuel, $fuelEconomy);

$command = trim(fgets(STDIN));

while ($command != 'END') {
    $commandArray = explode(' ', $command);
    $commandText = $commandArray[0];
    $commandParam = 0;

    if (count($commandArray) == 2) {
        $commandParam = $commandArray[1];
    }
    $result = '';
    switch ($commandText) {
        case 'Travel': {
            $car->travel($commandParam);
            break;
        }
        case 'Refuel': {
            $car->refuel($commandParam);
            break;
        }
        case 'Distance' : {
            $result = $car->distanceCommand();
            break;
        }
        case 'Time' : {
            $result = $car->timeCommand();
            break;
        }
        case 'Fuel' : {
            $result = $car->fuelCommand();
            break;
        }
    }

    echo $result;
    $command = trim(fgets(STDIN));
    if ($command != 'END') {
        echo PHP_EOL;
    }
}
?>
