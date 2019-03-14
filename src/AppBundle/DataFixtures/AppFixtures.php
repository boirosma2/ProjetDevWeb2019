<?php

namespace AppBundle\DataFixtures;

use AppBundle\Entity\Film;
use AppBundle\Entity\Projet;
use AppBundle\Entity\Role;
use AppBundle\Entity\Tache;
use AppBundle\Entity\user;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $users = [];
        // create 3 films! Bam!
        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setNom('Name ' . $i);
            $user->setPrenom('Prenom ' . $i);
            if ($i < 3) {
                $user->setRole('CHEF_PROJET');
            } else {
                $user->setRole('DEVELOPPEUR');
            }
            $user->addCompetences('Java');
            $manager->persist($user);
            $manager->flush();
            $users[] = $user;
        }


        for ($i = 0; $i < 3; $i++) {
            $projets = [];
            for ($j = 0; $j < mt_rand(1, 2); $j++) {
                $projet = new Projet();
                $projet->setNom('Projet ' . $i . $j);
                $ch = <<<'MARKDOWN'
Lorem ipsum dolor sit amet consectetur adipisicing elit, sed do eiusmod tempor
incididunt ut labore et **dolore magna aliqua**: Duis aute irure dolor in
reprehenderit in voluptate 

MARKDOWN;
                $projet->setDescription($ch);

                $projet->setClient('client ' . $j);
                $projet->setBudget(12000);
                $projet->setUser($users[$i]);
                $manager->persist($projet);
                $manager->flush();
                $projets[] = $projet;

                for ($k = 0; $k < mt_rand(1, 5); $k++) {
                    $tache = new Tache();
                    $tache->setNom('Tache ' . $k);
                    $tache->setDescription($ch);
                    $tache->setAvancement($k * mt_rand(10, 20));
                    $tache->setProjet($projets[$j]);
                    $tache->setUser($users[mt_rand(3, 9)]);
                    $manager->persist($tache);
                    $manager->flush();
                }
            }
        }
    }
}


