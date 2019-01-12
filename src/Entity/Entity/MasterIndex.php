<?php

namespace App\Entity\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MasterIndex
 *
 * @ORM\Table(name="master_index")
 * @ORM\Entity(repositoryClass="App\Repository\Entity\MasterIndexRepository")
 */
class MasterIndex
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="master", type="integer", unique=true)
     */
    private $master;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set master
     *
     * @param integer $master
     *
     * @return MasterIndex
     */
    public function setMaster($master)
    {
        $this->master = $master;

        return $this;
    }

    /**
     * Get master
     *
     * @return int
     */
    public function getMaster()
    {
        return $this->master;
    }
}

