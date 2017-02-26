<?php

class Person
{
    private $name;

    private $age;

    public function __construct($name, $age)
    {
        $this->setName($name);
        $this->setAge($age);
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setAge($age)
    {
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
        return "{$this->getName()} - {$this->getAge()}";
    }
}

class PersonDB
{
    /** @var Person[] $allFilterPersons*/
    private $allFilterPersons = [];

    public function setPerson(Person $person)
    {
        if ($person->getAge() > 30) {
            $this->allFilterPersons[] = $person;
        }
    }

    public function getPersonsOrderAndFilter()
    {
        usort($this->allFilterPersons, function (Person $a, Person $b){
            return $a->getName() > $b->getName();
        });

        for ($i = 0; $i < count($this->allFilterPersons); $i++) {
            echo $this->allFilterPersons[$i];

            if ($i < (count($this->allFilterPersons) - 1)) {
                echo PHP_EOL;
            }
        }
    }
}

$count = intval(fgets(STDIN));
$personDB = new PersonDB();

for ($i = 0; $i < $count; $i++) {
    $personTest = trim(fgets(STDIN));
    $personArray = explode(' ', $personTest);
    $name = $personArray[0];
    $age = $personArray[1];

    $person = new Person($name, $age);
    $personDB->setPerson($person);
}
$personDB->getPersonsOrderAndFilter();