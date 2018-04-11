<?php
# src/Entity/Transaction.php

namespace Payment\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity @ORM\Table(name="transaction")
 **/
class Transaction
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $transactionId;
    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    private $status;
    /**
     * @ORM\Column(type="datetime")
     * @var date
     */
    private $dateCreate;
    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var date
     */
    private $dateUpdate;
    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var date
     */
    private $dateAuthorized;
    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var date
     */
    private $dateCaptured;
    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var date
     */
    private $dateSettled;
    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var date
     */
    private $dateUnpaid;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTransactionId()
    {
        return $this->transactionId;
    }

    /**
     * @param string $transactionId
     */
    public function setTransactionId($transactionId)
    {
        $this->transactionId = $transactionId;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return datetime
     */
    public function getDateCreate()
    {
        return $this->dateCreate;
    }

    /**
     * @param datetime $dateCreate
     */
    public function setDateCreate($dateCreate)
    {
        $this->dateCreate = $dateCreate;
    }

    /**
     * @return datetime
     */
    public function getDateUpdate()
    {
        return $this->dateUpdate;
    }

    /**
     * @param datetime $dateUpdate
     */
    public function setDateUpdate($dateUpdate)
    {
        $this->dateUpdate = $dateUpdate;
    }

    /**
     * @return datetime
     */
    public function getDateAuthorized()
    {
        return $this->dateAuthorized;
    }

    /**
     * @param datetime $dateAuthorized
     */
    public function setDateAuthorized($dateAuthorized)
    {
        $this->dateAuthorized = $dateAuthorized;
    }

    /**
     * @return datetime
     */
    public function getDateCaptured()
    {
        return $this->dateCaptured;
    }

    /**
     * @param datetime $dateCaptured
     */
    public function setDateCaptured($dateCaptured)
    {
        $this->dateCaptured = $dateCaptured;
    }

    /**
     * @return datetime
     */
    public function getDateSettled()
    {
        return $this->dateSettled;
    }

    /**
     * @param datetime $dateSettled
     */
    public function setDateSettled($dateSettled)
    {
        $this->dateSettled = $dateSettled;
    }

    /**
     * @return datetime
     */
    public function getDateUnpaid()
    {
        return $this->dateUnpaid;
    }

    /**
     * @param datetime $dateUnpaid
     */
    public function setDateUnpaid($dateUnpaid)
    {
        $this->dateUnpaid = $dateUnpaid;
    }
}