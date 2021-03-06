<?php

namespace App\Entity\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Mailing
 *
 * @ORM\Table(name="mailing")
 * @ORM\Entity(repositoryClass="App\Repository\Entity\MailingRepository")
 */
class Mailing
{
    /**
     * @var int
     *
     * @ORM\Column(name="mailingId", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $mailingId;

    /**
     * @var string
     *
     * @ORM\Column(name="topic", type="string", length=45)
     */
    private $topic;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="string", length=1000, nullable=true)
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(name="fromEmail", type="string", length=45)
     */
    private $fromEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=1)
     */
    //S - wysyłanie, N - nowy, A - oczekuje na wyslanie,  E - błąd, X - zakończono, C - Anulowany
    private $status;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="timeCreated", type="datetime")
     */
    private $timeCreated;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="timeSent", type="datetime", nullable=true)
     */
    private $timeSent;

    /**
     * @return \DateTime|null
     */
    public function getTimeCreated(): ?\DateTime
    {
        return $this->timeCreated;
    }

    /**
     * @param \DateTime|null $timeCreated
     */
    public function setTimeCreated(?\DateTime $timeCreated): void
    {
        $this->timeCreated = $timeCreated;
    }

    /**
     * @return \DateTime|null
     */
    public function getTimeSent(): ?\DateTime
    {
        return $this->timeSent;
    }

    /**
     * @param \DateTime|null $timeSent
     */
    public function setTimeSent(?\DateTime $timeSent): void
    {
        $this->timeSent = $timeSent;
    }



    /**
     * Get id
     *
     * @return int
     */
    public function getMailingId()
    {
        return $this->mailingId;
    }

    /**
     * Set topic
     *
     * @param string $topic
     *
     * @return Mailing
     */
    public function setTopic($topic)
    {
        $this->topic = $topic;

        return $this;
    }

    /**
     * Get topic
     *
     * @return string
     */
    public function getTopic()
    {
        return $this->topic;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Mailing
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set fromEmail
     *
     * @param string $fromEmail
     *
     * @return Mailing
     */
    public function setFromEmail($fromEmail)
    {
        $this->fromEmail = $fromEmail;

        return $this;
    }

    /**
     * Get fromEmail
     *
     * @return string
     */
    public function getFromEmail()
    {
        return $this->fromEmail;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Mailing
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

}

