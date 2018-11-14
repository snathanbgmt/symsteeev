<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SubCategory
 *
 * @ORM\Table(name="sub_category")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SubCategoryRepository")
 */
class SubCategory
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
     * @ORM\Column(name="url_picture", type="string", length=255)
     */
    private $urlPicture;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Category")
     * @ORM\JoinColumn(nullable=false)
    */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\EnsembleTypePannes")
     * @ORM\JoinColumn(nullable=false)
    */
    private $ensemble_type_pannes;

    public function __construct()
  {
    $this->urlPicture = "https://image.freepik.com/icones-gratuites/icone-cible_318-84916.jpg";
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
     * @return SubCategory
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
     * Set urlPicture
     *
     * @param string $urlPicture
     *
     * @return SubCategory
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
     * Set category
     *
     * @param \AppBundle\Entity\Category $category
     *
     * @return SubCategory
     */
    public function setCategory(\AppBundle\Entity\Category $category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \AppBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set ensembleTypePannes
     *
     * @param \AppBundle\Entity\EnsembleTypePannes $ensembleTypePannes
     *
     * @return SubCategory
     */
    public function setEnsembleTypePannes(\AppBundle\Entity\EnsembleTypePannes $ensembleTypePannes)
    {
        $this->ensemble_type_pannes = $ensembleTypePannes;

        return $this;
    }

    /**
     * Get ensembleTypePannes
     *
     * @return \AppBundle\Entity\EnsembleTypePannes
     */
    public function getEnsembleTypePannes()
    {
        return $this->ensemble_type_pannes;
    }
}
