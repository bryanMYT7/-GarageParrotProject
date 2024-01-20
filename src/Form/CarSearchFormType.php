<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('minPrice', IntegerType::class, ['required' => false, 'label' => 'Prix minimum'])
            ->add('maxPrice', IntegerType::class, ['required' => false, 'label' => 'Prix maximum'])
            ->add('category', ChoiceType::class, [
                'choices' => ['Sedan' => 'sedan', 'SUV' => 'suv', 'Truck' => 'truck'],
                'required' => false,
                'label' => 'Catégorie',
                'expanded' => false, // Set to true if you want a dropdown
            ])
            ->add('brand', ChoiceType::class, [
                'label' => 'Marque',
                'choices' => ['Toyota' => 'toyota', 'Tesla' => 'tesla', 'Ford' => 'ford', 'Honda' => 'honda'],
                'required' => false,
            ])
            ->add('model', ChoiceType::class, [
                'label' => 'Modèle',
                'choices' => ['Model S' => 'models', 'Clio V' => 'Cliov', 'Clio IV' => 'Clioiv', 'Honda' => 'honda'],
                'required' => false,
            ])
            ->add('submit', SubmitType::class, ['label' => 'Rechercher']);
    }
}
