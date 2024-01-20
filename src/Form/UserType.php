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
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\EqualTo;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Context\ExecutionContext;
class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add("username", TextType::class, [
                "label" => "Nom d'utilisateur", 
                "required" => true, 
                "constraints" => [
                    new Length(['min' => 0, 'max' => 150, 'minMessage' => 'Le nom d\'utilisateur doit être supérieur à 5 caractères', 'maxMessage' => 'Le nom d\'utilisateur doit être inférieur à 200 caractères',
                    ])],
             ])
            ->add("password",PasswordType::class, [
                "label" => "Mot de passe", 
                "required" => true, 
                "constraints" => [
                    new NotBlank(['message' => 'Le mot de passe ne doit pas être vide !'])
                ]
             ])
             ->add("confirm",PasswordType::class, [
                "label" => "Confirmer le mot de passe", 
                "required" => true, 
                "constraints" => [
                    new NotBlank(["message" => "Le mot de passe ne doit pas  être vide!"]),
                    /**new EqualTo(["propertyPath" => "password", "message" => "Le mot de passe doit être différent !"])**/
                    new Callback([ 'callback' => function($value, ExecutionContext $ec){
                        if($ec->getRoot()['password']->getViewData() !== $value) {
                            $ec->addViolation("Le mot de passe doivent être identique!");
                    }
                }
                    ])
                ]
             ]);
            
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class
        ]);
    }
}
