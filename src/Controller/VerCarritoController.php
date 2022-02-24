<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class VerCarritoController extends AbstractController
{
    /**
     * @Route("/vercarrito/{datos}", name="ver_carrito")
     */
    public function index(Request $request, $datos): Response
    {
        
        // $request = Request::createFromGlobals();

        // $json = $request->request->get('json');

        return $this->render('ver_carrito/index.html.twig', [
            'controller_name' => 'VerCarritoController',
            'json' => $datos
        ]);
    }
}
