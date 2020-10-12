<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

/**
 * Class RegisterType
 * @package App\Form
 */
class RegisterType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $pwPattern = "/^(?:(?=.*[a-z])(?:(?=.*[A-Z])(?=.*[\d\W])|(?=.*\W)(?=.*\d))|(?=.*\W)(?=.*[A-Z])(?=.*\d)).{8,}$/";

        $pwHelp = "Votre mot de passe doit comporter au moins huit caractères, 
        dont des lettres majuscules et minuscules, des nombres et des symboles.";

        $builder
            ->add('firstName', TextType::class, [
                "label" => "Prénom",
                "constraints" => [
                    new NotBlank(),
                    new Length(["min" => 2, "max" => 255]),
                ]
            ])
            ->add("lastName", TextType::class, [
                "label" => "Nom",
                "constraints" => [
                    new NotBlank(),
                    new Length(["min" => 2, "max" => 255]),
                ]
            ])
            ->add("email", EmailType::class, [
                "label" => "Email",
                "constraints" => [
                    new NotBlank(),
                    new Email(),
                    new Length(["max" => 255]),
                ]
            ])
            ->add("plainPassword", PasswordType::class, [
                "label" => "Mot de passe",
                "help" => $pwHelp,
                "constraints" => [
                    new NotBlank(),
                    new Length(["max" => 255]),
                    new Regex([
                        "pattern" => $pwPattern
                    ])
                ]
            ])
        ;
    }
}
