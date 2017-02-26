<?php

class Engine
{
    private $model;

    private $power;

    private $displacement;

    private $efficiency;

    public function __construct($model, $power, $displacement, $efficiency)
    {
        $this->model = $model;
        $this->power = $power;
        $this->displacement = $displacement;
        $this->efficiency = $efficiency;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function getPower()
    {
        return $this->power;
    }

    public function getDisplacement()
    {
        return $this->displacement;
    }

    public function getEfficiency()
    {
        return $this->efficiency;
    }

    public function __toString()
    {
        $result = "{$this->getModel()}:" . PHP_EOL;
        $result .= "    Power: {$this->getPower()}" . PHP_EOL;
        $result .= "    Displacement: {$this->getDisplacement()}" . PHP_EOL;
        $result .= "    Efficiency: {$this->getEfficiency()}";

        return $result;
    }
}

class Car
{
    private $model;
    private $engine;
    private $weight;
    private $color;

    public function __construct($model, Engine $engine, $weight, $color)
    {
        $this->model = $model;
        $this->engine = $engine;
        $this->weight = $weight;
        $this->color = $color;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function getEngine(): Engine
    {
        return $this->engine;
    }

    public function getWeight()
    {
        return $this->weight;
    }

    public function getColor()
    {
        return $this->color;
    }

    public function __toString()
    {
        $result = "{$this->getModel()}:" . PHP_EOL;
        $result .= "  {$this->getEngine()}" . PHP_EOL;
        $result .= "  Weight: {$this->getWeight()}" . PHP_EOL;
        $result .= "  Color: {$this->getColor()}";

        return $result;
    }
}



$engineCounter = intval(fgets(STDIN));
$engineArrayData = [];
$carArrayData = [];

for ($i = 0; $i < $engineCounter; $i++) {
    $engineText = trim(fgets(STDIN));
    $engineArray = explode(' ', $engineText);
    $model = $engineArray[0];
    $power = $engineArray[1];
    $displacement = 'n/a';
    $efficiency = 'n/a';

    if (count($engineArray) == 4) {
        $displacement = $engineArray[2];
        $efficiency = $engineArray[3];
    } elseif (count($engineArray) == 3) {
        if (is_numeric($engineArray[2])) {
            $displacement = $engineArray[2];
        } else {
            $efficiency = $engineArray[2];
        }
    }

    $engine = new Engine($model, $power, $displacement, $efficiency);
    $engineArrayData[$model] = $engine;
}

$carCounter = intval(fgets(STDIN));

for ($i = 0; $i < $carCounter; $i++) {
    $carText = trim(fgets(STDIN));
    $carArray = explode(' ', $carText);

    $model = $carArray[0];
    $engineName = $carArray[1];
    $weight = 'n/a';
    $color = 'n/a';

    if (count($carArray) == 4) {
        $weight = $carArray[2];
        $color = $carArray[3];
    } elseif (count($carArray) == 3) {
        if (is_numeric($carArray[2])) {
            $weight = $carArray[2];
        } else {
            $color = $carArray[2];
        }
    }

    $car = new Car($model, $engineArrayData[$engineName], $weight, $color);
    $carArrayData[] = $car;
}

for ($i = 0; $i < count($carArrayData); $i++) {
    echo $carArrayData[$i];
    if ($i < (count($carArrayData) - 1)) {
        echo PHP_EOL;
    }
}
?>