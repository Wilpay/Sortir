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
        /*foreach ($sorties as $sortie)
        {
            $date = new DateTime('now');


            if($sortie->getDateLimiteInscription() > $date)
            {
                $etat = $em->getRepository(Etat::class)->findByLibelle('Clôturée');
                $sortie->setEtat($etat);

                $em->persist($sortie);
                $em->flush();
            }
        }*/

        return $this->render("main/home.html.twig", [
            'sorties' => $sorties,
        ]);
    }
}