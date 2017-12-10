<?php

namespace AppBundle\Form;

use AppBundle\Entity\Ingredient;
use AppBundle\Entity\Supplement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class OrderType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ingredients', EntityType::class, array(
                'class' => Ingredient::class,
                'choice_label' => 'name',
                'label' => 'Sudėtis',
                'multiple' => 'true',
                'attr' => [
                    'class' => 'selectpicker',
                    'multiple' => 'multiple',
                    'title' => 'Pasirinkite..'
                ]
            ))
            ->add('size', ChoiceType::class, array(
                'label' => 'Dydis',
                'choices' => [
                    'Mažas (1kg)' => '1',
                    'Vidutinis (2,5kg)' => '2',
                    'Didelis (5kg)' => '3',
                ],
                'attr' => [
                    'class' => 'selectpicker',
                ]
            ))
            ->
            add('adress', TextareaType::class, [
                'mapped' => false,
                'label' => 'Adresas',
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'action-button',
                ],
                'label' => 'Užsakyti',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Supplement::class,
        ]);
    }

    public function getBlockPrefix()
    {
        return 'order_form';
    }
}
