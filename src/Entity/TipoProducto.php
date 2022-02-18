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
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\OneToOne(targetEntity=Producto::class, mappedBy="tipo_producto", cascade={"persist", "remove"})
     */
    private $producto;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getProducto(): ?Producto
    {
        return $this->producto;
    }

    public function setProducto(Producto $producto): self
    {
        // set the owning side of the relation if necessary
        if ($producto->getTipoProducto() !== $this) {
            $producto->setTipoProducto($this);
        }

        $this->producto = $producto;

        return $this;
    }

    public function __toString(){

        return $this->nombre;
    }
}
