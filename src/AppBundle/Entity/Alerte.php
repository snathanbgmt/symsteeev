<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Alerte
 *
 * @ORM\Table(name="alerte")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AlerteRepository")
 */
class Alerte
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateachat", type="date")
     */
    private $dateachat;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dategarantie", type="date")
     */

    private $dategarantie;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Produit")
     * @ORM\JoinColumn(nullable=false)
     */
    private $produit;

   /**
   * @ORM\ManyToMany(targetEntity="AppBundle\Entity\TypeAlerte")
   */
    private $typealerte;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Alerte
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->typealerte = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Alerte
     */
    public function setUser(\AppBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add typealerte
     *
     * @param \AppBundle\Entity\TypeAlerte $typealerte
     *
     * @return Alerte
     */
    public function addTypealerte(\AppBundle\Entity\TypeAlerte $typealerte)
    {
        $this->typealerte[] = $typealerte;

        return $this;
    }

    /**
     * Remove typealerte
     *
     * @param \AppBundle\Entity\TypeAlerte $typealerte
     */
    public function removeTypealerte(\AppBundle\Entity\TypeAlerte $typealerte)
    {
        $this->typealerte->removeElement($typealerte);
    }

    /**
     * Get typealerte
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTypealerte()
    {
        return $this->typealerte;
    }

    /**
     * Set dateachat
     *
     * @param \DateTime $dateachat
     *
     * @return Alerte
     */
    public function setDateachat($dateachat)
    {
        $this->dateachat = $dateachat;

        return $this;
    }

    /**
     * Get dateachat
     *
     * @return \DateTime
     */
    public function getDateachat()
    {
        return $this->dateachat;
    }

    /**
     * Set dategarantie
     *
     * @param \DateTime $dategarantie
     *
     * @return Alerte
     */
    public function setDategarantie($dategarantie)
    {
        $this->dategarantie = $dategarantie;

        return $this;
    }

    /**
     * Get dategarantie
     *
     * @return \DateTime
     */
    public function getDategarantie()
    {
        return $this->dategarantie;
    }

    /**
     * Set produit
     *
     * @param \AppBundle\Entity\Produit $produit
     *
     * @return Alerte
     */
    public function setProduit(\AppBundle\Entity\Produit $produit)
    {
        $this->produit = $produit;

        return $this;
    }

    /**
     * Get produit
     *
     * @return \AppBundle\Entity\Produit
     */
    public function getProduit()
    {
        return $this->produit;
    }
}
