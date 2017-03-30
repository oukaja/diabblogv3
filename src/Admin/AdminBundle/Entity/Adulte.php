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
class Adulte extends Personne
{
   


 
     /**
     * @var string
     *
     * @ORM\Column(name="cin", type="string", length=255)
     */
    private $cin;


 
    /**
     * Set cin
     *
     * @param string $cin
     * @return Adulte
     */
    public function setCin($cin)
    {
        $this->cin = $cin;

        return $this;
    }

    /**
     * Get cin
     *
     * @return string 
     */
    public function getCin()
    {
        return $this->cin;
    }
    
}
