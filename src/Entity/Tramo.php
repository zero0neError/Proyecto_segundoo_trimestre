<?php

namespace App\Entity;

use App\Repository\TramoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TramoRepository::class)
 */
class Tramo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $duracion_tramo;

    /**
     * @ORM\Column(type="integer")
     */
    private $factor_reductor;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDuracionTramo(): ?int
    {
        return $this->duracion_tramo;
    }

    public function setDuracionTramo(int $duracion_tramo): self
    {
        $this->duracion_tramo = $duracion_tramo;

        return $this;
    }

    public function getFactorReductor(): ?int
    {
        return $this->factor_reductor;
    }

    public function setFactorReductor(int $factor_reductor): self
    {
        $this->factor_reductor = $factor_reductor;

        return $this;
    }
}
