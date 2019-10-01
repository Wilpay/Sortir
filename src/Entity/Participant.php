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
}