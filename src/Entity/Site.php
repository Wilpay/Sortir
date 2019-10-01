<?php


namespace App\Entity;


class Site
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $idSite;

    /**
     * @ORM\Column (type="string", length=30)
     */
    private $nom;

    /**
     * @var \App\Entity\Sortie
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Sortie", inversedBy="siteOrganise")
     * @ORM\JoinColumn(name="idSortie", referencedColumnName="idSite")
     */
    private $siteOrganisateur;

    /**
     * @var \App\Entity\Participant
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Participant", inversedBy="rattache")
     * @ORM\JoinColumn(name="idparticipant", referencedColumnName="idSite")
     */
    private $estrattache;

    /**
     * @return mixed
     */
    public function getIdSite()
    {
        return $this->idSite;
    }

    /**
     * @param mixed $idSite
     */
    public function setIdSite($idSite)
    {
        $this->idSite = $idSite;
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
     * @return Sortie
     */
    public function getSiteOrganisateur(): Sortie
    {
        return $this->siteOrganisateur;
    }

    /**
     * @param Sortie $siteOrganisateur
     */
    public function setSiteOrganisateur(Sortie $siteOrganisateur)
    {
        $this->siteOrganisateur = $siteOrganisateur;
    }

    /**
     * @return Participant
     */
    public function getEstrattache(): Participant
    {
        return $this->estrattache;
    }

    /**
     * @param Participant $estrattache
     */
    public function setEstrattache(Participant $estrattache)
    {
        $this->estrattache = $estrattache;
    }


}