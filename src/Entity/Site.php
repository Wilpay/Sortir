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

    
}