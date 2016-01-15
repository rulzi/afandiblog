<?php

namespace Afandi\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AfandiBlogBundle:Default:index.html.twig');
    }
}
