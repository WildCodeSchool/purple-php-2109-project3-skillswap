<?php

namespace App\Entity;

use DateTime;
use App\Entity\User;
use App\Entity\Skill;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\SwapRepository;

/**
 * @ORM\Entity(repositoryClass=SwapRepository::class)
 */
class Swap
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="askedSwaps")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?User $asker;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="helpedSwaps")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?User $helper;

    /**
     * @ORM\ManyToOne(targetEntity=Skill::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private ?Skill $skill;

    /**
     * @ORM\Column(type="datetime")
     */
    private \DateTimeInterface $date;

    /**
     * @ORM\Column(type="text")
     */
    private string $message;

    /**
     * @ORM\Column(type="boolean", options={"default" = false})
     */
    private bool $isAccepted = false;

    /**
     * @ORM\Column(type="boolean", options={"default" = false})
     */
    private bool $isDone = false;

    /**
     * @ORM\OneToMany(targetEntity=Discussion::class, mappedBy="swap", orphanRemoval=true)
     */
    private Collection $discussions;

    public function __construct(User $asker, User $helper, Skill $skill)
    {
        $this->asker = $asker;
        $this->helper = $helper;
        $this->skill = $skill;
        $this->date = new DateTime();
        $this->discussions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAsker(): ?User
    {
        return $this->asker;
    }

    public function setAsker(?User $asker): self
    {
        $this->asker = $asker;

        return $this;
    }

    public function getHelper(): ?User
    {
        return $this->helper;
    }

    public function setHelper(?User $helper): self
    {
        $this->helper = $helper;

        return $this;
    }

    public function getSkill(): ?Skill
    {
        return $this->skill;
    }

    public function setSkill(?Skill $skill): self
    {
        $this->skill = $skill;

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

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getIsAccepted(): ?bool
    {
        return $this->isAccepted;
    }

    public function setIsAccepted(bool $isAccepted): self
    {
        $this->isAccepted = $isAccepted;

        return $this;
    }

    public function getIsDone(): ?bool
    {
        return $this->isDone;
    }

    public function setIsDone(bool $isDone): self
    {
        $this->isDone = $isDone;

        return $this;
    }

    /**
     * @return Collection|Discussion[]
     */
    public function getDiscussions(): Collection
    {
        return $this->discussions;
    }

    public function addDiscussion(Discussion $discussion): self
    {
        if (!$this->discussions->contains($discussion)) {
            $this->discussions[] = $discussion;
            $discussion->setSwap($this);
        }

        return $this;
    }

    public function removeDiscussion(Discussion $discussion): self
    {
        if ($this->discussions->removeElement($discussion)) {
            // set the owning side to null (unless already changed)
            if ($discussion->getSwap() === $this) {
                $discussion->setSwap(null);
            }
        }

        return $this;
    }

    //solve proxy error message at user connexion
    public function __sleep()
    {
        return ['id'];
    }
}
