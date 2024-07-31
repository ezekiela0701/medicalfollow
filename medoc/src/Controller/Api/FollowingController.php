<?php

namespace App\Controller\Api ;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Alert
 * @Route("api/medoc/")
 */
class FollowingController
{
    
    protected $alertService ;
    
    public function __construct(AlertService $alertService)
    {
        $this->alertService = $alertService ;
    }

    /**
     * @Route(
     *     name="add_medoc",
     *     path="/add",
     *     methods={"POST"},
     *     defaults={
     *         "_controller"="src\Controller\api\FollowingController::add",
     *         "_api_collection_operation_name"="add_medoc"
     *     }
     * )
     */
    public function add(Request $request)
    {
        return $this->alertService->add($request) ;
    }
 
    /**
     * @Route(
     *     name="list_medoc",
     *     path="/list",
     *     methods={"GET"},
     *     defaults={
     *         "_controller"="src\Controller\api\FollowingController::add",
     *         "_api_collection_operation_name"="list_medoc"
     *     }
     * )
     */
    public function list(Request $request)
    {
        return $this->alertService->list($request) ;
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