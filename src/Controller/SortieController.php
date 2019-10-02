<?php

namespace App\Controller;

use App\Entity\Lieu;
use App\Entity\Sortie;
use App\Entity\Ville;
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
        $sortie->setOrganisateur($this->getUser());
        $sortie->setSiteOrganisateur($this->getUser()->getSite());
        $form = $this->createForm(SortieType::class, $sortie,["allow_extra_fields" => true]);
        $villeOrga =$this->getUser()->getSite();
        $villes = $em->getRepository(Ville::class)->findAll();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $idLieu = $request->request->get('lieu');
            $lieu = $em->getRepository(Lieu::class)->find($idLieu);
            $sortie->setLieu($lieu);
            $em->persist($sortie);
            $em->flush();

            $this->addFlash("success", "La sortie a été créée avec succes!");
            return $this->redirectToRoute("home");
        }

        return $this->render("sortie/creer.html.twig", ["form" => $form->createView(),"villes"=>$villes,"villeOrga"=>$villeOrga]);
    }

    /**
     * Route("/majLieux", name="majLieux")
     * @Route("/majLieux", name="majLieux")
     */
    public function majLieux(Request $request,EntityManagerInterface $em){
        //$request = $this->getRequest();
        $idVille = $request->request->get('idVille');
        $ville= $em->getRepository(Ville::class)->find($idVille);
        $lieux = $em->getRepository(Lieu::class)->findBy(['ville'=>$idVille]);
        return $this->render("ajax/listeLieux", ["lieux"=>$lieux,"cp"=>$ville->getCodePostal()]);
    }

    /**
     * Route("/majInfoLieu", name="majInfoLieu")
     * @Route("/majInfoLieu", name="majInfoLieu")
     */
    public function majInfoLieu(Request $request,EntityManagerInterface $em){
        $idLieu = $request->request->get('idLieu');
        $lieu = $em->getRepository(Lieu::class)->find($idLieu);
        return $this->render("ajax/majInfoLieu", ["lieu"=>$lieu]);
    }


    /**
     * @Route("/sortie/{id}", name="sortie")
     */
    public function sortie(EntityManagerInterface $em, $id)
    {
        $sortie = $em->getRepository(Sortie::class)->find($id);

        return $this->render("sortie/afficher.html.twig", [
            'sortie' => $sortie,
        ]);
    }
}
