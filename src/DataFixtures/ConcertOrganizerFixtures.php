<?php

namespace App\DataFixtures;

use App\Entity\ConcertOrganizer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ConcertOrganizerFixtures extends Fixture
{

    public const ORGANIZER_REFERENCE = 'organizer';

    public function load(ObjectManager $manager): void
    {
        $organizer = new ConcertOrganizer();
        $organizer->setName('Fnac');
        $organizer->setEmail('contact@fnac.fr');

        $manager->persist($organizer);
        $manager->flush();

        $this->addReference(self::ORGANIZER_REFERENCE, $organizer);
    }
}
