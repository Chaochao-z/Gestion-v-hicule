<?php

namespace App\Form;

use App\Entity\Dossier;
use App\Form\ProduitType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class DossierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('marque',null,[
                'attr' => ['class' =>'form-control',
                'placeholder' => 'Marque']
            ])
            ->add('modele',null,[
                'attr' => ['class' =>'form-control',
                'placeholder' => 'Modele']
            ])
            ->add('immatriculation',null,[
                'attr' => ['class' =>'form-control',
                'placeholder' => 'Immatriculation']
            ])
            ->add('daterdv', DateTimeType::class,[
                'widget' => 'single_text',
            ])
            ->add('nomclient',null,[
                'attr' => ['class' =>'form-control',
                'placeholder' => 'Nom du client']
            ])
            ->add('prenomclient',null,[
                'attr' => ['class' =>'form-control',
                'placeholder' => 'Prénom du client']
            ])
            ->add('telephone',null,[
                'attr' => ['class' =>'form-control',
                'placeholder' => 'Téléphone']
            ])
            ->add('email',null,[
                'attr' => ['class' => 'form-control',
             'placeholder' => 'Email'],
            ])
            ->add('remarque',null,[
                'attr' => ['class' => 'form-control',
             'placeholder' => 'Remarques'],
            ])
            ->add('produits', CollectionType::class,[
                'entry_type' => ProduitType::class,
                'entry_options' =>['label' => false],
                'allow_add' => true,
                'by_reference' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Dossier::class,
        ]);
    }
}
