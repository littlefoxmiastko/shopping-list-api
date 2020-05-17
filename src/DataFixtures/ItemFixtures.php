<?php
declare(strict_types=1);

namespace App\DataFixtures;


use App\Entity\Item;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ItemFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        for($i=0; $i<20; $i++) {
            $product = new Item();
            $product->setDone(false);
            $product->setQuantity($faker->numberBetween(1,10));
            $product->setUnit('kg');
            $product->setName($faker->words(3, true));
            $manager->persist($product);
        }
        $manager->flush();
    }
}