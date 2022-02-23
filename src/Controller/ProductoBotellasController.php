<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductoBotellasController extends AbstractController
{
    /**
     * @Route("/producto/botellas", name="producto_gafas")
     */
    public function index(): Response
    {
        return $this->render('producto_botellas/index.html.twig', [
            'controller_name' => 'ProductoBotellasController',
        ]);
    }
}
