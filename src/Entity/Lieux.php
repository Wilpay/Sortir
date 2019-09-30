<?php


namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

class Lieux
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $no_lieu;

    /**
     * @ORM\Column (type="string", length=30)
     */
    private $nom_lieu;

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
     * @return mixed
     */
    public function getNoLieu()
    {
        return $this->no_lieu;
    }

    /**
     * @param mixed $no_lieu
     */
    public function setNoLieu($no_lieu)
    {
        $this->no_lieu = $no_lieu;
    }

    /**
     * @return mixed
     */
    public function getNomLieu()
    {
        return $this->nom_lieu;
    }

    /**
     * @param mixed $nom_lieu
     */
    public function setNomLieu($nom_lieu)
    {
        $this->nom_lieu = $nom_lieu;
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



}