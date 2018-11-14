<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class LandingpagecategorieController extends Controller
{
    /**
     * @Route("/categorie/{id}", name="landing_page_categorie", requirements={"id":"\d+"})
     */
    public function categorieAction($id)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository('AppBundle:Category');
        $category = $repository->find($id);

        $repository = $this->getDoctrine()->getManager()->getRepository('AppBundle:SubCategory');

        $subcategories = $repository->findBy(
          array('category' => $category),   // Critere
          array('name' => 'desc'),                              // Tri
          null,                                                    // Limite
          null                                                     // Offset
        );

        return $this->render('landing-page-categorie.html.twig', array(
            'categorie'=> $category,
            'sous_categorie' => $subcategories
            ));
    }
}