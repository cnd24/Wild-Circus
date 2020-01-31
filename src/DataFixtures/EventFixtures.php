<?php

namespace App\DataFixtures;

use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;
use App\Entity\Event;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class EventFixtures extends Fixture implements DependentFixtureInterface
{
    const IMG = [
        'https://images.unsplash.com/photo-1547423753-bff7561e2956?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=60',
        'https://images.unsplash.com/photo-1567722681579-c671cabd2810?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=60',
        'https://images.unsplash.com/photo-1572252698222-3ce9dcc32888?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=60',
        'https://images.unsplash.com/photo-1542732935-0750da3c04b5?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
        'https://images.unsplash.com/photo-1559322622-95aeeddf3b5e?ixlib=rb-1.2.1&auto=format&fit=crop&w=634&q=80',
        'https://images.unsplash.com/photo-1544926323-8463f67ecb5d?ixlib=rb-1.2.1&auto=format&fit=crop&w=634&q=80',
        'https://images.unsplash.com/photo-1491911923017-19f90d8d7f83?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=634&q=80',
        'https://images.unsplash.com/photo-1579963460004-4c4e4ba1938b?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=634&q=80',
        'https://images.unsplash.com/photo-1571771952382-7ca6f59bab36?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1007&q=80',
        'https://images.unsplash.com/photo-1576544403918-c47d52572a9a?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=967&q=80',
    ];



    public function load(ObjectManager $manager)
    {
            $faker = Faker\Factory::create('fr_FR');

            for ($i=0; $i<20; $i++){
                $event = new Event();
                $event->setName($faker->sentence(3));
                $event->setDescription($faker->paragraph);
                $event->setDuration($faker->numberBetween(30, 120));
                $event->setPriceChildren($faker->numberBetween(10,15));
                $event->setPriceAdult($faker->numberBetween(20, 30));
                $event->setPicture(self::IMG[rand(0,9)]);

                $manager->persist($event);
                $this->addReference('event'.$i, $event);
                $event->addArtist($this->getReference('artist'.(rand(0,59))));
                $event->addArtist($this->getReference('artist'.(rand(0,59))));
                $event->addArtist($this->getReference('artist'.(rand(0,59))));
            }


        $manager->flush();
    }

    public function getDependencies()
    {
        return [ArtistFixtures::class];

    }
}
