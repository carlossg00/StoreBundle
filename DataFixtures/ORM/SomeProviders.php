<?php

namespace Acme\StoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Finder\Finder;
use Acme\StoreBundle\Entity\Provider;
use Acme\StoreBundle\Entity\Location;

 
class SomeProviders extends AbstractFixture implements OrderedFixtureInterface{

    public function load($manager)
    {
        /* load data from yaml file */

        $finder = new Finder();
        $finder->files()->name('data.yml')->in(__DIR__);

        foreach ($finder as $file) {
            $loader = Yaml::parse($file->getRealpath());
        }

        $locations = Array();

        foreach ($loader['locations'] as $key => $location) {
            $locations[$key] = new Location();
            $locations[$key]->setStreet($location['street']);
            $locations[$key]->setCity($location['city']);
            $locations[$key]->setProvince(
                $manager->merge($this->getReference($location['province'])));
            $community = $locations[$key]->getProvince()->getCommunity();
            $locations[$key]->SetCommunity($community);

            $manager->persist($locations[$key]);
        }

        $providers = Array();
        foreach ($loader['providers'] as $key => $provider) {
            $providers[$key] = new Provider();
            $providers[$key]->setName($provider['name']);
            $providers[$key]->setPhone($provider['phone']);
            $providers[$key]->setLocation($locations[$provider['location']]);

            $manager->persist($providers[$key]);
        }

        $manager->flush();

    }

    public function getOrder()
    {
        return 2;
    }

}
