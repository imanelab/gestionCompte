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
        ->add('comment','textarea',["required"=>false])
		->add('realDateMv','date',["widget"=>"single_text",'format'=>'dd/MM/yyyy'])
		->add('line','entity',['class'=>'compteBundle:Line','property'=>'title'])
        ->add('selectDebitAccount','choice',['choices'=>['1'=>"داخلي",'2'=>'خارجي'],'mapped'=>false])
        ->add('selectCreditAccount','choice',['choices'=>['1'=>"داخلي",'2'=>'خارجي'],'mapped'=>false])
		->add('codificationABB','entity',['class'=>'compteBundle:CodificationABB','property'=>'label','required'=>false])
		->add('creditAccount','entity',['class'=>'compteBundle:Account','property'=>'rib','required'=>false])
		->add('debitAccount','entity',['class'=>'compteBundle:Account','property'=>'rib','required'=>false])
		->add('creditEAccount','entity',['class'=>'compteBundle:ExternalAccount','property'=>'name','required'=>false])
		->add('debitEAccount','entity',['class'=>'compteBundle:ExternalAccount','property'=>'name','required'=>false])        ;

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
