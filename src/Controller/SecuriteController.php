<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\InscriptionType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecuriteController extends AbstractController
{
    /**
     * @Route("/inscription", name="securite_inscription")
     */
    public function inscription(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $user = new User();
        $form = $this->createForm(InscriptionType::class, $user);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $hash = $encoder->encodePassword($user, $user->getMdp());
            $user->setMdp($hash);
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('securite_connexion');
        }
        return $this->render('securite/inscription.html.twig', [
           'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/connexion", name="securite_connexion")
     */
    public function connexion()
    {
        return $this->render('securite/connexion.html.twig');
    }
    /**
     * @Route("/deconnexion", name="securite_deconnexion")
     */
    public function deconnexion()
    {

    }
}
