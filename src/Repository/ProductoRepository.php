<?php

namespace App\Repository;

use App\Entity\Producto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Producto|null find($id, $lockMode = null, $lockVersion = null)
 * @method Producto|null findOneBy(array $criteria, array $orderBy = null)
 * @method Producto[]    findAll()
 * @method Producto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Producto::class);
    }

    // /**
    //  * @return Producto[] Returns an array of Producto objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Producto
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    //###########################   BOTELLAS

    public function traeTramos()
    {
    
        $conn = $this->getEntityManager()->getConnection();
        $registros=array();
        $sql = 'SELECT id,duracion_tramo FROM tramo';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();
        $registros=$resultSet->fetchAll();
        
        return json_encode($registros);

    }

    public function traeProductoNoAlquiladoNumeroTotal($id,$fecha){

        $conn = $this->getEntityManager()->getConnection();
        $registros=array();
        $sql = 'SELECT count(nombre) as regis FROM PRODUCTO WHERE id_producto = :id and esta_alquilado = 0';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery(['id' => $id]);
        $registros=$resultSet->fetchAll();
        
        //$json1=json_encode($registros);
        //dd();
        $numero1=(int)$registros[0]["regis"];
        
        //dd($numero1);

        $conn = $this->getEntityManager()->getConnection();
        $registros=array();
        $sql = 'SELECT count(*) as regis FROM reservas WHERE fecha_fin_de_reserva = :fecha';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery(['fecha' => $fecha]);
        $registros=$resultSet->fetchAll();

        $numero2=(int)$registros[0]["regis"];
        
        return $numero1+$numero2;
    }

    public function alquilarNumeroDeRegistrosPorNombre(string $nombre,int $nveces){

        $conn = $this->getEntityManager()->getConnection();
        $registros=array();
        $sql = 'UPDATE PRODUCTO set esta_alquilado = 1 WHERE nombre = :nombre and esta_alquilado = 0 limit '.$nveces;
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery(['nombre' => $nombre]);
        dd($resultSet);
        $registros=$resultSet->fetchAll();
        
        return true;
    }

    public function traeProductoNoAlquiladoPorId($id){

        $conn = $this->getEntityManager()->getConnection();
        $registros=array();
        $sql = 'SELECT count(nombre) as registros FROM PRODUCTO WHERE id_producto = :id and esta_alquilado = 0';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery(['id' => $id]);
        $registros=$resultSet->fetchAll();
        
        return json_encode($registros);
    }

    public function traeProductoNoAlquiladoPorFecha(string $fecha){

        $conn = $this->getEntityManager()->getConnection();
        $registros=array();
        $sql = 'SELECT count(*) as registros FROM reservas WHERE fecha_fin_de_reserva = :fecha';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery(['fecha' => $fecha]);
        $registros=$resultSet->fetchAll();
        
        return json_encode($registros);
    }

    public function traeProductoPorNombre($nombre)
    {
    
        $conn = $this->getEntityManager()->getConnection();
        $registros=array();
        
        $sql = "SELECT id_producto,nombre,descripcion,precio,capacidad,img,tipo_producto_id,esta_alquilado FROM PRODUCTO WHERE nombre LIKE :nombre GROUP BY nombre";
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery(['nombre' => $nombre]);
        $registros=$resultSet->fetchAll();
        
        return $registros;

    }

    public function devuelveBotellasAPartirDePagina($pagina)
    {
    
        $conn = $this->getEntityManager()->getConnection();
        $registros=array();
        $sql = 'SELECT id_producto,nombre,descripcion,precio,produndidad_max,img,tipo_producto_id,esta_alquilado FROM PRODUCTO WHERE tipo_producto_id = 6';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();
        $registros=$resultSet->fetchAll();
        
        return json_encode($registros);

    }

    public function devuelveTodasLasBotellas()
    {
    
        $conn = $this->getEntityManager()->getConnection();
        $registros=array();
        $sql = 'SELECT id_producto,nombre,descripcion,precio,capacidad,img,tipo_producto_id,esta_alquilado FROM PRODUCTO WHERE tipo_producto_id LIKE 4';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();
        $registros=$resultSet->fetchAll();
        
        return json_encode($registros);

    }

    public function devuelveTodasLasBotellasNoJson()
    {
    
        $conn = $this->getEntityManager()->getConnection();
        $registros=array();
        $sql = 'SELECT id_producto,nombre,descripcion,precio,capacidad,img,tipo_producto_id,esta_alquilado FROM PRODUCTO WHERE tipo_producto_id LIKE 4';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();
        $registros=$resultSet->fetchAll();
        
        return $registros;

    }

    public function devuelveTodasLasBotellasAgrupadas()
    {
    
        $conn = $this->getEntityManager()->getConnection();
        $registros=array();
        $sql = 'SELECT id_producto,nombre,descripcion,precio,capacidad,img,tipo_producto_id,esta_alquilado FROM PRODUCTO WHERE tipo_producto_id LIKE 4 GROUP BY nombre';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();
        $registros=$resultSet->fetchAll();
        
        return json_encode($registros);

    }

    public function devuelveTodasLasBotellasNoAlquiladas()
    {
    
        $conn = $this->getEntityManager()->getConnection();
        $registros=array();
        $sql = 'SELECT id_producto,nombre,descripcion,precio,capacidad,img,tipo_producto_id FROM PRODUCTO WHERE tipo_producto_id = 4 and esta_alquilado = 0';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();
        $registros=$resultSet->fetchAll();
        
        return json_encode($registros);

    }

    //###########################   TRAJES
    public function devuelveTodosLosTrajesNoAlquilados()
    {
    
        $conn = $this->getEntityManager()->getConnection();
        $registros=array();
        $sql = 'SELECT id_producto,nombre,descripcion,precio,talla,img,tipo_producto_id FROM PRODUCTO WHERE tipo_producto_id = 2 and esta_alquilado = 0';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();
        $registros=$resultSet->fetchAll();
        
        return json_encode($registros);

    }


    public function devuelveTodosLosTrajes()
    {
    
        $conn = $this->getEntityManager()->getConnection();
        $registros=array();
        $sql = 'SELECT id_producto,nombre,descripcion,precio,talla,img,tipo_producto_id,esta_alquilado FROM PRODUCTO WHERE tipo_producto_id = 2';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();
        $registros=$resultSet->fetchAll();
        
        return json_encode($registros);

    }
    //###########################   GAFAS

    public function devuelveTodasLasGafasNoAlquiladas()
    {
    
        $conn = $this->getEntityManager()->getConnection();
        $registros=array();
        $sql = 'SELECT id_producto,nombre,descripcion,precio,talla,img,tipo_producto_id FROM PRODUCTO WHERE tipo_producto_id = 1 and esta_alquilado = 0';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();
        $registros=$resultSet->fetchAll();
        
        return json_encode($registros);

    }


    public function devuelveTodasLasGafas()
    {
    
        $conn = $this->getEntityManager()->getConnection();
        $registros=array();
        $sql = 'SELECT id_producto,nombre,descripcion,precio,talla,img,tipo_producto_id,esta_alquilado FROM PRODUCTO WHERE tipo_producto_id = 1';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();
        $registros=$resultSet->fetchAll();
        
        return json_encode($registros);

    }

    //###########################   MEDIDOR

    public function devuelveTodosLosMedidoresNoAlquilados()
    {
    
        $conn = $this->getEntityManager()->getConnection();
        $registros=array();
        $sql = 'SELECT id_producto,nombre,descripcion,precio,produndidad_max,img,tipo_producto_id FROM PRODUCTO WHERE tipo_producto_id = 5 and esta_alquilado = 0';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();
        $registros=$resultSet->fetchAll();
        
        return json_encode($registros);

    }


    public function devuelveTodosLasMedidores()
    {
    
        $conn = $this->getEntityManager()->getConnection();
        $registros=array();
        $sql = 'SELECT id_producto,nombre,descripcion,precio,produndidad_max,img,tipo_producto_id,esta_alquilado FROM PRODUCTO WHERE tipo_producto_id = 5';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();
        $registros=$resultSet->fetchAll();
        
        return json_encode($registros);

    }

    //###########################   CAMARA

    public function devuelveTodasLasCamarasNoAlquiladas()
    {
    
        $conn = $this->getEntityManager()->getConnection();
        $registros=array();
        $sql = 'SELECT id_producto,nombre,descripcion,precio,produndidad_max,img,tipo_producto_id FROM PRODUCTO WHERE tipo_producto_id = 6 and esta_alquilado = 0';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();
        $registros=$resultSet->fetchAll();
        
        return json_encode($registros);

    }


    public function devuelveTodasLasCamaras()
    {
    
        $conn = $this->getEntityManager()->getConnection();
        $registros=array();
        $sql = 'SELECT id_producto,nombre,descripcion,precio,produndidad_max,img,tipo_producto_id,esta_alquilado FROM PRODUCTO WHERE tipo_producto_id = 6';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();
        $registros=$resultSet->fetchAll();
        
        return json_encode($registros);

    }

    
    
}
