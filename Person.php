<?php

class Person
{
    public $name;

    public $age;

    public function __construct($name, $age)
    {
        $this->name = $name;
        $this->age = $age;
    }
}

$name = trim(fgets(STDIN));
$age = intval(fgets(STDIN));

$person = new Person($name, $age);

?>