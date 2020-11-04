<?php

namespace App\Controller;

use EasyCorp\Bundle\EasyAdminBundle\Controller\EasyAdminController;
use Symfony\Component\HttpFoundation\Response;

class SkelbimasController extends EasyAdminController
{
    public function showAction(): Response
    {
        if (!$this->getUser()) {
            $this->addFlash('error', 'Privalote prisijungti!');

            return $this->redirectToReferrer();
        }

        return parent::showAction();
    }

    public function editAction(): Response
    {
        if (!$this->getUser()) {
            $this->addFlash('error', 'Privalote prisijungti!');

            return $this->redirectToReferrer();
        }

        return parent::showAction();
    }

    public function newAction(): Response
    {
        if (!$this->getUser()) {
            $this->addFlash('error', 'Privalote prisijungti!');

            return $this->redirectToReferrer();
        }

        return parent::showAction();
    }
}
