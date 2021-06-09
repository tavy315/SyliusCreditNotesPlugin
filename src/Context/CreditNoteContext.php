<?php

declare(strict_types=1);

namespace Tavy315\SyliusCreditNotesPlugin\Context;

use Sylius\Component\Core\Context\ShopperContextInterface;
use Sylius\Component\Core\Model\ShopUserInterface;
use Sylius\Component\Customer\Model\CustomerInterface;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationCredentialsNotFoundException;
use Tavy315\SyliusCreditNotesPlugin\Entity\CustomerCreditNoteInterface;
use Tavy315\SyliusCreditNotesPlugin\Entity\CustomerCreditNoteProduct;
use Tavy315\SyliusCreditNotesPlugin\Repository\CustomerCreditNoteRepositoryInterface;
use Tavy315\SyliusCreditNotesPlugin\Repository\ProductRepositoryInterface;

final class CreditNoteContext implements CreditNoteContextInterface
{
    private CustomerCreditNoteRepositoryInterface $customerCreditNoteRepository;

    private ProductRepositoryInterface $productRepository;

    private ShopperContextInterface $shopperContext;

    private TokenStorageInterface $tokenStorage;

    public function __construct(
        CustomerCreditNoteRepositoryInterface $customerCreditNoteRepository,
        ProductRepositoryInterface $productRepository,
        ShopperContextInterface $shopperContext,
        TokenStorageInterface $tokenStorage
    ) {
        $this->customerCreditNoteRepository = $customerCreditNoteRepository;
        $this->productRepository = $productRepository;
        $this->shopperContext = $shopperContext;
        $this->tokenStorage = $tokenStorage;
    }

    public function getCreditNote(string $documentNo): CustomerCreditNoteInterface
    {
        $creditNote = $this->customerCreditNoteRepository->findOneByCustomerAndDocument($this->getCustomer(), $documentNo);

        if ($creditNote === null) {
            throw new NotFoundHttpException();
        }

        return $creditNote;
    }

    /**
     * @return array<CustomerCreditNoteProduct>
     */
    public function getCreditNoteProducts(CustomerCreditNoteInterface $creditNote, ?int $limit = null): array
    {
        $products = [];

        $creditNoteProducts = \array_slice($creditNote->getProducts(), 0, $limit);

        foreach ($creditNoteProducts as $product) {
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

    private function getCustomer(): CustomerInterface
    {
        $token = $this->tokenStorage->getToken();

        if ($token === null) {
            throw new AuthenticationCredentialsNotFoundException('The token storage contains no authentication token. One possible reason may be that there is no firewall configured for this URL.');
        }

        $user = $token ? $token->getUser() : null;

        if (!($user instanceof ShopUserInterface)) {
            throw new AccessDeniedHttpException();
        }

        $customer = $user->getCustomer();

        if (!($customer instanceof CustomerInterface)) {
            throw new AccessDeniedHttpException();
        }

        return $customer;
    }
}
