<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @var \DateTime
     *
     * @ORM\Column(name="dateDebut", type="date")
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateFinPrevue", type="date")
     */
    private $dateFinPrevue;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateFinReelle", type="date")
     */
    private $dateFinReelle;

    /**
     * @var int
     *
     * @ORM\Column(name="avancement", type="integer")
     */
    private $avancement;

    /**
     * @var \stdClass
     *
     * @ORM\Column(name="projet", type="object")
     */
    private $projet;


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
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     *
     * @return Tache
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set dateFinPrevue
     *
     * @param \DateTime $dateFinPrevue
     *
     * @return Tache
     */
    public function setDateFinPrevue($dateFinPrevue)
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
     * Set dateFinReelle
     *
     * @param \DateTime $dateFinReelle
     *
     * @return Tache
     */
    public function setDateFinReelle($dateFinReelle)
    {
        $this->dateFinReelle = $dateFinReelle;

        return $this;
    }

    /**
     * Get dateFinReelle
     *
     * @return \DateTime
     */
    public function getDateFinReelle()
    {
        return $this->dateFinReelle;
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
     * Set projet
     *
     * @param \stdClass $projet
     *
     * @return Tache
     */
    public function setProjet($projet)
    {
        $this->projet = $projet;

        return $this;
    }

    /**
     * Get projet
     *
     * @return \stdClass
     */
    public function getProjet()
    {
        return $this->projet;
    }
}

