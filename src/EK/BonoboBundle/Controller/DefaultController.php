<?php

namespace EK\BonoboBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('EKBonoboBundle:Default:index.html.twig');
    }
}
