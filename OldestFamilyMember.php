<?php

class Person
{
    private $name;

    private $age;

    public function __construct($name, $age)
    {
        $this->name = $name;
        $this->age = $age;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getAge()
    {
        return $this->age;
    }

    public function __toString()
    {
        return "{$this->getName()} {$this->getAge()}";
    }
}

class Family
{
    /** @var Person[] $allPersons */
    private $allPersons = [];

    public function setPerson(Person $person)
    {
        $this->allPersons[] = $person;
    }

    public function getOldestFamilyMember()
    {
        $persons = $this->allPersons;
        usort($persons, function (Person $a, Person $b) {
            return $a->getAge() < $b->getAge();
        });

        return isset($persons[0]) ? $persons[0] : '';
    }
}

$countPersons = intval(fgets(STDIN));
$family = new Family();

for ($i = 0; $i < $countPersons; $i++) {
    $personText = trim(fgets(STDIN));
    $personArray = explode(' ', $personText);
    $name = $personArray[0];
    $age = $personArray[1];
    $person = new Person($name, $age);
    $family->setPerson($person);
}

echo $family->getOldestFamilyMember();
?>