<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use App\Entity\Users;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommentRepository::class)
 */
class Comment
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private string $date;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="receivedComments")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?Users $recipient;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="sentComments")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?Users $sender;

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

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(string $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getRecipient(): ?Users
    {
        return $this->recipient;
    }

    public function setRecipient(?Users $recipient): self
    {
        $this->recipient = $recipient;

        return $this;
    }

    public function getSender(): ?Users
    {
        return $this->sender;
    }

    public function setSender(?Users $sender): self
    {
        $this->sender = $sender;

        return $this;
    }
}
