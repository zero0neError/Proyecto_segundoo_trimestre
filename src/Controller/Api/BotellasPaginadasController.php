<?php

namespace App\Controller\Api;

use App\Entity\Producto;
use App\Repository\ProductoRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class BotellasPaginadasController extends AbstractController
{
    /**
     * @Route("/api/botellas/pagina/{numero}", name="botellas_paginadas")
     */
    public function returnTodasBotellas(ManagerRegistry $doctrine, $numero): Response
    {
        $numero=$numero+0;
        $manager=$doctrine->getManager();

        $producto=$manager->getRepository(Producto::class)->devuelveTodasLasBotellasNoJson();
        //suponemos que tenemos 12 productos por pagina (index-> 11)

        $array_response=[];
        // $contador=0;
        // $contador2=0;
        // foreach ($producto as & $valor) {

            
        //     if($contador>=$numero){

        //         $array_response[$contador2]=$valor;
        //         $contador2=$contador2+1;
        //     }
        //     $contador=$contador+1;
        // }

        $array_response=[];
        $numero=$numero-1;
        $count = (count($producto))-$numero;
        
        
        
        for($i=0;$i<$count && $i<12 ;$i++){
            
            $array_response[$i]=$producto[$numero];
            
            $numero=$numero+1;
            
        }
        
        // dd($array_response);
        return new Response(json_encode($array_response));
    }
}
