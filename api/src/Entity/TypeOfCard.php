<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypeOfCardRepository")
 */
class TypeOfCard
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
     * @ORM\Column(type="text")
     */
    private $urlBackgroundCard;

    /**
     * @ORM\Column(type="text")
     */
    private $urlBackgroundPion;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\CardModel", inversedBy="typeOfCards")
     * @ORM\JoinTable(name="correspond")
     */
    private $cardModel;

    public function __construct()
    {
        $this->cardModel = new ArrayCollection();
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

    public function getUrlBackgroundCard(): ?string
    {
        return $this->urlBackgroundCard;
    }

    public function setUrlBackgroundCard(string $urlBackgroundCard): self
    {
        $this->urlBackgroundCard = $urlBackgroundCard;

        return $this;
    }

    public function getUrlBacgroundPion(): ?string
    {
        return $this->urlBacgroundPion;
    }

    public function setUrlBacgroundPion(string $urlBacgroundPion): self
    {
        $this->urlBacgroundPion = $urlBacgroundPion;

        return $this;
    }

    /**
     * @return Collection|CardModel[]
     */
    public function getCardModel(): Collection
    {
        return $this->cardModel;
    }

    public function addCardModel(CardModel $cardModel): self
    {
        if (!$this->cardModel->contains($cardModel)) {
            $this->cardModel[] = $cardModel;
        }

        return $this;
    }

    public function removeCardModel(CardModel $cardModel): self
    {
        if ($this->cardModel->contains($cardModel)) {
            $this->cardModel->removeElement($cardModel);
        }

        return $this;
    }
}
