<?php

namespace App\Entity;

use EWZ\Bundle\RecaptchaBundle\Validator\Constraints as Recaptcha;
use Symfony\Component\Validator\Constraints as Assert;

class Contact
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     *
     * @Assert\Email(mode="strict")
     */
    private $email;

    /**
     * @var string
     */
    private $message;

    /**
     * @Recaptcha\IsTrue
     */
    private $recaptcha;

    /**
     * Methods
     */

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): Contact
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): Contact
    {
        $this->email = $email;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): Contact
    {
        $this->message = $message;

        return $this;
    }
}
