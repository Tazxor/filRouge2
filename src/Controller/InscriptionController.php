<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\InscriptionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class InscriptionController extends AbstractController
{
    private $em;
    public function __construct(EntityManagerInterface $em){
        $this->em = $em;
    }
    #[Route('/inscription', name: 'inscription')]
    public function index(Request $request, UserPasswordHasherInterface $uphi): Response
    {
        $user = new User();
        $form= $this->createForm(InscriptionType::class, $user);
        // Ecouter la soumission du formulaire(submit)
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            // récupérer les données du formulaire
            $user = $form->getData();
            // récupérer le mdp non crypté
            $pwd = $uphi->hashPassword($user, $user->getPassword());
            // remettre le mdp crypté dans l'objet $user
            $user->setPassword($pwd);
            //dd($pwd);
            //dd($user);
            // Figer les données à envoyer vers la BDD
            $this->em->persist($user);
            // mettre à jour dans la BDD
            $this->em->flush();
        }

        return $this->render('inscription/inscription.html.twig', [
            'formInscription'=> $form->createView()

        ]);
    }
}
