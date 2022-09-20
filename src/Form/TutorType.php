<?php

namespace App\Form;

use App\Entity\Tutor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TutorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('FirstName')
            ->add('LastName')
            ->add('Telephone')
            ->add('Email')
            ->add('Address')
            ->add('students')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tutor::class,
        ]);
    }
}
