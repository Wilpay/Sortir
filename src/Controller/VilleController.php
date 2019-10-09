<?php

namespace App\Controller;

use App\Entity\Ville;
use App\Form\VilleType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class VilleController extends Controller
{

    /**
     * @Route("/ville", name="liste_ville")
     */
    public function ville(EntityManagerInterface $em)
    {
        $ville = $em->getRepository(Ville::class)->findAll();

        return $this->render("ville/listeVille.html.twig", [
            'ville' => $ville,
        ]);
    }

    /**
     * @Route("/villeCreation/{id}", name="villeCreation",requirements={"id": "\d+"})
     */
    public function index( Request $request, EntityManagerInterface $em, $id){
        if($id == 0){

            $ville = new Ville();
        }else{
            $ville = $em->getRepository(Ville::class)->find($id);
        }

        $form = $this->createForm(VilleType::class, $ville);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $em->persist($ville);
            $em->flush();

            if($id == 0){

                $this->addFlash('success', 'Ville créée avec succes');
            }else{
                $this->addFlash('success', 'Ville modifiée avec succes');
            }
            return $this->redirectToRoute('liste_ville');
        }

        return $this->render('ville/creerVille.html.twig', [
            'form' => $form->createView()


        ]);
    }
}
