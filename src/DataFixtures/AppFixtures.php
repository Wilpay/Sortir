<?php

namespace App\DataFixtures;

use App\Entity\Etat;
use App\Entity\Lieu;
use App\Entity\Participant;
use App\Entity\Site;
use App\Entity\Sortie;
use App\Entity\Ville;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {




        for ($i = 0; $i < 5; $i++) {
            $ville = new Ville();
            $ville->setNom('Ville'.$i);
            $ville->setCodePostal('440'.$i);
            $manager->persist($ville);

            $lieu = new Lieu();
            $lieu->setNom('Lieu'.$i);
            $lieu->setRue('rue'.$i);
            $lieu->setVille($ville);
            $lieu->setLongitude($i);
            $lieu->setLatitude($i);
            $manager->persist($lieu);

            $site = new Site();
            $site->setNom('Site'.$i);
            $manager->persist($site);

            $etat = new Etat();
            if($i == 1 || $i == 3) {
                $etat->setLibelle("En cours");
            }
            else{
                $etat->setLibelle("Ouverte");
            }
            $manager->persist($etat);

            $participant = new Participant();
            if($i == 1)
            {
                //$participant = new Participant();
                $participant->setNom('nom'.$i);
                $participant->setPrenom('prenom'.$i);
                $participant->setPseudo('pseudo'.$i);
                $participant->setMail('mail'.$i.'@gmail.com');
                $password = $this->encoder->encodePassword($participant, '123');
                $participant->setPassword($password);
                $participant->setTelephone('0123456789');
                $participant->setSite($site);
                $participant->setRoles(['ROLE_ADMIN']);
                $participant->setActif(false);

            }
            else
            {
                //$participant2 = new Participant();
                $participant->setNom('nom'.$i);
                $participant->setPrenom('prenom'.$i);
                $participant->setPseudo('pseudo'.$i);
                $participant->setMail('mail'.$i.'@gmail.com');
                $password = $this->encoder->encodePassword($participant, '123');
                $participant->setPassword($password);
                $participant->setTelephone('0123456789');
                $participant->setSite($site);
                $participant->setRoles(['ROLE_USER']);
                $participant->setActif(false);
                //$manager->persist($participant);
            }
                $manager->persist($participant);


                $sortie = new Sortie();
                $sortie->setNom('sortie'.$i);
                $sortie->setOrganisateur($participant);
                $sortie->setDateHeureDebut(new \DateTime('now'));
                $sortie->setDateLimiteInscription(new \DateTime('now'));
                $sortie->setDuree(0);
                //$password = $this->encoder->encodePassword($participant, '123');
                $sortie->setEtat(1);
                $sortie->setEtats($etat);
                $sortie->setInfosSortie('infoSotie'.$i);
                $sortie->setNbInscriptionsMax(10);
                $sortie->setSiteorganisateur($site);
                $sortie->setLieu($lieu);
                $manager->persist($sortie);

        }



        $manager->flush();
    }
}
