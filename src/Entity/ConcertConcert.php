<?php

namespace App\Entity;

use App\Repository\ConcertConcertRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ConcertConcertRepository::class)
 */
class ConcertConcert
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $nb_ticket;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datetime_begin;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datetime_end;

    /**
     * @ORM\ManyToOne(targetEntity=ConcertGroup::class, inversedBy="concert_hall")
     * @ORM\JoinColumn(nullable=false)
     */
    private $concert_group;

    /**
     * @ORM\ManyToOne(targetEntity=ConcertOrganizer::class, inversedBy="concertConcerts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $concert_organizer;

    /**
     * @ORM\ManyToMany(targetEntity=ConcertTicketOffice::class, inversedBy="concertConcerts")
     */
    private $concert_ticketoffice;

    /**
     * @ORM\ManyToOne(targetEntity=ConcertHall::class, inversedBy="concertConcerts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $concert_hall;

    /**
     * ConcertConcert constructor.
     */
    public function __construct()
    {
        $this->concert_ticketoffice = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return int|null
     */
    public function getNbTicket(): ?int
    {
        return $this->nb_ticket;
    }

    /**
     * @param int $nb_ticket
     * @return $this
     */
    public function setNbTicket(int $nb_ticket): self
    {
        $this->nb_ticket = $nb_ticket;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getDatetimeBegin(): ?\DateTimeInterface
    {
        return $this->datetime_begin;
    }

    /**
     * @param \DateTimeInterface $datetime_begin
     * @return $this
     */
    public function setDatetimeBegin(\DateTimeInterface $datetime_begin): self
    {
        $this->datetime_begin = $datetime_begin;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getDatetimeEnd(): ?\DateTimeInterface
    {
        return $this->datetime_end;
    }

    /**
     * @param \DateTimeInterface $datetime_end
     * @return $this
     */
    public function setDatetimeEnd(\DateTimeInterface $datetime_end): self
    {
        $this->datetime_end = $datetime_end;

        return $this;
    }

    /**
     * @return ConcertGroup|null
     */
    public function getConcertGroup(): ?ConcertGroup
    {
        return $this->concert_group;
    }

    /**
     * @param ConcertGroup|null $concert_group
     * @return $this
     */
    public function setConcertGroup(?ConcertGroup $concert_group): self
    {
        $this->concert_group = $concert_group;

        return $this;
    }

    /**
     * @return ConcertOrganizer|null
     */
    public function getConcertOrganizer(): ?ConcertOrganizer
    {
        return $this->concert_organizer;
    }

    /**
     * @param ConcertOrganizer|null $concert_organizer
     * @return $this
     */
    public function setConcertOrganizer(?ConcertOrganizer $concert_organizer): self
    {
        $this->concert_organizer = $concert_organizer;

        return $this;
    }

    /**
     * @return Collection|ConcertTicketOffice[]
     */
    public function getConcertTicketoffice(): Collection
    {
        return $this->concert_ticketoffice;
    }

    /**
     * @param ConcertTicketOffice $concertTicketoffice
     * @return $this
     */
    public function addConcertTicketoffice(ConcertTicketOffice $concertTicketoffice): self
    {
        if (!$this->concert_ticketoffice->contains($concertTicketoffice)) {
            $this->concert_ticketoffice[] = $concertTicketoffice;
        }

        return $this;
    }

    /**
     * @param ConcertTicketOffice $concertTicketoffice
     * @return $this
     */
    public function removeConcertTicketoffice(ConcertTicketOffice $concertTicketoffice): self
    {
        $this->concert_ticketoffice->removeElement($concertTicketoffice);

        return $this;
    }

    /**
     * @return ConcertHall|null
     */
    public function getConcertHall(): ?ConcertHall
    {
        return $this->concert_hall;
    }

    /**
     * @param ConcertHall|null $concert_hall
     * @return $this
     */
    public function setConcertHall(?ConcertHall $concert_hall): self
    {
        $this->concert_hall = $concert_hall;

        return $this;
    }
}
