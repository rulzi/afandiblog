<?php

namespace Afandi\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Afandi\BlogBundle\Entity\Blog;
use Afandi\BlogBundle\Form\Type\BlogType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class BlogController extends Controller
{
    public function listAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->getRepository('AfandiBlogBundle:Blog')
            ->findAllBlogPagination();

        $paginator  = $this->get('knp_paginator');
        $blogs = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            5/*limit per page*/
        );

        return $this->render('AfandiBlogBundle:Blog:list.html.twig', array(
            'blogs' => $blogs
        ));
    }

    public function addAction(Request $request)
    {
        $blog = new Blog();

        $form = $this->createForm(BlogType::class, $blog, array(
            'method' => 'POST',
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $title = $form->getData()->getTitle();
            $author = $form->getData()->getAuthor();
            $content = $form->getData()->getContent();
            $category_id = $form->getData()->getCategoryId()->getId();
            $feature_image = $form->getData()->getImageFile();

            $repository = $this->getDoctrine()
            ->getRepository('AfandiBlogBundle:Category');

            $category = $repository->findOneById($category_id);

            $blog->setTitle($title);
            $blog->setAuthor($author);
            $blog->setContent($content);
            $blog->setCategoryId($category);
            $blog->setImageFile($feature_image);

            $em = $this->getDoctrine()->getManager();

            $em->persist($blog);
            $em->flush();

            $this->addFlash(
                'notice',
                'Blog Saved'
            );

        }

        return $this->render('AfandiBlogBundle:Blog:form.html.twig', array(
            'form' => $form->createView(),
            'action' => "Add"
        ));
    }

    public function editAction($id, Request $request)
    {

        $repository = $this->getDoctrine()
            ->getRepository('AfandiBlogBundle:Blog');

        $blog = $repository->findOneById($id);

        if (!$blog) {
            return $this->render('AfandiBlogBundle:Blog:form.html.twig', array(
                'form' => null,
                'action' => "Edit"
            ));
        }

        $blog->setTitle($blog->getTitle());
        $blog->setAuthor($blog->getAuthor());
        $blog->setContent($blog->getContent());
        $blog->setCategoryId($blog->getCategoryId());
        $blog->setImageFile($blog->getImageFile());

        $form = $this->createForm(BlogType::class, $blog, array(
            'method' => 'POST',
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $title = $form->getData()->getTitle();
            $author = $form->getData()->getAuthor();
            $content = $form->getData()->getContent();
            $category_id = $form->getData()->getCategoryId()->getId();
            $feature_image = $form->getData()->getImageFile();

            $c_repository = $this->getDoctrine()
            ->getRepository('AfandiBlogBundle:Category');

            $category = $c_repository->findOneById($category_id);

            $blog->setTitle($title);
            $blog->setAuthor($author);
            $blog->setContent($content);
            $blog->setCategoryId($category);
            $blog->setImageFile($feature_image);

            $em = $this->getDoctrine()->getManager();

            $em->flush();

            $this->addFlash(
                'notice',
                'Blog Updated'
            );

        }

        return $this->render('AfandiBlogBundle:Blog:form.html.twig', array(
            'form' => $form->createView(),
            'action' => "Edit"
        ));
    }

    public function deleteAction($id)
    {
        $repository = $this->getDoctrine()
            ->getRepository('AfandiBlogBundle:Blog');

        $blog = $repository->findOneById($id);

        if (!$blog) {
            $this->addFlash(
                'notice_nulldata',
                'Category Deleted'
            );

            return new RedirectResponse($this->generateUrl('admin_blog_list'));
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($blog);
        $em->flush();   

        $this->addFlash(
            'notice',
            'Category Deleted'
        );

        return new RedirectResponse($this->generateUrl('admin_blog_list'));

    }

}
