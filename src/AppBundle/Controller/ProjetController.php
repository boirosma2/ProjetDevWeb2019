<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Projet;
use AppBundle\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Projet controller.
 *
 * @Route("projet")
 */
class ProjetController extends Controller
{
    /**
     * Lists all projet entities.
     *
     * @Route("/", name="projet_index")
     * @Method("GET")
     */
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();

        $projets = $em->getRepository('AppBundle:Projet')->findAll();

        return $this->render('projet/index.html.twig', array(
            'projets' => $projets,
        ));
    }

    /**
     * Creates a new projet entity.
     *
     * @Route("/new/{id}", name="projet_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, User $user)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        if (false === $this->get('security.authorization_checker')->isGranted('ROLE_CHEF')) {
            // Sinon on déclenche une exception « Accès interdit »

            throw new AccessDeniedException('Accès limité : vous n avez pas le droit le droit de creer un projet.');
        }
        $user = $this->get('security.token_storage')->getToken()->getUser();
        if (false === $this->get('security.authorization_checker')->isGranted('ROLE_CHEF')) {
            // Sinon on déclenche une exception « Accès interdit »

            throw new AccessDeniedException('Accès limité aux Chef de projet.');
        }

        $projet = new Projet();
        $projet->setUser($user);
        /*$form = $this->createForm('AppBundle\Form\ProjetType', $projet);*/


        $form = $this->createFormBuilder($projet)
            ->add('nom', TextType::class)
            ->add('description', TextType::class)
            ->add('dateDeb', DateTimeType::class)
            ->add('dateFin', DateTimeType::class)
            ->add('client', TextType::class)
            ->add('budget', IntegerType::class)
             ->getForm();

        $form->handleRequest($request);
        /*$builder
            ->add('nom')
            ->add('description')
            ->add('dateLimite')
            ->add('dateDebut')
            ->add('client')
            ->add('budget');*/

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($projet);
            $em->flush();

            return $this->redirectToRoute('projet_show', array('id' => $projet->getId()));
        }

        return $this->render('projet/new.html.twig', array(
            'projet' => $projet,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a projet entity.
     *
     * @Route("/{id}", name="projet_show")
     * @Method("GET")
     */
    public function showAction(Projet $projet)
    {
        $deleteForm = $this->createDeleteForm($projet);

        return $this->render('projet/show.html.twig', array(
            'projet' => $projet,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing projet entity.
     *
     * @Route("/{id}/edit", name="projet_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Projet $projet)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        if (false === $this->get('security.authorization_checker')->isGranted('ROLE_CHEF')) {
            // Sinon on déclenche une exception « Accès interdit »

            throw new AccessDeniedException('Accès limité: vous ne pouvez pas modifier ce projet ');
        }
        $deleteForm = $this->createDeleteForm($projet);
        $editForm = $this->createFormBuilder($projet)
            ->add('nom', TextType::class)
            ->add('description', TextType::class)
            ->add('dateDeb', DateTimeType::class)
            ->add('dateFin', DateTimeType::class)
            ->add('client', TextType::class)
            ->add('budget', IntegerType::class)
            ->getForm();

        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('projet_show', array('id' => $projet->getId()));
        }

        return $this->render('projet/edit.html.twig', array(
            'projet' => $projet,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a projet entity.
     *
     * @Route("/{id}", name="projet_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Projet $projet)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        if (false === $this->get('security.authorization_checker')->isGranted('ROLE_CHEF')) {
            // Sinon on déclenche une exception « Accès interdit »

            throw new AccessDeniedException('Accès limité: vous ne pouvez modifier que les projets que vous avez creer.');
        }
        $form = $this->createDeleteForm($projet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($projet);
            $em->flush();
        }

        return $this->redirectToRoute('projet_index');
    }

    /**
     * Creates a form to delete a projet entity.
     *
     * @param Projet $projet The projet entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Projet $projet)
    {

        return $this->createFormBuilder()
            ->setAction($this->generateUrl('projet_delete', array('id' => $projet->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
