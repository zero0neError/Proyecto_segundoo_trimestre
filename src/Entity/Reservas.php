<?php

namespace App\Entity;

use App\Repository\ReservasRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @ORM\OneToMany(targetEntity=ReservaProducto::class, mappedBy="id_reserva", orphanRemoval=true)
     */
    private $reservaProducto;

    public function __construct()
    {
        $this->reservaProducto = new ArrayCollection();
    }

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

    /**
     * @return Collection|ReservaProducto[]
     */
    public function getReservaProducto(): Collection
    {
        return $this->reservaProducto;
    }

    public function addReservaProducto(ReservaProducto $reservaProducto): self
    {
        if (!$this->reservaProducto->contains($reservaProducto)) {
            $this->reservaProducto[] = $reservaProducto;
            $reservaProducto->setIdReserva($this);
        }

        return $this;
    }

    public function removeReservaProducto(ReservaProducto $reservaProducto): self
    {
        if ($this->reservaProducto->removeElement($reservaProducto)) {
            // set the owning side to null (unless already changed)
            if ($reservaProducto->getIdReserva() === $this) {
                $reservaProducto->setIdReserva(null);
            }
        }

        return $this;
    }
}
