<?php


namespace App\Controller;

use App\Entity\Participant;
use App\Entity\Profil;
use App\Form\ParticipantType;
use App\Form\ProfilType;
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
            'form' => $form->createView(),
            'utilisateur' => $user,


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
        $profil = $em->getRepository(Profil::class)->findByLibelle($user);
        $formPhoto = $this->createForm(ProfilType::class, $profil);

        $form->handleRequest($request);
        $formPhoto->handleRequest($request);
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
        else if($formPhoto->isSubmitted() && $formPhoto->isValid()){


            if (null !==  $formPhoto['file']->getData()) {
                $file = $formPhoto['file']->getData();
                // Efface le fichier et le nom déjà existant
                if (null !== $profil->getImage()) {
                    $oldFile = $this->getParameter('download_dir') . '/' . $profil->getImage();
                    if (file_exists($oldFile)) {
                        unlink($oldFile);
                    }
                }
                $filename = $this->generateUniqueFileName() . '.' . $file->guessExtension();
                $profil->setImage($filename);
                $file->move(
                    $this->getParameter('download_dir'),
                    $filename
                );

            }

            //Gérer le mot de passe : encodage



            $em->persist($profil);

            $em->flush();


            $this->addFlash('success', 'Participant modifié');
            return $this->redirectToRoute('profil');
        }
        return $this->render("user/mon-profil.html.twig", [
            'form' => $form->createView(),
            'formPhoto' => $formPhoto->createView(),
            'utilisateur' => $profil,


        ]);
    }

    /**
     * @Route("/profil/{id}", name="profil_user")
     */
    public function profil(EntityManagerInterface $em, $id)
    {
        $participant = $em->getRepository(Participant::class)->find($id);
        $profil = $em->getRepository(Profil::class)->find($participant->getId());
        return $this->render("user/profil.html.twig", [
            'participant' => $participant,
            'utilisateur' => $profil,
        ]);
    }

    /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }
}