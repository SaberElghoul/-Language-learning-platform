<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\HttpFoundation\Request;

class SecurityController extends Controller
{


    /**
     * @Route("/",  name="redirect")
     */
             public function redirectAction()
        {



        $authChecker = $this->container->get('security.authorization_checker');

        $user = $this->getUser();





        if ($authChecker->isGranted('ROLE_TEACHER')) {
            return $this->redirectToRoute('fos_teacher_profile_show');
        } else if ($authChecker->isGranted('ROLE_USER')) {
            return $this->redirectToRoute('fos_user_profile_show');

        } else { return $this->render('@FOSUser/Security/admin_home.html.twig', array(
            'user' => $user,

        ));
            }
    }



    /**
     * @param Request $request
     *
     * @return Response
     */
    public function loginAction(Request $request)
    {
        /** @var $session Session */
        $session = $request->getSession();

        $authErrorKey = Security::AUTHENTICATION_ERROR;
        $lastUsernameKey = Security::LAST_USERNAME;

        // get the error if any (works with forward and redirect -- see below)
        if ($request->attributes->has($authErrorKey)) {
            $error = $request->attributes->get($authErrorKey);
        } elseif (null !== $session && $session->has($authErrorKey)) {
            $error = $session->get($authErrorKey);
            $session->remove($authErrorKey);
        } else {
            $error = null;
        }

        if (!$error instanceof AuthenticationException) {
            $error = null; // The value does not come from the security component.
        }

        // last username entered by the user
        $lastUsername = (null === $session) ? '' : $session->get($lastUsernameKey);

        $csrfToken = $this->tokenManager
            ? $this->tokenManager->getToken('authenticate')->getValue()
            : null;


        return $this->renderLogin(array(
            'last_username' => $lastUsername,
            'error' => $error,
            'csrf_token' => $csrfToken,
        ));
    }

}
