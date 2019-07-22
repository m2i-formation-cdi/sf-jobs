<?php

namespace App\Form;

use App\Entity\Applicant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ApplicantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('resume')
            ->add('skills', CollectionType::class, [
                'entry_type' => SkillType::class,
                'allow_add' => true,
                'entry_options'=> ['label'=> false],
                'prototype' => true,
                'by_reference' => false

            ])

            /*
            ->add('experiences', CollectionType::class, [
                'entry_type' => ExperienceType::class,
                'allow_add' => true,
                'entry_options'=> ['label'=> false],
                'prototype' => true,
                'by_reference' => false
            ])*/

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Applicant::class,
        ]);
    }
}
