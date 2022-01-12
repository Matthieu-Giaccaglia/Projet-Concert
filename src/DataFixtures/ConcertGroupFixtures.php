<?php

namespace App\DataFixtures;

use App\Entity\ConcertArtist;
use App\Entity\ConcertGroup;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ConcertGroupFixtures extends Fixture implements DependentFixtureInterface
{

    public const GROUP_REFERENCE = 'group';

    public function load(ObjectManager $manager): void
    {
        $group = new ConcertGroup();
        $group->setName('Test');
        $group->setDescription('The second best lawyer again');
        $group->addConcertArtist($this->getReference(ConcertArtistFixtures::ARTIST_REFERENCE));

        $manager->persist($group);
        $manager->flush();

        $this->addReference(self::GROUP_REFERENCE, $group);
    }

    public function getDependencies(): array
    {
        return[
            ConcertArtistFixtures::class
        ];
    }
}

