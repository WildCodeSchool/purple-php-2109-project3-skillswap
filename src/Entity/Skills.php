<?php

namespace App\Entity;

use App\Repository\SkillsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SkillsRepository::class)
 */
class Skills
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $category;

    /**
     * @ORM\ManyToMany(targetEntity=Swapper::class, mappedBy="skills")
     */
    private $swappers;

    public function __construct()
    {
        $this->swappers = new ArrayCollection();
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

    public function getCategory(): string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection|Swapper[]
     */
    public function getSwappers(): Collection
    {
        return $this->swappers;
    }

    public function addSwapper(Swapper $swapper): self
    {
        if (!$this->swappers->contains($swapper)) {
            $this->swappers[] = $swapper;
            $swapper->addSkill($this);
        }

        return $this;
    }

    public function removeSwapper(Swapper $swapper): self
    {
        if ($this->swappers->removeElement($swapper)) {
            $swapper->removeSkill($this);
        }

        return $this;
    }
}
