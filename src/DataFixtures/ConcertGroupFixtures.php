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
        $group->setName('Imagine Dragons');
        $group->setDescription("Imagine Dragons est un groupe de pop rock américain, originaire de Las Vegas, dans le Nevada. Imagine Dragons est formé en 2008 alors que le chanteur Dan Reynolds est à l'université Brigham Young. Le groupe compte au total 5 albums. ");
        $group->setImgName('imagine_dragons.jpg');
        for($i=1; $i<=4;$i++) {
            $group->addConcertArtist($this->getReference(ConcertArtistFixtures::ARTIST_REFERENCE.'_IMAGINE_DRAGONS_'.$i));
        }

        $manager->persist($group);
        $manager->flush();

        $this->addReference(self::GROUP_REFERENCE.'_IMAGINE_DRAGONS', $group);
    }

    public function getDependencies(): array
    {
        return[
            ConcertArtistFixtures::class
        ];
    }
}

