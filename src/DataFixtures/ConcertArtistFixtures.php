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
        $artist->setName('Dan Reynolds');
        $artist->setDescription('Daniel Coulter Reynolds, dit Dan Reynolds, est un chanteur, auteur-compositeur-interprète et producteur de musique américain, né le 14 juillet 1987 à Las Vegas dans le Nevada. Il est le chanteur principal du groupe de musique Imagine Dragons. Depuis 2014, il figure au Songwriters Hall of Fame.');
        $artist->setImgName('dan_reynolds.jpg');
        $this->addReference(self::ARTIST_REFERENCE . '_IMAGINE_DRAGONS_1', $artist);
        $manager->persist($artist);

        $artist = new ConcertArtist();
        $artist->setName('Wayne Sermon');
        $artist->setDescription("Daniel Wayne Sermon, né le 15 juin 1984 à American Fork dans l'Utah est un guitariste, musicien multi-instrumentiste, auteur-compositeur et producteur de disques américain. Il est le guitariste principal du groupe de musique Imagine Dragons.");
        $artist->setImgName('wayne_sermon.jpg');
        $this->addReference(self::ARTIST_REFERENCE . '_IMAGINE_DRAGONS_2', $artist);
        $manager->persist($artist);

        $artist = new ConcertArtist();
        $artist->setName('Ben McKee');
        $artist->setDescription("Benjamin Arthur McKee est un musicien, auteur-compositeur et producteur de disques américain. Il est le bassiste du groupe pop rock Imagine Dragons.");
        $artist->setImgName('ben_mckee.jpg');
        $this->addReference(self::ARTIST_REFERENCE . '_IMAGINE_DRAGONS_3', $artist);
        $manager->persist($artist);

        $artist = new ConcertArtist();
        $artist->setName('Dan Platzman');
        $artist->setDescription("Daniel James Platzman est un musicien, auteur-compositeur, producteur de disques et compositeur américain. Il est le batteur du groupe pop rock Imagine Dragons.");
        $artist->setImgName('dan_platzman.jpg');
        $this->addReference(self::ARTIST_REFERENCE . '_IMAGINE_DRAGONS_4', $artist);
        $manager->persist($artist);


        $artist = new ConcertArtist();
        $artist->setName('Patrick Stump');
        $artist->setDescription("Patrick Stump, de son vrai nom Patrick Vaughn Stumph1, né le 27 avril 1984 à Evanston dans l’Illinois, est un auteur-compositeur-interprète, musicien et producteur américain.
        \nIl est plus particulièrement connu pour être le chanteur principal, guitariste, pianiste et compositeur du groupe rock américain Fall Out Boy. ");
        $artist->setImgName('patrick_stump.jpg');
        $this->addReference(self::ARTIST_REFERENCE . '_FALL_OUT_BOY_1', $artist);
        $manager->persist($artist);

        $artist = new ConcertArtist();
        $artist->setName('Pete Wentz');
        $artist->setDescription("Peter Lewis Kingston \"Pete\" Wentz III (né le 5 juin 1979 à Wilmette, dans l'Illinois) est un auteur-compositeur-interprète, musicien, homme d'affaires, producteur de cinéma et producteur de musique américain. Il est surtout connu pour être le bassiste, parolier et chanteur de fond du groupe de rock Fall Out Boy, depuis 2001.");
        $artist->setImgName('pete_wentz.jpg');
        $this->addReference(self::ARTIST_REFERENCE . '_FALL_OUT_BOY_2', $artist);
        $manager->persist($artist);

        $artist = new ConcertArtist();
        $artist->setName('Joe Trohman');
        $artist->setDescription("Joseph Mark Trohman (né le 1er septembre 1984 à Hollywood en Floride) est un musicien américain. 
        \nIl est guitariste et membre cofondateur du groupe Fall Out Boy. Il a connu Peter Wentz (bassiste du groupe Fall Out Boy) au lycée New Trier Township. C’est aussi lui qui présenta Patrick Stump (chanteur et guitariste de Fall Out Boy) à Peter Wentz pour une audition. ");
        $artist->setImgName('joe_trohman.jpg');
        $this->addReference(self::ARTIST_REFERENCE . '_FALL_OUT_BOY_3', $artist);
        $manager->persist($artist);

        $artist = new ConcertArtist();
        $artist->setName('Andy Hurley');
        $artist->setDescription("Andrew John « Andy » Hurley (né à Milwaukee, Wisconsin, 31 mai 1980) est un musicien américain. Il est le batteur du groupe Fall Out Boy. ");
        $artist->setImgName('andy_hurley.jpg');
        $this->addReference(self::ARTIST_REFERENCE . '_FALL_OUT_BOY_4', $artist);
        $manager->persist($artist);

        $manager->flush();

    }
}
