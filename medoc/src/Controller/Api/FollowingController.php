<?php

namespace App\Controller\Api ;


use App\Services\Api\FollowingService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/api/medoc')]

class FollowingController extends AbstractController
{
    
    public $followingService ;
    
    public function __construct(FollowingService $followingService)
    {
        $this->followingService = $followingService ;
    }

    
    #[Route('/add', name: 'add_medoc')]
    public function add(Request $request)
    {
        return $this->followingService->add($request) ;
    }
 
    #[Route('/list', name: 'list_medoc')]
    public function list(Request $request)
    {
        return $this->followingService->list($request) ;
    }

    // /**
    //  * @Route(
    //  *     name="delete_alert",
    //  *     path="/delete",
    //  *     methods={"DELETE"},
    //  *     defaults={
    //  *         "_controller"="src\Controller\api\AlertController::add",
    //  *         "_api_collection_operation_name"="delete_alert"
    //  *     }
    //  * )
    //  */
    // public function delete(Request $request)
    // {
    //     return $this->alertService->delete($request) ;
    // }
}