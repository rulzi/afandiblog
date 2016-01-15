<?php

namespace Afandi\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Afandi\BlogBundle\Entity\Category;
use Afandi\BlogBundle\Form\Type\CategoryType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class CategoryController extends Controller
{
    public function listAction(Request $request)
    {
        
        $em = $this->getDoctrine()->getManager();
        $query = $em->getRepository('AfandiBlogBundle:Category')
            ->findAllCategoryPagination();

        $paginator  = $this->get('knp_paginator');
        $categories = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            5/*limit per page*/
        );

        return $this->render('AfandiBlogBundle:Category:list.html.twig', array(
            'categories' => $categories
        ));
    }

    public function addAction(Request $request)
    {
        $category = new Category();

        $form = $this->createForm(CategoryType::class, $category, array(
            'method' => 'POST',
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $name = $form->getData()->getName();

            $category->setName($name);

            $em = $this->getDoctrine()->getManager();

            $em->persist($category);
            $em->flush();

            $this->addFlash(
                'notice',
                'Category Saved'
            );

        }

        return $this->render('AfandiBlogBundle:Category:form.html.twig', array(
            'form' => $form->createView(),
            'action' => "Add"
        ));
    }

    public function editAction($id, Request $request)
    {
        
        $repository = $this->getDoctrine()
            ->getRepository('AfandiBlogBundle:Category');

        $category = $repository->findOneById($id);

        if (!$category) {
            return $this->render('AfandiBlogBundle:Category:form.html.twig', array(
                'form' => null,
                'action' => "Edit"
            ));
        }

        $category->setName($category->getName());

        $form = $this->createForm(CategoryType::class, $category, array(
            'method' => 'POST',
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $name = $form->getData()->getName();

            $category->setName($name);

            $em = $this->getDoctrine()->getManager();

            $em->flush();

            $this->addFlash(
                'notice',
                'Category Updated'
            );

        }

        return $this->render('AfandiBlogBundle:Category:form.html.twig', array(
            'form' => $form->createView(),
            'action' => "Edit"
        ));
    }

    public function deleteAction($id, Request $request)
    {
        $repository = $this->getDoctrine()
            ->getRepository('AfandiBlogBundle:Category');

        $category = $repository->findOneById($id);

        if (!$category) {
            $this->addFlash(
                'notice_nulldata',
                'Id Category Tidak ada'
            );
            return new RedirectResponse($this->generateUrl('admin_category_list'));
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($category);
        $em->flush();   

        $this->addFlash(
            'notice',
            'Category Deleted'
        );

        return new RedirectResponse($this->generateUrl('admin_category_list'));

    }

}
