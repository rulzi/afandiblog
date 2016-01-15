<?php

namespace Afandi\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AboutController extends Controller
{
    public function aboutAction()
    {

    	$em = $this->getDoctrine()->getManager();
        $about = $em->getRepository('AfandiBlogBundle:General')
            ->findGeneralValue('about');

        return $this->render('AfandiBlogBundle:About:about.html.twig', array(
            'about' => $about
        ));
    }

}
