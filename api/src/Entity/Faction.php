<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FactionRepository")
 */
class Faction
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
     * @ORM\OneToMany(targetEntity="App\Entity\HeroModel", mappedBy="faction")
     */
    private $heroModels;

    public function __construct()
    {
        $this->heroModels = new ArrayCollection();
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

    /**
     * @return Collection|HeroModel[]
     */
    public function getHeroModels(): Collection
    {
        return $this->heroModels;
    }

    public function addHeroModel(HeroModel $heroModel): self
    {
        if (!$this->heroModels->contains($heroModel)) {
            $this->heroModels[] = $heroModel;
            $heroModel->setFaction($this);
        }

        return $this;
    }

    public function removeHeroModel(HeroModel $heroModel): self
    {
        if ($this->heroModels->contains($heroModel)) {
            $this->heroModels->removeElement($heroModel);
            // set the owning side to null (unless already changed)
            if ($heroModel->getFaction() === $this) {
                $heroModel->setFaction(null);
            }
        }

        return $this;
    }
}
