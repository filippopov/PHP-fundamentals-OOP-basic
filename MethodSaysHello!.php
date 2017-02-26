<?php
class Person
{
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function sayHello()
    {
        return "{$this->getName()} says \"Hello\"!";
    }
}

$name = trim(fgets(STDIN));
$person = new Person($name);
echo $person->sayHello();
?>
