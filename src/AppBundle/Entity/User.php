<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User
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
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="role", type="string", length=255)
     */
    private $role;

    /**
     * @var \stdClass
     *
     * @ORM\Column(name="competences", type="object")
     */
    private $competences;

    /**
     * @var \stdClass
     *
     * @ORM\OneToMany(targetEntity="Tache", mappedBy="user")
     */
    private $taches;

    /**
     * @var \stdClass
     *
     * @ORM\OneToMany(targetEntity="Projet", mappedBy="user")
     */
    private $projets;


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
     * Set name
     *
     * @param string $name
     *
     * @return User
     */
    public function setNom($name)
    {
        $this->nom = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return User
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set role
     *
     * @param string $role
     *
     * @return User
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set competences
     *
     * @param \stdClass $competences
     *
     * @return User
     */
    public function addCompetences($competence)
    {
        $this->competences[] = $competence;

        return $this;
    }

    /**
     * Get competences
     *
     * @return \stdClass
     */
    public function getCompetences()
    {
        return $this->competences;
    }

    public function getTaches()
    {
        return $this->taches;
    }

    public function addTaches(Tache $tache)
    {
        $this->taches[] = $tache;
    }

    public function getProjets()
    {
        return $this->projets;
    }

    public function addProjets(Projet $projet)
    {
        $this->projets[] = $projet;
    }
}

