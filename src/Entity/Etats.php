<?php


namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


class Etats
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $no_etat;

    /**
     * @ORM\Column (type="string", length=30)
     */
    private $libelle;

    /**
     * @return mixed
     */
    public function getNoEtat()
    {
        return $this->no_etat;
    }

    /**
     * @param mixed $no_etat
     */
    public function setNoEtat($no_etat)
    {
        $this->no_etat = $no_etat;
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


}