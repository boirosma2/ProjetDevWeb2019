<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use FOS\UserBundle\Model\User as BaseUser;


/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     * @Assert\NotBlank(message="Please enter your name.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=3,
     *     max=255,
     *     minMessage="The name is too short.",
     *     maxMessage="The name is too long.",
     *     groups={"Registration", "Profile"}
     * )
     */
    protected $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     * @Assert\NotBlank(message="Please enter your name.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=3,
     *     max=255,
     *     minMessage="The name is too short.",
     *     maxMessage="The name is too long.",
     *     groups={"Registration", "Profile"}
     * )
     */
    protected $prenom;



    /**
     * @var \stdClass
     *
     * @ORM\Column(name="competences", type="object")
     */
    protected $competences;

    /**
     * @var \stdClass
     *
     * @ORM\OneToMany(targetEntity="Tache", mappedBy="user")
     */
    protected $taches;

    /**
     * @var \stdClass
     *
     * @ORM\OneToMany(targetEntity="Projet", mappedBy="user")
     */
    protected $projets;


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
    public function getNom()
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
     * Set competences
     *
     * @param \stdClass $competences
     *
     * @return User
     */
    public function SetCompetences(array $competence)
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

   /* public function __construct()
    {
        parent::__construct();
        if ($this->getFonction() == 'DEVELOPPEUR'){
            $this->roles = array('ROLE_DEV');
        }else if($this->getFonction() == 'CHEF_PROJET'){
            $this->roles = array('ROLE_CHEF');
        }

    }*/
}

