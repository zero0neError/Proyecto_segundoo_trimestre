<?php

namespace App\Entity;

use App\Repository\ReservaProductoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReservaProductoRepository::class)
 */
class ReservaProducto
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Reservas::class, inversedBy="reservaProducto")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_reserva;

    /**
     * @ORM\ManyToOne(targetEntity=Producto::class, inversedBy="reservaProducto")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_producto;

    /**
     * @ORM\Column(type="integer")
     */
    private $precio;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdReserva(): ?Reservas
    {
        return $this->id_reserva;
    }

    public function setIdReserva(?Reservas $id_reserva): self
    {
        $this->id_reserva = $id_reserva;

        return $this;
    }

    public function getIdProducto(): ?Producto
    {
        return $this->id_producto;
    }

    public function setIdProducto(?Producto $id_producto): self
    {
        $this->id_producto = $id_producto;

        return $this;
    }

    public function getPrecio(): ?int
    {
        return $this->precio;
    }

    public function setPrecio(int $precio): self
    {
        $this->precio = $precio;

        return $this;
    }
}
