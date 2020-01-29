<?php

namespace App\DataFixtures;

use App\Entity\Show;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ShowFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
            $show = new Show();
            $show->setName('Mon spectacle');
            $show->setDescription('Ma description');
            $show->setDuration('2');
            $manager->persist($show);

        $manager->flush();
    }
}
