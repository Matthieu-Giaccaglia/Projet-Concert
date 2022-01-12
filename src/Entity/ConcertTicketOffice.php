<?php

namespace App\Entity;

use App\Repository\ConcertTicketOfficeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ConcertTicketOfficeRepository::class)
 */
class ConcertTicketOffice
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=ConcertConcert::class, mappedBy="concert_ticketoffice")
     */
    private $concertConcerts;

    public function __construct()
    {
        $this->concertConcerts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|ConcertConcert[]
     */
    public function getConcertConcerts(): Collection
    {
        return $this->concertConcerts;
    }

    public function addConcertConcert(ConcertConcert $concertConcert): self
    {
        if (!$this->concertConcerts->contains($concertConcert)) {
            $this->concertConcerts[] = $concertConcert;
            $concertConcert->addConcertTicketoffice($this);
        }

        return $this;
    }

    public function removeConcertConcert(ConcertConcert $concertConcert): self
    {
        if ($this->concertConcerts->removeElement($concertConcert)) {
            $concertConcert->removeConcertTicketoffice($this);
        }

        return $this;
    }
}
