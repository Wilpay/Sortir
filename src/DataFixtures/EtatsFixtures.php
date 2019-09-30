<?php


namespace App\DataFixtures;
use App\Entity\Etats;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class EtatsFixtures extends Fixture
{


    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        //Génère un Etat
        $etat1 = new Etats();
        $etat1->setLibelle("Créée");
        $manager->persist($etat1);

        //Génère un second Etat
        $etat2 = new Etats();
        $etat2->setLibelle("Ouverte");
        $manager->persist($etat2);

        $manager->flush();
    }
}