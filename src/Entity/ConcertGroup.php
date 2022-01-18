<?php

namespace App\Entity;

use App\Repository\ConcertGroupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ConcertGroupRepository::class)
 */
class ConcertGroup
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
     * @ORM\ManyToMany(targetEntity=ConcertArtist::class, inversedBy="concertGroups")
     */
    private $concertArtist;

    /**
     * @ORM\OneToMany(targetEntity=ConcertConcert::class, mappedBy="concert_group", orphanRemoval=true)
     */
    private $concertConcerts;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imgName;

    /**
     * ConcertGroup constructor.
     */
    public function __construct()
    {
        $this->concertArtist = new ArrayCollection();
        $this->concertConcerts = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }


    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return $this
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|ConcertArtist[]
     */
    public function getConcertArtist(): Collection
    {
        return $this->concertArtist;
    }

    /**
     * @param ConcertArtist $concertArtist
     * @return $this
     */
    public function addConcertArtist(ConcertArtist $concertArtist): self
    {
        if (!$this->concertArtist->contains($concertArtist)) {
            $this->concertArtist[] = $concertArtist;
        }

        return $this;
    }

    /**
     * @param ConcertArtist $concertArtist
     * @return $this
     */
    public function removeConcertArtist(ConcertArtist $concertArtist): self
    {
        $this->concertArtist->removeElement($concertArtist);

        return $this;
    }

    /**
     * @return Collection|ConcertConcert[]
     */
    public function getConcertConcerts(): Collection
    {
        return $this->concertConcerts;
    }

    /**
     * @param ConcertConcert $concertConcert
     * @return $this
     */
    public function addConcertConcert(ConcertConcert $concertConcert): self
    {
        if (!$this->concertConcerts->contains($concertConcert)) {
            $this->concertConcerts[] = $concertConcert;
            $concertConcert->setConcertGroup($this);
        }

        return $this;
    }

    /**
     * @param ConcertConcert $concertConcert
     * @return $this
     */
    public function removeConcertConcert(ConcertConcert $concertConcert): self
    {
        if ($this->concertConcerts->removeElement($concertConcert)) {
            // set the owning side to null (unless already changed)
            if ($concertConcert->getConcertGroup() === $this) {
                $concertConcert->setConcertGroup(null);
            }
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

    public function __toString() {
        return $this->name;
    }
}
