<?php

declare(strict_types=1);

namespace Tavy315\SyliusCreditNotesPlugin\Form\Type;

use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;

final class CustomerCreditNoteType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('customer', CustomerAutocompleteChoiceType::class, [
                'label'       => 'sylius.ui.customer',
                'multiple'    => false,
                'placeholder' => 'tavy315_sylius_credit_notes.ui.select_customer',
                'required'    => true,
            ])
            ->add('documentDate', DateType::class, [
                'label'    => 'tavy315_sylius_credit_notes.ui.document_date',
                'required' => true,
            ])
            ->add('documentNo', TextType::class, [
                'label'    => 'tavy315_sylius_credit_notes.ui.document_no',
                'required' => true,
            ])
            ->add('dueAmount', NumberType::class, [
                'label' => 'tavy315_sylius_credit_notes.ui.due_amount',
            ])
            ->add('paidAmount', NumberType::class, [
                'label' => 'tavy315_sylius_credit_notes.ui.paid_amount',
            ])
            ->add('products', CollectionType::class, [
                'allow_add'    => true,
                'allow_delete' => true,
                'entry_type'   => CustomerCreditNoteProductType::class,
            ])
            ->add('totalAmount', NumberType::class, [
                'label' => 'tavy315_sylius_credit_notes.ui.total_amount',
            ])
            ->add('url', UrlType::class, [
                'label' => 'tavy315_sylius_credit_notes.ui.url',
            ]);
    }

    public function getBlockPrefix(): string
    {
        return 'tavy315_sylius_credit_notes_credit_note';
    }
}
