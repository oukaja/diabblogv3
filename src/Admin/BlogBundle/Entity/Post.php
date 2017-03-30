<?php

namespace Admin\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Vlabs\MediaBundle\Annotation\Vlabs; 

/**
 * Post
 *
 * @ORM\Table(name="post")
 * @ORM\Entity(repositoryClass="Admin\BlogBundle\Repository\PostRepository")
 */
class Post {

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
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="corps", type="text")
     */
    private $corps;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="publicationDate", type="datetime")
     */
    private $publicationDate;

    /**
     * @var VlabsFile
     *
     * @ORM\OneToOne(targetEntity="Image", cascade={"persist", "remove"}, orphanRemoval=true))
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="image", referencedColumnName="id")
     * })
     * 
     * @Vlabs\Media(identifier="image_entity", upload_dir="files/images")
     * @Assert\Valid()
     */
    private $image;

    /**
     * Set image
     *
     * @param Admin\BlogBundle\Entity\Image $image
     * @return Post
     */
    public function setImage(Image $image = null) {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return Admin\BlogBundle\Entity\Image
     */
    public function getImage() {
        return $this->image;
    }

    function __construct() {
        $this->publicationDate = new \DateTime('now');
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set titre
     *
     * @param string $titre
     *
     * @return Post
     */
    public function setTitre($titre) {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre() {
        return $this->titre;
    }

    /**
     * Set corps
     *
     * @param string $corps
     *
     * @return Post
     */
    public function setCorps($corps) {
        $this->corps = $corps;

        return $this;
    }

    /**
     * Get corps
     *
     * @return string
     */
    public function getCorps() {
        return $this->corps;
    }

    /**
     * Set publicationDate
     *
     * @param \DateTime $publicationDate
     *
     * @return Post
     */
    public function setPublicationDate($publicationDate) {
        $this->publicationDate = $publicationDate;

        return $this;
    }

    /**
     * Get publicationDate
     *
     * @return \DateTime
     */
    public function getPublicationDate() {
        return $this->publicationDate;
    }

}
