<?php

namespace Afandi\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BlogpostController extends Controller
{
    public function postAction($id)
    {

    	$repository = $this->getDoctrine()
            ->getRepository('AfandiBlogBundle:Blog');

        $blog = $repository->findOneById($id);

        return $this->render('AfandiBlogBundle:Blogpost:post.html.twig', array(
            'blog' => $blog
        ));
    }

}
