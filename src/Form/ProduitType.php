<?php

namespace App\Form;

use App\Entity\Produit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',null,[
                'attr' => ['class' =>'form-control',
                'placeholder' => 'Nom Pièce']
            ])
            ->add('cout_piece',null,[
                'attr' => ['class' =>'form-control',
                'placeholder' => 'Coût Pièce']
            ])
            ->add('prix',null,[
                'attr' => ['class' =>'form-control',
                'placeholder' => 'Prix']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
