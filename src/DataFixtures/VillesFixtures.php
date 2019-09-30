<?php


namespace App\DataFixtures;
use App\Entity\Villes;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class VillesFixtures extends Fixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        // Génère une première ville
        $ville1 = new Villes();
        $ville1->setNomVille("Nantes");
        $ville1->setCodePostal("44400");
        $manager->persist($ville1);

        //Génère une seconde ville
        $ville2 = new Villes();
        $ville2->setNomVille("Vallet");
        $ville2->setCodePostal("44330");
        $manager->persist($ville1);

        $manager->flush();

    }
}