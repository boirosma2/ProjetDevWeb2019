<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Projet;
use AppBundle\Entity\Tache;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Tache controller.
 *
 * @Route("tache")
 */
class TacheController extends Controller
{
    /**
     * Lists all tache entities.
     *
     * @Route("/", name="tache_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        if (false === $this->get('security.authorization_checker')->isGranted('ROLE_DEV')) {
            // Sinon on déclenche une exception « Accès interdit »

            throw new AccessDeniedException('Accès limité aux developpeurs.');
        }
        $em = $this->getDoctrine()->getManager();

        $taches = $em->getRepository('AppBundle:Tache')->findAll();

        return $this->render('tache/index.html.twig', array(
            'taches' => $taches,
        ));
    }

    /**
     * Creates a new tache entity.
     *
     * @Route("/new/{id}", name="tache_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, Projet $projet)
    {
        if (false === $this->get('security.authorization_checker')->isGranted('ROLE_CHEF')) {
            // Sinon on déclenche une exception « Accès interdit »

            throw new AccessDeniedException('Accès limité aux chefs de projets.');
        }
        $tache = new Tache();
        $tache->setProjet($projet);
        $form = $this->createFormBuilder($tache)
            ->add('nom', TextType::class)
            ->add('description', TextType::class)
            ->add('avancement', IntegerType::class)
            ->add('dateDeb', DateTimeType::class)
            ->add('dateFinPrevue', DateTimeType::class)
            ->add('dateFinReel', DateTimeType::class)
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tache);
            $em->flush();

            return $this->redirectToRoute('tache_show', array('id' => $tache->getId()));
        }

        return $this->render('tache/new.html.twig', array(
            'tache' => $tache,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a tache entity.
     *
     * @Route("/{id}", name="tache_show")
     * @Method("GET")
     */
    public function showAction(Tache $tache)
    {
        if (false === $this->get('security.authorization_checker')->isGranted('ROLE_DEV')) {
        // Sinon on déclenche une exception « Accès interdit »

        throw new AccessDeniedException('Accès limité aux developpeurs.');
        }
        $deleteForm = $this->createDeleteForm($tache);

        return $this->render('tache/show.html.twig', array(
            'tache' => $tache,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Finds and displays a tache entity.
     *
     * @Route("/{id}/ShowMyTaskes", name="tache_showAllFromProjet")
     * @Method("GET")
     */
    public function showAllFromProjectAction(Projet $projet)
    {
        if (false === $this->get('security.authorization_checker')->isGranted('ROLE_DEV')) {
            // Sinon on déclenche une exception « Accès interdit »

            throw new AccessDeniedException('Accès limité aux developpeurs.');
        }
        $em = $this->getDoctrine()
            ->getRepository(Tache::class)
            ->findBy(['projet' => $projet,]);

        if(!$em){
            throw $this->createNotFoundException(
                'No Task found for project '.$projet->getNom()
            );
        }


        return $this->render('tache/index.html.twig', array(
            'taches' => $em,
        ));
    }

    /**
     * Displays a form to edit an existing tache entity.
     *
     * @Route("/{id}/edit", name="tache_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Tache $tache)
    {
        if (false === $this->get('security.authorization_checker')->isGranted('ROLE_CHEF')) {
            // Sinon on déclenche une exception « Accès interdit »

            throw new AccessDeniedException('Accès limité aux developpeurs.');
        }
        $deleteForm = $this->createDeleteForm($tache);
        $editForm = $this->createForm('AppBundle\Form\TacheType', $tache);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tache_show', array('id' => $tache->getId()));
        }

        return $this->render('tache/edit.html.twig', array(
            'tache' => $tache,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a tache entity.
     *
     * @Route("/{id}", name="tache_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Tache $tache)
    {
        if (false === $this->get('security.authorization_checker')
                ->isGranted('ROLE_CHEF')) {
            // Sinon on déclenche une exception « Accès interdit »

            throw new AccessDeniedException('Accès limité au chef du projet.');
        }
        $form = $this->createDeleteForm($tache);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tache);
            $em->flush();
        }

        return $this->redirectToRoute('tache_index');
    }

    /**
     * Creates a form to delete a tache entity.
     *
     * @param Tache $tache The tache entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Tache $tache)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tache_delete', array('id' => $tache->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * End a tache entity.
     *
     * @Route("/{id}/terminer", name="tache_terminer")
     * @Method({"GET", "POST"})
     */
    public function terminerAction(Request $request, Tache $tache)
    {
        if (false === $this->get('security.authorization_checker')
                ->isGranted('ROLE_DEV')) {
            // Sinon on déclenche une exception « Accès interdit »

            throw new AccessDeniedException('Accès limité 
            au developpeur .');
        }
        /*$fin = (int)($tache->getDateFinPrevue()->format("d"));
        $deb = (int)($tache->getDateDeb()->format("d"));
        $datediff = $fin - $deb;*/
        $tache->setAvancement(100);
        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute('tache_index');
    }

    /**
     * Edit $avancement of a tache entity.
     *
     * @Route("/{id}/avancer", name="tache_avancer")
     * @Method({"GET", "POST"})
     */
    public function AvancerAction(Request $request, Tache $tache)
    {
        if (false === $this->get('security.authorization_checker')
                ->isGranted('ROLE_DEV')) {
            // Sinon on déclenche une exception « Accès interdit »

            throw new AccessDeniedException('Accès limité 
            au developpeur.');
        }
        $form = $this->createFormBuilder($tache)
            ->add('avancement', IntegerType::class)
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tache_Show', array('id' => $tache->getId()));
        }


        return $this->redirectToRoute('tache_index');
    }

}
