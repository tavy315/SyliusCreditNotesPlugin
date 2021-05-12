<?php

declare(strict_types=1);

namespace Tavy315\SyliusCreditNotesPlugin\Controller\Action;

use Sylius\Component\Core\Context\ShopperContextInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Tavy315\SyliusCreditNotesPlugin\Context\CreditNoteContextInterface;
use Tavy315\SyliusCreditNotesPlugin\Entity\CustomerCreditNoteInterface;
use Tavy315\SyliusCreditNotesPlugin\Entity\CustomerCreditNoteProduct;
use Tavy315\SyliusCreditNotesPlugin\Repository\ProductRepositoryInterface;
use Twig\Environment;

final class ListCreditNoteProductsAction
{
    private CreditNoteContextInterface $creditNoteContext;

    private ProductRepositoryInterface $productRepository;

    private ShopperContextInterface $shopperContext;

    private Environment $twig;

    public function __construct(
        CreditNoteContextInterface $creditNoteContext,
        ProductRepositoryInterface $productRepository,
        Environment $twig,
        ShopperContextInterface $shopperContext
    ) {
        $this->creditNoteContext = $creditNoteContext;
        $this->productRepository = $productRepository;
        $this->shopperContext = $shopperContext;
        $this->twig = $twig;
    }

    public function __invoke(string $document, Request $request): Response
    {
        $creditNote = $this->creditNoteContext->getCreditNote($document);

        return new Response($this->twig->render('@Tavy315SyliusCreditNotesPlugin/Account/CustomerCreditNote/Grid/products.html.twig', [
            'creditNote' => $creditNote,
            'products'   => $this->getProducts($creditNote),
        ]));
    }

    /**
     * @return array<CustomerCreditNoteProduct>
     */
    private function getProducts(CustomerCreditNoteInterface $creditNote): array
    {
        $products = [];

        foreach ($creditNote->getProducts() as $product) {
            $customerCreditNote = CustomerCreditNoteProduct::fromArray($product);

            if ($product['no'] !== '') {
                $customerCreditNote->product = $this->productRepository
                    ->createShopListQueryBuilder(
                        $this->shopperContext->getChannel(),
                        $this->shopperContext->getLocaleCode(),
                        [ $product['no'] ]
                    )
                    ->getQuery()
                    ->getOneOrNullResult();
            }

            $products[] = $customerCreditNote;
        }

        return $products;
    }
}
