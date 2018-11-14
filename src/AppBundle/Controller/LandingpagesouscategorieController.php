<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class LandingpagesouscategorieController extends Controller
{
    /**
     * @Route("/sous-categorie/{id}", name="landing_page_sous_categorie", requirements={"id":"\d+"})
     */
    public function souscategorieAction($id, Request $request)
    {
      $critere = "name";
      $criterevalue = "asc";

      if ($request->isMethod('POST')) {
        $trierpar =$_POST['trierpar'];
        if($trierpar == "tpc"){
          $critere = "prix";
          $criterevalue = "asc";
        }elseif($trierpar == "tpd"){
          $critere = "prix";
          $criterevalue = "desc";
        }elseif($trierpar== "tdc"){
          $critere = "defaultLifespan";
          $criterevalue = "asc";
        }else{
          $critere = "defaultLifespan";
          $criterevalue = "desc";
        }

      }
      $repository = $this->getDoctrine()->getManager()->getRepository('AppBundle:Produit');

      $produits = $repository->findBy(
          array('subcategory' => $id),   // Critere
          array($critere => $criterevalue),                              // Tri
          10,                                                    // Limite
          null                                                     // Offset
          );

      $repository = $this->getDoctrine()->getManager()->getRepository('AppBundle:SubCategory');
      $subcategory = $repository->find($id);


      $typePannes = $subcategory->getEnsembleTypePannes()->getTypePannes();

      $brands = array();
      foreach ($produits as $produit){
        $test = 0;
        foreach ($brands as $brand) {
          if($brand == $produit->getBrand()){
            $test = 1;
          }
        }
        if($test == 0){
          array_push($brands, $produit->getBrand());
        }
}

      return $this->render('landing-page-sous-categorie.html.twig', array(
        'produits' => $produits,
        'subcategory' => $subcategory,
        'brands' => $brands,
        'pannes' => $typePannes,
        ));
    }
  }