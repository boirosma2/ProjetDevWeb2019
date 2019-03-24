<?php

namespace AppBundle\DataFixtures;


use AppBundle\Entity\Projet;
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
                $user->setRoles(array('ROLE_CHEF'));
            } else {
                $user->setRoles(array('ROLE_DEV'));
            }
            $user->setUsername($user->getNom());
            $user->setEnabled(1);
            $user->setEmail('name'.$i.'@gmail.com');
            $user->setPlainPassword('password');
            $user->setSalt('');
            $user->addCompetences('Java');

            $manager->persist($user);
            $manager->flush();
            $users[] = $user;
        }
        $user = new User();
        $user->setNom('admin');
        $user->setPrenom('admin');
        $user->setRoles(array('ROLE_ADMIN'));
        $user->setUsername('admin');
        $user->setEnabled(1);
        $user->setEmail('admin@gmail.com');
        $user->setPlainPassword('admin');
        $user->addCompetences('Java');
        $manager->persist($user);
        $manager->flush();
        $users[] = $user;


        for ($i = 0; $i < 3; $i++) {
            $projets = [];
            for ($j = 0; $j < mt_rand(1, 2); $j++) {
                $projet = new Projet();
                $projet->setNom('Projet ' . $i . $j);
                $ch = <<<'MARKDOWN'
ici se trouve toutes les informations sur le projet en cours

MARKDOWN;
                $projet->setDescription($ch);

                $projet->setClient('client ' . $j);
                $projet->setBudget(12000);
                $projet->setDateDeb(new \DateTime('now + '.$j.'seconds'));
                $projet->setDateFin(new \DateTime('now + '.$j.'seconds'));
                $projet->setUser($users[$i]);
                $manager->persist($projet);
                $manager->flush();
                $projets[] = $projet;

                for ($k = 0; $k < mt_rand(1, 5); $k++) {
                    $tache = new Tache();
                    $tache->setNom('Tache ' . $k);
                    $tache->setDescription($ch);
                    $tache->setDateDeb(new \DateTime('now + '.$k.'seconds'));
                    $tache->setDateFinPrevue(new \DateTime('now + '.$k.'seconds'));
                    $tache->setDateFinReel(new \DateTime('now + '.$k.'seconds'));
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


