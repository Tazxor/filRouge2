<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeliciousIceCreamController extends AbstractController
{
    #[Route('/accueil', name: 'app_delicious_ice_cream')]
    public function index(): Response
    { $name ="thomas";
        return $this->render('delicious_ice_cream/accueil.html.twig',['nom' => $name]);
    }
}
