<?php

namespace App\Entity;

use DateTime;
use App\Entity\Swap;
use App\Entity\User;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\DiscussionRepository;

/**
 * @ORM\Entity(repositoryClass=DiscussionRepository::class)
 */
class Discussion
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="text")
     */
    private string $message;

    /**
     * @ORM\Column(type="datetime")
     */
    private \DateTimeInterface $date;

    /**
     * @ORM\ManyToOne(targetEntity=Swap::class, inversedBy="discussions")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?Swap $swap;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private ?User $sender;

    public function __construct(Swap $swap, User $sender)
    {
        $this->swap = $swap;
        $this->sender = $sender;
        $this->date = new DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getSwap(): ?Swap
    {
        return $this->swap;
    }

    public function setSwap(?Swap $swap): self
    {
        $this->swap = $swap;

        return $this;
    }

    public function getSender(): ?User
    {
        return $this->sender;
    }

    public function setSender(?User $sender): self
    {
        $this->sender = $sender;

        return $this;
    }
}
