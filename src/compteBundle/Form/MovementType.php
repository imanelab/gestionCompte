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
	->add('dateMv','datetime',array(
	'widget'=>'single_text',
	'html5'=>false,
	))
		->add('months')
		->add('realDateMv')
		->add('line')
		->add('codificationABB')
		->add('creditAccount')
		->add('debitAccount')
		->add('creditEAccount')
		->add('debitEAccount')        ;
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
