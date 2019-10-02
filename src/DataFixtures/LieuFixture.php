<?php


namespace App\DataFixtures;


use App\Entity\Lieu;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;


class LieuFixture extends Fixture
{

    public const LIEU_REFERENCE1 = 'lieu-ref1';
    public const LIEU_REFERENCE2 = 'lieu-ref2';
    public const LIEU_REFERENCE3 = 'lieu-ref3';
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $lieu1 = new Lieu();
        $lieu1->setNom('Warehouse');
        $lieu1->setRue('rue Hangar à bananes');
        $ville = $this->getReference(VilleFixture::VILLE_REFERENCE1);
        $lieu1->setVille($ville);
        $lieu1->setLatitude(5);
        $lieu1->setLongitude(788);
        $manager->persist($lieu1);

        $lieu2 = new Lieu();
        $lieu2->setNom('Champi');
        $lieu2->setRue('rue du centre');
        $ville = $this->getReference(VilleFixture::VILLE_REFERENCE2);
        $lieu2->setVille($ville);
        $lieu2->setLatitude(277);
        $lieu2->setLongitude(2);
        $manager->persist($lieu2);

        $lieu3 = new Lieu();
        $lieu3->setNom('Notre Dame');
        $lieu3->setRue('rue principal');
        $ville = $this->getReference(VilleFixture::VILLE_REFERENCE3);
        $lieu3->setVille($ville);
        $lieu3->setLatitude(150);
        $lieu3->setLongitude(24);
        $manager->persist($lieu3);




        $manager->flush();

        $this->addReference(self::LIEU_REFERENCE1, $lieu1);
        $this->addReference(self::LIEU_REFERENCE2, $lieu2);
        $this->addReference(self::LIEU_REFERENCE3, $lieu3);
    }
}