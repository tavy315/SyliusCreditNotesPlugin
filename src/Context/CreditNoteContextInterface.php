<?php

declare(strict_types=1);

namespace Tavy315\SyliusCreditNotesPlugin\Context;

use Tavy315\SyliusCreditNotesPlugin\Entity\CustomerCreditNoteInterface;

interface CreditNoteContextInterface
{
    public function getCreditNote(string $documentNo): CustomerCreditNoteInterface;
}
