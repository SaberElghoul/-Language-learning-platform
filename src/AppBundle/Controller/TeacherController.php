<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * User controller.
 *
 * @Route("teacher")
 */
class TeacherController extends Controller
{
    /**
     * Lists all user entities.
     *
     * @Route("/", name="teacher_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user=$this->getUser();

        $teachers = $em->getRepository('AppBundle:User')->findAll();

        return $this->render('@FOSUser/Teacher/index.html.twig', array(
            'teachers' => $teachers,
            'user'=>$user
        ));
    }

    /**
     * Finds and displays a user entity.
     *
     * @Route("/{id}", name="teacher_show")
     * @Method("GET")
     */
    public function showAction(User $teacher)
    {
        $user=$this->getUser();

        $disponibilities=$teacher->getDisponibilities();

        return $this->render('@FOSUser/Teacher/show.html.twig', array(
            'teacher' => $teacher,
            'user'=>$user,
            'disponibilities'=>$disponibilities
        ));
    }

















    /**
     * Lists all user entities.
     *
     * @Route("/indexforteacher/", name="teacher_indexforteacher")
     * @Method("GET")
     */
    public function indexforteacherAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user=$this->getUser();

        $teachers = $em->getRepository('AppBundle:User')->findAll();

        return $this->render('@FOSUser/Teacher/index_teacher.html.twig', array(
            'teachers' => $teachers,
            'user'=>$user
        ));
    }

    /**
     * Finds and displays a user entity.
     *
     * @Route("/showforteacher/{id}", name="teacher_showforteacher")
     * @Method("GET")
     */
    public function forteachershowAction(User $teacher)
    {
        $user=$this->getUser();
        $disponibilities=$teacher->getDisponibilities();

        return $this->render('@FOSUser/Teacher/show_teacher.html.twig', array(
            'teacher' => $teacher,
            'user'=>$user,
            'disponibilities'=>$disponibilities
    ));
    }
}
