<?php


namespace App\DataFixtures;


use App\Entity\Site;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class SiteFixture extends Fixture
{
    public const SITE_REFERENCE1 = 'site-ref1';
    public const SITE_REFERENCE2 = 'site-ref2';
    public const SITE_REFERENCE3 = 'site-ref3';
    public const SITE_REFERENCE4 = 'site-ref4';
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $site1 = new Site();
        $site1->setNom('SAINT HERBLAIN');

        $site2 = new Site();
        $site2->setNom('VERTOU');

        $site3 = new Site();
        $site3->setNom('ANGERS');

        $site4 = new Site();
        $site4->setNom('BREST');

        $manager->persist($site1);
        $manager->persist($site2);
        $manager->persist($site3);
        $manager->persist($site4);

        $manager->flush();

        $this->addReference(self::SITE_REFERENCE1, $site1);
        $this->addReference(self::SITE_REFERENCE2, $site2);
        $this->addReference(self::SITE_REFERENCE3, $site3);
        $this->addReference(self::SITE_REFERENCE4, $site4);
    }
}