<?php

namespace OC\PlatformBundle\Form;

use OC\PlatformBundle\OCPlatformBundle;
use OC\PlatformBundle\Repository\AdvertRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
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
            ->add('published', 'checkbox', ['required' => false])
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
//                'categories',
//                'entity',
//                [
//                    'class' => 'OCPlatformBundle:Category',
//                    'property' => 'name',
//                    'multiple' => true,
//                ])

            ->add('save', 'submit');


    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => 'OC\PlatformBundle\Entity\Advert',
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'oc_platformbundle_advert';
    }


}
