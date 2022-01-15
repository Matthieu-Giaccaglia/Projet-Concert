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
    private $nbTicket;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datetimeBegin;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datetimeEnd;

    /**
     * @ORM\ManyToOne(targetEntity=ConcertGroup::class, inversedBy="concert_hall")
     * @ORM\JoinColumn(nullable=false)
     */
    private $concertGroup;

    /**
     * @ORM\ManyToOne(targetEntity=ConcertOrganizer::class, inversedBy="concertConcerts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $concertOrganizer;

    /**
     * @ORM\ManyToMany(targetEntity=ConcertTicketOffice::class, inversedBy="concertConcerts")
     */
    private $concertTicketoffice;

    /**
     * @ORM\ManyToOne(targetEntity=ConcertHall::class, inversedBy="concertConcerts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $concertHall;

    /**
     * ConcertConcert constructor.
     */
    public function __construct()
    {
        $this->concertTicketoffice = new ArrayCollection();
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
        return $this->nbTicket;
    }

    /**
     * @param int $nbTicket
     * @return $this
     */
    public function setNbTicket(int $nbTicket): self
    {
        $this->nbTicket = $nbTicket;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getDatetimeBegin(): ?\DateTimeInterface
    {
        return $this->datetimeBegin;
    }

    /**
     * @param \DateTimeInterface $datetimeBegin
     * @return $this
     */
    public function setDatetimeBegin(\DateTimeInterface $datetimeBegin): self
    {
        $this->datetimeBegin = $datetimeBegin;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getDatetimeEnd(): ?\DateTimeInterface
    {
        return $this->datetimeEnd;
    }

    /**
     * @param \DateTimeInterface $datetimeEnd
     * @return $this
     */
    public function setDatetimeEnd(\DateTimeInterface $datetimeEnd): self
    {
        $this->datetimeEnd = $datetimeEnd;

        return $this;
    }

    /**
     * @return ConcertGroup|null
     */
    public function getConcertGroup(): ?ConcertGroup
    {
        return $this->concertGroup;
    }

    /**
     * @param ConcertGroup|null $concertGroup
     * @return $this
     */
    public function setConcertGroup(?ConcertGroup $concertGroup): self
    {
        $this->concertGroup = $concertGroup;

        return $this;
    }

    /**
     * @return ConcertOrganizer|null
     */
    public function getConcertOrganizer(): ?ConcertOrganizer
    {
        return $this->concertOrganizer;
    }

    /**
     * @param ConcertOrganizer|null $concertOrganizer
     * @return $this
     */
    public function setConcertOrganizer(?ConcertOrganizer $concertOrganizer): self
    {
        $this->concertOrganizer = $concertOrganizer;

        return $this;
    }

    /**
     * @return Collection|ConcertTicketOffice[]
     */
    public function getConcertTicketoffice(): Collection
    {
        return $this->concertTicketoffice;
    }

    /**
     * @param ConcertTicketOffice $concertTicketoffice
     * @return $this
     */
    public function addConcertTicketoffice(ConcertTicketOffice $concertTicketoffice): self
    {
        if (!$this->concertTicketoffice->contains($concertTicketoffice)) {
            $this->concertTicketoffice[] = $concertTicketoffice;
        }

        return $this;
    }

    /**
     * @param ConcertTicketOffice $concertTicketoffice
     * @return $this
     */
    public function removeConcertTicketoffice(ConcertTicketOffice $concertTicketoffice): self
    {
        $this->concertTicketoffice->removeElement($concertTicketoffice);

        return $this;
    }

    /**
     * @return ConcertHall|null
     */
    public function getConcertHall(): ?ConcertHall
    {
        return $this->concertHall;
    }

    /**
     * @param ConcertHall|null $concertHall
     * @return $this
     */
    public function setConcertHall(?ConcertHall $concertHall): self
    {
        $this->concertHall = $concertHall;

        return $this;
    }
}
