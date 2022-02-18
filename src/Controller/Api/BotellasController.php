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


    /**
     * @Route("/api/botellas/libres", name="libresBotellas")
     */
    public function devuelveBotellasLibres(ManagerRegistry $doctrine): Response
    {
                
        $manager=$doctrine->getManager();

        $producto=$manager->getRepository(Producto::class)->devuelveTodasLasBotellasNoAlquiladas();

        return new Response($producto);
    }
}