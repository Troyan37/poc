<?php

namespace App\Entity\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Email_has_tag
 *
 * @ORM\Table(name="email_has_tag")
 * @ORM\Entity(repositoryClass="App\Repository\Entity\Email_has_tagRepository")
 */
class Email_has_tag
{

    /**
     * @var int
     *
     * @ORM\Column(name="email_has_tagId", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $emailHasTagId;

    /**
     * @return int
     */
    public function getEmailHasTagId(): int
    {
        return $this->emailHasTagId;
    }

    /**
     * @param int $emailHasTagId
     */
    public function setEmailHasTagId(int $emailHasTagId): void
    {
        $this->emailHasTagId = $emailHasTagId;
    }

    /**
     * @var int
     *
     * @ORM\Column(name="email_emailId", type="integer")
     */
    private $emailEmailId;

    /**
     * @var int
     *
     * @ORM\Column(name="tag_tagId", type="integer")
     */
    private $tagTagId;



    /**
     * Set emailEmailId
     *
     * @param integer $emailEmailId
     *
     * @return Email_has_tag
     */
    public function setEmailEmailId($emailEmailId)
    {
        $this->emailEmailId = $emailEmailId;

        return $this;
    }

    /**
     * Get emailEmailId
     *
     * @return int
     */
    public function getEmailEmailId()
    {
        return $this->emailEmailId;
    }

    /**
     * Set tagTagId
     *
     * @param integer $tagTagId
     *
     * @return Email_has_tag
     */
    public function setTagTagId($tagTagId)
    {
        $this->tagTagId = $tagTagId;

        return $this;
    }

    /**
     * Get tagTagId
     *
     * @return int
     */
    public function getTagTagId()
    {
        return $this->tagTagId;
    }
}

