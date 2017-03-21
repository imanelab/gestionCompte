<?php

namespace compteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class LineType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('title','text')
        ->add('idl','number')
        ->add('amount','number')
        //->add('version')
        ->add('masterEntities','entity',['class'=>'compteBundle:MasterEntity','property'=>'name','required'=>false,'multiple'=>true, 'expanded'=>true ])
        ->add('paragraph','entity',['class'=>'compteBundle:Paragraph','property'=>'idp','required'=>false]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'compteBundle\Entity\Line'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'comptebundle_line';
    }

}

