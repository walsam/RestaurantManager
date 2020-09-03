<?php

namespace App\Entity;

use App\Repository\BillRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BillRepository::class)
 */
class Bill
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $priceToPay;

    /**
     * @ORM\OneToOne(targetEntity=Order::class, inversedBy="bill", cascade={"persist", "remove"})
     */
    private $orderOfit;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPriceToPay(): ?float
    {
        return $this->priceToPay;
    }

    public function setPriceToPay(float $priceToPay): self
    {
        $this->priceToPay = $priceToPay;

        return $this;
    }

    public function getOrderOfit(): ?Order
    {
        return $this->orderOfit;
    }

    public function setOrderOfit(?Order $orderOfit): self
    {
        $this->orderOfit = $orderOfit;

        return $this;
    }
}
