<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends Controller
{
    /**
     * @Route("/connexion", name="connexion")
     */
    public function connexion()
    {
        return $this->render("user/connexion.html.twig");
    }

    /**
     * @Route("/monProfil", name="monProfil")
     */
    public function monProfil()
    {
        return $this->render("user/mon-profil.html.twig");
    }
}