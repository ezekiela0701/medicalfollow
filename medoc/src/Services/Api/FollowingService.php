<?php
namespace App\Services\Api ;

use App\Utils\Utils;
use App\Entity\Following;
use App\Mybase\Services\Base\SBase;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class FollowingService extends SBase
{

    public function add(Request $request)
    {

        $datas = $this->getPostedData($request) ;

        $following = new Following() ;
            
        $following  = $this->deserialize($datas, Following::class, 'json');
        $following->setStatus(true) ;

        $this->save($following) ;

        $datas = $this->serialize($following, 'json' , ['groups' => 'medocLists:read' ]);
        
        return $this->jsonResponseOk($datas , "Added following medoc with success" ) ;

    }
    
    public function list(Request $request)
    {

        $medocLists     = $this->getRepository(Following::class)->findBy(['status' => 1]) ;

        if($medocLists){
            
            $datas = $this->serialize($medocLists, 'json', ["groups"=>"medocLists:read"]);

            return $this->jsonResponseOk($datas , "medoc listing done" ) ;

        }
        
        return $this->jsonResponseNotFound("No result found") ;

    }

    // public function delete(Request $request)
    // {

    //     $authorization  = $request->headers->get('authorization');
    //     $token          = explode(" ",$authorization)[1];
    //     $currentUser    = $this->utils->getCurrentUserByToken($token) ;

    //     $datas          = $this->getPostedData($request) ;

    //     $idAlert        = $datas['idAlert'] ;

    //     $alert          =$this->getRepository(Alert::class)->findOneBy(['id' => $idAlert , 'user' => $currentUser]) ;

    //     if($alert){

    //         $this->remove($alert) ;

    //         return $this->jsonResponseOk(null , "Alert deleted with success" ) ;

    //     }

    //     return $this->jsonResponseNotFound("No result found") ;

    // }

}