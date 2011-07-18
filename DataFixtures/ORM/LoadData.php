<?php

namespace Acme\StoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Finder\Finder;
use Acme\StoreBundle\Entity\Product;
use Acme\StoreBundle\Entity\Category;
use Acme\StoreBundle\Entity\Community;
use Acme\StoreBundle\Entity\Province;

 
class SomeProducts extends AbstractFixture implements OrderedFixtureInterface {

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

        $communities = Array();

        foreach ($loader['communities'] as $key => $community) {
            $communities[$key] = new Community();
            $communities[$key]->setName($community['name']);

            $manager->persist($communities[$key]);
        }

        $provinces = Array();

        foreach ($loader['provinces'] as $key => $province) {
            $provinces[$key] = new Province();
            $provinces[$key]->setName($province['name']);
            $provinces[$key]->setCommunity($communities[$province['community']]);

            $manager->persist($provinces[$key]);

            $this->addReference($key,$provinces[$key]);

        }

        $manager->flush();

    }

    public function getOrder()
    {
        return 1;
    }

}
