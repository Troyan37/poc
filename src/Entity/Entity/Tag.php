<?php

namespace App\Entity\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;
/**
 * Tag
 *
 * @ORM\Table(name="tag")
 * @ORM\Entity(repositoryClass="App\Repository\Entity\TagRepository")
 */
class Tag
{
    /**
     * @var int
     *
     * @ORM\Column(name="tagId", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $tagId;

    /**
     * @var string
     * @Assert\NotBlank
     * @ORM\Column(name="tagName", type="string", length=45)
     */
    private $tagName;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->tagId;
    }

    /**
     * Set tagName
     *
     * @param string $tagName
     *
     * @return Tag
     */
    public function setTagName($tagName)
    {
        $this->tagName = $tagName;

        return $this;
    }

    /**
     * Get tagName
     *
     * @return string
     */
    public function getTagName()
    {
        return $this->tagName;
    }
}

