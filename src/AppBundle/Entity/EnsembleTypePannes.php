<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EnsembleTypePannes
 *
 * @ORM\Table(name="ensemble_type_pannes")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EnsembleTypePannesRepository")
 */
class EnsembleTypePannes
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
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;


    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\TypePannes")
     */
    private $type_pannes;

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
     * Set description
     *
     * @param string $description
     *
     * @return EnsembleTypePannes
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add typePanne
     *
     * @param \AppBundle\Entity\TypePannes $typePanne
     *
     * @return EnsembleTypePannes
     */
    public function addTypePanne(\AppBundle\Entity\TypePannes $typePanne)
    {
        $this->type_pannes[] = $typePanne;

        return $this;
    }

    /**
     * Remove typePanne
     *
     * @param \AppBundle\Entity\TypePannes $typePanne
     */
    public function removeTypePanne(\AppBundle\Entity\TypePannes $typePanne)
    {
        $this->type_pannes->removeElement($typePanne);
    }

    /**
     * Get typePannes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTypePannes()
    {
        return $this->type_pannes;
    }
}
