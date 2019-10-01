<?php


namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

class Ville
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $idVille;

    /**
     * @ORM\Column (type="string", length=30)
     */
    private $nom;

    /**
     * @ORM\Column (type="string", length=10)
     */
    private $codePostal;

    /**
     * @var \App\Entity\Lieu
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Lieu", inversedBy="VilleLieux")
     * @ORM\JoinColumn(name="idLieu", referencedColumnName="idVille")
     */
    private $Lieu;

    /**
     * @return mixed
     */
    public function getIdVille()
    {
        return $this->idVille;
    }

    /**
     * @param mixed $idVille
     */
    public function setIdVille($idVille)
    {
        $this->idVille = $idVille;
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
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    /**
     * @param mixed $codePostal
     */
    public function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;
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



}