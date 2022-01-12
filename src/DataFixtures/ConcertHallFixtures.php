<?php

namespace App\DataFixtures;

use App\Entity\ConcertHall;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ConcertHallFixtures extends Fixture
{

    public const HALL_REFERENCE = 'hall';

    public function load(ObjectManager $manager): void
    {
        $hall = new ConcertHall();
        $hall->setName('Salle B');

        $manager->persist($hall);
        $manager->flush();

        $this->addReference(self::HALL_REFERENCE, $hall);
    }
}
