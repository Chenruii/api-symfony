<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;



/**
 * @ORM\Entity(repositoryClass="App\Repository\cardRepository")
 */
class Card
{
    /**
     * @Groups("card")
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups("card")
     * @ORM\Column(type="string", nullable=true)
     */
    private $name;

    /**
     * @Groups("card")
     * @ORM\Column(type="string", length=255)
     */
    private $creditCardType;

    /**
     * @Groups("card")
     * @ORM\Column(type="string", length=255)
     */
    private $creditCardNumber;

    /**
     * @Groups("card")
     * @ORM\Column(type="string", length=255)
     */
    private $currencyCode;

    /**
     * @Groups("card")
     * @ORM\Column(type="integer")
     */
    private $value;


    /**
     * @Groups("userlight")
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="cards")
     * @ORM\JoinColumn(nullable=true)
     */
    private $users;

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->users;
    }

    /**
     * @param mixed $user_sub
     */
    public function setUser($users)
    {
        $this->user = $users;
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

    public function getCreditCardType(): ?string
    {
        return $this->creditCardType;
    }

    public function setCreditCardType(string $creditCardType): self
    {
        $this->creditCardType = $creditCardType;

        return $this;
    }

    public function getCreditCardNumber(): ?string
    {
        return $this->creditCardNumber;
    }

    public function setCreditCardNumber(string $creditCardNumber): self
    {
        $this->creditCardNumber = $creditCardNumber;

        return $this;
    }

    public function getCurrencyCode(): ?string
    {
        return $this->currencyCode;
    }

    public function setCurrencyCode(string $currencyCode): self
    {
        $this->currencyCode = $currencyCode;

        return $this;
    }

    public function getValue(): ?int
    {
        return $this->value;
    }

    public function setValue(int $value): self
    {
        $this->value = $value;

        return $this;
    }


    public function getCards(): ?User
    {
        return $this->cards;
    }

    public function setCards(?User $cards): self
    {
        $this->cards = $cards;

        return $this;
    }
}
