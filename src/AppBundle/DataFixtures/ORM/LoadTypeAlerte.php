<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\TypeAlerte;
use \Datetime;

class LoadTypeAlerte implements FixtureInterface
{
  public function load(ObjectManager $manager)
  {

    $typealerte = new TypeAlerte();
    $typealerte->setName("Cochez pour être averti 1 mois avant la fin de la garantie");

    $manager->persist($typealerte);

    $typealerte = new TypeAlerte();
    $typealerte->setName("Cochez pour être averti avant la fin de la garantie");

    $manager->persist($typealerte);

    $typealerte = new TypeAlerte();
    $typealerte->setName("Cochez pour être averti quand votre produit dépasse sa durée de vie moyenne");

    $manager->persist($typealerte);

    $manager->flush();
  }
}