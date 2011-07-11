<?php

namespace Acme\StoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('category','entity',array('class' => 'Acme\StoreBundle\Entity\Category'));
        $builder->add('name');
        $builder->add('price','money');
        $builder->add('city');
        $builder->add('description','textarea');
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Acme\StoreBundle\Entity\Product'
        );

    }

}
