<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 * @ORM\Table(name="`order`")
 */
class Order
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="time")
     */
    private $time;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isPaid;

    /**
     * @ORM\Column(type="float")
     */
    private $priceTTC;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $methodeOfPaiment;

    /**
     * @ORM\ManyToOne(targetEntity=Table::class, inversedBy="orders")
     */
    private $tableOfit;

    /**
     * @ORM\OneToOne(targetEntity=Bill::class, mappedBy="orderOfit", cascade={"persist", "remove"})
     */
    private $bill;

    /**
     * @ORM\OneToMany(targetEntity=OrderItem::class, mappedBy="parentOrder", orphanRemoval=true)
     */
    private $orderItems;

    public function __construct()
    {
        $this->orderItems = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTime(): ?\DateTimeInterface
    {
        return $this->time;
    }

    public function setTime(\DateTimeInterface $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getIsPaid(): ?bool
    {
        return $this->isPaid;
    }

    public function setIsPaid(bool $isPaid): self
    {
        $this->isPaid = $isPaid;

        return $this;
    }

    public function getPriceTTC(): ?float
    {
        return $this->priceTTC;
    }

    public function setPriceTTC(float $priceTTC): self
    {
        $this->priceTTC = $priceTTC;

        return $this;
    }

    public function getMethodeOfPaiment(): ?string
    {
        return $this->methodeOfPaiment;
    }

    public function setMethodeOfPaiment(string $methodeOfPaiment): self
    {
        $this->methodeOfPaiment = $methodeOfPaiment;

        return $this;
    }

    public function getTableOfit(): ?Table
    {
        return $this->tableOfit;
    }

    public function setTableOfit(?Table $tableOfit): self
    {
        $this->tableOfit = $tableOfit;

        return $this;
    }

    public function getBill(): ?Bill
    {
        return $this->bill;
    }

    public function setBill(?Bill $bill): self
    {
        $this->bill = $bill;

        // set (or unset) the owning side of the relation if necessary
        $newOrderOfit = null === $bill ? null : $this;
        if ($bill->getOrderOfit() !== $newOrderOfit) {
            $bill->setOrderOfit($newOrderOfit);
        }

        return $this;
    }

    /**
     * @return Collection|OrderItem[]
     */
    public function getOrderItems(): Collection
    {
        return $this->orderItems;
    }

    public function addOrderItem(OrderItem $orderItem): self
    {
        if (!$this->orderItems->contains($orderItem)) {
            $this->orderItems[] = $orderItem;
            $orderItem->setParentOrder($this);
        }

        return $this;
    }

    public function removeOrderItem(OrderItem $orderItem): self
    {
        if ($this->orderItems->contains($orderItem)) {
            $this->orderItems->removeElement($orderItem);
            // set the owning side to null (unless already changed)
            if ($orderItem->getParentOrder() === $this) {
                $orderItem->setParentOrder(null);
            }
        }

        return $this;
    }
}
