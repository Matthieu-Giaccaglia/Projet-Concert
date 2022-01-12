<?php

namespace App\DataFixtures;

use App\Entity\ConcertTicketOffice;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ConcertTicketOfficeFixtures extends Fixture
{

    public const TICKET_OFFICE_REFERENCE = 'TicketOffice';

    public function load(ObjectManager $manager): void
    {
        $ticketOffice = new ConcertTicketOffice();
        $ticketOffice->setName('Fnac');

        $manager->persist($ticketOffice);
        $manager->flush();

        $this->addReference(self::TICKET_OFFICE_REFERENCE, $ticketOffice);
    }
}
