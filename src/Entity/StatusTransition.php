<?php
# src/Entity/StatusTransition.php

namespace Payment\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity @ORM\Table(name="status_transition")
 **/
class StatusTransition
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    private $fromStatus;

    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    private $toStatus;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getFromStatus()
    {
        return $this->fromStatus;
    }

    /**
     * @param int $fromStatus
     */
    public function setFromStatus($fromStatus)
    {
        $this->fromStatus = $fromStatus;
    }

    /**
     * @return int
     */
    public function getToStatus()
    {
        return $this->toStatus;
    }

    /**
     * @param int $toStatus
     */
    public function setToStatus($toStatus)
    {
        $this->toStatus = $toStatus;
    }

}