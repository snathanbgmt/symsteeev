<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use AppBundle\Entity\Alerte;
use AppBundle\Entity\Contribution;
use AppBundle\Form\ContributionType;
use AppBundle\Form\PanneType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Entity\Produit;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class FicheproduitController extends Controller
{
    /**
     * @Route("/produit/{id}", name="fiche_produit", requirements={"id":"\d+"})
     */
    public function produitAction($id,Request $request)
    {


    $contribution = new Contribution();

    // On crée le FormBuilder grâce au service form factory
    $formBuilder1 = $this->get('form.factory')->createBuilder(FormType::class, $contribution);

    // On ajoute les champs de l'entité que l'on veut à notre formulaire
    $formBuilder1
      ->add('dateachat',DateType::class,array('label'=>'Date d\'achat du produit'))
      ->add('Panne', CollectionType::class, array(
        'entry_type'   => PanneType::class,
        'allow_add'    => true,
        'allow_delete' => true
      ))
      ->add('Contribuer',      SubmitType::class);

    $formc = $formBuilder1->getForm();

      $popupcontribution = false;
      if (isset($_GET["contribution"])) {
        $popupcontribution = true;
      }



      $repository = $this->getDoctrine()->getManager()->getRepository('AppBundle:Produit');
      $produit = $repository->find($id);

      $repository = $this->getDoctrine()->getManager()->getRepository('AppBundle:Contribution');
      $contributions = $repository->findOneBy(
          array('user' => $this->getUser(), 'produit' => $produit), // Critere
          array('id' => 'desc'),        // Tri
          1,                              // Limite
          0                               // Offset
          );
      if ($contributions==null) {
        $iscontribution = false;
        $contribution = new Contribution();
      }
      else {
        $iscontribution= true;
        $contribution = $contributions;
      }
      $repository = $this->getDoctrine()->getManager()->getRepository('AppBundle:Produit');

      $simils = $repository->findBy(
          array('subcategory' => $produit->getSubcategory()), // Critere
          array('name' => 'desc'),        // Tri
          5,                              // Limite
          0                               // Offset
          );

      $tops = $repository->findBy(
          array('subcategory' => $produit->getSubcategory()), // Critere
          array('nbcontributions' => 'desc'),        // Tri
          3,                              // Limite
          0                               // Offset
          );
      $repository = $this->getDoctrine()->getManager()->getRepository('AppBundle:Alerte');
      $alertes = $repository->findOneBy(
          array('user' => $this->getUser(), 'produit' => $produit), // Critere
          array('id' => 'desc'),        // Tri
          1,                              // Limite
          0                               // Offset
          );
      if ($alertes==null) {
        $isalerte = false;
        $alerte = new Alerte();
      }
      else {
        $isalerte= true;
        $alerte = $alertes;
      }

        //Form Alerte


        // On crée le FormBuilder grâce au service form factory
      $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $alerte);

        // On ajoute les champs de l'entité que l'on veut à notre formulaire
      $formBuilder
      ->add('dateachat',      DateType::class, array('label'=> 'Date d\'achat du produit:'))
      ->add('dategarantie',      DateType::class, array('label'=> 'Date de fin de garantie du produit:'))
      ->add('typealerte', EntityType::class, array(
        'class'        => 'AppBundle:TypeAlerte',
        'choice_label' => 'name',
        'multiple'     => true,
        'expanded'     =>true,
        ))
      ->add('Creer mon alerte',      SubmitType::class)
      ;
        // Pour l'instant, pas de candidatures, catégories, etc., on les gérera plus tard

        // À partir du formBuilder, on génère le formulaire
      $form = $formBuilder->getForm();


        // Si la requête est en POST
      if ($request->isMethod('POST')) {
          // On fait le lien Requête <-> Formulaire
          // À partir de maintenant, la variable $advert contient les valeurs entrées dans le formulaire par le visiteur
        $form->handleRequest($request);
        $formc->handleRequest($request);

        if ($request->request->has('form')) {
          // On vérifie que les valeurs entrées sont correctes
          // (Nous verrons la validation des objets en détail dans le prochain chapitre)
          if ($form->isSubmitted() and $form->isValid()) {
           echo "string";
            // On enregistre notre objet $advert dans la base de données, par exemple
            $em = $this->getDoctrine()->getManager();
            $alerte -> setProduit($produit);
            $alerte -> setUser($this->getUser());
            $em->persist($alerte);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Alerte bien enregistrée.');

            // On redirige vers la page de visualisation de l'annonce nouvellement créée
            return $this->redirectToRoute('Accueil');
          }
        }else if ($formc->isSubmitted()) {

          // On vérifie que les valeurs entrées sont correctes
          // (Nous verrons la validation des objets en détail dans le prochain chapitre)
          if ($formc->isValid()) {
            // On enregistre notre objet $advert dans la base de données, par exemple
            $em = $this->getDoctrine()->getManager();
            $contribution -> setProduit($produit);
            $contribution -> setUser($this->getUser());
            $em->persist($contribution);
            $produit->setNbcontributions($produit->getNbcontributions()+1);
            $em->persist($produit);
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice', 'Contribution bien enregistrée, MERCI!');

            // On redirige vers la page de visualisation de l'annonce nouvellement créée
            return $this->redirectToRoute('Accueil');
          }
        }

      }
        //panes

      $typePannes = $produit->getSubcategory()->getEnsembleTypePannes()->getTypePannes();

      $repository = $this->getDoctrine()->getManager()->getRepository('AppBundle:Panne');
      $Tpannes = array();
      $courrante;
      $nbcourrante=0;
      $year=0;
      $month=0;
      foreach ($typePannes as $typePanne){

        $pannes = $repository->findBy(
          array('typepanne' => $typePanne),
          array('id' => 'desc')
          );
        $T1pannes = array($typePanne->getName() => count($pannes) );
        $Tpannes=array_merge($Tpannes, $T1pannes);
        if(count($pannes)>=$nbcourrante){
          $courrante=$typePanne;
          $nbcourrante = count($pannes);
          foreach ($pannes as $panne){
            $year = $year + $panne->getYear();
            $month=$month + $panne->getMonth();
          }
          if(count($pannes) == 0){
            $year = 0;
            $month = 0;
          }else{
            $year = $year/count($pannes);
            $month = $month/count($pannes);
          }
        }
      }


      return $this->render('fiche-produit.html.twig', array(
        'courante' =>$courrante->getName(),
        'year'=>$year,
        'month'=>$month,
        'typePannes' => $Tpannes,
        'produit' => $produit,
        'simils' => $simils,
        'tops' => $tops,
        'form' => $form->createView(),
        'formc' => $formc->createView(),
        'isalerte' =>$isalerte,
        'iscontribution' => $iscontribution,
        'popupcontribution' => $popupcontribution,
        ));
    }
  }