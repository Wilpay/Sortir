<?php

namespace App\Controller;

use App\Entity\Lieu;
use App\Entity\Participant;
use App\Form\LieuType;
use App\Form\ParticipantType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class LieuController extends Controller
{
    /**
     * @Route("/lieuCreation/{id}", name="lieuCreation",requirements={"id": "\d+"})
     */
    public function index( Request $request, EntityManagerInterface $em, $id){
        if($id == 0){

            $lieu = new Lieu();
        }else{
            $lieu = $em->getRepository(Lieu::class)->find($id);
        }


        $form = $this->createForm(LieuType::class, $lieu);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $em->persist($lieu);
            $em->flush();

            $this->addFlash('success', 'Lieu créé');
            return $this->redirectToRoute('home');
        }

        return $this->render('lieu/creerLieu.html.twig', [
            'form' => $form->createView()


        ]);
    }
}
