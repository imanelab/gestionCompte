<?php

namespace compteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use compteBundle\Repository\AccountRepository;

class AccountType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('rib')
		//->add('depth')
		 ->add('balance')//,'money',["currency"=>"MAD"])
		->add('delegation','entity',["class"=>"compteBundle:Delegation","property"=>"name","required"=>false])
        ->add('account','entity',['class'=>'compteBundle:Account', 'property'=>'rib','query_builder' => 
                                                                function (AccountRepository $a) {
                                                            return $a->getAccountProperty(); },
        'required'=>false]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'compteBundle\Entity\Account'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'comptebundle_account';
    }


}
