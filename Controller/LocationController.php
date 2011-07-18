<?php

/*
 * This file is part of the Symfony framework.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Acme\StoreBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use \Symfony\Component\HttpFoundation\Response;

use Acme\StoreBundle\Entity\Provider;
use Acme\StoreBundle\Form\ProviderType;


class LocationController extends Controller
{
     /**
     * @Route("/", name="_location_list")
     */

    public function indexAction()
    {
        $em = $this->get('doctrine')->getEntityManager();
        $locations = $em->getRepository('AcmeStoreBundle:Location')->findAll();
        return $this->render('AcmeStoreBundle:Location:index.html.twig',
            array('locations' => $locations));
    }

       /**
     * @Route("/provinceByCommunity", name="_provinceByCommunity")
     */
    public function listProvinceByCommunityId()
    {
        $this->em = $this->get('doctrine')->getEntityManager();
        $this->repository = $this->em->getRepository('AcmeStoreBundle:Province');

        $communityId = $this->get('request')->query->get('data');

        $provinces = $this->repository->findByCommunity($communityId);

        if (empty($provinces)) {
            return new Response('<option>No provinces found for that community</option>');
        }


        $html = '';
        foreach($provinces as $province)
        {
            $html = $html . sprintf("<option value=\"%d\">%s</option>",$province->getId(), $province->getName());
        }

        return new Response($html);
    }


}
