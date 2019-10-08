<?php


namespace App\Controller;


use App\Entity\Groupes;
use App\Entity\Participant;
use App\Entity\Ville;
use App\Form\GroupesType;
use App\Form\SortieType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class GroupesController extends Controller
{

    /**
     * @Route("/groupes", name="groupes")
     */
    public function Groupes(Request $request, EntityManagerInterface $em)
    {
        $groupe = new Groupes();
        $form = $this->createForm(GroupesType::class, $groupe, array('user' => $this->getUser()));
        $user = $em->getRepository(Participant::class)->find($this->getUser()->getId());
        $users = $em->getRepository(Participant::class)->findAll();
        $groupes = $em->getRepository(Groupes::class)->findByChef($user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            //$groupe->addParticipant($form->get('participants')->getData());
           //$groupe->setNom($form->get('nom')->getData());
           $groupe->setChef($user->getId());
           $em->persist($groupe);
           $em->flush();
            return $this->redirectToRoute('groupes');
        }
        //$participant = $em->getRepository(Participant::class)->find($this->getUser()->getId());
        return $this->render('Groupe/groupes.html.twig', [
            'form' => $form->createView(),
            'groupes' => $groupes,
            'users' => $users
        ]);

    }

    /**
     * @Route("/groupe/remove/{id}/{idgroupe}", name="remove_util")
     */
    public function RemoveUtil(Request $request, EntityManagerInterface $em, $id, $idgroupe)
    {
        $participant = $em->getRepository(Participant::class)->find($id);
        $groupe = $em->getRepository(Groupes::class)->find($idgroupe);
        $groupe->removeParticipant($participant);
        //$em->remove($participant);
        $em->flush();



        //$participant = $em->getRepository(Participant::class)->find($this->getUser()->getId());
        return $this->redirectToRoute('groupes');

    }

    /**
     * @Route("/groupe/removegroupe/{id}", name="remove_group")
     */
    public function RemoveGroupe(Request $request, EntityManagerInterface $em, $id)
    {
        //$participant = $em->getRepository(Participant::class)->find($id);
        $groupe = $em->getRepository(Groupes::class)->find($id);
        foreach ($groupe->getParticipants() as $participant)
        {
            $groupe->removeParticipant($participant);
        }
        $em->remove($groupe);
        //$em->remove($participant);
        $em->flush();



        //$participant = $em->getRepository(Participant::class)->find($this->getUser()->getId());
        return $this->redirectToRoute('groupes');

    }

    /**
     * @Route("/groupe/modifier/{id}", name="modifierGroupe")
     */
    public function Modifier(Request $request, EntityManagerInterface $em, $id)
    {
        $groupe = $em->getRepository(Groupes::class)->find($id);
        $form = $this->createForm(GroupesType::class, $groupe, array('user' => $this->getUser()));
        $user = $em->getRepository(Participant::class)->find($this->getUser()->getId());
        $users = $em->getRepository(Participant::class)->findAll();
        $groupes = $em->getRepository(Groupes::class)->findByChef($user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            //$groupe->addParticipant($form->get('participants')->getData());
            //$groupe->setNom($form->get('nom')->getData());
            //$groupe->setChef($user->getId());
            $em->persist($groupe);
            $em->flush();
            return $this->redirectToRoute('groupes');
        }
        //$participant = $em->getRepository(Participant::class)->find($this->getUser()->getId());
        return $this->render('Groupe/ajoutParticipantGroupe.html.twig', [
            'form' => $form->createView(),
            'groupes' => $groupes,
            'users' => $users
        ]);

    }

}