<?php

namespace App\Entity;

use App\Repository\TipoProductoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TipoProductoRepository::class)
 */
class TipoProducto
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Producto::class, inversedBy="tipoProducto", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $nombre;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?Producto
    {
        return $this->nombre;
    }

    public function setNombre(Producto $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }
}
