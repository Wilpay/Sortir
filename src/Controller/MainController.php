<?php
namespace App\Controller;

use App\Entity\Etat;
use App\Entity\Sortie;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;

class MainController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function home(EntityManagerInterface $em)
    {
        $sorties = $em->getRepository(Sortie::class)->findAll();

        $ouverte = $em->getRepository(Etat::class)->findByLibelle('Ouverte');
        $cloturee = $em->getRepository(Etat::class)->findByLibelle('Clôturée');
        $encours = $em->getRepository(Etat::class)->findByLibelle('Activité en cours');
        $passee = $em->getRepository(Etat::class)->findByLibelle('Passée');

        foreach ($sorties as $sortie)
        {
            $date = date_timestamp_get(date_create())+3600*2;
            $datefin = $sortie->getDateHeureDebut()->getTimestamp() + $sortie->getDuree()*60;

            if($sortie->getDateLimiteInscription()->getTimestamp() < $date && $sortie->getEtat() == $ouverte)
            {
                $sortie->setEtat($cloturee);
            }

            if($sortie->getDateHeureDebut()->getTimestamp() <= $date && $date <= $datefin && $sortie->getEtat() == $cloturee)
            {
                $sortie->setEtat($encours);
            }

            if($datefin <= $date && ($sortie->getEtat() == $encours || $sortie->getEtat() == $cloturee || $sortie->getEtat() == $ouverte))
            {
                $sortie->setEtat($passee);
            }

            $em->persist($sortie);
            $em->flush();
        }

        return $this->render("main/home.html.twig", [
            'sorties' => $sorties,
        ]);
    }
}