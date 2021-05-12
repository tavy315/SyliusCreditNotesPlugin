<?php

declare(strict_types=1);

namespace Tavy315\SyliusCreditNotesPlugin\Entity;

use Sylius\Component\Customer\Model\CustomerInterface;
use Sylius\Component\Resource\Model\TimestampableTrait;

class CustomerCreditNote implements CustomerCreditNoteInterface
{
    use TimestampableTrait;

    /** @var int */
    protected $id;

    /** @var CustomerInterface|null */
    protected $customer;

    /** @var \DateTimeInterface|null */
    protected $documentDate;

    /** @var string|null */
    protected $documentNo;

    /** @var int */
    protected $dueAmount = 0;

    /** @var int */
    protected $paidAmount = 0;

    /** @var array<array> */
    protected $products = [];

    /** @var int */
    protected $totalAmount = 0;

    /** @var string|null */
    protected $url = null;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCustomer(): ?CustomerInterface
    {
        return $this->customer;
    }

    public function setCustomer(?CustomerInterface $customer): void
    {
        $this->customer = $customer;
    }

    public function getDocumentDate(): ?\DateTimeInterface
    {
        return $this->documentDate;
    }

    public function setDocumentDate(?\DateTimeInterface $documentDate): void
    {
        $this->documentDate = $documentDate;
    }

    public function getDocumentNo(): ?string
    {
        return $this->documentNo;
    }

    public function setDocumentNo(?string $documentNo): void
    {
        $this->documentNo = $documentNo;
    }

    public function getDueAmount(): int
    {
        return $this->dueAmount;
    }

    public function setDueAmount(int $dueAmount): void
    {
        $this->dueAmount = $dueAmount;
    }

    public function getPaidAmount(): int
    {
        return $this->paidAmount;
    }

    public function setPaidAmount(int $paidAmount): void
    {
        $this->paidAmount = $paidAmount;
    }

    /**
     * @return array<array>
     */
    public function getProducts(): array
    {
        return $this->products;
    }

    /**
     * @param array<array> $products
     */
    public function setProducts(array $products): void
    {
        $this->products = $products;
    }

    public function getTotalAmount(): int
    {
        return $this->totalAmount;
    }

    public function setTotalAmount(int $totalAmount): void
    {
        $this->totalAmount = $totalAmount;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): void
    {
        $this->url = $url;
    }
}
