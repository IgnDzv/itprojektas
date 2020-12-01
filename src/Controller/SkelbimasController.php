<?php

namespace App\Controller;

use App\Entity\Vartotojas;
use App\Entity\Zinute;
use App\Form\SkelbimasShowType;
use DateTime;
use EasyCorp\Bundle\EasyAdminBundle\Controller\EasyAdminController;
use EasyCorp\Bundle\EasyAdminBundle\Event\EasyAdminEvents;
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

        $builder
            ->add(
            'vartotojas',
            EntityType::class,
            $options
            )
        ;

        return $builder;
    }

    protected function showAction()
    {
        $this->dispatch(EasyAdminEvents::PRE_SHOW);

        $id = $this->request->query->get('id');
        $easyadmin = $this->request->attributes->get('easyadmin');
        $entity = $easyadmin['item'];

        $fields = $this->entity['show']['fields'];
        $deleteForm = $this->createDeleteForm($this->entity['name'], $id);

        $komentarasType = $this->createForm(SkelbimasShowType::class);
        $komentarasType->handleRequest($this->request);
        if ($komentarasType->isSubmitted() && $komentarasType->isValid())
        {
            $zinute = new Zinute();
            $zinute
                ->setSkelbimas($entity)
                ->setTekstas($komentarasType->get('naujasKomentaras')->getData())
                ->setData(new DateTime())
                ->setVartotojas($this->getUser())
            ;

            $this->getDoctrine()->getManager()->persist($zinute);
            $this->getDoctrine()->getManager()->flush();
        }

        $this->dispatch(EasyAdminEvents::POST_SHOW, [
            'deleteForm' => $deleteForm,
            'fields' => $fields,
            'entity' => $entity,
        ]);

        $parameters = [
            'entity' => $entity,
            'fields' => $fields,
            'delete_form' => $deleteForm->createView(),
            'naujasKomentaras' => $komentarasType->createView(),
        ];

        return $this->render($this->entity['templates']['show'], $parameters);
    }
}
