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
        $sortie1->setDateHeureDebut(new \DateTime('now'));
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
        $sortie2->setDateHeureDebut(new \DateTime('now'));
        $sortie2->setDuree(48);
        $sortie2->setDateLimiteInscription(new \DateTime('2019-10-03T15:03:01.012345Z'));
        $sortie2->setNbInscriptionsMax(50);
        $sortie2->setInfosSortie('Parc d\'attraction');
        $etat = $this->getReference(EtatFixture::ETAT_REFERENCE5);
        $sortie2->setEtat($etat);
        $lieu = $this->getReference(LieuFixture::LIEU_REFERENCE2);
        $sortie2->setLieu($lieu);
        $site = $this->getReference(SiteFixture::SITE_REFERENCE3);
        $sortie2->setSiteorganisateur($site);
        $organisateur = $this->getReference(ParticipantFixture::PARTICIPANT_REFERENCE2);
        $sortie2->setOrganisateur($organisateur);

        $sortie3 = new Sortie();
        $sortie3->setNom('24h du mans');
        $sortie3->setDateHeureDebut(new \DateTime('now'));
        $sortie3->setDuree(72);
        $sortie3->setDateLimiteInscription(new \DateTime('2019-10-02T15:03:01.012345Z'));
        $sortie3->setNbInscriptionsMax(100);
        $sortie3->setInfosSortie('Course de moto avec hôtel');
        $etat = $this->getReference(EtatFixture::ETAT_REFERENCE6);
        $sortie3->setEtat($etat);
        $lieu = $this->getReference(LieuFixture::LIEU_REFERENCE3);
        $sortie3->setLieu($lieu);
        $site = $this->getReference(SiteFixture::SITE_REFERENCE4);
        $sortie3->setSiteorganisateur($site);
        $organisateur = $this->getReference(ParticipantFixture::PARTICIPANT_REFERENCE2);
        $sortie3->setOrganisateur($organisateur);

        $manager->persist($sortie1);
        $manager->persist($sortie2);
        $manager->persist($sortie3);

        $manager->flush();
    }
}