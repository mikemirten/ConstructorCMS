<?php

namespace App\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function mainAction()
    {
        return $this->render('AppAdminBundle:Admin:main.html.twig');
    }
}
