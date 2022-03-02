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
        $product = $doctrine->getRepository(Producto::class)->findOneBy(['id_producto' => $nombre]);
        $json=json_encode($product);
        dd($product);
        
        return new Response($json);

        
    }
}
