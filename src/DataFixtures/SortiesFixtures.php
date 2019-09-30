<?php


namespace App\DataFixtures;


use App\Entity\Sortie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class SortiesFixtures extends Fixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        // Génère une Sortie
        $sortie1 = new Sortie();
        $sortie1->setNom("BUC");
        $sortie1->setDatedebut(date());
        $sortie1->setDuree();
        $sortie1->setDatecloture();
        $sortie1->setNbinscriptionsmax();
        $sortie1->setDescriptioninfos();
        $sortie1->setEtatsortie();
        $sortie1->setUrlPhoto();
        $sortie1->setOrganisateur();
        $sortie1->setLieuxNoLieu();
        $sortie1->setEtatsNoEtat();

        $manager->persist($sortie1);


        $sortie2 = new Sortie();
        $sortie2->setNom();
        $sortie2->setDatedebut();
        $sortie2->setDuree();
        $sortie2->setDatecloture();
        $sortie2->setNbinscriptionsmax();
        $sortie2->setDescriptioninfos();
        $sortie2->setEtatsortie();
        $sortie2->setUrlPhoto();
        $sortie2->setOrganisateur();
        $sortie2->setLieuxNoLieu();
        $sortie2->setEtatsNoEtat();

        $manager->persist($sortie2);

        $manager->flush();
    }
}