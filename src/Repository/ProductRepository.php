<?php

declare(strict_types=1);

namespace Tavy315\SyliusCreditNotesPlugin\Repository;

use Doctrine\ORM\QueryBuilder;
use Sylius\Component\Channel\Model\ChannelInterface;
use Sylius\Component\Product\Repository\ProductRepositoryInterface as BaseProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    private BaseProductRepositoryInterface $productRepository;

    public function __construct(BaseProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @param array<string> $products
     */
    public function createShopListQueryBuilder(ChannelInterface $channel, string $locale, array $products): QueryBuilder
    {
        /** @var QueryBuilder $qb */
        $qb = $this->productRepository->createQueryBuilder('o');

        return $qb->distinct()
                  ->addSelect('translation')
                  ->innerJoin('o.translations', 'translation', 'WITH', 'translation.locale = :locale')
                  ->andWhere(':channel MEMBER OF o.channels')
                  ->andWhere('o.enabled = true')
                  ->andWhere('o.code IN (:codes)')
                  ->setParameter('codes', $products)
                  ->setParameter('locale', $locale)
                  ->setParameter('channel', $channel);
    }
}
