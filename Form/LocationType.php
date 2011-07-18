<?php

namespace Acme\StoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class LocationType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('community','entity',array(
                       'class' => 'Acme\StoreBundle\Entity\Community',
                       'property' => 'name'));
        $builder->add('province','null_entity',array(
                        'class' => 'Acme\StoreBundle\Entity\Province',
                       'property' => 'name',
                       'required' => false));
        $builder->add('city');
        $builder->add('street');
    }

    public function getName()
    {
        return 'location';
    }

}
