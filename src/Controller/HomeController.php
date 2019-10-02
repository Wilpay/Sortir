<?php


namespace App\Controller;

use App\Entity\Etat;
use App\Entity\Participant;
use App\Entity\Sortie;
use Cassandra\Date;
use Doctrine\ORM\EntityManagerInterface;
use http\Client\Curl\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class HomeController extends Controller
{


    /**
     * @Route("/inscrire/{id}", name="inscrire")
     */
    public function Inscription(EntityManagerInterface $em, $id)
    {
        $sortie = $em->getRepository(Sortie::class)->find($id);
        $participant = $em->getRepository(Participant::class)->find($this->getUser());


        $sortie->addInscrit($participant);
        $em->persist($sortie);
        $em->flush();
        return $this->redirectToRoute('home');

    }

    /**
     * @Route("/desinscrire/{id}", name="desinscrire")
     */
    public function Desinscription(EntityManagerInterface $em, $id)
    {
        $sortie = $em->getRepository(Sortie::class)->find($id);
        $participant = $em->getRepository(Participant::class)->find($this->getUser());


        $sortie->removeInscrit($participant);
        $em->persist($sortie);
        $em->flush();
        return $this->redirectToRoute('home');

    }

    /**
     * @Route("/publier/{id}", name="publier")
     */
    public function Publier(EntityManagerInterface $em, $id)
    {
        $sortie = $em->getRepository(Sortie::class)->find($id);
        $etat = $em->getRepository(Etat::class)->findByLibelle('Ouverte');

        $sortie->setEtat($etat);



        $em->persist($sortie);
        $em->flush();
        return $this->redirectToRoute('home');

    }

    /**
     * @Route("/annuler/{id}", name="annuler")
     */
    public function Annuler(EntityManagerInterface $em, $id)
    {
        $sortie = $em->getRepository(Sortie::class)->find($id);
        $etat = $em->getRepository(Etat::class)->findByLibelle('Annulée');

        $sortie->setEtat($etat);

        $em->persist($sortie);
        $em->flush();
        return $this->redirectToRoute('home');

    }

}