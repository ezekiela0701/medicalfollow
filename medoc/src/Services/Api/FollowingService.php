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
    // public function __construct(EntityManagerInterface $entityManager, ContainerInterface $container , SerializerInterface $serializer 
    // , TokenGeneratorInterface $tokenGenerator , UserPasswordEncoderInterface $passwordEncoder,  MailToSend $mailer ,  Sendmail $sendmail , Utils $utils , Formule $formule ,
    // TraitementUrl $traitementUrl , GetloyerprospectifImmogo $getRentImmogo , EntityManagerInterface $em  , ParameterBagInterface $parameterBagInterface)
    // {
    //     parent::__construct($entityManager, $container , $serializer , $tokenGenerator , $passwordEncoder) ;
        
    //     $this->utils = $utils ;

    // }

    public function add(Request $request)
    {

        $datas = $this->getPostedData($request) ;

        $alert = new Following() ;

        if(isset($datas['idThepropertyType'])){

            $idThepropertyType = $datas['idThepropertyType'] ;
            $thepropertyType = $this->getRepository(PropertyType::class)->findOneBy(['id' => $idThepropertyType]) ;

            $alert->setPropertyType($thepropertyType) ;
        
        }

        if($alert !=null || !empty($alert)){
            
            $alert->setUser($currentUser) ;

            $this->save($alert) ;

            $datas = $this->serialize($alert, 'json' , ['groups' => 'syndicdocumentcomment:read' ]);
            
            return $this->jsonResponseOk($datas , "Added alert with success" ) ;

        }

        return $this->jsonResponseNotFound("No result found") ;

    }
    
    public function list(Request $request)
    {
        $alertLists     = $this->getRepository(Alert::class)->findBy(['user' => $currentUser]) ;

        if($alertLists){
            
            $datas = $this->serialize($alertLists, 'json', ["groups"=>"alert:read"]);

            return $this->jsonResponseOk($datas , "offer inserted" ) ;

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