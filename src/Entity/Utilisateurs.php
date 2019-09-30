<?php


namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

class Utilisateurs
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $no_utilisateur;

    /**
     * @ORM\Column (type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    private $passwordPlain;

    /**
     * @ORM\Column(name="roles", type="json_array")
     */
    private $roles = [];

    /**
     * @return mixed
     */
    public function getNoUtilisateur()
    {
        return $this->no_utilisateur;
    }

    /**
     * @param mixed $no_utilisateur
     */
    public function setNoUtilisateur($no_utilisateur)
    {
        $this->no_utilisateur = $no_utilisateur;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getPasswordPlain()
    {
        return $this->passwordPlain;
    }

    /**
     * @param mixed $passwordPlain
     */
    public function setPasswordPlain($passwordPlain)
    {
        $this->passwordPlain = $passwordPlain;
    }

    /**
     * @return array
     */
    public function getRoles(): array
    {
        return $this->roles;
    }

    /**
     * @param array $roles
     */
    public function setRoles(array $roles)
    {
        $this->roles = $roles;
    }


}