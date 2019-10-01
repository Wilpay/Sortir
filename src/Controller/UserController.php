<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UserController extends Controller
{
    /**
     * @Route("/connexion", name="connexion")
     */
    public function connexion(AuthenticationUtils $authenticationUtils, Request $request)
    {
        $errors = $authenticationUtils->getLastAuthenticationError();
        $lastname = $authenticationUtils->getLastUsername();

        dump($this->getUser());

        return $this->render("user/connexion.html.twig", [
            'lastusername' => $lastname,
            'error' => $errors
        ]);
    }

    /**
     * @Route("/deconnexion", name="deconnexion")
     */
    public function deconnexion(){}

    /**
     * @Route("/monProfil", name="monProfil")
     */
    public function monProfil()
    {
        return $this->render("user/mon-profil.html.twig");
    }

    /**
     * @Route("/profil", name="profil")
     */
    public function profil()
    {
        return $this->render("user/profil.html.twig");
    }
}