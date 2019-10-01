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

    /**
     * @var \App\Entity\Participant
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Participant", inversedBy="estOrganise")
     * @ORM\JoinColumn(name="idparticipant", referencedColumnName="idSortie")
     */
    private $Organise;

    /**
     * @var \App\Entity\Participant
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Participant", inversedBy="inscrit")
     * @ORM\JoinColumn(name="idparticipant", referencedColumnName="idSortie")
     */
    private $inscrit;

    /**
     * @var \App\Entity\Site
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Site", inversedBy="siteOrganisateur")
     * @ORM\JoinColumn(name="idSite", referencedColumnName="idSortie")
     */
    private $siteOrganisateur;

    /**
     * @return mixed
     */
    public function getIdSortie()
    {
        return $this->idSortie;
    }

    /**
     * @param mixed $idSortie
     */
    public function setIdSortie($idSortie)
    {
        $this->idSortie = $idSortie;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getDateHeureDebut()
    {
        return $this->dateHeureDebut;
    }

    /**
     * @param mixed $dateHeureDebut
     */
    public function setDateHeureDebut($dateHeureDebut)
    {
        $this->dateHeureDebut = $dateHeureDebut;
    }

    /**
     * @return mixed
     */
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * @param mixed $duree
     */
    public function setDuree($duree)
    {
        $this->duree = $duree;
    }

    /**
     * @return mixed
     */
    public function getDateLimiteInscription()
    {
        return $this->dateLimiteInscription;
    }

    /**
     * @param mixed $dateLimiteInscription
     */
    public function setDateLimiteInscription($dateLimiteInscription)
    {
        $this->dateLimiteInscription = $dateLimiteInscription;
    }

    /**
     * @return mixed
     */
    public function getNbInscriptionsMax()
    {
        return $this->nbInscriptionsMax;
    }

    /**
     * @param mixed $nbInscriptionsMax
     */
    public function setNbInscriptionsMax($nbInscriptionsMax)
    {
        $this->nbInscriptionsMax = $nbInscriptionsMax;
    }

    /**
     * @return mixed
     */
    public function getInfosSortie()
    {
        return $this->infosSortie;
    }

    /**
     * @param mixed $infosSortie
     */
    public function setInfosSortie($infosSortie)
    {
        $this->infosSortie = $infosSortie;
    }

    /**
     * @return mixed
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @param mixed $etat
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    }

    /**
     * @return Lieu
     */
    public function getLieu(): Lieu
    {
        return $this->Lieu;
    }

    /**
     * @param Lieu $Lieu
     */
    public function setLieu(Lieu $Lieu)
    {
        $this->Lieu = $Lieu;
    }

    /**
     * @return Etat
     */
    public function getEtats(): Etat
    {
        return $this->Etats;
    }

    /**
     * @param Etat $Etats
     */
    public function setEtats(Etat $Etats)
    {
        $this->Etats = $Etats;
    }

    /**
     * @return Participant
     */
    public function getOrganise(): Participant
    {
        return $this->Organise;
    }

    /**
     * @param Participant $Organise
     */
    public function setOrganise(Participant $Organise)
    {
        $this->Organise = $Organise;
    }

    /**
     * @return Participant
     */
    public function getInscrit(): Participant
    {
        return $this->inscrit;
    }

    /**
     * @param Participant $inscrit
     */
    public function setInscrit(Participant $inscrit)
    {
        $this->inscrit = $inscrit;
    }

    /**
     * @return Site
     */
    public function getSiteOrganisateur(): Site
    {
        return $this->siteOrganisateur;
    }

    /**
     * @param Site $siteOrganisateur
     */
    public function setSiteOrganisateur(Site $siteOrganisateur)
    {
        $this->siteOrganisateur = $siteOrganisateur;
    }







}