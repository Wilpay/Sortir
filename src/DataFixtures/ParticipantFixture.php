<?php


namespace App\DataFixtures;


use App\Entity\Participant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ParticipantFixture extends Fixture
{
    private $encoder;
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    public const PARTICIPANT_REFERENCE1 = 'participant-ref1';
    public const PARTICIPANT_REFERENCE2 = 'participant-ref2';
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        // TODO: Implement load() method.
        $participant1 = new Participant();
        $participant1->setNom('BAUDRY');
        $participant1->setPrenom('Quentin');
        $participant1->setPseudo('qbaudry');
        $participant1->setTelephone('0123456789');
        $participant1->setMail('quentin@gmail.com');
        $participant1->setRoles(['ROLE_USER']);
        $participant1->setActif(true);
        $password = $this->encoder->encodePassword($participant1, '123');
        $participant1->setPassword($password);
        $site = $this->getReference(SiteFixture::SITE_REFERENCE1);
        $participant1->setSite($site);

        $participant2 = new Participant();
        $participant2->setNom('TENAUD');
        $participant2->setPrenom('Willy');
        $participant2->setPseudo('wtenaud');
        $participant2->setTelephone('0123456789');
        $participant2->setMail('willy@gmail.com');
        $participant2->setRoles(['ROLE_ADMIN']);
        $participant2->setActif(false);
        $password = $this->encoder->encodePassword($participant2, '123');
        $participant2->setPassword($password);
        $site = $this->getReference(SiteFixture::SITE_REFERENCE4);
        $participant2->setSite($site);

        $manager->persist($participant1);
        $manager->persist($participant2);

        $manager->flush();

        $this->addReference(self::PARTICIPANT_REFERENCE1, $participant1);
        $this->addReference(self::PARTICIPANT_REFERENCE2, $participant2);
    }
}