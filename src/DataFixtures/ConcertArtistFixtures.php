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
        $imagineDragons = [];

        $artist = new ConcertArtist();
        $artist->setFirstName('Dan');
        $artist->setLastName('Reynolds');
        $artist->setDescription('Daniel Coulter Reynolds, dit Dan Reynolds, est un chanteur, auteur-compositeur-interprète et producteur de musique américain, né le 14 juillet 1987 à Las Vegas dans le Nevada. Il est le chanteur principal du groupe de musique Imagine Dragons. Depuis 2014, il figure au Songwriters Hall of Fame.');
        $artist->setImgName('dan_reynolds.jpg');
        $this->addReference(self::ARTIST_REFERENCE . '_IMAGINE_DRAGONS_1', $artist);
        $manager->persist($artist);

        $artist = new ConcertArtist();
        $artist->setFirstName('Wayne');
        $artist->setLastName('Sermon');
        $artist->setDescription("Daniel Wayne Sermon, né le 15 juin 1984 à American Fork dans l'Utah est un guitariste, musicien multi-instrumentiste, auteur-compositeur et producteur de disques américain. Il est le guitariste principal du groupe de musique Imagine Dragons.");
        $artist->setImgName('wayne_sermon.jpg');
        $this->addReference(self::ARTIST_REFERENCE . '_IMAGINE_DRAGONS_2', $artist);
        $manager->persist($artist);

        $artist = new ConcertArtist();
        $artist->setFirstName('Ben');
        $artist->setLastName('McKee');
        $artist->setDescription("Benjamin Arthur McKee est un musicien, auteur-compositeur et producteur de disques américain. Il est le bassiste du groupe pop rock Imagine Dragons.");
        $artist->setImgName('ben_mckee.jpg');
        $this->addReference(self::ARTIST_REFERENCE . '_IMAGINE_DRAGONS_3', $artist);
        $manager->persist($artist);

        $artist = new ConcertArtist();
        $artist->setFirstName('Dan');
        $artist->setLastName('Platzman');
        $artist->setDescription("Daniel James Platzman est un musicien, auteur-compositeur, producteur de disques et compositeur américain. Il est le batteur du groupe pop rock Imagine Dragons.");
        $artist->setImgName('dan_platzman.jpg');
        $this->addReference(self::ARTIST_REFERENCE . '_IMAGINE_DRAGONS_4', $artist);
        $manager->persist($artist);

        $manager->flush();

    }
}
