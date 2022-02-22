<?php

namespace App\Controller\Admin;

use App\Entity\Producto;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;


class ProductoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Producto::class;
    }

    
    public function configureFields(string $pageName): iterable
    {

        return [
            NumberField::new('id_producto'),
            TextField::new('nombre'),
            TextField::new('descripcion'),
            TextField::new('talla'),
            NumberField::new('precio'),
            NumberField::new('capacidad'),
            NumberField::new('produndidad_max'),
            TextField::new('resolucion'),
            ImageField::new('img')->setUploadDir("public/images/subidas"),
            AssociationField::new('tipo_producto')
            
        ];
    }
   
}
