<?php

namespace AppBundle\Form;

use AppBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Validator\Constraints as Assert;

class RegisrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, array(
                'label' => 'El. Paštas*',
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Email(),
                ]
            ))
            ->add('name', TextType::class, array(
                'label' => 'Pilnas Vardas*',
                'constraints' => [
                    new Assert\NotBlank(),
                ]
            ))
            ->add('username', TextType::class, array(
                'label' => 'Vartotojo Vardas*',
                'constraints' => [
                    new Assert\NotBlank(),
                ]
            ))
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options'  => array('label' => 'Slaptažodis*'),
                'second_options' => array('label' => 'Pakartoti Slaptažodį*',
                    'constraints' => [
                        new Assert\NotBlank(),
                    ]),
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => User::class,
        ));
    }
}
