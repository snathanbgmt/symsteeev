<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Date;

/**
 * Panne
 *
 * @ORM\Table(name="panne")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PanneRepository")
 */
class Panne
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
     * @ORM\Column(name="datepanne", type="date")
     * @ORM\JoinColumn(nullable=false)
     */
    private $datepanne;


  /**
   * @ORM\Column(name="definitif", type="boolean")
   */
  private $definitif = false;

    /** 
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TypePannes")
     */
    private $typepanne;

    /** MANY-TO-ONE BIDIRECTIONAL, OWNING SIDE
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Contribution", inversedBy="Panne")
     */
    protected $contribution;


    public function __construct()
    {
    }


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set datepanne
     *
     * @param \DateTime $datepanne
     *
     * @return Panne
     */
    public function setDatepanne($datepanne)
    {
        $this->datepanne = $datepanne;

        return $this;
    }

    /**
     * Get datepanne
     *
     * @return \DateTime
     */
    public function getDatepanne()
    {
        return $this->datepanne;
    }

    /**
     * Set definitif
     *
     * @param boolean $definitif
     *
     * @return Panne
     */
    public function setDefinitif($definitif)
    {
        $this->definitif = $definitif;

        return $this;
    }

    /**
     * Get definitif
     *
     * @return boolean
     */
    public function getDefinitif()
    {
        return $this->definitif;
    }

    /**
     * Set typepanne
     *
     * @param \AppBundle\Entity\TypePannes $typepanne
     *
     * @return Panne
     */
    public function setTypepanne(\AppBundle\Entity\TypePannes $typepanne = null)
    {
        $this->typepanne = $typepanne;

        return $this;
    }

    /**
     * Get typepanne
     *
     * @return \AppBundle\Entity\TypePannes
     */
    public function getTypepanne()
    {
        return $this->typepanne;
    }

    /**
     * Set contribution
     *
     * @param \AppBundle\Entity\Contribution $contribution
     *
     * @return Panne
     */
    public function setContribution(\AppBundle\Entity\Contribution $contribution = null)
    {
        $this->contribution = $contribution;

        return $this;
    }

    /**
     * Get contribution
     *
     * @return \AppBundle\Entity\Contribution
     */
    public function getContribution()
    {
        return $this->contribution;
    }
}
