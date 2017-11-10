<?php

namespace compteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

use compteBundle\Repository\LineRepository;
use compteBundle\Repository\ParagraphRepository;
use compteBundle\Entity\Morass;



class ExpenseTransferType extends AbstractType
{
    /**
     * {@inheritdoc}
     */

    protected $morass;

    public function __construct(Morass $morass){

        $this->morass= $morass;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $morasse = $this->morass;
        $builder->add('fromParagraph','entity', array(
                'class'=> 'compteBundle:Paragraph','query_builder'=>function(ParagraphRepository $pa) use($morasse) {
            return $pa->getParagraphsByMorass($morasse);},'property'=>'idp','required'=>true,'multiple'=>false, 'expanded'=>false ))
        ->add('fromLine','entity', array(
                'class'=> 'compteBundle:Line','property'=>'idl','required'=>true,'multiple'=>false,'expanded'=>false ))

        /*->addEventListener(
                FormEvents::PRE_SET_DATA,
                array($this, 'onPreSetData')
            )*/

        ->add('toParagraph','entity', array(
                'class'       => 'compteBundle:Paragraph','query_builder'=>function(ParagraphRepository $pa) use($morasse) {
            return $pa->getParagraphsByMorass($morasse);},'property'=>'idp','required'=>true,'multiple'=>false, 'expanded'=>false ))

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

   /* public function onPreSetData(FormEvent $event){

        $form = $event->getForm();
        $data = $event->getData();

         if ($data)
            {
                $fromParagraph = $data->getFromParagraph();
                //$em = new EntityManager();
              //  $em = $DC->container->get('doctrine.orm.entity_manager')->getManager();
                $lines = $this->em->getRepository('compteBundle:Line')->findByParagraph($fromParagraph);
                foreach($lines as $value) {
                    $id_set[]   = $value->getId();
                    $name_set[] = $value->getIdl();
                }

                $form->add('fromLine','entity', array(
                'class'=> 'compteBundle:Line','choices'=>$lines,'property'=>'idl','required'=>true,'multiple'=>false,'expanded'=>false ));
            }

        

    }*/


}
