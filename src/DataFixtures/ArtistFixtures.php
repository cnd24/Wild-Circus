<?php

namespace App\DataFixtures;

use App\Entity\Artist;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class ArtistFixtures extends Fixture
{
    const PERFORMANCES = [
        'Magicien',
        'Clown',
        'Ventriloque',
        'Equilibriste',
        'Jongleur',
        'Dompteur',
        'Voltigeur',
        'Trapéziste',
        'funambule',
        'acrobate',
    ];


    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i=0; $i<30; $i++){
            $artist = new Artist();
            $artist->setName($faker->name);
            $artist->setPerformance(self::PERFORMANCES[(rand(0,9))]);

            $manager->persist($artist);
            $this->addReference('artist'.$i, $artist);

        }

        $manager->flush();
    }

}
