<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * entity created to manage the validity of the contact form.
 */
class Contact
{

    /**
     * @Assert\NotBlank(message = "Le prénom doit être rempli !")
     */
    private string $firstname;

    /**
     * @Assert\Email(message = "L'email {{ value }} n'est pas une adresse valide !")
     * @Assert\NotBlank(message = "L'email doit être rempli !")
     */
    private string $email;

    /**
     * @Assert\NotBlank(message = "Le texte doit être rempli !")
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
