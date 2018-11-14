<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class supprimerContributionController extends Controller
{
    /**
     * @Route("/supprimerContribution/{id}")
     */
    public function supprimerContributionAction($id)
    {
    	$em = $this->getDoctrine()->getManager();
    	$contribution = $em->getRepository('AppBundle:Contribution')->find($id);
        foreach ($contribution->getPanne() as $panne) {
            $contribution->removeTypealerte($panne);
        }
        $em->persist($contribution);
        $em->flush();
        $contribution = $em->getRepository('AppBundle:Contribution')->find($id);
    	$em->remove($contribution);
		$em->flush();
		return $this->redirectToRoute('fos_user_profile_show');
    }

}
