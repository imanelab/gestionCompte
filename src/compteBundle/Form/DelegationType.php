<?php

namespace compteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use compteBundle\Entity\Delegation;

use compteBundle\Repository\DelegationRepository;

class DelegationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
		$emptyDelegation= new Delegation();
        $builder->add('name')
		//->add('depth')
		->add('delegation','entity',array('class'=>'compteBundle:Delegation','property'=>'name',
            'query_builder'=>function (DelegationRepository $dr){return $dr->createQueryBuilder('d')
                ->where('d.depth=1');},'required'=> false))     ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'compteBundle\Entity\Delegation'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'comptebundle_delegation';
    }


}
