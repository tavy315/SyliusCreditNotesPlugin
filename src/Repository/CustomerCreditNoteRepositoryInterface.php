<?php

declare(strict_types=1);

namespace Tavy315\SyliusCreditNotesPlugin\Repository;

use Doctrine\ORM\QueryBuilder;
use Sylius\Component\Customer\Model\CustomerInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Tavy315\SyliusCreditNotesPlugin\Entity\CustomerCreditNoteInterface;

interface CustomerCreditNoteRepositoryInterface extends RepositoryInterface
{
    public function findOneByCustomerAndDocument(CustomerInterface $customer, string $documentNo): ?CustomerCreditNoteInterface;

    public function createByCustomerQueryBuilder($customerId): QueryBuilder;
}
