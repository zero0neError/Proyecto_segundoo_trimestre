<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShowProfileController extends AbstractController
{
    /**
     * @Route("/show/profile", name="show_profile")
     */
    public function index(): Response
    {
        return $this->render('show_profile/index.html.twig', [
            'controller_name' => 'ShowProfileController',
        ]);
    }
}
