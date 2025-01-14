<?php


require_once 'vendor/autoload.php';

use Unity\Animals\AnimalFactory;
use Unity\Zoo\Zoo;

$data = [
    ['name' => 'Kazimierz', 'species' => 'Tygrys', 'eatingBehavior' => 'carnivorous', 'isFurry' => true],
    ['name' => 'Mirosław', 'species' => 'Słoń', 'eatingBehavior' => 'herbivorous', 'isFurry' => false],
    ['name' => 'Mateusz', 'species' => 'Nosorożec', 'eatingBehavior' => 'herbivorous', 'isFurry' => false],
    ['name' => 'Zbigniew', 'species' => 'Lis', 'eatingBehavior' => 'omnivorous', 'isFurry' => true],
    ['name' => 'Wacław', 'species' => 'Irbis', 'eatingBehavior' => 'carnivorous', 'isFurry' => true],
    ['name' => 'Stanisław', 'species' => 'Królik', 'eatingBehavior' => 'herbivorous', 'isFurry' => false],
];
$food = ['meat', 'plant', 'insects'];

$zoo = new Zoo();

$factory = new AnimalFactory();
array_walk($data, function ($animalData) use ($zoo, $factory) {
    $animal = $factory::createAnimal(
        $animalData['name'],
        $animalData['species'],
        [Unity\Animals\EatingBehaviors::class, $animalData['eatingBehavior']],
        $animalData['isFurry']
    );
    $zoo->addAnimal($animal);
});

foreach ($zoo->listAnimals() as $animal) {
    echo $animal . " lives in zoo.\n";
    array_walk($food, function ($foodType) use ($animal) {
        $animal->eat($foodType);
    });
    if (usesTrait($animal, 'Unity\Animals\Groomable')) {
        $animal->groom();
    }
    echo "\n";
}

function usesTrait($object, $trait)
{
    return in_array($trait, class_uses($object));
}
