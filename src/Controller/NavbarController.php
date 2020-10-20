<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class NavbarController extends AbstractController
{
    public function navbar()
    {
        return $this->render('navbar/_navbar.html.twig', [
            'controller_name' => 'NavbarController',
        ]);
    }
}
