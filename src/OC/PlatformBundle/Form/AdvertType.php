<?php

namespace OC\PlatformBundle\Form;

use OC\PlatformBundle\Repository\AdvertRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdvertType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', 'date')
            ->add('title', 'text')
            ->add('content', 'textarea')
            ->add('author', 'text')
            ->add('image', new ImageType())
            ->add(
                'categories',
                // collection permet de créer une liste de n'importe quoi
                'collection',
                [
                    'type'         => new CategoryType(),
                    'allow_add'    => true,
                    'allow_delete' => true,
                ]
            )
//            ->add(
//                'advert',
//                'entity',
//                [
//                    'class'         => 'OC\PlatformBundle\Entity\Advert',
//                    'property'      => 'title',
//                    'query_builder' => function (AdvertRepository $repo) {
//                        return $repo->getPublishedQueryBuilder();
//                    },
//                ]
//            )


//            ->add(
//                'categories',
//                'entity',
//                [
//                    'class' => 'OCPlatformBundle:Category',
//                    'property' => 'name',
//                    'multiple' => true,
//                ])

            ->add('save', 'submit');

        // ajout fonction qui écoute evenement
        $builder->addEventListener(
            FormEvents::PRE_SET_DATA, // 1er argument l'evenement
            function (FormEvent $event){ // evenement à executer lorsque evenement déclenché
                $advert = $event->getData(); // recupe objet
                if(null === $advert){
                    return; // sort de la fonction sans rien faire
                }

                // si l'annonce n'est pas encore publiée ou que son id est null
                if(!$advert->getPublished() || null === $advert->getId()){
                    // alors ajout champ published
                    $event->getForm()->add('published', 'checkbox', array(
                        'required' => false
                    ));
                }else{
                    $event->getForm()->remove('published');
                }

            }
        );

    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'OC\PlatformBundle\Entity\Advert'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'oc_platformbundle_advert';
    }


}
