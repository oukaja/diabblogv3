<?php

namespace Admin\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VisiteNA
 *
 * @ORM\Table(name="visite_n_a")
 * @ORM\Entity(repositoryClass="Admin\AdminBundle\Repository\VisiteNARepository")
 */
class VisiteNA
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
     * @ORM\Column(name="tension", type="string", length=255)
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
     * @ORM\Column(name="remarque", type="string", length=255, nullable=true)
     */
    private $remarque;
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
     * Set diab
     *
     * @param float $diab
     * @return VisiteNA
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
     * @return VisiteNA
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
     * @return VisiteNA
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
     * @return VisiteNA
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
     * Get datevisite
     *
     * @return \DateTime 
     */
    function getDatevisite() {
        return $this->datevisite;
    }

    /**
     * Set datevisite
     *
     * @param \DateTime $datevisite
     * @return Visite
     */
    function setDatevisite(\DateTime $datevisite) {
        $this->datevisite = $datevisite;
    }
    
}
