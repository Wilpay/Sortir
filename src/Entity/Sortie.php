<?php

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SortieRepository")
 */
class Sortie
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     * @Assert\NotBlank(message="Veuillez entrer un nom")
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "Le nom de la sortie ne peut pas dépasser {{ limit }} caractères"
     * )
     */
    private $nom;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var datetime
     * @Assert\NotBlank(message="Veuillez entrer une date")
     * @Assert\GreaterThanOrEqual(
     *      value = "now",
     *      message = "Veuillez entrer une date future"
     * )
     */

    private $dateHeureDebut;

    /**
     * @ORM\Column(type="integer")
     *
     * @var Integer
     * @Assert\NotBlank(message="Veuillez entrer une durée")
     * )
     * @Assert\Range(
     *      min = 1,
     *      minMessage = "Veuillez entrer une valeur positive")
     */
    private $duree;

    /**
     * @ORM\Column(type="datetime")
     * @var datetime
     * @Assert\NotBlank(message="Veuillez entrer une date")
     * @Assert\Expression(
     *     "this.getDateHeureDebut() > this.getDateLimiteInscription()",
     *     message="Les inscriptions ne peuvent pas etre cloturées après le début de l'événement")
     * @Assert\GreaterThanOrEqual(
     *      value = "today",
     *      message = "Veuillez entrer une date future"
     * )
     */
    private $dateLimiteInscription;

    /**
     * @ORM\Column(type="integer")
     *
     * @var Integer
     * @Assert\NotBlank(message="Veuillez entrer le nombre max de participants")
     * @Assert\Range(
     *      min = 1,
     *      minMessage = "Veuillez entrer une valeur positive"
     * )
     */
    private $nbInscriptionsMax;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank(message="Veuillez entrer une description")
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "Le nom de la sortie ne peut pas dépasser {{ limit }} caractères"
     * )
     */
    private $infosSortie;

    //* @Assert\NotBlank(message="Veuillez Sélectionner le lieu")
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Lieu", inversedBy="sortie")
     *
     * @var Lieu
     */
    private $lieu;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Participant", inversedBy="sorties")
     */
    private $inscrit;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Participant", inversedBy="organisateur")
     *
     * @var Participant
     */
    private $organisateur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Site", inversedBy="sorties")
     */
    private $siteorganisateur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Etat", inversedBy="sorties")
     */
    private $etat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $motif;

    public function __construct()
    {
        $this->inscrit = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDateHeureDebut(): ?\DateTimeInterface
    {
        return $this->dateHeureDebut;
    }

    public function setDateHeureDebut(\DateTimeInterface $dateHeureDebut): self
    {
        $this->dateHeureDebut = $dateHeureDebut;

        return $this;
    }

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(int $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getDateLimiteInscription(): ?\DateTimeInterface
    {
        return $this->dateLimiteInscription;
    }

    public function setDateLimiteInscription(\DateTimeInterface $dateLimiteInscription): self
    {
        $this->dateLimiteInscription = $dateLimiteInscription;

        return $this;
    }

    public function getNbInscriptionsMax(): ?int
    {
        return $this->nbInscriptionsMax;
    }

    public function setNbInscriptionsMax(int $nbInscriptionsMax): self
    {
        $this->nbInscriptionsMax = $nbInscriptionsMax;

        return $this;
    }

    public function getInfosSortie(): ?string
    {
        return $this->infosSortie;
    }

    public function setInfosSortie(string $infosSortie): self
    {
        $this->infosSortie = $infosSortie;

        return $this;
    }



    public function getLieu(): ?Lieu
    {
        return $this->lieu;
    }

    public function setLieu(?Lieu $lieu): self
    {
        $this->lieu = $lieu;

        return $this;
    }

    /**
     * @return Collection|Participant[]
     */
    public function getInscrit(): Collection
    {
        return $this->inscrit;
    }

    public function addInscrit(Participant $inscrit): self
    {
        if (!$this->inscrit->contains($inscrit)) {
            $this->inscrit[] = $inscrit;
        }

        return $this;
    }

    public function removeInscrit(Participant $inscrit): self
    {
        if ($this->inscrit->contains($inscrit)) {
            $this->inscrit->removeElement($inscrit);
        }

        return $this;
    }

    public function getOrganisateur(): ?Participant
    {
        return $this->organisateur;
    }

    public function setOrganisateur(?Participant $organisateur): self
    {
        $this->organisateur = $organisateur;

        return $this;
    }

    public function getSiteorganisateur(): ?Site
    {
        return $this->siteorganisateur;
    }

    public function setSiteorganisateur(?Site $siteorganisateur): self
    {
        $this->siteorganisateur = $siteorganisateur;

        return $this;
    }

    public function getEtat(): ?Etat
    {
        return $this->etat;
    }

    public function setEtat(?Etat $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMotif()
    {
        return $this->motif;
    }

    /**
     * @param mixed $motif
     */
    public function setMotif($motif): void
    {
        $this->motif = $motif;
    }
}
