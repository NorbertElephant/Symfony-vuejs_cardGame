<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PlayerRepository")
 */
class Player
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $NumGamePlayed;

    /**
     * @ORM\Column(type="integer")
     */
    private $numGameWin;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", cascade={"persist", "remove"})
     */
    private $user;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\DeckModel", cascade={"persist", "remove"})
     */
    private $deckModel;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\HeroGame", cascade={"persist", "remove"})
     */
    private $heroGame;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CardGame", mappedBy="player")
     */
    private $cardGames;
    
    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Game", mappedBy="rejoin", cascade={"persist", "remove"})
     */
    private $game;

    public function __construct()
    {
        $this->cardGames = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumGamePlayed(): ?int
    {
        return $this->NumGamePlayed;
    }

    public function setNumGamePlayed(int $NumGamePlayed): self
    {
        $this->NumGamePlayed = $NumGamePlayed;

        return $this;
    }

    public function getNumGameWin(): ?int
    {
        return $this->numGameWin;
    }

    public function setNumGameWin(int $numGameWin): self
    {
        $this->numGameWin = $numGameWin;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getDeckModel(): ?DeckModel
    {
        return $this->deckModel;
    }

    public function setDeckModel(?DeckModel $deckModel): self
    {
        $this->deckModel = $deckModel;

        return $this;
    }

    public function getHeroGame(): ?HeroGame
    {
        return $this->heroGame;
    }

    public function setHeroGame(?HeroGame $heroGame): self
    {
        $this->heroGame = $heroGame;

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
            $cardGame->setPlayer($this);
        }

        return $this;
    }

    public function removeCardGame(CardGame $cardGame): self
    {
        if ($this->cardGames->contains($cardGame)) {
            $this->cardGames->removeElement($cardGame);
            // set the owning side to null (unless already changed)
            if ($cardGame->getPlayer() === $this) {
                $cardGame->setPlayer(null);
            }
        }

        return $this;
    }
}
