<?php


namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

class Lieu
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $idLieu;

    /**
     * @ORM\Column (type="string", length=30)
     */
    private $nom;

    /**
     * @ORM\Column (type="string", length=30)
     */
    private $rue;

    /**
     * @ORM\Column (type="float")
     */
    private  $latitude;

    /**
     * @ORM\Column (type="float")
     */
    private  $longitude;

    /**
     * @var \App\Entity\Ville
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Ville", inversedBy="LieuVilles")
     * @ORM\JoinColumn(name="idVille", referencedColumnName="idLieu")
     */
    private $Ville;

    /**
     * @var \App\Entity\Sortie
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Sortie", inversedBy="LieuSorties")
     * @ORM\JoinColumn(name="idSortie", referencedColumnName="idLieu")
     */
    private $Sortie;

    /**
     * @return mixed
     */
    public function getIdLieu()
    {
        return $this->idLieu;
    }

    /**
     * @param mixed $idLieu
     */
    public function setIdLieu($idLieu)
    {
        $this->idLieu = $idLieu;
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
    public function getRue()
    {
        return $this->rue;
    }

    /**
     * @param mixed $rue
     */
    public function setRue($rue)
    {
        $this->rue = $rue;
    }

    /**
     * @return mixed
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param mixed $latitude
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    /**
     * @return mixed
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param mixed $longitude
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }

    /**
     * @return Ville
     */
    public function getVille(): Ville
    {
        return $this->Ville;
    }

    /**
     * @param Ville $Ville
     */
    public function setVille(Ville $Ville)
    {
        $this->Ville = $Ville;
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