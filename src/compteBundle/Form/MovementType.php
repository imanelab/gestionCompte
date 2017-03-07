<?php

namespace compteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MovementType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('amountMv')
	   ->add('dateMv','date',["widget"=>"single_text",'format'=>'dd/MM/yyyy'])
		->add('months','number')
		->add('realDateMv','date',["widget"=>"single_text",'format'=>'dd/MM/yyyy'])
		->add('line','entity',['class'=>'compteBundle:Line','property'=>'name'])
		->add('codificationABB','entity',['class'=>'compteBundle:CodificationABB','property'=>'label','required'=>false])
		->add('creditAccount','entity',['class'=>'compteBundle:Account','property'=>'rib','required'=>false])
		->add('debitAccount','entity',['class'=>'compteBundle:Account','property'=>'rib','required'=>false])
		->add('creditEAccount','entity',['class'=>'compteBundle:Account','property'=>'rib','required'=>false])
		->add('debitEAccount','entity',['class'=>'compteBundle:Account','property'=>'rib','required'=>false])        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'compteBundle\Entity\Movement'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'comptebundle_movement';
    }


}
