<?php

namespace App\Form;

use App\Entity\Produit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',ChoiceType::class,[
                'attr' => ['class' =>'form-control'],
                'choices' =>[
                    "Atelier" =>[
                        ""=>"",
                        "Amortisseurs Arrières (R-Remplacement)" => "Amortisseurs Arrières (R-Remplacement)",
                        "Alternateur (changement)" => "Alternateur (changement)",
                        "Amortisseurs Avant (R-Remplacement)"=>"Amortisseurs Avant (R-Remplacement)",
                        "Ampoules (C-Changement)"=>"Ampoules (C-Changement)",
                        "Batterie 85 Ah (R-Remplacement)"=>"Batterie 85 Ah (R-Remplacement)",
                        "Biellettes de Barre Stabilisatrice (C-Changement)"=>"Biellettes de Barre Stabilisatrice (C-Changement)",
                        "Bougie d’allumage (remplacement)"=>"Bougie d’allumage (remplacement)",
                        "Bloc Thermostat"=>"Bloc Thermostat",
                        "Bougies de Préchauffage (C-Changement)"=>"Bougies de Préchauffage (C-Changement)",
                        "Cardans Avant-A"=>"Cardans Avant-A",
                        "Coupelles d'amortisseur"=>"Coupelles d'amortisseur",
                        "Courroie d’accessoire"=>"Courroie d’accessoire",
                        "Filtre à AIR"=>"Filtre à AIR",
                        "Filtre à huile"=>"Filtre à huile",
                        "Filtre à Carburant"=>"Filtre à Carburant",
                        "Diagnostic Électronique D-D"=>"Diagnostic Électronique D-D",
                        "Démarreur (R-Remplacement)"=>"Démarreur (R-Remplacement)",
                        "Disques et Plaquettes AR"=>"Disques et Plaquettes AR",
                        "Jeu de Plaquettes AR"=>"Jeu de Plaquettes AR",
                        "Disques & Plaquettes AV"=>"Disques & Plaquettes AV",
                        "Disque et Plaquette AV/AR"=>"Disque et Plaquette AV/AR",
                        "Jeu de Plaquettes AV"=>"Jeu de Plaquettes AV",
                        "Kit Courroie De Distribution + Pompe à Eau"=>"Kit Courroie De Distribution + Pompe à Eau",
                        "Kit de Courroie d’Accessoires (C-Changement)"=>"Kit de Courroie d’Accessoires (C-Changement)",
                        "Kit d’Embrayage et Volant Moteur (R-Remplacement)"=>"Kit d’Embrayage et Volant Moteur (R-Remplacement)",
                        "Kit embrayage (R-Remplacement)"=>"Kit embrayage (R-Remplacement)",
                        "Mâchoires de frein arrière (C-Changement)"=>"Mâchoires de frein arrière (C-Changement)",
                        "Pompe à eau (R-Remplacement)"=>"Pompe à eau (R-Remplacement)",
                        "Rotule de direction (Pièces)"=>"Rotule de direction (Pièces)",
                        "Recharge climatisation"=>"Recharge climatisation",
                        "Rotules de suspensions (R-Remplacement)"=>"Rotules de suspensions (R-Remplacement)",
                        "Roulements de Roue arrière (C-Changement)"=>"Roulements de Roue arrière (C-Changement)",
                        "Roulements de Roue avant (C-Changement)"=>"Roulements de Roue avant (C-Changement)",
                        "Révision Constructeur Diesel D"=>"Révision Constructeur Diesel D",
                        "Révision Constructeur Essence E"=>"Révision Constructeur Essence E",
                        "Révision Intermédiaire"=>"Révision Intermédiaire",
                        "Support moteur"=>"Support moteur",
                        "Triangles / Bras de Suspension (C-Changement)"=>"Triangles / Bras de Suspension (C-Changement)",
                        "Vanne EGR"=>"Vanne EGR",
                        "Changement des pneus"=>"Changement des pneus",
                        "Autre (Atelier-A)"=>"Autre (Atelier-A)",
                    ],
                    "Réception"=>[
                        "Diagnostic sécurité DS"=>"Diagnostic sécurité DS",
                        "Diagnostic électronique DE"=>"Diagnostic électronique DE",
                        "Filtre Habitacle (Pièces)"=>"Filtre Habitacle (Pièces)",
                        "Huile Castrol (H)"=>"Huile Castrol (H)",
                        "Lavage Intérieur/Extérieur IE"=>"Lavage Intérieur/Extérieur IE",
                        "Lustrage (LT)"=>"Lustrage (LT)",
                        "Purge Liquide de Frein (PLF)"=>"Purge Liquide de Frein (PLF)",
                        "Purge Liquide de Refroidissement (PLR)"=>"Purge Liquide de Refroidissement (PLR)",
                        "Rénovation de Phare (RP)"=>"Rénovation de Phare (RP)",
                        "Vidange boîte de vitesse (VBV)"=>"Vidange boîte de vitesse (VBV)",
                        "Autre (Réception)"=>"Autre (Réception)",
                        "Diagnostic général (DG)"=>"Diagnostic général (DG)",
                    ]
                ],
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
