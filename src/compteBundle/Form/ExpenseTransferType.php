<?php

namespace compteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExpenseTransferType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('fromParagraph','entity', array(
                'class'       => 'compteBundle:Paragraph','property'=>'idp','required'=>true,'multiple'=>false, 'expanded'=>false ))

        ->add('fromLine','entity', array(
                'class'       => 'compteBundle:Line','property'=>'idl','required'=>true,'multiple'=>false, 'expanded'=>false ))

        ->add('toParagraph','entity', array(
                'class'       => 'compteBundle:Paragraph','property'=>'idp','required'=>true,'multiple'=>false, 'expanded'=>false ))

        ->add('toLine','entity', array(
                'class'       => 'compteBundle:Line','property'=>'idl','required'=>true,'multiple'=>false, 'expanded'=>false ))

        ->add('amount');
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'compteBundle\Entity\ExpenseTransfer'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'comptebundle_morass';
    }


}
