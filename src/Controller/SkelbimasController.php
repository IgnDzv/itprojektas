<?php

namespace App\Controller;

use App\Entity\Vartotojas;
use EasyCorp\Bundle\EasyAdminBundle\Controller\EasyAdminController;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\HttpFoundation\Response;

class SkelbimasController extends EasyAdminController
{
//    public function showAction(): Response
//    {
//        if (!$this->getUser()) {
//            $this->addFlash('error', 'Privalote prisijungti!');
//
//            return $this->redirectToReferrer();
//        }
//
//        return parent::showAction();
//    }

    public function editAction(): Response
    {
        if (!$this->getUser()) {
            $this->addFlash('error', 'Privalote prisijungti!');

            return $this->redirectToReferrer();
        }

        return parent::editAction();
    }

    public function newAction(): Response
    {
        if (!$this->getUser()) {
            $this->addFlash('error', 'Privalote prisijungti!');

            return $this->redirectToReferrer();
        }

        return parent::newAction();
    }

    public function createEntityFormBuilder($entity, $view)
    {
        $builder = parent::createEntityFormBuilder($entity, $view);

        $options = [
            'class' => Vartotojas::class,
            'data' => $this->getUser(),
        ];

        if (!$this->isGranted('ROLE_ADMIN')) {
            $options = array_merge($options, ['choices' => [$this->getUser()]]);
        }

        $builder->add(
            'vartotojas',
            EntityType::class,
            $options
        );

        return $builder;
    }
}
