<?php

declare(strict_types=1);

namespace Tavy315\SyliusCreditNotesPlugin\Controller\Action;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Tavy315\SyliusCreditNotesPlugin\Context\CreditNoteContextInterface;
use Twig\Environment;

final class ListCreditNoteProductsAction
{
    private CreditNoteContextInterface $creditNoteContext;

    private ?int $productLimit;

    private Environment $twig;

    public function __construct(CreditNoteContextInterface $creditNoteContext, Environment $twig, ?int $productLimit)
    {
        $this->creditNoteContext = $creditNoteContext;
        $this->productLimit = $productLimit;
        $this->twig = $twig;
    }

    public function __invoke(string $document, Request $request): Response
    {
        $creditNote = $this->creditNoteContext->getCreditNote($document);

        return new Response($this->twig->render('@Tavy315SyliusCreditNotesPlugin/Account/CustomerCreditNote/Grid/show.html.twig', [
            'creditNote' => $creditNote,
            'products'   => $this->creditNoteContext->getCreditNoteProducts($creditNote, $this->productLimit),
        ]));
    }
}
