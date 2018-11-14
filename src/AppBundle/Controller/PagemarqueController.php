<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use \PDO;

class PagemarqueController extends Controller
{
    /**
     * @Route("/marque/{id}", name="page_marque", requirements={"id":"\d+"})
     */
    public function marqueAction($id, Request $request)
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
          array('brand' => $id),   // Critere
          array($critere  => $criterevalue),                              // Tri
          10,                                                    // Limite
          null                                                     // Offset
          );

      $repository = $this->getDoctrine()->getManager()->getRepository('AppBundle:Brand');
      $brand = $repository->find($id);



      $subcategories = array();
      foreach ($produits as $produit){
        $test = 0;
        foreach ($subcategories as $subcategory) {
          if($subcategory == $produit->getSubcategory()){
            $test = 1;
          }
        }
        if($test == 0){
          array_push($subcategories, $produit->getSubcategory());
        }
}
      $typePannes = $subcategories[0]->getEnsembleTypePannes()->getTypePannes();
      return $this->render('page-marque.html.twig', array(
        'produits' => $produits,
        'marque' => $brand,
        'subcategories' => $subcategories,
        'pannes' => $typePannes,
        ));
    }
  }