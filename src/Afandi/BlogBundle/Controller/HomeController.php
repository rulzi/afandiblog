<?php

namespace Afandi\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller
{
    public function indexAction(Request $request)
    {

    	$em = $this->getDoctrine()->getManager();
        $query = $em->getRepository('AfandiBlogBundle:Blog')
            ->findAllBlogPagination();

        $paginator  = $this->get('knp_paginator');
        $blogs = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            3/*limit per page*/
        );

        return $this->render('AfandiBlogBundle:Home:index.html.twig', array(
            'blogs' => $blogs
        ));
    }

}
