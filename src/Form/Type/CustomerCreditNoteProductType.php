<?php

declare(strict_types=1);

namespace Tavy315\SyliusCreditNotesPlugin\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class CustomerCreditNoteProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('amount', NumberType::class, [
                'label' => 'tavy315_sylius_credit_notes.ui.product_amount',
            ])
            ->add('description', TextType::class, [
                'label' => 'tavy315_sylius_credit_notes.ui.product_description',
            ])
            ->add('no', TextType::class, [
                'label' => 'tavy315_sylius_credit_notes.ui.product_no',
            ])
            ->add('price', NumberType::class, [
                'label' => 'tavy315_sylius_credit_notes.ui.product_price',
            ])
            ->add('quantity', NumberType::class, [
                'label' => 'tavy315_sylius_credit_notes.ui.product_quantity',
            ])
            ->add('measurement', TextType::class, [
                'label' => 'tavy315_sylius_credit_notes.ui.product_measurement',
            ])
            ->add('type', TextType::class, [
                'label' => 'tavy315_sylius_credit_notes.ui.product_type',
            ]);
    }
}
