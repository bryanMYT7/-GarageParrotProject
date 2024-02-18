<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('price', IntegerType::class, [
                'required' => false,
                'label' => 'Prix maximum',
                'attr' => ['placeholder' => 'Entrez le prix maximum'],
            ])
            ->add('circulation_date', IntegerType::class, [
                'required' => false,
                'label' => 'Année de circulation',
                'attr' => ['placeholder' => 'Entrez l\'année de circulation'],
            ])
            ->add('kilometers', IntegerType::class, [
                'required' => false,
                'label' => 'Kilométrage maximum',
                'attr' => ['placeholder' => 'Entrez le kilométrage maximum'],
            ])
            ->add('brand', TextType::class, [
                'required' => false,
                'label' => 'Marque',
                'attr' => ['placeholder' => 'Entrez la marque'],
            ])
            ->add('category', TextType::class, [
                'required' => false,
                'label' => 'Catégorie',
                'attr' => ['placeholder' => 'Entrez la catégorie'],
            ])
            ->add('model', TextType::class, [
                'required' => false,
                'label' => 'Modèle',
                'attr' => ['placeholder' => 'Entrez le modèle'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Définissez ici la classe d'entité associée
            'data_class' => null,
        ]);
    }
}
