<?php

namespace App\Entity;

use App\Repository\ConcertArtistRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ConcertArtistRepository::class)
 */
class ConcertArtist
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
    private $first_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $last_name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $pseudo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity=ConcertGroup::class, mappedBy="concert_artist")
     */
    private $concertGroups;

    public function __construct()
    {
        $this->concertGroups = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): self
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): self
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(?string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|ConcertGroup[]
     */
    public function getConcertGroups(): Collection
    {
        return $this->concertGroups;
    }

    public function addConcertGroup(ConcertGroup $concertGroup): self
    {
        if (!$this->concertGroups->contains($concertGroup)) {
            $this->concertGroups[] = $concertGroup;
            $concertGroup->addConcertArtist($this);
        }

        return $this;
    }

    public function removeConcertGroup(ConcertGroup $concertGroup): self
    {
        if ($this->concertGroups->removeElement($concertGroup)) {
            $concertGroup->removeConcertArtist($this);
        }

        return $this;
    }
}
