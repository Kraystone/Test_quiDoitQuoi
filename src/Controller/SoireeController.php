<?php

namespace App\Controller;

use App\Entity\Soiree;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SoireeController extends AbstractController
{
    /**
     * @Route("/soiree", name="soiree")
     */
    public function index()
    {
        return $this->render('soiree/index.html.twig', [
            'controller_name' => 'SoireeController',
        ]);
    }

    /**
     * @Route("/soiree/ajouter", name="soiree_ajouter")
     */
    public function ajouter(Request $request)
    {
        $soiree = new Soiree();
        $form = $this->createForm(Soiree::class, $soiree);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($soiree);
            $em->flush();
            return $this->redirectToRoute("soiree");
        }
        return $this->render("soiree/ajouter.html.twig", [
                "formulaire" => $form->createView()
            ]);
    }
}
