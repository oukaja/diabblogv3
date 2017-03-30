<?php

namespace Admin\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Recherche
 *
 * @ORM\Table(name="recherche")
 * @ORM\Entity(repositoryClass="Admin\AdminBundle\Repository\RechercheRepository")
 */
class Recherche
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
     * @var \DateTime
     *
     * @ORM\Column(name="dateToPrint", type="datetime")
     */
    private $dateToPrint;


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
     * Set dateToPrint
     *
     * @param \DateTime $dateToPrint
     *
     * @return Recherche
     */
    public function setDateToPrint($dateToPrint)
    {
        $this->dateToPrint = $dateToPrint;

        return $this;
    }

    /**
     * Get dateToPrint
     *
     * @return \DateTime
     */
    public function getDateToPrint()
    {
        return $this->dateToPrint;
    }
}

