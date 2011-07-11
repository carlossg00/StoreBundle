<?php

namespace Acme\StoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Finder\Finder;
use Acme\StoreBundle\Entity\Product;
use Acme\StoreBundle\Entity\Category;

 
class SomeProducts implements FixtureInterface{

    public function load($manager)
    {
        /* load data from yaml file */

        $finder = new Finder();
        $finder->files()->name('data.yml')->in(__DIR__);

        foreach ($finder as $file) {
            $loader = Yaml::parse($file->getRealpath());
        }

        $categories = Array();
        foreach ($loader['categories'] as $key => $category) {
            $categories[$key] = new Category();
            $categories[$key]->setName($category['name']);

            $manager->persist($categories[$key]);
        }

        $products= Array();

        foreach ($loader['products'] as $key => $product) {
            $products[$key] = new Product();
            $products[$key]->setName($product['name']);
            $products[$key]->setPrice($product['price']);
            $products[$key]->setDescription($product['description']);
            $products[$key]->setCategory($categories[$product['category']]);

            $manager->persist($products[$key]);
        }

        $manager->flush();

    }

}
