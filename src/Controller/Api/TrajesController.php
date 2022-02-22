<?php

namespace App\Controller\Api;


use App\Entity\Producto;
use App\Repository\ProductoRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;


class TrajesController extends AbstractController
{
    /**
     * @Route("/api/trajes/todas", name="todosTrajes")
     */
    public function returnTodosTrajes(ManagerRegistry $doctrine): Response
    {
                
        $manager=$doctrine->getManager();

        $producto=$manager->getRepository(Producto::class)->devuelveTodosLosTrajes();

        return new Response($producto);
    }
    
}