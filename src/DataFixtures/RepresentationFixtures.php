<?php

namespace App\DataFixtures;

use App\Entity\Representation;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class RepresentationFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {
            $faker = Faker\Factory::create('fr_FR');

            for ($i=0; $i<30; $i++){
                $representation = new Representation();
                $representation->setCity($faker->city);
                $representation->setDate($faker->dateTime);
                $manager->persist($representation);
                $representation->setEvent($this->getReference('event'.rand(0,19)));
            }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [EventFixtures::class];

    }
}
