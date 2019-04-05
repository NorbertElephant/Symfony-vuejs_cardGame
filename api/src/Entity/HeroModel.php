<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HeroModelRepository")
 */
class HeroModel
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
     * @ORM\Column(type="text")
     */
    private $picture;

    /**
     * @ORM\Column(type="text")
     */
    private $pion;

    /**
     * @ORM\Column(type="integer")
     */
    private $hp;

    /**
     * @ORM\Column(type="boolean")
     */
    private $turn;

    /**
     * @ORM\Column(type="boolean")
     */
    private $swap;

    /**
     * @ORM\Column(type="integer")
     */
    private $mana;

    /**
     * @ORM\Column(type="integer")
     */
    private $manaMax;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Faction", inversedBy="heroModels")
     * @ORM\JoinColumn(nullable=false)
     */
    private $faction;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CardModel", mappedBy="heroModel")
     */
    private $cardModels;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\HeroGame", mappedBy="heroModel")
     */
    private $heroGames;

    public function __construct()
    {
        $this->cardModels = new ArrayCollection();
        $this->heroGames = new ArrayCollection();
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

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getPion(): ?string
    {
        return $this->pion;
    }

    public function setPion(string $pion): self
    {
        $this->pion = $pion;

        return $this;
    }

    public function getHp(): ?int
    {
        return $this->hp;
    }

    public function setHp(int $hp): self
    {
        $this->hp = $hp;

        return $this;
    }

    public function getTurn(): ?bool
    {
        return $this->turn;
    }

    public function setTurn(bool $turn): self
    {
        $this->turn = $turn;

        return $this;
    }

    public function getSwap(): ?bool
    {
        return $this->swap;
    }

    public function setSwap(bool $swap): self
    {
        $this->swap = $swap;

        return $this;
    }

    public function getMana(): ?int
    {
        return $this->mana;
    }

    public function setMana(int $mana): self
    {
        $this->mana = $mana;

        return $this;
    }

    public function getManaMax(): ?int
    {
        return $this->manaMax;
    }

    public function setManaMax(int $manaMax): self
    {
        $this->manaMax = $manaMax;

        return $this;
    }

    public function getFaction(): ?Faction
    {
        return $this->faction;
    }

    public function setFaction(?Faction $faction): self
    {
        $this->faction = $faction;

        return $this;
    }

    /**
     * @return Collection|CardModel[]
     */
    public function getCardModels(): Collection
    {
        return $this->cardModels;
    }

    public function addCardModel(CardModel $cardModel): self
    {
        if (!$this->cardModels->contains($cardModel)) {
            $this->cardModels[] = $cardModel;
            $cardModel->setHeroModel($this);
        }

        return $this;
    }

    public function removeCardModel(CardModel $cardModel): self
    {
        if ($this->cardModels->contains($cardModel)) {
            $this->cardModels->removeElement($cardModel);
            // set the owning side to null (unless already changed)
            if ($cardModel->getHeroModel() === $this) {
                $cardModel->setHeroModel(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|HeroGame[]
     */
    public function getHeroGames(): Collection
    {
        return $this->heroGames;
    }

    public function addHeroGame(HeroGame $heroGame): self
    {
        if (!$this->heroGames->contains($heroGame)) {
            $this->heroGames[] = $heroGame;
            $heroGame->setHeroModel($this);
        }

        return $this;
    }

    public function removeHeroGame(HeroGame $heroGame): self
    {
        if ($this->heroGames->contains($heroGame)) {
            $this->heroGames->removeElement($heroGame);
            // set the owning side to null (unless already changed)
            if ($heroGame->getHeroModel() === $this) {
                $heroGame->setHeroModel(null);
            }
        }

        return $this;
    }
}
