<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductoGafasController extends AbstractController
{
    /**
     * @Route("/producto/gafas", name="producto_gafas")
     */
    public function index(): Response
    {
        return $this->render('producto_gafas/index.html.twig', [
            'controller_name' => 'ProductoGafasController',
        ]);
    }
}
