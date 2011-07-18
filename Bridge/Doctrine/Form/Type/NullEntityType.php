<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Acme\StoreBundle\Bridge\Doctrine\Form\Type;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;

use Acme\StoreBundle\Bridge\Doctrine\Form\DataTransformer\TextToIdTransformer;


use Symfony\Component\Form\AbstractType;

class NullEntityType extends AbstractType
{

    public function __construct(RegistryInterface $registry)
    {
        $this->registry = $registry;
    }

    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->prependClientTransformer(new TextToIdTransformer(
           $this->registry->getEntityManager($options['em']),
           $options['class'],
           $options['property']
        ));
    }

    public function getDefaultOptions(array $options)
    {
        $defaultOptions = array(
            'em'                => null,
            'class'             => null,
            'property'          => null,
            'hidden'            => false,
        );

        $options = array_replace($defaultOptions, $options);

        return $options;
    }

    public function getParent(array $options)
    {
        if ($options['hidden']) {
            return 'hidden';
        }
        return 'choice';
    }

    public function getName()
    {
        return 'null_entity';
    }
}
