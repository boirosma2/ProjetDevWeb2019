<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Tache
 *
 * @ORM\Table(name="tache")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TacheRepository")
 */
class Tache
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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="avancement", type="integer")
     */
    private $avancement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDeb", type="datetime")
     */
    private $dateDeb;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateFinPrevue", type="datetime")
     */
    private $dateFinPrevue;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateFinReel", type="datetime")
     */
    private $dateFinReel;

    /**
     * @var \stdClass
     * @ORM\ManyToOne(targetEntity="Projet", inversedBy="taches", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true,onDelete="CASCADE")
     */
    private $projet;

    /**
     * @var \stdClass
     * @ORM\ManyToOne(targetEntity="User", inversedBy="taches", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true,onDelete="CASCADE")
     */
    private $user;

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
     * Set nom
     *
     * @param string $nom
     *
     * @return Tache
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Tache
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set avancement
     *
     * @param integer $avancement
     *
     * @return Tache
     */
    public function setAvancement($avancement)
    {
        $this->avancement = $avancement;

        return $this;
    }

    /**
     * Get avancement
     *
     * @return int
     */
    public function getAvancement()
    {
        return $this->avancement;
    }

    /**
     * Set dateDeb
     *
     * @param \DateTime $datedeb
     *
     * @return Tache
     */
    public function setDateDeb(\DateTime $datedeb)
    {
        $this->dateDeb = $datedeb;

        return $this;
    }

    /**
     * Get dateDeb
     *
     * @return \DateTime
     */
    public function getDateDeb()
    {
        return $this->dateDeb;
    }

    /**
     * Set dateFinPrevue
     *
     * @param \DateTime $dateFinPrevue
     *
     * @return Tache
     */
    public function setDateFinPrevue(\DateTime $dateFinPrevue)
    {
        $this->dateFinPrevue = $dateFinPrevue;

        return $this;
    }

    /**
     * Get dateFinPrevue
     *
     * @return \DateTime
     */
    public function getDateFinPrevue()
    {
        return $this->dateFinPrevue;
    }

    /**
     * Set dateFinReel
     *
     * @param \DateTime $dateFinReel
     *
     * @return Tache
     */
    public function setDateFinReel(\DateTime $dateFinReel)
    {
        $this->dateFinReel = $dateFinReel;

        return $this;
    }

    /**
     * Get dateFinReel
     *
     * @return \DateTime
     */
    public function getDateFinReel()
    {
        return $this->dateFinReel;
    }

    public function getProjet()
    {
        return $this->projet;
    }

    public function setProjet(Projet $projet)
    {
        $this->projet = $projet;
    }

    public function getUser(){
        return $this->user;
    }

    public function setUser(User $user){
        $this->user = $user;
    }

    public function __construct()
    {
        $this->dateDeb = new \DateTime();
        $this->dateFinPrevue = new \DateTime();
        $this->dateFinReel = new \DateTime();
    }
}

