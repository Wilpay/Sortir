<?php


namespace App\DataFixtures;


use App\Entity\Ville;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class VilleFixture extends Fixture
{

    public const VILLE_REFERENCE1 = 'ville-ref1';
    public const VILLE_REFERENCE2 = 'ville-ref2';
    public const VILLE_REFERENCE3 = 'ville-ref3';
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $ville1 = new Ville();
        $ville1->setNom('Nantes');
        $ville1->setCodePostal('44100');
        $manager->persist($ville1);

        $ville2 = new Ville();
        $ville2->setNom('Vallet');
        $ville2->setCodePostal('44330');
        $manager->persist($ville2);

        $ville3 = new Ville();
        $ville3->setNom('Rezé');
        $ville3->setCodePostal('44400');
        $manager->persist($ville3);

        $manager->flush();

        $this->addReference(self::VILLE_REFERENCE1, $ville1);
        $this->addReference(self::VILLE_REFERENCE2, $ville2);
        $this->addReference(self::VILLE_REFERENCE3, $ville3);
    }
}