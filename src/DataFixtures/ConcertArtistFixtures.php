<?php

namespace App\DataFixtures;

use App\Entity\ConcertArtist;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ConcertArtistFixtures extends Fixture
{
    public const ARTIST_REFERENCE = 'artist';

    public function load(ObjectManager $manager): void
    {
        $artist = new ConcertArtist();
        $artist->setFirstName('Jimmy');
        $artist->setLastName('MacGill');
        $artist->setPseudo('Saul Goodman');
        $artist->setDescription('The second best lawyer again');

        $manager->persist($artist);
        $manager->flush();

        $this->addReference(self::ARTIST_REFERENCE, $artist);
    }
}
