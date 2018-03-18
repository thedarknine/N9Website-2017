<?php
namespace N9Bundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Contact
{
    /**
     * @Assert\Length(min=2, minMessage = "Votre prénom doit contenir au moins {{ limit }} caractères")
     * @Assert\NotBlank(message="Merci de saisir votre prénom")
     */
    protected $firstname;
    
    /**
     * @Assert\Length(min=2, minMessage = "Votre nom doit contenir au moins {{ limit }} caractères")
     * @Assert\NotBlank(message="Merci de saisir votre nom")
     */
    protected $lastname;

    /**
     * @Assert\Email(message = "Cette adresse email '{{ value }}' n'est pas valide.")
     * @Assert\NotBlank(message="Merci de saisir votre adresse email")
     */
    protected $email;

    /**
     * @Assert\Length(min=5, minMessage = "Le sujet doit contenir au moins {{ limit }} caractères")
     * @Assert\NotBlank(message="Veuillez saisir un sujet pour votre message")
     */
    protected $subject;

    /**
     * @Assert\Length(min=10, minMessage = "Le message doit contenir au moins {{ limit }} caractères")
     * @Assert\NotBlank(message="Veuillez saisir un message")
     */
    protected $message;
    
    
    public function getFirstname()
    {
        return $this->firstname;
    }

    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }
}