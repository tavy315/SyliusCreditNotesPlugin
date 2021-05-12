<?php

declare(strict_types=1);

namespace Tavy315\SyliusCreditNotesPlugin\Repository;

use Doctrine\ORM\QueryBuilder;
use Sylius\Component\Channel\Model\ChannelInterface;

interface ProductRepositoryInterface
{
    /**
     * @param ChannelInterface $channel
     * @param string           $locale
     * @param array<string>    $products
     *
     * @return QueryBuilder
     */
    public function createShopListQueryBuilder(ChannelInterface $channel, string $locale, array $products): QueryBuilder;
}
