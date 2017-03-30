<?php

namespace Admin\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Visite
 *
 * @ORM\Table(name="visite")
 * @ORM\Entity(repositoryClass="Admin\AdminBundle\Repository\VisiteRepository")
 */
class Visite
{
    function __construct() {
        $this->setDatevisite(new \DateTime());
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
     * @ORM\Column(name="datevisite", type="datetime")
     */
    private $datevisite;

    /**
     * @var float
     *
     * @ORM\Column(name="diab", type="float")
     */
    private $diab;

    /**
     * @var string
     *
     * @ORM\Column(name="tension", type="string", length=10)
     */
    private $tension;

    /**
     * @var float
     *
     * @ORM\Column(name="poid", type="float")
     */
    private $poid;

    /**
     * @var string
     *
     * @ORM\Column(name="remarque", nullable=true, type="string", length=255)
     */
    private $remarque;

    /**
     * Many Produit have One Vendu.
     * @ORM\ManyToOne(targetEntity="Personne", inversedBy="visite")
     * @ORM\JoinColumn(name="personne", referencedColumnName="id")
     */
    private $personne;
    
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
     * Set datevisite
     *
     * @param \DateTime $datevisite
     * @return Visite
     */
    public function setDatevisite($datevisite) {
        $this->datevisite = $datevisite;

        return $this;
    }

    /**
     * Get datevisite
     *
     * @return \DateTime 
     */
    public function getDatevisite() {
        return $this->datevisite;
    }

    /**
     * Set diab
     *
     * @param float $diab
     * @return Visite
     */
    public function setDiab($diab) {
        $this->diab = $diab;

        return $this;
    }

    /**
     * Get diab
     *
     * @return float 
     */
    public function getDiab() {
        return $this->diab;
    }

    /**
     * Set tension
     *
     * @param string $tension
     * @return Visite
     */
    public function setTension($tension) {
        $this->tension = $tension;

        return $this;
    }

    /**
     * Get tension
     *
     * @return string 
     */
    public function getTension() {
        return $this->tension;
    }

    /**
     * Set poid
     *
     * @param float $poid
     * @return Visite
     */
    public function setPoid($poid) {
        $this->poid = $poid;

        return $this;
    }

    /**
     * Get poid
     *
     * @return float 
     */
    public function getPoid() {
        return $this->poid;
    }

    /**
     * Set remarque
     *
     * @param string $remarque
     * @return Visite
     */
    public function setRemarque($remarque) {
        $this->remarque = $remarque;

        return $this;
    }

    /**
     * Get remarque
     *
     * @return string 
     */
    public function getRemarque() {
        return $this->remarque;
    }

    /**
     * Set personne
     *
     * @param \Admin\AdminBundle\Entity\Personne $personne
     * @return Visite
     */
    public function setPersonne(\Admin\AdminBundle\Entity\Personne $personne = null) {
        $this->personne = $personne;

        return $this;
    }

    /**
     * Get personne
     *
     * @return \Admin\AdminBundle\Entity\Personne 
     */
    public function getPersonne() {
        return $this->personne;
    }
    
}
