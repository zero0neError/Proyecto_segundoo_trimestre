<?php

namespace App\Controller\Api;


use App\Entity\Producto;
use App\Repository\ProductoRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;


class BotellasController extends AbstractController
{
    /**
     * @Route("/api/botellas/todas", name="todasBotellas")
     */
    public function returnTodasBotellas(ManagerRegistry $doctrine): Response
    {
                
        $manager=$doctrine->getManager();

        $producto=$manager->getRepository(Producto::class)->devuelveTodasLasBotellas();

        return new Response($producto);
    }

    // /**
    //  * @Route("/api/botellas/carrito", name="todasBotellas")
    //  */
    // public function cargaCarrito(ManagerRegistry $doctrine): Response
    // {
    //     $json = $_POST["json"];

    //     return new Response($json);
    // // }


    /**
     * @Route("/api/botellas/libres", name="libresBotellas")
     */
    public function devuelveBotellasLibres(ManagerRegistry $doctrine): Response
    {
                
        $manager=$doctrine->getManager();

        $producto=$manager->getRepository(Producto::class)->devuelveTodasLasBotellasNoAlquiladas();

        return new Response($producto);
    }


    /**
     * @Route("/api/botellas/agrupadas", name="botellasAgrupadas")
     */
    public function devuelveBotellasLibresAgrupadas(ManagerRegistry $doctrine): Response
    {
                
        $manager=$doctrine->getManager();

        $producto=$manager->getRepository(Producto::class)->devuelveTodasLasBotellasAgrupadas();

        return new Response($producto);
    }

    /**
     * @Route("/api/tramos/todos", name="botellasAgrupadas")
     */
    public function ddevuelveTramos(ManagerRegistry $doctrine): Response
    {
                
        $manager=$doctrine->getManager();

        $producto=$manager->getRepository(Producto::class)->traeTramos();

        return new Response($producto);
    }

    /**
     * @Route("/api/botella/busca/{nombre}", name="product_show")
     */
    public function show(ManagerRegistry $doctrine, string $nombre): Response
    {
        $nombre=urldecode($nombre);
        $manager=$doctrine->getManager();

        $producto=$manager->getRepository(Producto::class)->traeProductoPorNombre($nombre);
        
        $json=json_encode($producto);
        //dd($producto[0]);
        
        return new Response($json);  
    }

    /**
     * @Route("/api/botella/buscaNA/{id}", name="count_botellas_libres")
     */
    public function showNA(ManagerRegistry $doctrine, int $id): Response
    {
        
        $manager=$doctrine->getManager();

        $producto=$manager->getRepository(Producto::class)->traeProductoNoAlquiladoPorId($id);
        //dd($producto);
        //$json=json_encode($producto);
        //dd($producto[0]);
        //dd($json);
        return new Response($producto);  
    }

    /**
     * @Route("/api/botella/buscaNAFecha/{fecha}", name="count_botellas_libres_fecha")
     */
    public function showNAFecha(ManagerRegistry $doctrine,string $fecha): Response
    {
        
        $manager=$doctrine->getManager();

        $producto=$manager->getRepository(Producto::class)->traeProductoNoAlquiladoPorFecha($fecha);
        //dd($producto);
        //$json=json_encode($producto);
        //dd($producto[0]);
        //dd($json);
        return new Response($producto);  
    }

    /**
     * @Route("/api/botella/totalLibre/{fecha}/{id}", name="count_botellas_libres_totoal")
     */
    public function showLibresTotales(ManagerRegistry $doctrine,string $fecha, int $id): Response
    {
        
        $manager=$doctrine->getManager();

        $producto=$manager->getRepository(Producto::class)->traeProductoNoAlquiladoNumeroTotal($id,$fecha);
        //dd($producto);
        //$json=json_encode($producto);
        //dd($producto[0]);
        //dd($json);
        return new Response($producto);  
    }

    /**
     * @Route("/api/botella/update/{nombre}/{nveces}", name="update_producto")
     */
    public function updateaUnNumerroDeVecesUnProducto(ManagerRegistry $doctrine,string $nombre, int $nveces): Response
    {
        
        $manager=$doctrine->getManager();

        $producto=$manager->getRepository(Producto::class)->alquilarNumeroDeRegistrosPorNombre($nombre,$nveces);
        
        return new Response($producto);  
    }
}
