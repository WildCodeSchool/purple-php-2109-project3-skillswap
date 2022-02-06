<?php

namespace App\Entity;

use App\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CommentRepository;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Assert\NotBlank(message = "Le commentaire ne doit pas être vide !")
     * @Assert\Length(
     *      max = 300,
     *      maxMessage = "Votre description ne doit pas depasser {{ limit }} caractères."
     * )
     */
    private string $message;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="receivedComments")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?User $recipient;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="sentComments")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?User $sender;

    /**
     * @ORM\Column(type="datetime")
     */
    private \DateTimeInterface $date;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *      min = 1,
     *      max = 5,
     *      notInRangeMessage = "La note doit être comprise entre {{ min }} et {{ max }}.",
     * )
     */
    private int $rating;

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

    public function getRecipient(): ?User
    {
        return $this->recipient;
    }

    public function setRecipient(?User $recipient): self
    {
        $this->recipient = $recipient;

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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(int $rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    //solve proxy error message at user connexion
    public function __sleep()
    {
        return ['id', 'message'];
    }
}
