<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use FOS\UserBundle\Controller\ProfileController as BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Finder\Exception\AccessDeniedException;

class ProfileController extends BaseController
{
    public function showAction()
    {
        $user = $this->getUser();

        $repository = $this->getDoctrine()->getManager()->getRepository('AppBundle:Alerte');

        $alertes = $repository->findBy(
          array('user' => $this->getUser()), // Critere
          array('id' => 'desc'),           // Tri
          null,                              // Limite
          null                               // Offset
        );

        $repository = $this->getDoctrine()->getManager()->getRepository('AppBundle:Contribution');

        $contributions = $repository->findBy(
          array('user' => $this->getUser()), // Critere
          array('id' => 'desc'),           // Tri
          null,                              // Limite
          null                               // Offset
        );

        return $this->render('FOSUserBundle:Profile:show.html.twig', array(
            'user' => $user,
            'alertes' => $alertes,
            'contributions' => $contributions,
        ));
    }

}