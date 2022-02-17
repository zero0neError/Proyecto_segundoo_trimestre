<?php

namespace App\Controller\ProductoGafasController;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductoGafasController extends AbstractController
{
    /**
     * @Route("/api/getgafas", name="json_gafas")
     */
    public function getGafas(): Response{

        //Consulta a la base de datos y trae todas las filas de la base de datos
        return new Response();
    }
}