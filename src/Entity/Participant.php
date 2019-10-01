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

    /**
     * @var \App\Entity\Site
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Site", inversedBy="estRattache")
     * @ORM\JoinColumn(name="idSite", referencedColumnName="idparticipant")
     */
    private $estRattache;

    /**
     * @return mixed
     */
    public function getIdParticipant()
    {
        return $this->idParticipant;
    }

    /**
     * @param mixed $idParticipant
     */
    public function setIdParticipant($idParticipant)
    {
        $this->idParticipant = $idParticipant;
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
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return mixed
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @param mixed $telephone
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

    /**
     * @return mixed
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param mixed $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    /**
     * @return mixed
     */
    public function getAdministrateur()
    {
        return $this->administrateur;
    }

    /**
     * @param mixed $administrateur
     */
    public function setAdministrateur($administrateur)
    {
        $this->administrateur = $administrateur;
    }

    /**
     * @return mixed
     */
    public function getActif()
    {
        return $this->actif;
    }

    /**
     * @param mixed $actif
     */
    public function setActif($actif)
    {
        $this->actif = $actif;
    }

    /**
     * @return Sortie
     */
    public function getOrganisateur(): Sortie
    {
        return $this->Organisateur;
    }

    /**
     * @param Sortie $Organisateur
     */
    public function setOrganisateur(Sortie $Organisateur)
    {
        $this->Organisateur = $Organisateur;
    }

    /**
     * @return Sortie
     */
    public function getEstInscrit(): Sortie
    {
        return $this->estInscrit;
    }

    /**
     * @param Sortie $estInscrit
     */
    public function setEstInscrit(Sortie $estInscrit)
    {
        $this->estInscrit = $estInscrit;
    }

    /**
     * @return Site
     */
    public function getEstRattache(): Site
    {
        return $this->estRattache;
    }

    /**
     * @param Site $estRattache
     */
    public function setEstRattache(Site $estRattache)
    {
        $this->estRattache = $estRattache;
    }


}