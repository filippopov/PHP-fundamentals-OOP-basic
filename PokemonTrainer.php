<?php

class Pokemon
{
    private $name;
    private $element;
    private $health;

    public function __construct($name, $element, $health)
    {
        $this->name = $name;
        $this->element = $element;
        $this->health = $health;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getElement()
    {
        return $this->element;
    }

    public function getHealth()
    {
        return $this->health;
    }

    public function removeHealth()
    {
        $this->health -= 10;
    }

    public function isAlive() : bool
    {
        return $this->getHealth() > 0;
    }
}

class Trainer
{
    private $name;

    private $numberOfBadges;

    /** @var Pokemon[] $pokemonCollection*/
    private $pokemonCollection = [];

    public function __construct($name)
    {
        $this->name = $name;
        $this->numberOfBadges = 0;
    }

    private function updateNumberOfBadges()
    {
        $this->numberOfBadges++;
    }

    public function getNumberOfBadges(): int
    {
        return $this->numberOfBadges;
    }

    public function setPokemon(Pokemon $pokemon)
    {
        $this->pokemonCollection[$pokemon->getName()] = $pokemon;
    }

    public function checkPokemonElement($element)
    {
        $findPokemon = false;
        foreach ($this->pokemonCollection as $pokemon)
        {
            if ($pokemon->getElement() == $element) {
                $this->updateNumberOfBadges();
                $findPokemon = true;
                break;
            }
        }

        if (! $findPokemon) {
            foreach ($this->pokemonCollection as $pokemon)
            {
                $pokemon->removeHealth();
                if (! $pokemon->isAlive()) {
                    unset($this->pokemonCollection[$pokemon->getName()]);
                }
            }
        }
    }

    public function __toString()
    {
        $countPokemon = count($this->pokemonCollection);
        return "{$this->name} {$this->getNumberOfBadges()} {$countPokemon}";
    }
}

$trainersAndPokemon = trim(fgets(STDIN));

$resultArray = [];

while ($trainersAndPokemon != 'Tournament') {
    $trainersAndPokemonArray = explode(' ', $trainersAndPokemon);
    $trainerName = $trainersAndPokemonArray[0];
    $pokemonName = $trainersAndPokemonArray[1];
    $element = $trainersAndPokemonArray[2];
    $health = $trainersAndPokemonArray[3];

    $pokemon = new Pokemon($pokemonName, $element, $health);

    if (! isset($resultArray[$trainerName])) {
        $trainer = new Trainer($trainerName);
        $trainer->setPokemon($pokemon);
        $resultArray[$trainerName] = $trainer;
    } else {
        $resultArray[$trainerName]->setPokemon($pokemon);
    }

    $trainersAndPokemon = trim(fgets(STDIN));
}

$elements = trim(fgets(STDIN));
$elementArray = [];
while ($elements != 'End') {
    $elementArray[] = $elements;
    $elements = trim(fgets(STDIN));
}

foreach ($elementArray as $elementValue) {
    foreach ($resultArray as $trainerValue) {
        $trainerValue->checkPokemonElement($elementValue);
    }
}

$result = [];

usort($resultArray, function (Trainer $a, Trainer $b) {
    return $a->getNumberOfBadges() < $b->getNumberOfBadges();
});

foreach ($resultArray as $value) {
    $result[] = $value;
}

for ($i = 0; $i < count($result); $i++) {
    echo $result[$i];
    if ($i < (count($result) - 1)) {
        echo PHP_EOL;
    }
}
?>