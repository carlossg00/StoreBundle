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

use Acme\StoreBundle\Entity\Provider;
use Acme\StoreBundle\Form\ProviderType;


class ProviderController extends Controller
{
     /**
     * @Route("/", name="_provider_list")
     */

    public function indexAction()
    {
        $em = $this->get('doctrine')->getEntityManager();
        $providers = $em->getRepository('AcmeStoreBundle:Provider')->findAll();
        return $this->render('AcmeStoreBundle:Provider:index.html.twig',
            array('providers' => $providers));
    }

    /**
     * @Route("/create", name="_provider_create")
     * @Route("{id}/edit", name="_provider_edit")
     */

   public function editAction($id = null)
   {
       $em = $this->get('doctrine')->getEntityManager();

       if (isset($id))
       {
            $provider = $em->getRepository('AcmeStoreBundle:Provider')->findOneById($id);
       }
       else
       {
           $provider = new Provider();
       }

       $form = $this->createForm(new ProviderType(), $provider);

       $request = $this->get('request');
       if ($request->getMethod() == 'POST') {
           $form->bindRequest($request);
            if ($form->isValid()) {
               $em->persist($provider);
               $em->flush();
               return $this->redirect($this->generateUrl('_provider_list'));
            }
       }

       return $this->render('AcmeStoreBundle:Provider:form.html.twig', array(
           'form' => $form->createView(),
           'provider' => $provider
       ));
   }

    /**
     * @Route("/{id}/delete", name="_provider_delete")
     */

    public function deleteAction($id)
    {
        $em = $this->get('doctrine')->getEntityManager();
        $provider = $em->getRepository('AcmeStoreBundle:Provider')->findOneById($id);

        if (!$provider) {
            throw $this->createNotFoundException('No provider found for id '.$id);
        }

        $em->remove($provider);
        $em->flush();

        return $this->redirect($this->generateUrl('_provider_list'));
    }



}
