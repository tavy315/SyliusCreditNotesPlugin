<?php

declare(strict_types=1);

namespace Tavy315\SyliusCreditNotesPlugin\Context;

use Tavy315\SyliusCreditNotesPlugin\Entity\CustomerCreditNoteInterface;
use Tavy315\SyliusCreditNotesPlugin\Entity\CustomerCreditNoteProduct;

interface CreditNoteContextInterface
{
    public function getCreditNote(string $documentNo): CustomerCreditNoteInterface;

    /**
     * @return array<CustomerCreditNoteProduct>
     */
    public function getCreditNoteProducts(CustomerCreditNoteInterface $creditNote, ?int $limit = null): array;
}
