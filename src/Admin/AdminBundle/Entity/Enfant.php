<?php

namespace Admin\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Admin\AdminBundle\Entity\Personne;

/**
 * 
 *
 * @ORM\Entity
 * 
 */
class Enfant extends Personne
{
   


   
    
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
