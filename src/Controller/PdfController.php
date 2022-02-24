<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;

class PdfController extends AbstractController
{
    /**
     * @Route("/pdf", name="pdf")
     */
    public function index(): Response
    {
        
        // Crea una instancia de Dompdf
        $dompdf = new Dompdf();
        
        // Recupere el HTML generado en nuestro archivo twig
        $html = $this->renderView('pdf/index.html.twig',[
            'contenido' => ' '
        ]);
        
        // Cargar HTML en Dompdf
        $dompdf->loadHtml($html);

        // Renderiza el HTML como PDF
        $dompdf->render();

        // Envíe el PDF generado al navegador (vista en línea)
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => false
        ]);
    }
}
