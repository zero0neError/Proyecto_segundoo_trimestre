<?php

namespace App\Entity;

use App\Repository\ReservasRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReservasRepository::class)
 */
class Reservas
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Usuario::class, inversedBy="dameReservas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $FKCorreo;

    /**
     * @ORM\Column(type="date")
     */
    private $fecha_de_inicio_de_reserva;

    /**
     * @ORM\Column(type="date")
     */
    private $fecha_fin_de_reserva;

    /**
     * @ORM\Column(type="date")
     */
    private $fecha_creacion_reserva;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFKCorreo(): ?Usuario
    {
        return $this->FKCorreo;
    }

    public function setFKCorreo(?Usuario $FKCorreo): self
    {
        $this->FKCorreo = $FKCorreo;

        return $this;
    }

    public function getFechaDeInicioDeReserva(): ?\DateTimeInterface
    {
        return $this->fecha_de_inicio_de_reserva;
    }

    public function setFechaDeInicioDeReserva(\DateTimeInterface $fecha_de_inicio_de_reserva): self
    {
        $this->fecha_de_inicio_de_reserva = $fecha_de_inicio_de_reserva;

        return $this;
    }

    public function getFechaFinDeReserva(): ?\DateTimeInterface
    {
        return $this->fecha_fin_de_reserva;
    }

    public function setFechaFinDeReserva(\DateTimeInterface $fecha_fin_de_reserva): self
    {
        $this->fecha_fin_de_reserva = $fecha_fin_de_reserva;

        return $this;
    }

    public function getFechaCreacionReserva(): ?\DateTimeInterface
    {
        return $this->fecha_creacion_reserva;
    }

    public function setFechaCreacionReserva(\DateTimeInterface $fecha_creacion_reserva): self
    {
        $this->fecha_creacion_reserva = $fecha_creacion_reserva;

        return $this;
    }
}
