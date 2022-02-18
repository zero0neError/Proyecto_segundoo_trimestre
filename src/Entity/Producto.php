<?php

namespace App\Entity;

use App\Repository\ProductoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductoRepository::class)
 */
class Producto
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
    private $id_producto;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=300)
     */
    private $descripcion;

    /**
     * @ORM\Column(type="string", length=2, nullable=true)
     */
    private $talla;

    /**
     * @ORM\Column(type="integer")
     */
    private $precio;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $capacidad;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $produndidad_max;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $resolucion;

    /**
     * @ORM\Column(type="boolean", options={"default":"0"})
     */
    private $esta_alquilado=false;

    /**
     * @ORM\OneToMany(targetEntity=ReservaProducto::class, mappedBy="id_producto")
     */
    private $reservaProducto;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $img;

    /**
     * @ORM\ManyToOne(targetEntity=TipoProducto::class, inversedBy="producto", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $tipo_producto;


    public function __construct()
    {
        $this->reservaProducto = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdProducto(): ?int
    {
        return $this->id_producto;
    }

    public function setIdProducto(int $id_producto): self
    {
        $this->id_producto = $id_producto;

        return $this;
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

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getTalla(): ?string
    {
        return $this->talla;
    }

    public function setTalla(?string $talla): self
    {
        $this->talla = $talla;

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

    public function getCapacidad(): ?int
    {
        return $this->capacidad;
    }

    public function setCapacidad(?int $capacidad): self
    {
        $this->capacidad = $capacidad;

        return $this;
    }

    public function getProdundidadMax(): ?int
    {
        return $this->produndidad_max;
    }

    public function setProdundidadMax(?int $produndidad_max): self
    {
        $this->produndidad_max = $produndidad_max;

        return $this;
    }

    public function getResolucion(): ?string
    {
        return $this->resolucion;
    }

    public function setResolucion(string $resolucion): self
    {
        $this->resolucion = $resolucion;

        return $this;
    }

    public function getEstaAlquilado(): ?bool
    {
        return $this->esta_alquilado;
    }

    public function setEstaAlquilado(bool $esta_alquilado): self
    {
        $this->esta_alquilado = $esta_alquilado;

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
            $reservaProducto->setIdProducto($this);
        }

        return $this;
    }

    public function removeReservaProducto(ReservaProducto $reservaProducto): self
    {
        if ($this->reservaProducto->removeElement($reservaProducto)) {
            // set the owning side to null (unless already changed)
            if ($reservaProducto->getIdProducto() === $this) {
                $reservaProducto->setIdProducto(null);
            }
        }

        return $this;
    }

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(string $img): self
    {
        $this->img = $img;

        return $this;
    }

    public function getTipoProducto(): ?TipoProducto
    {
        return $this->tipo_producto;
    }

    public function setTipoProducto(TipoProducto $tipo_producto): self
    {
        $this->tipo_producto = $tipo_producto;

        return $this;
    }
}
