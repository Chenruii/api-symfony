<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SubscriptionRepository")
 */
class Subscription
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $slogan;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $url;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="subscription")
     */
    private $user_sub;

    public function __construct()
    {
        $this->user_sub = new ArrayCollection();
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

    public function getSlogan(): ?string
    {
        return $this->slogan;
    }

    public function setSlogan(?string $slogan): self
    {
        $this->slogan = $slogan;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUserSub(): Collection
    {
        return $this->user_sub;
    }

    public function addUserSub(User $userSub): self
    {
        if (!$this->user_sub->contains($userSub)) {
            $this->user_sub[] = $userSub;
            $userSub->setSubscription($this);
        }

        return $this;
    }

    public function removeUserSub(User $userSub): self
    {
        if ($this->user_sub->contains($userSub)) {
            $this->user_sub->removeElement($userSub);
            // set the owning side to null (unless already changed)
            if ($userSub->getSubscription() === $this) {
                $userSub->setSubscription(null);
            }
        }

        return $this;
    }
}
