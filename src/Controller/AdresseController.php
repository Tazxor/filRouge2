<?php

namespace App\Controller;

use App\Entity\Adresse;
use App\Form\AdresseType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdresseController extends AbstractController
{
    private $emi;
    public function __construct(EntityManagerInterface $emi)
    {
        $this->emi = $emi;
    }

    #[Route('/compte/adresse/ajouter', name: 'ajouterAdresse')]
    public function index(Request $request): Response
    {

        $adresse = new Adresse();
        $form = $this->createForm(AdresseType::class, $adresse);
        
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){



            $currentUser =$this->getUser();
            $adresse->setUser($currentUser);
            $this->emi->persist($adresse);
            $this->emi->flush();
            
        }


        return $this->render('adresse/gestionAdresse.html.twig', [
            'formAdresse' => $form->createView(),
        ]);
    }

    
    #[Route('/compte/adresse', name: 'adresse')]
    public function index1(): Response
    {
        return $this->render('adresse/mesAdresse.html.twig');
    }


    #[Route('/compte/adresse/supprimer{id}', name: 'supprimerAdresse')]
    public function index2($id): Response
    {

        //injection de dependance via une route de la variable $id
        $adresse = $this->emi->getRepository(Adresse::class)->find($id);
        if($adresse && ($this->getUser() == $adresse->getUser())){
            $this->emi->remove($adresse);
            $this->emi->flush();
        };
        return $this->redirectToRoute('adresse');
    }

    #[Route('/compte/adresse/modifier{id}', name: 'modifierAdresse')]
    public function index3($id, Request $request): Response
    {

        //injection de dependance via une route de la variable $id
        $adresse = $this->emi->getRepository(Adresse::class)->find($id);
        if(!$adresse || ($this->getUser() != $adresse->getUser())){
        return $this->redirectToRoute('adresse');
        };
        $form = $this->createForm(AdresseType::class, $adresse);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->emi->flush();
            return $this->redirectToRoute('adresse');
        }
        return $this->render('adresse/gestionAdresse.html.twig', [
            'formAdresse' => $form->createView(),
        ]);
    }
}
