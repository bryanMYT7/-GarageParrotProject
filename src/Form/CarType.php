<?php

namespace App\Form;


use App\Form\ImageType;
use App\Entity\Image;
use App\Entity\Car;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\FileType;



class CarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('price', NumberType::class, [
                'label' => 'Prix',
                'required' => true,
                'scale' => 2,
            ])
            ->add('circulation_date', DateTimeType::class, ["label" => "Date de Mise en circulation", "required" => true])
            ->add('imageFile', FileType::class, [
                'label' => 'Image du véhicule',
                'required' => false,
            ])
            ->add('kilometers', IntegerType::class, ["label" => "kilomètres", "required" => true])
            ->add('brand', TextType::class, ["label" => "Marque", "required" => true])
            ->add('model', TextType::class, ["label" => "Modèle", "required" => true])
            ->add('category', TextType::class, ["label" => "Catégorie", "required" => false]);
    }

   
}
