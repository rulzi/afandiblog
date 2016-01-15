<?php

namespace Afandi\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Afandi\BlogBundle\Entity\General;
use Afandi\BlogBundle\Form\Type\GeneralType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class GeneralController extends Controller
{
    public function listAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->getRepository('AfandiBlogBundle:General')
            ->findAllGeneralPagination();

        $paginator  = $this->get('knp_paginator');
        $generals = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            5/*limit per page*/
        );

        return $this->render('AfandiBlogBundle:General:list.html.twig', array(
            'generals' => $generals
        ));
    }

    public function addAction(Request $request)
    {
        $general = new General();

        $form = $this->createForm(GeneralType::class, $general, array(
            'method' => 'POST',
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $name = $form->getData()->getGeneralName();
            $string = $form->getData()->getGeneralValueString();
            $integer = $form->getData()->getGeneralValueInteger();
            $date = $form->getData()->getGeneralValueDate();
            $text = $form->getData()->getGeneralValueText();
            $image = $form->getData()->getImageFile();

            $general->setGeneralName($name);
            $general->setGeneralValueString($string);
            $general->setGeneralValueInteger($integer);
            $general->setGeneralValueDate($date);
            $general->setGeneralValueText($text);
            $general->setImageFile($image);

            $em = $this->getDoctrine()->getManager();

            $em->persist($general);
            $em->flush();

            $this->addFlash(
                'notice',
                'General Setting Saved'
            );

        }

        return $this->render('AfandiBlogBundle:General:form.html.twig', array(
            'form' => $form->createView(),
            'action' => "Add"
        ));
    }

    public function editAction($id, Request $request)
    {

        $repository = $this->getDoctrine()
            ->getRepository('AfandiBlogBundle:General');

        $general = $repository->findOneById($id);

        $general->setGeneralName($general->getGeneralName());
        $general->setGeneralValueString($general->getGeneralValueString());
        $general->setGeneralValueInteger($general->getGeneralValueInteger());
        $general->setGeneralValueDate($general->getGeneralValueDate());
        $general->setGeneralValueText($general->getGeneralValueText());

        $form = $this->createForm(GeneralType::class, $general, array(
            'method' => 'POST',
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $name = $form->getData()->getGeneralName();
            $string = $form->getData()->getGeneralValueString();
            $integer = $form->getData()->getGeneralValueInteger();
            $date = $form->getData()->getGeneralValueDate();
            $text = $form->getData()->getGeneralValueText();
            $image = $form->getData()->getImageFile();

            $general->setGeneralName($name);
            $general->setGeneralValueString($string);
            $general->setGeneralValueInteger($integer);
            $general->setGeneralValueDate($date);
            $general->setGeneralValueText($text);
            $general->setImageFile($image);

            $em = $this->getDoctrine()->getManager();

            $em->flush();

            $this->addFlash(
                'notice',
                'General Setting Updated'
            );

        }

        return $this->render('AfandiBlogBundle:General:form.html.twig', array(
            'form' => $form->createView(),
            'action' => "Update"
        ));
    }

    public function deleteAction($id)
    {
        $repository = $this->getDoctrine()
            ->getRepository('AfandiBlogBundle:General');

        $general = $repository->findOneById($id);

        if (!$general) {
            $this->addFlash(
                'notice_nulldata',
                'Category Deleted'
            );

            return new RedirectResponse($this->generateUrl('admin_general_list'));
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($general);
        $em->flush();   

        $this->addFlash(
            'notice',
            'Category Deleted'
        );

        return new RedirectResponse($this->generateUrl('admin_general_list'));
    }

}
