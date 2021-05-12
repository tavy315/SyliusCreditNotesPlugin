<?php

declare(strict_types=1);

namespace Tavy315\SyliusCreditNotesPlugin\Entity;

use Sylius\Component\Core\Model\ProductInterface;

class CustomerCreditNoteProduct
{
    public float $amount;

    public string $description;

    public string $no;

    public float $price;

    public int $quantity;

    public string $measurement;

    public ?ProductInterface $product = null;

    public static function fromArray(array $data): self
    {
        $product = new self();
        $product->amount = $data['amount'] ?? 0;
        $product->description = $data['description'] ?? '';
        $product->no = $data['no'] ?? '';
        $product->price = $data['price'] ?? 0;
        $product->quantity = (int) ($data['quantity'] ?? 0);
        $product->measurement = $data['measurement'] ?? '';

        return $product;
    }
}
