<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CardGameRepository")
 */
class CardGame
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
    private $pa;

    /**
     * @ORM\Column(type="smallint")
     */
    private $position;

    /**
     * @ORM\Column(type="boolean")
     */
    private $etat;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CardModel", inversedBy="cardGames")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cardModel;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Player", inversedBy="cardGames")
     * @ORM\JoinColumn(nullable=false)
     */
    private $player;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\HeroGame", mappedBy="draw")
     * @ORM\JoinTable(name="draw")
     */
    private $draw;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\CardGame")
     * @ORM\JoinTable(name="attack_card")
     */
    private $attackCard;

    public function __construct()
    {
        $this->draw = new ArrayCollection();
        $this->attackCard = new ArrayCollection();
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

    public function getPa(): ?int
    {
        return $this->pa;
    }

    public function setPa(int $pa): self
    {
        $this->pa = $pa;

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

    public function getEtat(): ?bool
    {
        return $this->etat;
    }

    public function setEtat(bool $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCardModel(): ?CardModel
    {
        return $this->cardModel;
    }

    public function setCardModel(?CardModel $cardModel): self
    {
        $this->cardModel = $cardModel;

        return $this;
    }

    public function getPlayer(): ?Player
    {
        return $this->player;
    }

    public function setPlayer(?Player $player): self
    {
        $this->player = $player;

        return $this;
    }

    /**
     * @return Collection|HeroGame[]
     */
    public function getDraw(): Collection
    {
        return $this->draw;
    }

    public function addDraw(HeroGame $draw): self
    {
        if (!$this->draw->contains($draw)) {
            $this->draw[] = $draw;
            $draw->addDraw($this);
        }

        return $this;
    }

    public function removeDraw(HeroGame $draw): self
    {
        if ($this->draw->contains($draw)) {
            $this->draw->removeElement($draw);
            $draw->removeDraw($this);
        }

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getAttackCard(): Collection
    {
        return $this->attackCard;
    }

    public function addAttackCard(self $attackCard): self
    {
        if (!$this->attackCard->contains($attackCard)) {
            $this->attackCard[] = $attackCard;
        }

        return $this;
    }

    public function removeAttackCard(self $attackCard): self
    {
        if ($this->attackCard->contains($attackCard)) {
            $this->attackCard->removeElement($attackCard);
        }

        return $this;
    }
}
