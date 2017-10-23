<?php

namespace compteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MorassMigrationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('fromParagraph',EntityType::class, array(
                'class'       => 'gestionCompteBundle:Paragraph',)

        ->add('fromLine',EntityType::class, array(
                'class'       => 'gestionCompteBundle:Line',)

        ->add('toParagraph',EntityType::class, array(
                'class'       => 'gestionCompteBundle:Paragraph',)

        ->add('toLine',EntityType::class, array(
                'class'       => 'gestionCompteBundle:Line',)

        ->add('amount');
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'compteBundle\Entity\Morass'
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
