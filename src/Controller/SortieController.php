<?php

namespace App\Controller;

use App\Entity\Sortie;
use App\Form\SortieType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SortieController extends Controller
{

    /**
     * Route("/creer", name="creer")
     * @Route("/creer", name="creer")
     */
    public function creer(Request $request,EntityManagerInterface $em)
    {
        $sortie = new Sortie();
        $form = $this->createForm(SortieType::class, $sortie);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($sortie);
            $em->flush();

            $this->addFlash("success", "La sortie a été créée avec succes!");
            return $this->redirectToRoute("home");
        }

        return $this->render("sortie/creer.html.twig", ["form" => $form->createView()]);
    }

}
