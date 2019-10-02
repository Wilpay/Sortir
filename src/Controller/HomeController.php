<?php


namespace App\Controller;

use App\Entity\Sortie;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function home(EntityManagerInterface $em)
    {
        $sortie = $em->getRepository(Sortie::class)->findAll();

        return $this->render("main/home.html.twig", [
            'sorties' => $sortie,
        ]);

    }

}