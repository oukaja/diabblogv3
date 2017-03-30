<?php

namespace Admin\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Admin\AdminBundle\Entity\Personne;

/**
 * Enfant
 *
 * @ORM\Table(name="enfant")
 * @ORM\Entity(repositoryClass="Admin\AdminBundle\Repository\EnfantRepository")
 */
class Enfant extends Personne
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
    
     /**
     * @var string
     *
     * @ORM\Column(name="nompere", type="string", length=255, nullable=true)
     */
    private $nompere;

    /**
     * @var string
     *
     * @ORM\Column(name="nommere", type="string", length=255, nullable=true)
     */
    private $nommere;


    /**
     * Set nompere
     *
     * @param string $nompere
     * @return Enfant
     */
    public function setNompere($nompere)
    {
        $this->nompere = $nompere;

        return $this;
    }

    /**
     * Get nompere
     *
     * @return string 
     */
    public function getNompere()
    {
        return $this->nompere;
    }

    /**
     * Set nommere
     *
     * @param string $nommere
     * @return Enfant
     */
    public function setNommere($nommere)
    {
        $this->nommere = $nommere;

        return $this;
    }

    /**
     * Get nommere
     *
     * @return string 
     */
    public function getNommere()
    {
        return $this->nommere;
    }
    
}
