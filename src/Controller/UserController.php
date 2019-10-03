<?php


namespace App\Controller;

use App\Entity\Participant;
use App\Form\ParticipantType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UserController extends Controller
{
    /**
     * @Route("/inscription", name="inscription")
     */
    public function inscription(
        Request $request,
        EntityManagerInterface $em,
        UserPasswordEncoderInterface $encoder
    )
    {
        $user = new Participant();

        $form = $this->createForm(ParticipantType::class, $user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            //Gérer le mot de passe : encodage
            $password = $encoder->encodePassword($user, $user->getPasswordPlain());
            $user->setPassword($password);
            
            //Gérer le role
            $user->setRoles(['ROLE_USER']);

            $user->setActif(0);

            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'Participant inscrit');
            return $this->redirectToRoute('connexion');
        }

        return $this->render('user/inscription.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/connexion", name="connexion")
     */
    public function connexion(AuthenticationUtils $authenticationUtils)
    {
        $errors = $authenticationUtils->getLastAuthenticationError();
        $lastname = $authenticationUtils->getLastUsername();

        dump($this->getUser());

        return $this->render("user/connexion.html.twig", [
            'lastusername' => $lastname,
            'error' => $errors
        ]);
    }

    /**
     * @Route("/deconnexion", name="deconnexion")
     */
    public function deconnexion(){}

    /**
     * @Route("/profil", name="profil")
     */
    public function monProfil(
        Request $request,
        EntityManagerInterface $em,
        UserPasswordEncoderInterface $encoder
    )
    {
        $user = $this->getUser();

        $form = $this->createForm(ParticipantType::class, $user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            //Gérer le mot de passe : encodage
            $password = $encoder->encodePassword($user, $user->getPasswordPlain());
            $user->setPassword($password);

            $user->setActif(0);

            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'Participant modifié');
            return $this->redirectToRoute('profil');
        }

        return $this->render("user/mon-profil.html.twig", [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/profil/{id}", name="profil_user")
     */
    public function profil(EntityManagerInterface $em, $id)
    {
        $participant = $em->getRepository(Participant::class)->find($id);

        return $this->render("user/profil.html.twig", [
            'participant' => $participant,
        ]);
    }
}