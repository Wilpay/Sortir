<?php
namespace App\Controller;

use App\Entity\Etat;
use App\Entity\Site;
use App\Entity\Participant;
use App\Entity\Profil;
use App\Entity\Sortie;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;

class MainController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function home(EntityManagerInterface $em)
    {
        $site = $em->getRepository(Site::class)->findAll();

        return $this->render("main/home.html.twig", [
            'sites' =>$site
        ]);
    }

    /**
     * @Route("/refreshSorties", name="refreshSorties")
     */
    public function refreshSorties(Request $request, EntityManagerInterface $em){

        $param = false;
        $sortiesTriees=[];
        $paramRequette=[];

        $site=$request->request->get("site");
        $recherche = $request->request->get("search");
        $orga = $request->request->get("orga");
        $inscrit= $request->request->get("inscrit");
        $nonInscrit = $request->request->get("noninscrit");
        $passe = $request->request->get("passees");
        $debut = $request->request->get("debut");
        $fin = $request->request->get("fin");
        $idPasse = $em->getRepository(etat::class)->findBy(["libelle"=>'Passée']);

        if($site!=0){
            $paramRequette["siteorganisateur"] = $site;
        }
        if($orga=="true"){
            $paramRequette["organisateur"] = $this->getUser()->getId();
        }
        if($passe=="true"){
            $paramRequette["etat"] = $idPasse[0]->getId();
        }

        if($this->isGranted('ROLE_ADMIN')){
            var_dump('ADMIN');
            if($paramRequette != []){
                $sorties = $em->getRepository(Sortie::class)->findBy($paramRequette);
            }else{
                $sorties = $em->getRepository(Sortie::class)->findAll();
            }
        } else {
            var_dump('USER');
            // Affiche sorties en retirant celle archivée et
            // En retirant celle dont l'état est 'Créée' par un organisateur différent de l'user connecté ($this->getUser()
            if($paramRequette != []){
                $sorties = $em->getRepository(Sortie::class)->findBy($paramRequette);
            }else{
                $sorties = $em->getRepository(Sortie::class)->findAll();
            }
        }

        if(!empty($recherche)){
            foreach ($sorties as $srt){
                if (stripos($srt->getNom(), $recherche) !== false) {
                    array_push($sortiesTriees, $srt);
                }
            }
            $sorties=$sortiesTriees;
        }
        $sortiesTriees=[];
        if(!empty($debut)){
            foreach ($sorties as $srt){
                if ($srt->getDateHeureDebut()->getTimestamp() >= strtotime($debut)) {
                    array_push($sortiesTriees, $srt);
                }
            }
            $sorties=$sortiesTriees;
        }
        $sortiesTriees=[];
        if(!empty($fin)){
            foreach ($sorties as $srt){
                if ($srt->getDateHeureDebut()->getTimestamp() <= strtotime($fin)) {
                    array_push($sortiesTriees, $srt);
                }
            }
            $sorties=$sortiesTriees;
        }
        $sortiesTriees=[];
        if($inscrit=="true" && $nonInscrit=="false"){
            foreach ($sorties as $srt){
                foreach ($srt->getInscrit() as $inscrit){
                    if ($inscrit->getId() == $this->getUser()->getId()) {
                        array_push($sortiesTriees, $srt);
                        break;
                    }
                }
            }
            $sorties=$sortiesTriees;
        }
        $sortiesTriees=[];
        if($inscrit=="false" && $nonInscrit=="true"){
            foreach ($sorties as $srt){
                $isInscrit=false;
                foreach ($srt->getInscrit() as $inscrit){
                    if ($inscrit->getId() == $this->getUser()->getId()) {
                        $isInscrit = true;
                        break;
                    }
                }
                if($isInscrit == false){
                    array_push($sortiesTriees, $srt);
                }
            }
            $sorties=$sortiesTriees;
        }
        $ouverte = $em->getRepository(Etat::class)->findByLibelle('Ouverte');
        $cloturee = $em->getRepository(Etat::class)->findByLibelle('Clôturée');
        $encours = $em->getRepository(Etat::class)->findByLibelle('Activité en cours');
        $passee = $em->getRepository(Etat::class)->findByLibelle('Passée');
        $archive = $em->getRepository(Etat::class)->findByLibelle('Archivée');

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

            if($datefin > new DateTime('now +30 days', new DateTimeZone('Europe/Paris')))
            {
                $sortie->setEtat($archive);
            }
            $em->persist($sortie);
            $em->flush();
        }
        return $this->render("ajax/listeSorties.html.twig", ['sorties' => $sorties]);
    }
}