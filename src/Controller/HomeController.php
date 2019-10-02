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
     * @Route("/", name="home")
     */
    public function home(EntityManagerInterface $em)
    {
        /*
        $sortie = $em->getRepository(Sortie::class)->findAll();
        foreach ($sortie2 as $sort)
        {
            if($sort->getDateHeureDebut() > new \DateTime('now'))
            {
                $etat = $sort->getEtat();


                $sort->setEtat();
            }




            $em->persist($sort);
            $em->flush();
        }
*/
        $sortie = $em->getRepository(Sortie::class)->findAll();
        return $this->render("main/home.html.twig", [
            'sorties' => $sortie,
        ]);

    }

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

}