<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SiteRepository")
 */
class Site
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Sortie", mappedBy="siteorganisateur")
     */
    private $sorties;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Participant", mappedBy="site")
     */
    private $rattache;

    public function __construct()
    {
        $this->sorties = new ArrayCollection();
        $this->rattache = new ArrayCollection();
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

    /**
     * @return Collection|Sortie[]
     */
    public function getSorties(): Collection
    {
        return $this->sorties;
    }

    public function addSorty(Sortie $sorty): self
    {
        if (!$this->sorties->contains($sorty)) {
            $this->sorties[] = $sorty;
            $sorty->setSiteorganisateur($this);
        }

        return $this;
    }

    public function removeSorty(Sortie $sorty): self
    {
        if ($this->sorties->contains($sorty)) {
            $this->sorties->removeElement($sorty);
            // set the owning side to null (unless already changed)
            if ($sorty->getSiteorganisateur() === $this) {
                $sorty->setSiteorganisateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Participant[]
     */
    public function getRattache(): Collection
    {
        return $this->rattache;
    }

    public function addRattache(Participant $rattache): self
    {
        if (!$this->rattache->contains($rattache)) {
            $this->rattache[] = $rattache;
            $rattache->setSite($this);
        }

        return $this;
    }

    public function removeRattache(Participant $rattache): self
    {
        if ($this->rattache->contains($rattache)) {
            $this->rattache->removeElement($rattache);
            // set the owning side to null (unless already changed)
            if ($rattache->getSite() === $this) {
                $rattache->setSite(null);
            }
        }

        return $this;
    }
}
