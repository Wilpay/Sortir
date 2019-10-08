<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class GroupesController extends Controller
{

    /**
     * @Route("/groupes", name="groupes")
     */
    public function Groupes()
    {

        return $this->render('Groupe/groupes.html.twig');

    }

}