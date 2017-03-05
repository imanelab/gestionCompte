<?php

namespace CUserBundle\Form;

//use FOS\UserBundle\Form\Type\RegistrationFormType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RegistrationType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName','text')
            ->add('lastName','text')
        ;
    }

 public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
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


    public function getBlockPrefix()
    {
        return 'cuser_user_registration';
    }

    // For Symfony 2.x
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}
