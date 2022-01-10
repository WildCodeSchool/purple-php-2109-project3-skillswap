<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Contact
{

    /**
     * @Assert\NotBlank(message = "The firstname must be provide !")
     */
    private string $firstname;

    /**
     * @Assert\Email(message = "The email {{ value }} is not a valid email !")
     * @Assert\NotBlank(message = "The email must be provide !")
     */
    private string $email;

    /**
     * @Assert\NotBlank(message = "The text must be provide !")
     */
    private string $text;

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }
}
