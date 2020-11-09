<?php

namespace App\Controller;

use App\Entity\Soiree;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NavbarController extends AbstractController
{
    public function navbar()
    {
        //récupérer le repository
        $repository=$this->getDoctrine()->getRepository(Soiree::class);
        //je lis la BDD
        $soirees=$repository->findAll();

        return $this->render('navbar/_navbar.html.twig', [
            "soiree"=>$soirees,
        ]);
    }
}
