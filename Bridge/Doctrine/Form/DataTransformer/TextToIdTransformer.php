<?php
/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Acme\StoreBundle\Bridge\Doctrine\Form\DataTransformer;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\Util\PropertyPath;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Symfony\Component\Form\Exception\TransformationFailedException;

class TextToIdTransformer implements DataTransformerInterface
{

    protected $em;
    protected $class;
    protected $propertyPath;

    public function __construct(EntityManager $em, $class, $property = null)
    {
        $this->em = $em;
        $this->class = $class;

        // The property option defines, which property (path) is used for
        // displaying entities as strings
        if ($property) {
            $this->propertyPath = new PropertyPath($property);
        }
    }

    /**
     * Transforms entities into text
     *
     * @param object $entity , a single entity or  NULL
     * @return mixed ,a single key or NULL
     */
    public function transform($entity)
    {
        if (null === $entity || '' === $entity) {
            return 'null';
        }

        if (!is_object($entity)) {
            throw new UnexpectedTypeException($entity, 'object');
        }

        if ($this->propertyPath) {
            // If the property option was given, use it
            $value = $this->propertyPath->getValue($entity);
        } else {
            // Otherwise expect a __toString() method in the entity
            $value = (string)$entity;
        }

        return $value;

    }

    /**
     * Transforms choice keys into entities
     *
     * @param  mixed $key   An array of keys, a single key or NULL
     * @return Collection|object  A collection of entities, a single entity
     *                            or NULL
     */
    public function reverseTransform($key)
    {
        if ('' === $key || null === $key) {
            return null;
        }

        if (!is_string($key))
        {
            return null;
        }

        if (!is_numeric($key))
        {
            throw new UnexpectedTypeException($key, 'numeric');
        }

        $entity = $this->em->getRepository($this->class)->findOneById($key);

        if ($entity === null) {
            throw new TransformationFailedException(sprintf('The entity with key "%s" could not be found', $key));
        }

        return $entity;
    }
}
