<?php

namespace compteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use compteBundle\Repository\LineRepository;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class MovementType extends AbstractType
{

  protected $tokenStorage;

    /**
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }


    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

         $user = $this->tokenStorage->getToken()->getUser();

        $builder->add('amountMv')

	   ->add('dateMv','date',["widget"=>"single_text",'format'=>'dd/MM/yyyy'])
		->add('months','number')
        ->add('comment','textarea',["required"=>false])
		->add('realDateMv','date',["widget"=>"single_text",'format'=>'dd/MM/yyyy'])
		->add('line','entity',['class'=>'compteBundle:Line','property'=>'title','query_builder'=>function(LineRepository $li) use($user) {
            return $li->getLinesByMasterEntitiesId($user);
        }])
        ->add('selectDebitAccount','choice',['choices'=>['1'=>"داخلي",'2'=>'خارجي'],'mapped'=>false])
        ->add('selectCreditAccount','choice',['choices'=>['1'=>"داخلي",'2'=>'خارجي'],'mapped'=>false])
		->add('codificationABB','entity',['class'=>'compteBundle:CodificationABB','property'=>'label','required'=>false])
		->add('creditAccount','entity',['class'=>'compteBundle:Account','property'=>'accountName','required'=>false])
		->add('debitAccount','entity',['class'=>'compteBundle:Account','property'=>'accountName','required'=>false])
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
