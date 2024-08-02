<?php
namespace App\Services\Api ;

use App\Utils\Utils;
use App\Entity\Following;
use App\Entity\Individual;
use App\Mybase\Services\Base\SBase;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class IndividualService extends SBase
{

    public function add(Request $request)
    {

        $datas = $this->getPostedData($request) ;

        $individual = new Individual() ;
        $individual = $this->deserialize($datas, Individual::class, 'json');

        $this->save($individual) ;

        $datas = $this->serialize($individual, 'json' , ['groups' => 'individualLists:read' ]);
        
        return $this->jsonResponseOk($datas , "Added individual information with success" ) ;

    }
    
    public function list(Request $request)
    {

        $individualLists = $this->getRepository(Individual::class)->findAll() ;

        if($individualLists){
            
            $datas = $this->serialize($individualLists, 'json', ["groups"=>"individualLists:read"]);

            return $this->jsonResponseOk($datas , "individual listing done" ) ;

        }
        
        return $this->jsonResponseNotFound("No result found") ;

    }

}