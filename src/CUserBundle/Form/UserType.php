<?php

namespace CUserBundle\Form;

//use FOS\UserBundle\Form\Type\RegistrationFormType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('roles','choice',['choices'=>['ROLE_OPERATOR'=>'OPERATOR','ROLE_APPROVER'=>'APPROVER','ROLE_SUPERVISOR'=>'SUPERVISOR','ROLE_SUPER_ADMIN'=>'SUPER ADMIN',],'expanded'=>true,'multiple'=>true])
            ->add('adminRole','submit',array('label'=>'Droits admin'))
            ->add('status','submit',array('label'=>'Statut'))
			
        ;
    }

    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CUserBundle\Entity\User'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cuserbundle_user';
    }
}
