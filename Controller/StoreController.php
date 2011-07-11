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

use Acme\StoreBundle\Entity\Product;
use Acme\StoreBundle\Form\ProductType;
use Acme\StoreBundle\Form\CategoryType;

class StoreController extends Controller
{
     /**
     * @Route("/", name="_product_list")
     */

    public function indexAction()
    {
        $em = $this->get('doctrine')->getEntityManager();
        $products = $em->getRepository('AcmeStoreBundle:Product')->findAll();
        return $this->render('AcmeStoreBundle:Default:index.html.twig',
            array('products' => $products));
    }

    /**
     * @Route("/create", name="_product_create")
     * @Route("{id}/edit", name="_product_edit")
     */

   public function editAction($id = null)
   {
       $em = $this->get('doctrine')->getEntityManager();

       if (isset($id))
       {
            $product = $em->getRepository('AcmeStoreBundle:Product')->findOneById($id);
       }
       else
       {
           $product = new Product();
       }

       $form = $this->createForm(new ProductType(), $product);

       $request = $this->get('request');
       if ($request->getMethod() == 'POST') {
           $form->bindRequest($request);
            if ($form->isValid()) {
               $em->persist($product);
               $em->flush();
               return $this->redirect($this->generateUrl('_product_list'));
           }
       }

       return $this->render('AcmeStoreBundle:Default:product.html.twig', array(
           'form' => $form->createView(),
       ));
   }

    /**
     * @Route("/{id}/delete", name="_product_delete")
     */

    public function deleteAction($id)
    {
        $em = $this->get('doctrine')->getEntityManager();
        $product = $em->getRepository('AcmeStoreBundle:Product')->findOneById($id);

        if (!$product) {
            throw $this->createNotFoundException('No product found for id '.$id);
        }

        $em->remove($product);
        $em->flush();

        return $this->redirect($this->generateUrl('_product_list'));
    }



}
