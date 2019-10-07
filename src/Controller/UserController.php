<?php


namespace App\Controller;

use App\Entity\Participant;
use App\Entity\Profil;
use App\Entity\Sortie;
use App\Form\ParticipantType;
use App\Form\ProfilType;
use App\Form\UploadCsvType;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\Boolean;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
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
        $formCsv = $this->createForm(UploadCsvType::class);
        $formCsv->handleRequest($request);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            //Gérer le mot de passe : encodage
            $password = $encoder->encodePassword($user, $user->getPasswordPlain());
            $user->setPassword($password);
            
            //Gérer le role
            $user->setRoles(['ROLE_USER']);

            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'Participant inscrit');
            return $this->redirectToRoute('connexion');
        }
        elseif ($formCsv->isSubmitted() && $formCsv->isValid())
        {
            $filename = $formCsv['file']->getData();
            $line = array();
            $row  = 0;
            if (($file = fopen($filename, "r")) !== FALSE) {
                while (($data = fgetcsv($file, 1000, ";")) !== FALSE) {
                    $participant = new Participant();
                    $participant->setNom($data['0']);
                    $participant->setPrenom($data['1']);
                    $participant->setPseudo($data['2']);
                    $participant->setTelephone($data['3']);
                    $participant->setMail($data['4']);
                    $password = $encoder->encodePassword($participant, $data['5']);
                    $participant->setPassword($password);
                    $role = $data['6'];
                    $participant->setRoles([''.$role.'']);
                    $participant->setActif($data['7']);
                    $em->persist($participant);

                }
                fclose($file);
                $em->flush();
            }
        }

        return $this->render('user/inscription.html.twig', [
            'form' => $form->createView(),
            'formCsv' => $formCsv->createView(),
            'utilisateur' => $user,


        ]);
    }

    /**
     * @Route("/connexion", name="connexion")
     */
    public function connexion(Request $request, AuthenticationUtils $authenticationUtils, EntityManagerInterface $em, SessionInterface $session)
    {

        $errors = $authenticationUtils->getLastAuthenticationError();
        $lastname = $authenticationUtils->getLastUsername();
        $form = $this->createForm(ParticipantType::class);
        $form->handleRequest($request);

        dump($session->get("ban"));
        if($session->get("ban") == 'test')
            $this->addFlash('danger', 'Compte non actif');
        return $this->render("user/connexion.html.twig", [
            'lastusername' => $lastname,
            'form' => $form->createView(),
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
        $profil = $em->getRepository(Profil::class)->findByLibelle($participant);

        return $this->render("user/profil.html.twig", [
            'participant' => $participant,
            'utilisateur' => $profil,
        ]);
    }

    /**
     * @Route("/motdepasseoubli", name="motdepasseoubli")
     */
    public function Motdepasseoubli(EntityManagerInterface $em,\Swift_Mailer $mailer,Request $request, UserPasswordEncoderInterface $encoder)
    {
        $test = $request->request->get('mail');

        $participant = $em->getRepository(Participant::class)->findByMail($test);
        if($participant != null)
        {
            $message =  (new \Swift_Message('Hello Email'))
                ->setFrom('sortietp@gmail.com')  //nom de l'expéditeur et normalement le mail saisie
                ->setReplyTo($test)  // répondre à la personne qui envoie avec le mail saisie car sans le cela si on fait répondre y a rien
                ->setTo($test) //mail qui reçoit le message
                ->setBody("<h1>Bonjour ". $participant->getNom()."</h1>,<br/> Votre Nouveau mot de passe temporaire est 123. <br/> Envoyé par : Sortir.com", 'text/html');


            $this->get('mailer')->send($message);

            $password = $encoder->encodePassword($participant, '123');
            $participant->setPassword($password);

            $em->persist($participant);
            $em->flush();

            $this->addFlash('success', 'Email Envoyé');
            return $this->redirectToRoute('connexion');
        }
        else
            {
                $this->addFlash('warning', 'Email invalide');
                return $this->redirectToRoute('connexion');
        }
    }

    /**
     * @Route("/liste", name="liste_users")
     */
    public function liste(EntityManagerInterface $em)
    {
        $users = $em->getRepository(Participant::class)->findAll();

        return $this->render("user/liste.html.twig", [
            'users' => $users
        ]);
    }

    /**
     * @Route("/ban/{id}", name="ban")
     */
    public function ban(EntityManagerInterface $em, $id)
    {
        $user = $em->getRepository(Participant::class)->find($id);
        $user->setActif(0);
        $em->persist($user);
        $em->flush();

        return $this->redirectToRoute('liste_users');
    }

    /**
     * @Route("/unban/{id}", name="unban")
     */
    public function unban(EntityManagerInterface $em, $id)
    {
        $user = $em->getRepository(Participant::class)->find($id);
        $user->setActif(1);
        $em->persist($user);
        $em->flush();

        return $this->redirectToRoute('liste_users');
    }

    /**
     * @Route("/remove/{id}", name="remove")
     */
    public function remove(EntityManagerInterface $em, $id)
    {
        $user = $em->getRepository(Participant::class)->find($id);

        $em->remove($user);
        $em->flush();

        return $this->redirectToRoute('liste_users');
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