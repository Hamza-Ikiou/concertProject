<?php

namespace App\Entity;

use App\Repository\RoomRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RoomRepository::class)
 */
class Room
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
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $number_of_place;

    /**
     * @ORM\OneToOne(targetEntity=Picture::class, cascade={"persist", "remove"})
     */
    private $pictures;

    /**
     * @ORM\OneToMany(targetEntity=concert::class, mappedBy="room")
     */
    private $concerts;

    public function __construct()
    {
        $this->concerts = new ArrayCollection();
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

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getNumberOfPlace(): ?int
    {
        return $this->number_of_place;
    }

    public function setNumberOfPlace(?int $number_of_place): self
    {
        $this->number_of_place = $number_of_place;

        return $this;
    }

    public function getPictures(): ?Picture
    {
        return $this->pictures;
    }

    public function setPictures(?Picture $pictures): self
    {
        $this->pictures = $pictures;

        return $this;
    }

    /**
     * @return Collection|concert[]
     */
    public function getConcerts(): Collection
    {
        return $this->concerts;
    }

    public function addConcert(concert $concert): self
    {
        if (!$this->concerts->contains($concert)) {
            $this->concerts[] = $concert;
            $concert->setRoom($this);
        }

        return $this;
    }

    public function removeConcert(concert $concert): self
    {
        if ($this->concerts->removeElement($concert)) {
            // set the owning side to null (unless already changed)
            if ($concert->getRoom() === $this) {
                $concert->setRoom(null);
            }
        }

        return $this;
    }
}
