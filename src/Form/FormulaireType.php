<?php

namespace App\Form;

use App\Entity\Formulaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class FormulaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
                ->add('myArray',ChoiceType::class,[
                                                'label' => false,
                                                'choices' => array_flip($options['services']),
                                                'multiple' => true,
                                            ]);
         $builder->add('Suivant', SubmitType::class,[
                        //~ 'validation_groups' => 'phase'.$options['laphase'],
                        'label' => 'Suivant',
                        'attr' => [
                            'class' => 'webform-next button-primary form-submit',
                        ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Formulaire::class,
            'services' => [],
        ]);

        // you can also define the allowed types, allowed values and
        // any other feature supported by the OptionsResolver component
        $resolver->setAllowedTypes('services', 'array');


    }
}
