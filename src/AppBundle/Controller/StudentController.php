<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * User controller.
 *
 * @Route("student")
 */
class StudentController extends Controller
{
    /**
     * Lists all user entities.
     *
     * @Route("/", name="student_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user=$this->getUser();

        $students = $em->getRepository('AppBundle:User')->findAll();

        return $this->render('@FOSUser/Student/index.html.twig', array(
            'students' => $students,
            'user'=>$user
        ));
    }

    /**
     * Finds and displays a user entity.
     *
     * @Route("/{id}", name="student_show")
     * @Method("GET")
     */
    public function showAction(User $student)
    {
        $user=$this->getUser();
        $studentsLanguages=$student->getStudentLanguages();
        return $this->render('@FOSUser/Student/show.html.twig', array(
            'student' => $student,
            'user'=>$user,
            'studentsLanguages'=>$studentsLanguages
        ));
    }





































    /**
     * @Route("/indexforteacher/", name="student_indexforteacher")
     * @Method("GET")
     */
    public function indexforteacherAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user=$this->getUser();

        $students = $em->getRepository('AppBundle:User')->findAll();

        return $this->render('@FOSUser/Student/index_teacher.html.twig', array(
            'students' => $students,
            'user'=>$user
        ));
    }

    /**
     * @Route("/showforteacher/{id}", name="student_showforteacher")
     * @Method("GET")
     */
    public function showforteacherAction(User $student)
    {
        $user=$this->getUser();
        $studentsLanguages=$student->getStudentLanguages();
        return $this->render('@FOSUser/Student/show_teacher.html.twig', array(
            'student' => $student,
            'user'=>$user,
            'studentsLanguages'=>$studentsLanguages
        ));
    }
}
