<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HeroGameRepository")
 */
class HeroGame
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
    private $hp;

    /**
     * @ORM\Column(type="integer")
     */
    private $mana;

    /**
     * @ORM\Column(type="integer")
     */
    private $manaMax;

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
    private $numTurn;

    /**
     * @ORM\Column(type="datetime")
     */
    private $copyHeroPlayer;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\HeroModel", inversedBy="heroGames")
     * @ORM\JoinColumn(nullable=false)
     */
    private $heroModel;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\CardGame", inversedBy="draw")
     * @ORM\JoinTable(name="draw")
     */
    private $draw;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\CardGame")
     * @ORM\JoinTable(name="attack_hp")
     * 
     */
    private $attackHp;


    public function __construct()
    {
        $this->draw = new ArrayCollection();
        $this->attackHp = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getNumTurn(): ?int
    {
        return $this->numTurn;
    }

    public function setNumTurn(int $numTurn): self
    {
        $this->numTurn = $numTurn;

        return $this;
    }

    public function getCopyHeroPlayer(): ?\DateTimeInterface
    {
        return $this->copyHeroPlayer;
    }

    public function setCopyHeroPlayer(\DateTimeInterface $copyHeroPlayer): self
    {
        $this->copyHeroPlayer = $copyHeroPlayer;

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
    public function getDraw(): Collection
    {
        return $this->draw;
    }

    public function addDraw(CardGame $draw): self
    {
        if (!$this->draw->contains($draw)) {
            $this->draw[] = $draw;
        }

        return $this;
    }

    public function removeDraw(CardGame $draw): self
    {
        if ($this->draw->contains($draw)) {
            $this->draw->removeElement($draw);
        }

        return $this;
    }

    /**
     * @return Collection|CardGame[]
     */
    public function getAttackHp(): Collection
    {
        return $this->attackHp;
    }

    public function addAttackHp(CardGame $attackHp): self
    {
        if (!$this->attackHp->contains($attackHp)) {
            $this->attackHp[] = $attackHp;
        }

        return $this;
    }

    public function removeAttackHp(CardGame $attackHp): self
    {
        if ($this->attackHp->contains($attackHp)) {
            $this->attackHp->removeElement($attackHp);
        }

        return $this;
    }
}
