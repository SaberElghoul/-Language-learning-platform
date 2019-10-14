<?php

namespace AppBundle\Controller;

use AppBundle\Entity\StudentLanguages;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\RedirectResponse;
use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\FilterUserResponseEvent;




/**
 * Studentlanguage controller.
 *
 * @Route("student_profile")
 */
class StudentLanguagesController extends Controller
{


    /**
     * Creates a new studentLanguage entity.
     *
     * @Route("/", name="studentlanguages_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {   $user = $this->getUser();
        $studentLanguage = new StudentLanguages();
        $form = $this->createForm('AppBundle\Form\StudentLanguagesType', $studentLanguage);
        $form->handleRequest($request);
        $id=$user->getId();

        $userdata = $this -> getDoctrine()
            ->getRepository('AppBundle:User')
            ->find($id);
        $studentsLanguages=$userdata->getStudentLanguages();

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $language = $form['Languages']->getData();
            $studentLanguage->setLanguages($language);
            $studentLanguage->setUsers($user);
            $level = $form['level']->getData();
            $studentLanguage->setUsers($user);

            $em->persist($studentLanguage);
            $em->flush();

            return $this->redirectToRoute('fos_user_profile_show');
        }

        return $this->render('FOSUserBundle:Profile:show.html.twig', array(
            'studentLanguage' => $studentLanguage,
            'form' => $form->createView(),
            'user' => $user,
            'studentsLanguages'=> $studentsLanguages,
        ));
    }












    /**
     * @Route("/edit", name="student_profile_edit")
     */


    public function editAction(Request $request)
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        /** @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface */
        $formFactory = $this->get('form.factory');

        $form = $formFactory->create('AppBundle\Form\TeacherProfileFormType', $user);
        $form->setData($user);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $file=$user->getImage();
            $fileName=md5(uniqid()).'.'.$file->guessExtension();
            $file->move(
                $this->getParameter('images_directory'),$fileName
            );
            $user->setImage($fileName);


            /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
            $userManager = $this->get('fos_user.user_manager');
            $event = new FormEvent($form, $request);
            $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_SUCCESS, $event);

            $userManager->updateUser($user);

            if (null === $response = $event->getResponse()) {
                $url = $this->generateUrl('fos_user_profile_show');
                $response = new RedirectResponse($url);
            }

            $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

            return $response;
        }


        return $this->render('FOSUserBundle:Profile:edit.html.twig', array(

            'form' => $form->createView(),
            'user' => $user
        ));
    }

    /**
     * Displays a form to edit an existing studentLanguage entity.
     *
     * @Route("/{id}/edit_language", name="studentlanguages_edit")
     * @Method({"GET", "POST"})
     */
    public function edit_languageAction(Request $request, StudentLanguages $studentLanguage)
    {
        $deleteForm = $this->createDeleteForm($studentLanguage);
        $editForm = $this->createForm('AppBundle\Form\StudentLanguagesType', $studentLanguage);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('studentlanguages_edit', array('id' => $studentLanguage->getId()));
        }

        return $this->render('studentlanguages/edit.html.twig', array(
            'studentLanguage' => $studentLanguage,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }


    /**
     * @Route("/languageDelete/{id}", name="languageDelete")
     */
    public function deleteAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $StudentLanguages=$em->getRepository('AppBundle:StudentLanguages')->find($id);
        $em->remove($StudentLanguages);
        $em->flush();





        return $this->redirectToRoute('fos_user_profile_show');

    }

}
