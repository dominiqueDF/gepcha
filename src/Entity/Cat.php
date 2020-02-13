<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CatRepository")
 */
class Cat
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="date")
     */
    private $birthday;

    /**
     * @ORM\Column(type="string", length=7)
     */
    private $sex;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $comments;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Owner", inversedBy="cats")
     * @ORM\JoinColumn(nullable=false)
     */
    private $owner;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Hosting", mappedBy="cat")
     */
    private $hostings;

    /**
     * @ORM\Column(type="blob", nullable=true)
     */
    private $picture;

    public function __construct()
    {
        $this->hostings = new ArrayCollection();
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

    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(\DateTimeInterface $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }

    public function getSex(): ?string
    {
        return $this->sex;
    }

    public function setSex(string $sex): self
    {
        $this->sex = $sex;

        return $this;
    }

    public function getComments(): ?string
    {
        return $this->comments;
    }

    public function setComments(?string $comments): self
    {
        $this->comments = $comments;

        return $this;
    }

    public function getOwner(): ?Owner
    {
        return $this->owner;
    }

    public function setOwner(?Owner $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * @return Collection|Hosting[]
     */
    public function getHostings(): Collection
    {
        return $this->hostings;
    }

    public function addHosting(Hosting $hosting): self
    {
        if (!$this->hostings->contains($hosting)) {
            $this->hostings[] = $hosting;
            $hosting->setCat($this);
        }

        return $this;
    }

    public function removeHosting(Hosting $hosting): self
    {
        if ($this->hostings->contains($hosting)) {
            $this->hostings->removeElement($hosting);
            // set the owning side to null (unless already changed)
            if ($hosting->getCat() === $this) {
                $hosting->setCat(null);
            }
        }

        return $this;
    }

    /**
     * Méthode pour calculer l'âge d'un chat
     * @return int
     */
    public function getAge()
    {
        $age = $this->birthday->diff(new \DateTime());
        return $age->y;
    }

    public function getPicture()
    {
        return stream_get_contents($this->picture);
    }

    public function setPicture($picture): self
    {
        $this->picture = $picture;

        return $this;
    }
}
