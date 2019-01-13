<?php

namespace App\Entity\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;
/**
 * Email
 *
 * @ORM\Table(name="email")
 * @ORM\Entity(repositoryClass="App\Repository\Entity\EmailRepository")
 */
class Email
{
    /**
     * @var int
     *
     * @ORM\Column(name="emailId", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $emailId;

    /**
     * @var string
     * @Assert\NotBlank
     * @ORM\Column(name="emailAddress", type="string", length=45)
     */
    private $emailAddress;


    /**
     * Get emailId
     *
     * @return int
     */
    public function getEmailId()
    {
        return $this->emailId;
    }

    /**
     * Set emailAddress
     *
     * @param string $emailAddress
     *
     * @return Email
     */
    public function setEmailAddress($emailAddress)
    {
        $this->emailAddress = $emailAddress;

        return $this;
    }

    /**
     * Get emailAddress
     *
     * @return string
     */
    public function getEmailAddress()
    {
        return $this->emailAddress;
    }
}

