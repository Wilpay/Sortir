<?php


namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;


class Participant
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $idParticipant;

    /**
     * @ORM\Column (type="string", length=30)
     */
    private $nom;

    /**
     * @ORM\Column (type="string", length=30)
     */
    private $prenom;

    /**
     * @ORM\Column (type="string", length=13)
     */
    private $telephone;

    /**
     * @ORM\Column (type="string", length=350)
     */
    private $mail;

    /**
     * @ORM\Column (type="boolean")
     */
    private $administrateur;

    /**
     * @ORM\Column (type="boolean")
     */
    private $actif;

    /**
     * @var \App\Entity\Sortie
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Sortie", inversedBy="Organise")
     * @ORM\JoinColumn(name="idSortie", referencedColumnName="idparticipant")
     */
    private $Organisateur;

    /**
     * @var \App\Entity\Sortie
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Sortie", inversedBy="inscrit")
     * @ORM\JoinColumn(name="idSortie", referencedColumnName="idparticipant")
     */
    private $estInscrit;
}