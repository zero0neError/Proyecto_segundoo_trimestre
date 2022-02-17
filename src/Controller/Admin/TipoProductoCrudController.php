<?php

namespace App\Controller\Admin;

use App\Entity\TipoProducto;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TipoProductoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TipoProducto::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
