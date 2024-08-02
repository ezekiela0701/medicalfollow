<?php

namespace App\Controller\Api ;

use App\Services\Api\IndividualService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/api/individual')]

class IndividualController extends AbstractController
{
    
    public $individualService ;
    
    public function __construct(IndividualService $individualService)
    {
        $this->individualService = $individualService ;
    }
    
    #[Route('/add', name: 'add_individual')]
    public function add(Request $request)
    {
        return $this->individualService->add($request) ;
    }
 
    #[Route('/list', name: 'list_individual')]
    public function list(Request $request)
    {
        return $this->individualService->list($request) ;
    }

}