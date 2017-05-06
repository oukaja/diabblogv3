<?php

namespace Admin\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({"adulte" = "Adulte", "enfant" = "Enfant"})
 */
abstract class Personne
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
     * @ORM\Column(name="ninscription", type="string", length=255)
     */
    private $ninscription;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateinscription", type="date")
     */
    private $dateinscription;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datenaissance", type="date")
     */
    private $datenaissance;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="remarque", type="string", length=255)
     */
    private $remarque;

    /**
     * @var string
     *
     * @ORM\Column(name="civilite", type="string", length=255)
     */
    private $civilite;

    /**
     * @var string
     *
     * @ORM\Column(name="ad", type="string", length=255)
     */
    private $ad;

    /**
     * One Product has Many Features.
     * @ORM\OneToMany(targetEntity="Visite", mappedBy="personne")
     */
    private $visite;

     /**
     * @var int
     *
     * @ORM\Column(name="adh", type="integer", options={"default":1})
     */
    private $adh;
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set ninscription
     *
     * @param string $ninscription
     * @return Personne
     */
    public function setNinscription($ninscription) {
        $this->ninscription = $ninscription;

        return $this;
    }

    /**
     * Get ninscription
     *
     * @return string 
     */
    public function getNinscription() {
        return $this->ninscription;
    }

    /**
     * Set dateinscription
     *
     * @param \DateTime $dateinscription
     * @return Personne
     */
    public function setDateinscription($dateinscription) {
        $this->dateinscription = $dateinscription;

        return $this;
    }

    /**
     * Get dateinscription
     *
     * @return \DateTime 
     */
    public function getDateinscription() {
        return $this->dateinscription;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Personne
     */
    public function setNom($nom) {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom() {
        return $this->nom;
    }

    /**
     * Set datenaissance
     *
     * @param \DateTime $datenaissance
     * @return Personne
     */
    public function setDatenaissance($datenaissance) {
        $this->datenaissance = $datenaissance;

        return $this;
    }

    /**
     * Get datenaissance
     *
     * @return \DateTime 
     */
    public function getDatenaissance() {
        return $this->datenaissance;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     * @return Personne
     */
    public function setAdresse($adresse) {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string 
     */
    public function getAdresse() {
        return $this->adresse;
    }

    /**
     * Set remarque
     *
     * @param string $remarque
     * @return Personne
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
     * Set civilite
     *
     * @param string $civilite
     * @return Personne
     */
    public function setCivilite($civilite) {
        $this->civilite = $civilite;

        return $this;
    }

    /**
     * Get civilit�
     *
     * @return string 
     */
    public function getCivilite() {
        return $this->civilite;
    }

    /**
     * Set ad
     *
     * @param string $ad
     * @return Personne
     */
    public function setAd($ad) {
        $this->ad = $ad;

        return $this;
    }

    /**
     * Get ad
     *
     * @return string 
     */
    public function getAd() {
        return $this->ad;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->visite = new \Doctrine\Common\Collections\ArrayCollection();
        $this->setDateinscription(new \DateTime());
    }

    /**
     * Add visite
     *
     * @param BlogBundle\Entity\Visite $visite
     * @return Personne
     */
    public function addVisite(\Admin\AdminBundle\Entity\Visite $visite) {
        $this->visite[] = $visite;

        return $this;
    }

    /**
     * Remove visite
     *
     * @param BlogBundle\Entity\Visite $visite
     */
    public function removeVisite(\Admin\AdminBundle\Entity\Visite $visite) {
        $this->visite->removeElement($visite);
    }

    /**
     * Get visite
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getVisite() {
        return $this->visite;
    }

    

    /**
     * Set adh
     *
     * @param integer $adh
     *
     * @return Personne
     */
    public function setAdh($adh)
    {
        $this->adh = $adh;

        return $this;
    }

    /**
     * Get adh
     *
     * @return integer
     */
    public function getAdh()
    {
        return $this->adh;
    }
}
