<?php


namespace App\DataFixtures;


use App\Entity\Lieux;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LieuxFixtures extends Fixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        // Génère un premier Lieu
        $lieux1 = new Lieux();
        $lieux1->setNomLieu("Lieu 1");
        $lieux1->setRue("Rue de la paix");
        $lieux1->setLatitude(115);
        $lieux1->setLongitude(94);
        $manager->persist($lieux1);

        //Génère un second Lieu
        $lieux2 = new Lieux();
        $lieux2->setNomLieu("Lieu 2");
        $lieux2->setRue("Avenue des Champs Elysées");
        $lieux2->setLatitude(1115);
        $lieux2->setLongitude(289);
        $manager->persist($lieux2);



        $manager->flush();
    }
}