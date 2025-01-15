<?php
require_once 'vendor/autoload.php';

use Unity\Animals\AnimalFactory;
use Unity\Zoo\Zoo;

$food = ['meat', 'plant', 'insects'];
$animals = [
    ['name' => 'Kazimierz', 'species' => 'Tygrys', 'eatingBehavior' => 'carnivorous', 'isFurry' => true],
    ['name' => 'Mirosław', 'species' => 'Słoń', 'eatingBehavior' => 'herbivorous', 'isFurry' => false],
    ['name' => 'Mateusz', 'species' => 'Nosorożec', 'eatingBehavior' => 'herbivorous', 'isFurry' => false],
    ['name' => 'Zbigniew', 'species' => 'Lis', 'eatingBehavior' => 'omnivorous', 'isFurry' => true],
    ['name' => 'Wacław', 'species' => 'Irbis', 'eatingBehavior' => 'carnivorous', 'isFurry' => true],
    ['name' => 'Stanisław', 'species' => 'Królik', 'eatingBehavior' => 'herbivorous', 'isFurry' => false],
];

$factory = new AnimalFactory();

array_walk($animals, function ($data) use ($factory) {
    $animal = $factory->createAnimal( // Create an animal object
        $data['name'],
        $data['species'],
        [Unity\Animals\EatingBehaviors::class, $data['eatingBehavior']],
        $data['isFurry']
    );
    Zoo::create()->addAnimal($animal); // Zoo is a singleton
});

foreach (Zoo::create()->listAnimals() as $animal) {
    echo $animal . "\n"; // Prints species and animal name
    array_walk($food, function ($foodType) use ($animal) {
        $animal->eat($foodType); // Feed the animal
    });
    if (usesTrait($animal, 'Unity\Animals\Groomable')) {
        $animal->groom(); // Groom the animal
    }
    echo "\n";
}

function usesTrait($object, $trait)
{
    return in_array($trait, class_uses($object));
}
