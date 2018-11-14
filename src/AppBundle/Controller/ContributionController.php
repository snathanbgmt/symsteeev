<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Contribution;
use AppBundle\Entity\Produit;
use AppBundle\Form\ContributionType;
use AppBundle\Form\PanneType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
class ContributionController extends Controller
{
    /**
     * @Route("/contribution", name="contribution")
     */
    public function contributionAction(Request $request)
    {
        $contribution = new Contribution();
        // On crée le FormBuilder grâce au service form factory
        $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $contribution);

        // On ajoute les champs de l'entité que l'on veut à notre formulaire
        $formBuilder
        ->add('produit', EntityType::class, array(
    'class'        => 'AppBundle:Produit',
    'choice_label' => 'name',
    'multiple'     => false,
  ))
        ->add('year', IntegerType::class)
        ->add('month', IntegerType::class)
        ->add('dead', CheckboxType::class, array('required' => false, 'label'=>'Cochez si le produit est toujours en vie'))
        ->add('Panne', CollectionType::class, array(
        'entry_type'   => PanneType::class,
        'allow_add'    => true,
        'allow_delete' => true
      ))
        ->add('Contribuer',      SubmitType::class);
        // Pour l'instant, pas de candidatures, catégories, etc., on les gérera plus tard

        // À partir du formBuilder, on génère le formulaire
        $form = $formBuilder->getForm();

        if ($request->isMethod('POST')) {
          // On fait le lien Requête <-> Formulaire
          // À partir de maintenant, la variable $advert contient les valeurs entrées dans le formulaire par le visiteur
          $form->handleRequest($request);

          // On vérifie que les valeurs entrées sont correctes
          // (Nous verrons la validation des objets en détail dans le prochain chapitre)
          if ($form->isValid()) {
            // On enregistre notre objet $advert dans la base de données, par exemple
            $em = $this->getDoctrine()->getManager();
            $contribution -> setUser($this->getUser());
            $em->persist($contribution);
            $produit = $contribution->getProduit();
            $produit->setNbcontributions($produit->getNbcontributions()+1);
            $em->persist($produit);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Contribution bien enregistrée, Merci!');

            // On redirige vers la page de visualisation de l'annonce nouvellement créée
            return $this->redirectToRoute('Accueil');
          }
        }
        return $this->render('contribution.html.twig', array(
        	'formc' => $form->createView(),

            ));
    }
}