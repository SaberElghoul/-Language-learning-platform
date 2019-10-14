<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Entity\Language;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class StudentLanguagesType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {     $builder->add('level',
                        ChoiceType::class,array('choices'=> array('Beginner' =>'Beginner','Elementary' =>'Elementary','Intermediate'=>'Intermediate','Advanced'=>'Advanced'),
                         'attr'=>array('class'=>'form-control','style'=>'margin-bottom:15px')))

            ->add('Languages',EntityType::class,array(
            'class'=>'AppBundle\Entity\Language',
            'choice_label'=>'name',
            'expanded'=>false,
            'multiple'=>false,
            'mapped'=>false,
        ));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\StudentLanguages'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_studentlanguages';
    }


}
