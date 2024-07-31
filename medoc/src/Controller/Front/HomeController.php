<?php

namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

#[Route('/app', name: 'Front.')]
class HomeController extends AbstractController
{
    #[Route('/{slug?}', name: 'home')]
    public function index(): Response
    {
        
        
        return $this->render('Front/home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/api/helloworld/{name}', name: 'helloworld')]
    public function helloWorld(string $name): Response
    {

        return new JsonResponse('hello' .$name) ;

    }

}
