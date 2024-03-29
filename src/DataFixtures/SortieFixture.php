<?php


namespace App\DataFixtures;


use App\Entity\Participant;
use App\Entity\Sortie;
use App\Repository\EtatRepository;
use DateInterval;
use DateTime;
use DateTimeZone;
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
        $sortie1->setDateHeureDebut(new DateTime('now +3 days', new DateTimeZone('Europe/Paris')));
        $sortie1->setDuree(3);
        $sortie1->setDateLimiteInscription(new DateTime('now +1 day', new DateTimeZone('Europe/Paris')));
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

        $sortie2 = new Sortie();
        $sortie2->setNom('Parc Astérix');
        $sortie2->setDateHeureDebut(new DateTime('now +13 days', new DateTimeZone('Europe/Paris')));
        $sortie2->setDuree(48);
        $sortie2->setDateLimiteInscription(new DateTime('now +5 days', new DateTimeZone('Europe/Paris')));
        $sortie2->setNbInscriptionsMax(3);
        $sortie2->setInfosSortie('Parc d\'attraction');
        $etat = $this->getReference(EtatFixture::ETAT_REFERENCE2);
        $sortie2->setEtat($etat);
        $lieu = $this->getReference(LieuFixture::LIEU_REFERENCE2);
        $sortie2->setLieu($lieu);
        $site = $this->getReference(SiteFixture::SITE_REFERENCE3);
        $sortie2->setSiteorganisateur($site);
        $organisateur = $this->getReference(ParticipantFixture::PARTICIPANT_REFERENCE2);
        $sortie2->setOrganisateur($organisateur);

        $participant2 = $this->getReference(ParticipantFixture::PARTICIPANT_REFERENCE1);
        $participant3 = $this->getReference(ParticipantFixture::PARTICIPANT_REFERENCE3);
        $sortie2->addInscrit($participant2);
        $sortie2->addInscrit($participant3);

        $sortie8 = new Sortie();
        $sortie8->setNom('Parc Astérix 2');
        $sortie8->setDateHeureDebut(new DateTime('now +13 days', new DateTimeZone('Europe/Paris')));
        $sortie8->setDuree(48);
        $sortie8->setDateLimiteInscription(new DateTime('now +5 days', new DateTimeZone('Europe/Paris')));
        $sortie8->setNbInscriptionsMax(2);
        $sortie8->setInfosSortie('Parc d\'attraction');
        $etat = $this->getReference(EtatFixture::ETAT_REFERENCE2);
        $sortie8->setEtat($etat);
        $lieu = $this->getReference(LieuFixture::LIEU_REFERENCE2);
        $sortie8->setLieu($lieu);
        $site = $this->getReference(SiteFixture::SITE_REFERENCE3);
        $sortie8->setSiteorganisateur($site);
        $organisateur = $this->getReference(ParticipantFixture::PARTICIPANT_REFERENCE2);
        $sortie8->setOrganisateur($organisateur);

        $participant2 = $this->getReference(ParticipantFixture::PARTICIPANT_REFERENCE1);
        $participant3 = $this->getReference(ParticipantFixture::PARTICIPANT_REFERENCE3);
        $sortie8->addInscrit($participant2);
        $sortie8->addInscrit($participant3);

        $sortie3 = new Sortie();
        $sortie3->setNom('24h du mans');
        $sortie3->setDateHeureDebut(new DateTime('now +5 days', new DateTimeZone('Europe/Paris')));
        $sortie3->setDuree(72);
        $sortie3->setDateLimiteInscription(new DateTime('now -2 days', new DateTimeZone('Europe/Paris')));
        $sortie3->setNbInscriptionsMax(24);
        $sortie3->setInfosSortie('Course de moto avec hôtel');
        $etat = $this->getReference(EtatFixture::ETAT_REFERENCE3);
        $sortie3->setEtat($etat);
        $lieu = $this->getReference(LieuFixture::LIEU_REFERENCE3);
        $sortie3->setLieu($lieu);
        $site = $this->getReference(SiteFixture::SITE_REFERENCE4);
        $sortie3->setSiteorganisateur($site);
        $organisateur = $this->getReference(ParticipantFixture::PARTICIPANT_REFERENCE3);
        $sortie3->setOrganisateur($organisateur);

        $sortie4 = new Sortie();
        $sortie4->setNom('Gagner à l\'euro Millions');
        $sortie4->setDateHeureDebut(new DateTime('now', new DateTimeZone('Europe/Paris')));
        $sortie4->setDuree(30);
        $sortie4->setDateLimiteInscription(new DateTime('now -4 days', new DateTimeZone('Europe/Paris')));
        $sortie4->setNbInscriptionsMax(1);
        $sortie4->setInfosSortie('190 millions €');
        $etat = $this->getReference(EtatFixture::ETAT_REFERENCE4);
        $sortie4->setEtat($etat);
        $lieu = $this->getReference(LieuFixture::LIEU_REFERENCE2);
        $sortie4->setLieu($lieu);
        $site = $this->getReference(SiteFixture::SITE_REFERENCE3);
        $sortie4->setSiteorganisateur($site);
        $organisateur = $this->getReference(ParticipantFixture::PARTICIPANT_REFERENCE3);
        $sortie4->setOrganisateur($organisateur);

        $sortie5 = new Sortie();
        $sortie5->setNom('Voyage Dubai');
        $sortie5->setDateHeureDebut(new DateTime('now -5 days', new DateTimeZone('Europe/Paris')));
        $sortie5->setDuree(480);
        $sortie5->setDateLimiteInscription(new DateTime('now -7 days', new DateTimeZone('Europe/Paris')));
        $sortie5->setNbInscriptionsMax(50);
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
        $sortie6->setNom('Concert');
        $sortie6->setDateHeureDebut(new DateTime('now +8 days', new DateTimeZone('Europe/Paris')));
        $sortie6->setDuree(72);
        $sortie6->setDateLimiteInscription(new DateTime('now +1 days', new DateTimeZone('Europe/Paris')));
        $sortie6->setNbInscriptionsMax(25);
        $sortie6->setInfosSortie('Au zenith de Nantes');
        $sortie6->setMotif('Annulé pour cause de pluie');
        $etat = $this->getReference(EtatFixture::ETAT_REFERENCE6);
        $sortie6->setEtat($etat);
        $lieu = $this->getReference(LieuFixture::LIEU_REFERENCE2);
        $sortie6->setLieu($lieu);
        $site = $this->getReference(SiteFixture::SITE_REFERENCE2);
        $sortie6->setSiteorganisateur($site);
        $organisateur = $this->getReference(ParticipantFixture::PARTICIPANT_REFERENCE3);
        $sortie6->setOrganisateur($organisateur);

        $sortie7 = new Sortie();
        $sortie7->setNom('Sortie Archivée');
        $sortie7->setDateHeureDebut(new DateTime('now -9 days', new DateTimeZone('Europe/Paris')));
        $sortie7->setDuree(56);
        $sortie7->setDateLimiteInscription(new DateTime('now -19 days', new DateTimeZone('Europe/Paris')));
        $sortie7->setNbInscriptionsMax(5);
        $sortie7->setInfosSortie('Au zenith de Nantes');
        $etat = $this->getReference(EtatFixture::ETAT_REFERENCE7);
        $sortie7->setEtat($etat);
        $lieu = $this->getReference(LieuFixture::LIEU_REFERENCE2);
        $sortie7->setLieu($lieu);
        $site = $this->getReference(SiteFixture::SITE_REFERENCE2);
        $sortie7->setSiteorganisateur($site);
        $organisateur = $this->getReference(ParticipantFixture::PARTICIPANT_REFERENCE1);
        $sortie7->setOrganisateur($organisateur);

        $manager->persist($sortie1);
        $manager->persist($sortie2);
        $manager->persist($sortie3);
        $manager->persist($sortie4);
        $manager->persist($sortie5);
        $manager->persist($sortie6);
        $manager->persist($sortie7);
        $manager->persist($sortie8);

        $manager->flush();
    }
}