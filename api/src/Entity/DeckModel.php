<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DeckModelRepository")
 */
class DeckModel
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="deckModels")
     * @ORM\JoinTable(name="deck_model_user")
     */
    private $user;

      /**
     * @ORM\ManyToMany(targetEntity="App\Entity\CardModel", inversedBy="consistOf")
     * @ORM\JoinTable(name="consist_of")
     */
    private $consist;

    public function __construct()
    {
        $this->user = new ArrayCollection();
        $this->consist = new ArrayCollection();
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

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(User $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user[] = $user;
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->user->contains($user)) {
            $this->user->removeElement($user);
        }

        return $this;
    }

    
    /**
     * @return Collection|CardModel[]
     */
    public function getConsist(): Collection
    {
        return $this->consist;
    }

    public function addConsist(CardModel $consist): self
    {
        if (!$this->consist->contains($consist)) {
            $this->consist[] = $consist;
        }

        return $this;
    }

    public function removeConsist(CardModel $consist): self
    {
        if ($this->consist->contains($consist)) {
            $this->consist->removeElement($consist);
        }

        return $this;
    }
}
