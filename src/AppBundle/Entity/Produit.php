<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Produit
 *
 * @ORM\Table(name="produit")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProduitRepository")
 */
class Produit
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="prix", type="decimal", precision=10, scale=0)
     */
    private $prix;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_ajout", type="date")
     */
    private $dateAjout;

    /**
     * @var string
     *
     * @ORM\Column(name="url_picture", type="string", length=255)
     */
    private $urlPicture;

    /**
     * @var string
     *
     * @ORM\Column(name="default_lifespan", type="decimal", precision=10, scale=0, nullable=true)
     */
    private $defaultLifespan;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\SubCategory")
     * @ORM\JoinColumn(nullable=false)
    */
    private $subcategory;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Brand")
     * @ORM\JoinColumn(nullable=false)
    */
    private $brand;

    /**
     * @var int
     *
     * @ORM\Column(name="nbcontributions", type="integer")
     * @ORM\JoinColumn(nullable=true)
     */
    private $nbcontributions;

    public function __construct()
  {
    $this->nbcontributions = 0;
  }




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
     * Set name
     *
     * @param string $name
     *
     * @return Produit
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Produit
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
     * Set prix
     *
     * @param string $prix
     *
     * @return Produit
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return string
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set dateAjout
     *
     * @param \DateTime $dateAjout
     *
     * @return Produit
     */
    public function setDateAjout($dateAjout)
    {
        $this->dateAjout = $dateAjout;

        return $this;
    }

    /**
     * Get dateAjout
     *
     * @return \DateTime
     */
    public function getDateAjout()
    {
        return $this->dateAjout;
    }

    /**
     * Set urlPicture
     *
     * @param string $urlPicture
     *
     * @return Produit
     */
    public function setUrlPicture($urlPicture)
    {
        $this->urlPicture = $urlPicture;

        return $this;
    }

    /**
     * Get urlPicture
     *
     * @return string
     */
    public function getUrlPicture()
    {
        return $this->urlPicture;
    }

    /**
     * Set defaultLifespan
     *
     * @param string $defaultLifespan
     *
     * @return Produit
     */
    public function setDefaultLifespan($defaultLifespan)
    {
        $this->defaultLifespan = $defaultLifespan;

        return $this;
    }

    /**
     * Get defaultLifespan
     *
     * @return string
     */
    public function getDefaultLifespan()
    {
        return $this->defaultLifespan;
    }

    /**
     * Set subcategory
     *
     * @param \AppBundle\Entity\SubCategory $subcategory
     *
     * @return Produit
     */
    public function setSubcategory(\AppBundle\Entity\SubCategory $subcategory)
    {
        $this->subcategory = $subcategory;

        return $this;
    }

    /**
     * Get subcategory
     *
     * @return \AppBundle\Entity\SubCategory
     */
    public function getSubcategory()
    {
        return $this->subcategory;
    }

    /**
     * Set brand
     *
     * @param \AppBundle\Entity\Brand $brand
     *
     * @return Produit
     */
    public function setBrand(\AppBundle\Entity\Brand $brand)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return \AppBundle\Entity\Brand
     */
    public function getBrand()
    {
        return $this->brand;
    }


    /**
     * Set nbcontributions
     *
     * @param integer $nbcontributions
     *
     * @return Produit
     */
    public function setNbcontributions($nbcontributions)
    {
        $this->nbcontributions = $nbcontributions;

        return $this;
    }

    /**
     * Get nbcontributions
     *
     * @return integer
     */
    public function getNbcontributions()
    {
        return $this->nbcontributions;
    }
}
