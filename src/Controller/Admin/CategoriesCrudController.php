<?php

namespace App\Controller\Admin;

use App\Entity\Categories;

use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CategoriesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Categories::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('Uid' , 'Code Raccourci'),
            // TextField::new('codeRaccourci' , 'code'),
            TextField::new('nomCategory' , 'nom'),
        ];
    }

   public function deleteEntity(EntityManagerInterface $manager, $entityInstance) : void{
        if(!$entityInstance instanceof Categories) return;

        foreach ($entityInstance->getLicenciers() as $liencier) {
            $manager->remove($liencier);
        }
        parent::deleteEntity($manager, $entityInstance);
   }
}
