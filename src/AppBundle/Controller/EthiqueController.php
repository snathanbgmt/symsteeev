<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class EthiqueController extends Controller
{
    /**
     * @Route("/ethique", name="Notre Etique")
     */
    public function ethiqueAction(Request $request)
    {
        return $this->render('etique.html.twig'
            );
    }
}
