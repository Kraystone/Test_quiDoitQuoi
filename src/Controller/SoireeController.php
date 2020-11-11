<?php

namespace App\Controller;

use App\Entity\Soiree;
use App\Form\SoireeType;
use App\Form\SupprimerSoireeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SoireeController extends AbstractController
{
    /**
     * @Route("/soiree/index/{id}", name="soiree_index")
     */
    public function index($id, Request $request)
    {
        $repo=$this->getDoctrine()->getRepository(Soiree::class);
        $soiree= $repo->find($id);

        return $this->render('soiree/index.html.twig', [
            'soiree' => $soiree,
        ]);
    }

    /**
    * @Route("/soiree/ajouter", name="soiree_ajouter")
    */

    public function ajouter(Request $request)
    {
        $soiree = new Soiree();
        $form = $this -> createForm ( SoireeType:: class, $soiree );
        $form -> handleRequest ( $request );
        if( $form -> isSubmitted () && $form -> isValid ()) {
        $em = $this -> getDoctrine () -> getManager ();
            $em -> persist ( $soiree );
            $em -> flush ();
            return  $this -> redirectToRoute ( "home" );
        }
        return  $this -> render ( "soiree/ajouter.html.twig" , [
            "formulaire" => $form -> createView ()
        ]);
    }

    /**
     * @Route("/soiree/supprimer/{id}", name="soiree_supprimer")
     */

    public function supprimer($id, Request $request){
        $repo=$this->getDoctrine()->getRepository(Soiree::class);
        $soireesup= $repo->find($id);

        //création du formulaire
        $form=$this->createForm(SupprimerSoireeType::class, $soireesup);


        //recup du POST
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            //recup de l'entitymanager -> gere les objet
            $em=$this->getDoctrine()->getManager();

            //dire au manager qu'on veut garder notre objet en BDD
            $em->remove($soireesup);

            //générer l'insert
            $em->flush();

            //aller a la liste des catégories
            return $this->redirectToRoute("soiree_ajouter");

        }

        return $this->render("soiree/supprimer.html.twig",[
            "formulaire" => $form->createView(),
            "soiree"=>$soireesup,
        ]);
    }
}
