<?php

namespace Acme\StoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Acme\StoreBundle\Form\LocationType;

class ProviderType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('name');
        $builder->add('phone');
        $builder->add('location',new LocationType());
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Acme\StoreBundle\Entity\Provider'
        );

    }

    public function getName()
    {
        return 'provider';
    }

}
