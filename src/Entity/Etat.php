<?php


namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


class Etat
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $idEtat;

    /**
    @ORM\Column(name="libelle", type="string", columnDefinition="enum('Créée', 'Ouverte', 'Clôturée', 'Activité en cours', 'passée', 'Annulée')")
     */
    private $libelle;


    /**
     * @var \App\Entity\Sortie
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Sortie", inversedBy="EtatSorties")
     * @ORM\JoinColumn(name="idSortie", referencedColumnName="idEtat")
     */
    private $Sortie;

    /**
     * @return mixed
     */
    public function getIdEtat()
    {
        return $this->idEtat;
    }

    /**
     * @param mixed $idEtat
     */
    public function setIdEtat($idEtat)
    {
        $this->idEtat = $idEtat;
    }

    /**
     * @return mixed
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * @param mixed $libelle
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    }

    /**
     * @return Sortie
     */
    public function getSortie(): Sortie
    {
        return $this->Sortie;
    }

    /**
     * @param Sortie $Sortie
     */
    public function setSortie(Sortie $Sortie)
    {
        $this->Sortie = $Sortie;
    }






}