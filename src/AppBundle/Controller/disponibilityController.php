<?php

namespace AppBundle\Controller;

use AppBundle\Entity\disponibility;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Disponibility controller.
 *
 * @Route("teacher/disponibility")
 */
class disponibilityController extends Controller
{
    /**
     * Lists all disponibility entities.
     *
     * @Route("/", name="disponibility_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $disponibilities = $em->getRepository('AppBundle:disponibility')->findAll();

        return $this->render('disponibility/index.html.twig', array(
            'disponibilities' => $disponibilities,
        ));
    }

    /**
     * Creates a new disponibility entity.
     *
     * @Route("/add", name="disponibility_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {    $user = $this->getUser();
        $disponibility = new Disponibility();
        $form = $this->createForm('AppBundle\Form\disponibilityType', $disponibility);
        $form->handleRequest($request);
        $id=$user->getId();

        $userdata = $this -> getDoctrine()
            ->getRepository('AppBundle:User')
            ->find($id);
        $disponibilities=$userdata->getDisponibilities();

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $disponibility->setUser($user);
            $language = $form['taughtlanguage']->getData();
            $disponibility->setTaughtlanguage($language);

            $em->persist($disponibility);
            $em->flush();
            return $this->redirectToRoute('fos_teacher_profile_show');
        }

        return $this->render('FOSUserBundle:Profile:teacher_show.html.twig', array(

            'form' => $form->createView(),
            'user'=>$user,
            'disponibilities' => $disponibilities,
        ));
    }

    /**
     * Finds and displays a disponibility entity.
     *
     * @Route("/{id}", name="disponibility_show")
     * @Method("GET")
     */
    public function showAction(disponibility $disponibility)
    {
        $deleteForm = $this->createDeleteForm($disponibility);

        return $this->render('disponibility/show.html.twig', array(
            'disponibility' => $disponibility,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing disponibility entity.
     *
     * @Route("/{id}/edit", name="disponibility_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, disponibility $disponibility)
    {
        $deleteForm = $this->createDeleteForm($disponibility);
        $editForm = $this->createForm('AppBundle\Form\disponibilityType', $disponibility);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('disponibility_edit', array('id' => $disponibility->getId()));
        }

        return $this->render('disponibility/edit.html.twig', array(
            'disponibility' => $disponibility,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }


    /**
     * @Route("/disponibility_delete/{id}", name="disponibility_delete")
     */
    public function deleteAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $dispo=$em->getRepository('AppBundle:disponibility')->find($id);
        $em->remove($dispo);
        $em->flush();





        return $this->redirectToRoute('fos_teacher_profile_show');

    }

}
