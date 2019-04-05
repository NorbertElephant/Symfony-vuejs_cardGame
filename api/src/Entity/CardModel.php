<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CardModelRepository")
 */
class CardModel
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
    private $description;

    /**
     * @ORM\Column(type="text")
     */
    private $backgroundCard;

    /**
     * @ORM\Column(type="text")
     */
    private $picture;

    /**
     * @ORM\Column(type="integer")
     */
    private $mana;

    /**
     * @ORM\Column(type="integer")
     */
    private $pa;

    /**
     * @ORM\Column(type="integer")
     */
    private $hp;

    /**
     * @ORM\Column(type="smallint")
     */
    private $position;

    /**
     * @ORM\Column(type="text")
     */
    private $quote;

    /**
     * @ORM\Column(type="smallint")
     */
    private $copyMax;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\HeroModel", inversedBy="cardModels")
     * @ORM\JoinColumn(nullable=false)
     */
    private $heroModel;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CardGame", mappedBy="cardModel")
     */
    private $cardGames;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\TypeOfCard", mappedBy="cardModel")
     * @ORM\JoinTable(name="correspond")
     */
    private $typeOfCards;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\DeckModel")
     * @ORM\JoinTable(name="consist_of")
     */
    private $consistOf;

    public function __construct()
    {
        $this->cardGames = new ArrayCollection();
        $this->typeOfCards = new ArrayCollection();
        $this->consistOf = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getBackgroundCard(): ?string
    {
        return $this->backgroundCard;
    }

    public function setBackgroundCard(string $backgroundCard): self
    {
        $this->backgroundCard = $backgroundCard;

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

    public function getMana(): ?int
    {
        return $this->mana;
    }

    public function setMana(int $mana): self
    {
        $this->mana = $mana;

        return $this;
    }

    public function getPa(): ?int
    {
        return $this->pa;
    }

    public function setPa(int $pa): self
    {
        $this->pa = $pa;

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

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(int $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getQuote(): ?string
    {
        return $this->quote;
    }

    public function setQuote(string $quote): self
    {
        $this->quote = $quote;

        return $this;
    }

    public function getCopyMax(): ?int
    {
        return $this->copyMax;
    }

    public function setCopyMax(int $copyMax): self
    {
        $this->copyMax = $copyMax;

        return $this;
    }

    public function getHeroModel(): ?HeroModel
    {
        return $this->heroModel;
    }

    public function setHeroModel(?HeroModel $heroModel): self
    {
        $this->heroModel = $heroModel;

        return $this;
    }

    /**
     * @return Collection|CardGame[]
     */
    public function getCardGames(): Collection
    {
        return $this->cardGames;
    }

    public function addCardGame(CardGame $cardGame): self
    {
        if (!$this->cardGames->contains($cardGame)) {
            $this->cardGames[] = $cardGame;
            $cardGame->setCardModel($this);
        }

        return $this;
    }

    public function removeCardGame(CardGame $cardGame): self
    {
        if ($this->cardGames->contains($cardGame)) {
            $this->cardGames->removeElement($cardGame);
            // set the owning side to null (unless already changed)
            if ($cardGame->getCardModel() === $this) {
                $cardGame->setCardModel(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|TypeOfCard[]
     */
    public function getTypeOfCards(): Collection
    {
        return $this->typeOfCards;
    }

    public function addTypeOfCard(TypeOfCard $typeOfCard): self
    {
        if (!$this->typeOfCards->contains($typeOfCard)) {
            $this->typeOfCards[] = $typeOfCard;
            $typeOfCard->addCardModel($this);
        }

        return $this;
    }

    public function removeTypeOfCard(TypeOfCard $typeOfCard): self
    {
        if ($this->typeOfCards->contains($typeOfCard)) {
            $this->typeOfCards->removeElement($typeOfCard);
            $typeOfCard->removeCardModel($this);
        }

        return $this;
    }

    /**
     * @return Collection|DeckModel[]
     */
    public function getConsistOf(): Collection
    {
        return $this->consistOf;
    }

    public function addConsistOf(DeckModel $consistOf): self
    {
        if (!$this->consistOf->contains($consistOf)) {
            $this->consistOf[] = $consistOf;
        }

        return $this;
    }

    public function removeConsistOf(DeckModel $consistOf): self
    {
        if ($this->consistOf->contains($consistOf)) {
            $this->consistOf->removeElement($consistOf);
        }

        return $this;
    }
}
