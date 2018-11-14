<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Alerte;

class SupprimerAlerteController extends Controller
{
    /**
     * @Route("/supprimerAlerte/{id}", name="SupprimerAlerte")
     */
    public function supprimerAlerteAction($id)
    {
    	$em = $this->getDoctrine()->getManager();
    	$alerte = $em->getRepository('AppBundle:Alerte')->find($id);
        foreach ($alerte->getTypealerte() as $typealerte) {
            $alerte->removeTypealerte($typealerte);
        }
        $em->persist($alerte);
        $em->flush();
        $alerte = $em->getRepository('AppBundle:Alerte')->find($id);
    	$em->remove($alerte);
		$em->flush();
		return $this->redirectToRoute('fos_user_profile_show');
    }

}
