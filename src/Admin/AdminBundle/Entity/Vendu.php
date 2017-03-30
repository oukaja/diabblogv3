<?php

namespace Admin\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vendu
 *
 * @ORM\Table(name="vendu")
 * @ORM\Entity(repositoryClass="Admin\AdminBundle\Repository\VenduRepository")
 */
class Vendu
{
     function __construct() {
        $this->setDatevendu(new \DateTime());
    }
    
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
     * @ORM\Column(name="datevendu", type="datetime",  nullable=false)
     */
    private $datevendu;

    /**
     * @var int
     *
     * @ORM\Column(name="qte", type="integer")
     */
    private $qte;

    /**
     * Many Produit have One Vendu.
     * @ORM\ManyToOne(targetEntity="Produit")
     * @ORM\JoinColumn(name="produitId", referencedColumnName="id")
     */
    private $produit;

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
     * Set datevendu
     *
     * @param \DateTime $datevendu
     * @return Vendu
     */
    public function setDatevendu($datevendu) {
        $this->datevendu = $datevendu;

        return $this;
    }

    /**
     * Get datevendu
     *
     * @return \DateTime 
     */
    public function getDatevendu() {
        return $this->datevendu;
    }

    /**
     * Set qte
     *
     * @param integer $qte
     * @return Vendu
     */
    public function setQte($qte) {
        $this->qte = $qte;

        return $this;
    }

    /**
     * Get qte
     *
     * @return integer 
     */
    public function getQte() {
        return $this->qte;
    }

    /**
     * Set produit
     *
     * @param \Admin\AdminBundle\Entity\Produit$produit
     * @return Vendu
     */
    public function setProduit(\Admin\AdminBundle\Entity\Produit $produit = null) {
        $this->produit = $produit;

        return $this;
    }

    /**
     * Get produit
     *
     * @return \Admin\AdminBundle\Entity\Produit 
     */
    public function getProduit() {
        return $this->produit;
    }
    
}
