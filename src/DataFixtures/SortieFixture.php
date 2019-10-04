<?php


namespace App\DataFixtures;


use App\Entity\Participant;
use App\Entity\Sortie;
use App\Repository\EtatRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class SortieFixture extends Fixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {


        $sortie1 = new Sortie();
        $sortie1->setNom('BUC');
        $sortie1->setDateHeureDebut(new \DateTime('2020-02-01T15:03:01.012345Z'));
        $sortie1->setDuree(3);
        $sortie1->setDateLimiteInscription(new \DateTime('2020-01-01T15:03:01.012345Z'));
        $sortie1->setNbInscriptionsMax(15);
        $sortie1->setInfosSortie('Boire un coup dans un bar');
        $etat = $this->getReference(EtatFixture::ETAT_REFERENCE1);
        $sortie1->setEtat($etat);
        $lieu = $this->getReference(LieuFixture::LIEU_REFERENCE1);
        $sortie1->setLieu($lieu);
        $site = $this->getReference(SiteFixture::SITE_REFERENCE1);
        $sortie1->setSiteorganisateur($site);
        $organisateur = $this->getReference(ParticipantFixture::PARTICIPANT_REFERENCE1);
        $sortie1->setOrganisateur($organisateur);

        $participant2 = $this->getReference(ParticipantFixture::PARTICIPANT_REFERENCE2);
        $participant3 = $this->getReference(ParticipantFixture::PARTICIPANT_REFERENCE3);
      //  $sortie1->addInscrit($participant1);
        $sortie1->addInscrit($participant2);
        $sortie1->addInscrit($participant3);

        $sortie2 = new Sortie();
        $sortie2->setNom('Parc Astérix');
        $sortie2->setDateHeureDebut(new \DateTime('2019-12-05T15:03:01.012345Z'));
        $sortie2->setDuree(48);
        $sortie2->setDateLimiteInscription(new \DateTime('2019-10-03T15:03:01.012345Z'));
        $sortie2->setNbInscriptionsMax(50);
        $sortie2->setInfosSortie('Parc d\'attraction');
        $etat = $this->getReference(EtatFixture::ETAT_REFERENCE2);
        $sortie2->setEtat($etat);
        $lieu = $this->getReference(LieuFixture::LIEU_REFERENCE2);
        $sortie2->setLieu($lieu);
        $site = $this->getReference(SiteFixture::SITE_REFERENCE3);
        $sortie2->setSiteorganisateur($site);
        $organisateur = $this->getReference(ParticipantFixture::PARTICIPANT_REFERENCE2);
        $sortie2->setOrganisateur($organisateur);

        $sortie3 = new Sortie();
        $sortie3->setNom('24h du mans');
        $sortie3->setDateHeureDebut(new \DateTime('2019-10-30T15:03:01.012345Z'));
        $sortie3->setDuree(72);
        $sortie3->setDateLimiteInscription(new \DateTime('2019-10-02T15:03:01.012345Z'));
        $sortie3->setNbInscriptionsMax(100);
        $sortie3->setInfosSortie('Course de moto avec hôtel');
        $etat = $this->getReference(EtatFixture::ETAT_REFERENCE3);
        $sortie3->setEtat($etat);
        $lieu = $this->getReference(LieuFixture::LIEU_REFERENCE3);
        $sortie3->setLieu($lieu);
        $site = $this->getReference(SiteFixture::SITE_REFERENCE4);
        $sortie3->setSiteorganisateur($site);
        $organisateur = $this->getReference(ParticipantFixture::PARTICIPANT_REFERENCE2);
        $sortie3->setOrganisateur($organisateur);

        $sortie4 = new Sortie();
        $sortie4->setNom('Gagner à l\euro Millions');
        $sortie4->setDateHeureDebut(new \DateTime('2019-10-04T21:30:00.012345Z'));
        $sortie4->setDuree(1);
        $sortie4->setDateLimiteInscription(new \DateTime('2019-10-04T10:00:00.012345Z'));
        $sortie4->setNbInscriptionsMax(100000);
        $sortie4->setInfosSortie('190 millions €');
        $etat = $this->getReference(EtatFixture::ETAT_REFERENCE4);
        $sortie4->setEtat($etat);
        $lieu = $this->getReference(LieuFixture::LIEU_REFERENCE2);
        $sortie4->setLieu($lieu);
        $site = $this->getReference(SiteFixture::SITE_REFERENCE3);
        $sortie4->setSiteorganisateur($site);
        $organisateur = $this->getReference(ParticipantFixture::PARTICIPANT_REFERENCE2);
        $sortie4->setOrganisateur($organisateur);

        $sortie5 = new Sortie();
        $sortie5->setNom('Voyage Dubai');
        $sortie5->setDateHeureDebut(new \DateTime('2019-10-04T09:30:01.012345Z'));
        $sortie5->setDuree(480);
        $sortie5->setDateLimiteInscription(new \DateTime('2019-10-02T15:03:01.012345Z'));
        $sortie5->setNbInscriptionsMax(100);
        $sortie5->setInfosSortie('Course de moto avec hôtel');
        $etat = $this->getReference(EtatFixture::ETAT_REFERENCE5);
        $sortie5->setEtat($etat);
        $lieu = $this->getReference(LieuFixture::LIEU_REFERENCE1);
        $sortie5->setLieu($lieu);
        $site = $this->getReference(SiteFixture::SITE_REFERENCE1);
        $sortie5->setSiteorganisateur($site);
        $organisateur = $this->getReference(ParticipantFixture::PARTICIPANT_REFERENCE2);
        $sortie5->setOrganisateur($organisateur);

        $sortie6 = new Sortie();
        $sortie6->setNom('24h du mans');
        $sortie6->setDateHeureDebut(new \DateTime('2019-10-30T15:03:01.012345Z'));
        $sortie6->setDuree(72);
        $sortie6->setDateLimiteInscription(new \DateTime('2019-10-02T15:03:01.012345Z'));
        $sortie6->setNbInscriptionsMax(100);
        $sortie6->setInfosSortie('Course de moto avec hôtel');
        $etat = $this->getReference(EtatFixture::ETAT_REFERENCE6);
        $sortie6->setEtat($etat);
        $lieu = $this->getReference(LieuFixture::LIEU_REFERENCE2);
        $sortie6->setLieu($lieu);
        $site = $this->getReference(SiteFixture::SITE_REFERENCE2);
        $sortie6->setSiteorganisateur($site);
        $organisateur = $this->getReference(ParticipantFixture::PARTICIPANT_REFERENCE2);
        $sortie6->setOrganisateur($organisateur);




        $manager->persist($sortie1);
        $manager->persist($sortie2);
        $manager->persist($sortie3);
        $manager->persist($sortie4);
        $manager->persist($sortie5);
        $manager->persist($sortie6);

        $manager->flush();
    }
}