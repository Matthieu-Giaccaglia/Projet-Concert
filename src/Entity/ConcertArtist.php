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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity=ConcertGroup::class, mappedBy="concert_artist")
     */
    private $concertGroups;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imgName;

    public function __construct()
    {
        $this->concertGroups = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $pseudo): self
    {
        $this->name = $pseudo;

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

    public function getImgName(): ?string
    {
        return $this->imgName;
    }

    public function setImgName(?string $imgName): self
    {
        $this->imgName = $imgName;

        return $this;
    }
}
