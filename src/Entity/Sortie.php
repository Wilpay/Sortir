<?php


namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

class Sortie
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $idSortie;

    /**
     * @ORM\Column (type="string", length=30)
     */
    private $nom;

    /**
     * @ORM\Column (type="datetime")
     */
    private $dateHeureDebut;

    /**
     * @ORM\Column (type="integer")
     */
    private $duree;

    /**
     * @ORM\Column (type="datetime")
     */
    private $dateLimiteInscription;

    /**
     * @ORM\Column (type="integer")
     */
    private $nbInscriptionsMax;

    /**
     * @ORM\Column (type="string", length=500)
     */
    private $infosSortie;

    /**
     * @ORM\Column (type="integer")
     */
    private $etat;

    /**
     * @var \App\Entity\Lieu
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Lieu", inversedBy="SortiesLieu")
     * @ORM\JoinColumn(name="idLieu", referencedColumnName="idSortie")
     */
    private $Lieu;

    /**
     * @var \App\Entity\Etat
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Etat", inversedBy="SortiesEtats")
     * @ORM\JoinColumn(name="idEtat", referencedColumnName="idSortie")
     */
    private $Etats;





}