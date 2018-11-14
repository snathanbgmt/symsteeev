<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="Accueil")
     */
    public function indexAction(Request $request)
    {
      $repository = $this->getDoctrine()->getManager()->getRepository('AppBundle:Produit');
      $produits = $repository->findBy(
          array(), // Critere
          array('nbcontributions' => 'desc'),        // Tri
          3,                              // Limite
          0                               // Offset
          );
      return $this->render('home.html.twig', array(
        'produits' => $produits,
        )
      );
    }

    /**
     * @Route("/search", name="Search")
     */
    public function searchAction(Request $request)
    {
    	$data = $request->get('input');

    	$em = $this->getDoctrine()->getManager();
      $query = $em->createQuery(''
        . 'SELECT p.id, p.name '
        . 'FROM AppBundle:Produit p ' 
        . 'WHERE p.name LIKE :data '
        . 'ORDER BY p.name ASC'
        )->setMaxResults(20)
      ->setParameter('data', '%' . $data . '%');
      $results = $query->getResult();

      $produitList = '<ul id="matchList">';
      foreach ($results as $result) {
            $matchStringBold = preg_replace('/('.$data.')/i', '<strong>$1</strong>', $result['name']); // Replace text field input by bold one
            $produitList .= '<li id="'.$result['name'].'">'.$matchStringBold.'</li>'; // Create the matching list - we put maching name in the ID too
          }
          $produitList .= '</ul>';

          $response = new JsonResponse();
          $response->setData(array('produitList' => $produitList));
          return $response;
        }

    /**
     * @Route("/searchproduct", name="SearchProduct")
     */
    public function searchproductAction(Request $request)
    {
     if ($request->isMethod('POST')) {


      $repository = $this->getDoctrine()->getManager()->getRepository('AppBundle:Produit');
      $produit = $repository->findOneBy(
		          array('name' => $_POST["produit"]), // Critere
		          array('id' => 'desc'),        // Tri
		          1,                              // Limite
		          0                               // Offset
              );
      if(is_null($produit)){

        $data = $_POST["produit"];
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(''
          . 'SELECT p '
          . 'FROM AppBundle:Produit p ' 
          . 'WHERE p.name LIKE :data '
          . 'ORDER BY p.name ASC'
          )
        ->setParameter('data', '%' . $data . '%');
        $results = $query->getResult();


      return $this->render('resultats-recherche.html.twig', array(
        'produits' =>$results,
        ));

      }else{
		            // On redirige vers la page de visualisation de l'annonce nouvellement créée
        return $this->redirectToRoute('fiche_produit', array('id' => $produit->getId()));
      }


    }else{
      $this->addFlash('warning', 'Aucun produit n\'a été trouvé');
      return $this->redirectToRoute('Accueil');
    }

  }
}
