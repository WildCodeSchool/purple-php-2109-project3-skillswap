<?php

namespace App\Entity;

use App\Entity\Skill;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

/**
 * entity for creating a user
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 * @SuppressWarnings(PHPMD.ExcessivePublicCount)
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
*/
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\Email(message = "The email {{ value }} is not a valid email." )
     * @Assert\NotBlank(message = "You must provide an email.")
     */
    private string $email;

    /**
     * @ORM\Column(type="json")
     */
    private array $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private string $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $firstname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $lastname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $picture = "defaultUserPicture.png";

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $linkedin;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $website;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $company;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Assert\Length(
     *      max = 1000,
     *      maxMessage = "Votre description ne doit pas depasser {{ limit }} caractères")
     */
    private ?string $description;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $available = true;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $isVerified = false;

    /**
     * @ORM\OneToMany(targetEntity=Swap::class, mappedBy="asker", orphanRemoval=true)
     */
    private Collection $askedSwaps;

    /**
     * @ORM\OneToMany(targetEntity=Swap::class, mappedBy="helper", orphanRemoval=true)
     */
    private Collection $helpedSwaps;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="recipient", orphanRemoval=true)
     */
    private Collection $receivedComments;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="sender", orphanRemoval=true)
     */
    private Collection $sentComments;

    /**
     * @ORM\ManyToMany(targetEntity=Skill::class, inversedBy="user", orphanRemoval=false)
     * @Assert\Count(min = 0, max = 5)
     */
    private Collection $skill;

    /**
     * @ORM\Column(type="float")
     * @Assert\Range(
     *      min = 1,
     *      max = 5,
     *      notInRangeMessage = "The notation must be between {{ min }} and {{ max }}.",
     * )
     */
    private float $notation = 3;

    public function __construct()
    {
        $this->askedSwaps = new ArrayCollection();
        $this->helpedSwaps = new ArrayCollection();
        $this->receivedComments = new ArrayCollection();
        $this->sentComments = new ArrayCollection();
        $this->skill = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getLinkedin(): ?string
    {
        return $this->linkedin;
    }

    public function setLinkedin(?string $linkedin): self
    {
        $this->linkedin = $linkedin;

        return $this;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(?string $website): self
    {
        $this->website = $website;

        return $this;
    }

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(?string $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAvailable(): ?bool
    {
        return $this->available;
    }

    public function setAvailable(bool $available): self
    {
        $this->available = $available;

        return $this;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;
        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getreceivedComments(): Collection
    {
        return $this->receivedComments;
    }

    public function addReceivedComment(Comment $receivedComment): self
    {
        if (!$this->receivedComments->contains($receivedComment)) {
            $this->receivedComments[] = $receivedComment;
            $receivedComment->setRecipient($this);
        }
        return $this;
    }

    /**
     * @return Collection|Skill[]
     */
    public function getSkill(): Collection
    {
        return $this->skill;
    }

    public function addSkill(Skill $skill): self
    {
        if (!$this->skill->contains($skill)) {
            $this->skill[] = $skill;
        }
        return $this;
    }

    public function removeReceivedComment(Comment $receivedComment): self
    {
        if ($this->receivedComments->removeElement($receivedComment)) {
            // set the owning side to null (unless already changed)
            if ($receivedComment->getRecipient() === $this) {
                $receivedComment->setRecipient(null);
            }
        }
        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getsentComments(): Collection
    {
        return $this->sentComments;
    }

    public function addSentComment(Comment $sentComment): self
    {
        if (!$this->sentComments->contains($sentComment)) {
            $this->sentComments[] = $sentComment;
            $sentComment->setSender($this);
        }
        return $this;
    }

    public function removeSentComment(Comment $sentComment): self
    {
        if ($this->sentComments->removeElement($sentComment)) {
            // set the owning side to null (unless already changed)
            if ($sentComment->getSender() === $this) {
                $sentComment->setSender(null);
            }
        }
        return $this;
    }

    public function removeSkill(Skill $skill): self
    {
        $this->skill->removeElement($skill);
        return $this;
    }

    public function getNotation(): ?float
    {
        return $this->notation;
    }

    public function setNotation(float $notation): self
    {
        $this->notation = $notation;

        return $this;
    }

    /**
     * @return Collection|Swap[]
     */
    public function getAskedSwaps(): Collection
    {
        return $this->askedSwaps;
    }

    public function addAskedSwap(Swap $askedSwap): self
    {
        if (!$this->askedSwaps->contains($askedSwap)) {
            $this->askedSwaps[] = $askedSwap;
            $askedSwap->setAsker($this);
        }

        return $this;
    }

    public function removeAskedSwap(Swap $askedSwap): self
    {
        if ($this->askedSwaps->removeElement($askedSwap)) {
            // set the owning side to null (unless already changed)
            if ($askedSwap->getAsker() === $this) {
                $askedSwap->setAsker(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Swap[]
     */
    public function getHelpedSwaps(): Collection
    {
        return $this->helpedSwaps;
    }

    public function addHelpedSwap(Swap $helpedSwap): self
    {
        if (!$this->helpedSwaps->contains($helpedSwap)) {
            $this->helpedSwaps[] = $helpedSwap;
            $helpedSwap->setHelper($this);
        }

        return $this;
    }

    public function removeHelpedSwap(Swap $helpedSwap): self
    {
        if ($this->helpedSwaps->removeElement($helpedSwap)) {
            // set the owning side to null (unless already changed)
            if ($helpedSwap->getHelper() === $this) {
                $helpedSwap->setHelper(null);
            }
        }

        return $this;
    }

    //solve proxy error message at user connexion
    public function __sleep()
    {
        return ['email', 'id', 'password'];
    }
}
