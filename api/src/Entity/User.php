<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use App\Entity\Rank;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(
 *      fields = {"email"}, 
 *      message ="{{ value }} que vous avez indiqué est déjà utilisé! ",
 * )
 * @UniqueEntity(
 *      fields = {"username"}, 
 *      message ="{{ value }} que vous avez indiqué est déjà utilisé! ",
 * )
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=75)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=75)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=75)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="boolean")
     */
    private $valid;

    /**
     * @ORM\Column(type="boolean")
     */
    private $connect;

    /**
     * @ORM\Column(type="integer")
     */
    private $numGamePlayed;

    /**
     * @ORM\Column(type="integer")
     */
    private $numGameWin;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Rank", inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     */
    private $rank;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\DeckModel", mappedBy="user")
     */
    private $deckModels;

    /**
     * Champ Entity et non dans la BDD
     * @Assert\EqualTo(propertyPath="password", message="Vous n'avez pas tapé le même mot de passe")
     */
    private $confirm_password;

    

    public function __construct()
    {
        $this->deckModels = new ArrayCollection();
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

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getValid(): ?bool
    {
        return $this->valid;
    }

    public function setValid(bool $valid): self
    {
        $this->valid = $valid;

        return $this;
    }

    public function getConnect(): ?bool
    {
        return $this->connect;
    }

    public function setConnect(bool $connect): self
    {
        $this->connect = $connect;

        return $this;
    }

    public function getNumGamePlayed(): ?int
    {
        return $this->numGamePlayed;
    }

    public function setNumGamePlayed(int $numGamePlayed): self
    {
        $this->numGamePlayed = $numGamePlayed;

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

    public function getRank(): ?Rank
    {
        return $this->rank;
    }

    public function setRank(?Rank $rank): self
    {
        $this->rank = $rank;

        return $this;
    }

    /**
     * @return Collection|DeckModel[]
     */
    public function getDeckModels(): Collection
    {
        return $this->deckModels;
    }

    public function addDeckModel(DeckModel $deckModel): self
    {
        if (!$this->deckModels->contains($deckModel)) {
            $this->deckModels[] = $deckModel;
            $deckModel->addUser($this);
        }

        return $this;
    }

    public function removeDeckModel(DeckModel $deckModel): self
    {
        if ($this->deckModels->contains($deckModel)) {
            $this->deckModels->removeElement($deckModel);
            $deckModel->removeUser($this);
        }

        return $this;
    }

    public function getGame(): ?Game
    {
        return $this->game;
    }

    public function setGame(?Game $game): self
    {
        $this->game = $game;

        // set (or unset) the owning side of the relation if necessary
        $newRejoin = $game === null ? null : $this;
        if ($newRejoin !== $game->getRejoin()) {
            $game->setRejoin($newRejoin);
        }

        return $this;
    }

    public function getConfirmPassword(): ?string
    {
        return $this->confirm_password;
    }

    public function setConfirmPassword(string $confirm_password): self
    {
        $this->confirm_password = $confirm_password;

        return $this;
    }

    public function eraseCredentials(){

    }

    public function getSalt(){

    }

    public function getRoles(){
        return ['ROLE_USER'];
    }
}
