<?php

namespace App\Controller\Admin;

use App\Entity\Usuario;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UsuarioCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Usuario::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
        
            TextField::new('email'),
            TextField::new('nombre'),
            TextField::new('apellidos'),
            BooleanField::new('is_verified'),
            ArrayField::new('roles')
        ];
    }
   
}
