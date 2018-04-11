<?php

namespace Payment\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity @ORM\Table(name="status")
 **/

class Status
{
    const STATUS_AUTHORIZED = 100;
    const STATUS_CAPTURED = 200;
    const STATUS_SETTLED = 300;
    const STATUS_CANCELLED = 600;
    const STATUS_REFUNDED = 700;
    const STATUS_CHARGEBACKED = 800;
    const STATUS_ERROR = 900;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @var varchar
     */
    private $name;

    /**
     * @ORM\Column(type="string")
     */
    private $dateToUpdate;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return varchar
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param varchar $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDateToUpdate()
    {
        return $this->dateToUpdate;
    }

    /**
     * @param string $dateToUpdate
     */
    public function setDateToUpdate($dateToUpdate)
    {
        $this->dateToUpdate = $dateToUpdate;
    }

}