<?php

namespace App\Controller;

use App\Entity\Lieu;
use App\Entity\Participant;
use App\Entity\Ville;
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
     * @Route("/lieux", name="liste_lieux")
     */
    public function lieux(EntityManagerInterface $em)
    {
        if($this->isGranted('ROLE_ADMIN')) {
            $lieux = $em->getRepository(Lieu::class)->findBy(array(), array('ville' => 'ASC'));
        }else{
            $lieux = $em->getRepository(Lieu::class)->findBy(array('modificateur'=>$this->getUser()->getId()), array('ville' => 'ASC'));
        }
        return $this->render("lieu/liste.html.twig", [
            'lieux' => $lieux,
        ]);
    }

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
            $lieu->setModificateur($this->getUser());
            $em->persist($lieu);
            $em->flush();

            if($id == 0){

                $this->addFlash('success', 'Lieu créé avec succes');
            }else{
                $this->addFlash('success', 'Lieu modifié avec succes');
            }
            return $this->redirectToRoute('liste_lieux');
        }

        return $this->render('lieu/creerLieu.html.twig', [
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/lieuSuppression/{id}", name="lieuSuppression",requirements={"id": "\d+"})
     */
    public function suppressionVille( Request $request, EntityManagerInterface $em, $id){
       /* $lieu = $em->getRepository(Lieu::class)->find($id);

        $em->remove($lieu);
        $em->flush();*/
        $em->getRepository(Lieu::class)->delete($id,$em);
        $this->addFlash('success', 'Lieu supprimé avec succes');

        return $this->redirectToRoute('liste_lieux');
    }
}
