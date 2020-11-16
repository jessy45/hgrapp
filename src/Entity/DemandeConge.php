<?php

namespace App\Entity;

use App\Repository\DemandeCongeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DemandeCongeRepository::class)
 */
class DemandeConge
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $dateDebut;

    /**
     * @ORM\Column(type="integer")
     */
    private $nombreJour;

    /**
     * @ORM\Column(type="date")
     */
    private $dateReprise;

    /**
     * @ORM\Column(type="date")
     */
    private $dateFin;

    /**
     * @ORM\Column(type="boolean")
     */
    private $approbationChef;

    /**
     * @ORM\Column(type="boolean")
     */
    private $approbationDir;

    /**
     * @ORM\Column(type="boolean")
     */
    private $approbationAg;

    /**
     * @ORM\Column(type="integer")
     */
    private $etat;

    /**
     * @ORM\ManyToOne(targetEntity=Personnel::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $personnel;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getNombreJour(): ?int
    {
        return $this->nombreJour;
    }

    public function setNombreJour(int $nombreJour): self
    {
        $this->nombreJour = $nombreJour;

        return $this;
    }

    public function getDateReprise(): ?\DateTimeInterface
    {
        return $this->dateReprise;
    }

    public function setDateReprise(\DateTimeInterface $dateReprise): self
    {
        $this->dateReprise = $dateReprise;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getApprobationChef(): ?bool
    {
        return $this->approbationChef;
    }

    public function setApprobationChef(bool $approbationChef): self
    {
        $this->approbationChef = $approbationChef;

        return $this;
    }

    public function getApprobationDir(): ?bool
    {
        return $this->approbationDir;
    }

    public function setApprobationDir(bool $approbationDir): self
    {
        $this->approbationDir = $approbationDir;

        return $this;
    }

    public function getApprobationAg(): ?bool
    {
        return $this->approbationAg;
    }

    public function setApprobationAg(bool $approbationAg): self
    {
        $this->approbationAg = $approbationAg;

        return $this;
    }

    public function getEtat(): ?int
    {
        return $this->etat;
    }

    public function setEtat(int $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getPersonnel(): ?Personnel
    {
        return $this->personnel;
    }

    public function setPersonnel(?Personnel $personnel): self
    {
        $this->personnel = $personnel;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
