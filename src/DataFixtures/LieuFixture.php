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

        $lieu4 = new Lieu();
        $lieu4->setNom('Gare de Nantes');
        $lieu4->setRue('27 Boulevard de Stalingrad');
        $ville = $this->getReference(VilleFixture::VILLE_REFERENCE1);
        $lieu4->setVille($ville);
        $lieu4->setLatitude(45);
        $lieu4->setLongitude(65);
        $manager->persist($lieu4);

        $lieu2 = new Lieu();
        $lieu2->setNom('Champi');
        $lieu2->setRue('rue du centre');
        $ville = $this->getReference(VilleFixture::VILLE_REFERENCE2);
        $lieu2->setVille($ville);
        $lieu2->setLatitude(277);
        $lieu2->setLongitude(2);
        $manager->persist($lieu2);

        $lieu5 = new Lieu();
        $lieu5->setNom('La cave');
        $lieu5->setRue('rue du vignoble');
        $ville = $this->getReference(VilleFixture::VILLE_REFERENCE2);
        $lieu5->setVille($ville);
        $lieu5->setLatitude(421);
        $lieu5->setLongitude(29);
        $manager->persist($lieu5);

        $lieu3 = new Lieu();
        $lieu3->setNom('Notre Dame');
        $lieu3->setRue('rue principal');
        $ville = $this->getReference(VilleFixture::VILLE_REFERENCE3);
        $lieu3->setVille($ville);
        $lieu3->setLatitude(150);
        $lieu3->setLongitude(24);
        $manager->persist($lieu3);

        $lieu6 = new Lieu();
        $lieu6->setNom('Musée');
        $lieu6->setRue('rue de la paix');
        $ville = $this->getReference(VilleFixture::VILLE_REFERENCE3);
        $lieu6->setVille($ville);
        $lieu6->setLatitude(80);
        $lieu6->setLongitude(739);
        $manager->persist($lieu6);

        $manager->flush();

        $this->addReference(self::LIEU_REFERENCE1, $lieu1);
        $this->addReference(self::LIEU_REFERENCE2, $lieu2);
        $this->addReference(self::LIEU_REFERENCE3, $lieu3);
    }
}