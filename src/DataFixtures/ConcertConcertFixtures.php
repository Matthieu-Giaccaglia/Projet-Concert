<?php

namespace App\DataFixtures;

use App\Entity\ConcertConcert;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ConcertConcertFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $concert = new ConcertConcert();
        $concert->setConcertGroup($this->getReference(ConcertGroupFixtures::GROUP_REFERENCE.'_IMAGINE_DRAGONS'));
        $concert->setConcertHall($this->getReference(ConcertHallFixtures::HALL_REFERENCE));
        $concert->setConcertOrganizer($this->getReference(ConcertOrganizerFixtures::ORGANIZER_REFERENCE));
        $concert->setDatetimeBegin(new \DateTime('2022-05-05 17:45:00'));
        $concert->setDatetimeEnd(new \DateTime('2022-05-05 20:45:00'));
        $concert->setNbTicket(450);
        $concert->addConcertTicketoffice($this->getReference(ConcertTicketOfficeFixtures::TICKET_OFFICE_REFERENCE));

        $manager->persist($concert);
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return[
            ConcertGroupFixtures::class,
            ConcertTicketOfficeFixtures::class,
            ConcertOrganizerFixtures::class,
            ConcertHallFixtures::class
        ];
    }
}
