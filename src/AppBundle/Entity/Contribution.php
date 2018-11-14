<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Date;

/**
 * Contribution
 *
 * @ORM\Table(name="contribution")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ContributionRepository")
 */
class Contribution
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
     * @ORM\Column(name="dateachat", type="date")
     * @ORM\JoinColumn(nullable=false)
     */
    private $dateachat;


    /**
    * @ORM\Column(name="datemort", type="date")
    */
    private $datemort;


    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Produit")
     * @ORM\JoinColumn(nullable=false)
    */
    private $produit;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(nullable=true)
    */
    private $user;

    /**
    * @ORM\OneToMany(targetEntity="AppBundle\Entity\Panne", cascade={"persist"}, mappedBy="contribution")
    */
    private $Panne;

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
     * Set produit
     *
     * @param \AppBundle\Entity\Produit $produit
     *
     * @return Contribution
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

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Contribution
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
     * Set dead
     *
     * @param boolean $dead
     *
     * @return Contribution
     */
    public function setDead($dead)
    {
        $this->dead = $dead;

        return $this;
    }

    /**
     * Get dead
     *
     * @return boolean
     */
    public function getDead()
    {
        return $this->dead;
    }

    /**
     * Set panne
     *
     * @param \AppBundle\Entity\Panne $panne
     *
     * @return Contribution
     */
    public function setPanne(\AppBundle\Entity\Panne $panne = null)
    {
        $this->Panne = $panne;

        return $this;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->Panne = new \Doctrine\Common\Collections\ArrayCollection();
        $this->dateachat = new \DateTime();
        $this->datemort = new \DateTime();
    }


    /**
     * Set dateachat
     *
     * @param \DateTime $dateachat
     *
     * @return Contribution
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
     * Set datemort
     *
     * @param \DateTime $datemort
     *
     * @return Contribution
     */
    public function setDatemort($datemort)
    {
        $this->datemort = $datemort;

        return $this;
    }

    /**
     * Get datemort
     *
     * @return \DateTime
     */
    public function getDatemort()
    {
        return $this->datemort;
    }

    /**
     * Add panne
     *
     * @param \AppBundle\Entity\Panne $panne
     *
     * @return Contribution
     */
    public function addPanne(\AppBundle\Entity\Panne $panne)
    {
        $this->Panne[] = $panne;

        return $this;
    }

    /**
     * Remove panne
     *
     * @param \AppBundle\Entity\Panne $panne
     */
    public function removePanne(\AppBundle\Entity\Panne $panne)
    {
        $this->Panne->removeElement($panne);
    }

    /**
     * Get panne
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPanne()
    {
        return $this->Panne;
    }
}
