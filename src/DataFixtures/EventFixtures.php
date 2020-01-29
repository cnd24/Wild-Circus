<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Event;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class EventFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
            $faker = Faker\Factory::create('fr_FR');

            for ($i=0; $i<20; $i++){
                $event = new Event();
                $event->setName($faker->word);
                $event->setDescription($faker->paragraph);
                $event->setDuration($faker->numberBetween(30, 120));
                $manager->persist($event);
            }


        $manager->flush();
    }
}
