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

    const PIC = [
        'https://images.unsplash.com/photo-1504398230496-c3bf48cdfa94?ixlib=rb-1.2.1&auto=format&fit=crop&w=821&q=80',
        'https://images.unsplash.com/photo-1516527083915-bcc0641e1d43?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=793&q=80',
        'https://images.unsplash.com/photo-1508378817913-43c62adcdd59?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=800&q=80',
        'https://images.unsplash.com/photo-1542732935-0750da3c04b5?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=60',
        'https://images.unsplash.com/photo-1519758965401-328f73031806?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=800&q=80',
        'https://images.unsplash.com/photo-1504505278590-428d1acd0f07?ixlib=rb-1.2.1&auto=format&fit=crop&w=801&q=80',
    ];


    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i=0; $i<60; $i++){
            $artist = new Artist();
            $artist->setName($faker->name);
            $artist->setPerformance(self::PERFORMANCES[(rand(0,9))]);
            $artist->setPicture(self::PIC[(rand(0,5))]);

            $manager->persist($artist);
            $this->addReference('artist'.$i, $artist);
        }

        $manager->flush();
    }

}
