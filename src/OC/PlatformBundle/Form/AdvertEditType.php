<?php

namespace OC\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

// herite de AdvertType
class AdvertEditType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->remove('date');
    }

    public function getName()
    {
        // modeification impossible de la date. Même si on peut le faire, n'enregistre pas
        return 'oc_platformbundle_advert_edit';
    }

    public function getParent()
    {
        return new AdvertType();
    }

}
