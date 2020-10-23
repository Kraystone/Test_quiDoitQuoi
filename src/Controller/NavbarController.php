<?php

namespace App\Controller;

use App\Entity\Soiree;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class NavbarController extends AbstractController
{
    public function navbar()
    {
        $repository=$this->getDoctrine()->getRepository(Soiree::class);
        $soiree=$repository->findAll();

        return $this->render('navbar/_navbar.html.twig', [
            'soiree'=>$soiree,
        ]);
    }
}
