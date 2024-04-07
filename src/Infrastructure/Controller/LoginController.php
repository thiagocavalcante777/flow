<?php

namespace App\Infrastructure\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{

    /**
     * @Route("/login", name="app_login", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
         $error = $authenticationUtils->getLastAuthenticationError();

         $lastUsername = $authenticationUtils->getLastUsername();

          return $this->render('login/index.html.twig', [
                   'last_username' => $lastUsername,
                   'error'         => $error,
          ]);
      }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout(): void
    {

    }
}
