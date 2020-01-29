<?php

namespace App\DataFixtures;

use App\Entity\Event;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class EventFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
            $event = new Event();
            $event->setName('Mon spectacle');
            $event->setDescription('Ma description');
            $event->setDuration('2');
            $manager->persist($event);

        $manager->flush();
    }
}
