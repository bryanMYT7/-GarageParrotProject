<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;


class LoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add("username", TextType::class, [
                "label" => "Nom d'utilisateur", 
                "required" => true, 
                "constraints" => [
                    new Length(['min' => 0, 'max' => 150, 'minMessage' => 'Le nom d\'utilisateur doit être supérieur à 5 caractères', 'maxMessage' => 'Le nom d\'utilisateur doit être inférieur à 200 caractères',
                    new NotBlank(['message' => 'Le nom d\'utilisateur ne doit pas être vide !'])
                    ])],
             ])
            ->add("password", PasswordType::class, [
                "label" => "Mot de passe", 
                "required" => true, 
                "constraints" => [
                    new NotBlank(['message' => 'Le mot de passe ne doit pas être vide !'])
                ]
             ]);
    }


    public function configureOptions(OptionsResolver $resolver): void
{
    $resolver->setDefaults([
        'data_class' => User::class,
    ]);
}
}
