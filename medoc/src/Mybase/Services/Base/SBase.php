<?php

/**
 * Base service
 */
namespace App\Mybase\Services\Base;

use Monolog\Logger;
use App\Entity\User;
use App\Utils\Utils;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\EntityRepository;
use App\Mybase\Services\Logger\SLogger;
use Doctrine\ORM\EntityManagerInterface;
use App\Mybase\Services\Base\SBaseInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;

class SBase implements SBaseInterface {

     /**
      * @var EntityManagerInterface
      */
     protected $entityManager;

     /**
     * @var SerializerInterface
     */
    protected  $serializer;

    /**
     * @var TokenGeneratorInterface
     */
    protected  $tokenGenerator;


    /**
     * Base service constructor
     *
     * @param EntityManagerInterface $entityManager
     * @param SerializerInterface $serializer
     * @param TokenGeneratorInterface $tokenGenerator
     */
    public function __construct(EntityManagerInterface $entityManager,  SerializerInterface $serializer 
    , TokenGeneratorInterface $tokenGenerator  )
    {
        $this->serializer       = $serializer;
        $this->entityManager    = $entityManager;
        $this->tokenGenerator   = $tokenGenerator ; 

    }

    /**
     * Gets the default Entity Manager
     *
     * @return EntityManagerInterface
     */
    public function getEntityManager(): EntityManagerInterface
    {
        return $this->entityManager;
    }

    /**
     * Gets the related Repository for given class name
     *
     * @param string $entityClass The entity class name
     * 
     * @return mixed The repository
     * 
     * @throws InvalidArgumentException if the repository is not defined
     */
    public function getRepository($entity) :EntityRepository
    {
        return $this->entityManager->getRepository($entity);
    }

    /**
     * Gets the parameter value for the given name from Container
     *
     * @param string $name The parameter
     * 
     * @return mixed The parameter value
     * 
     * @throws InvalidArgumentException if the parameter is not defined
     */
    public function getParameter(string $name)
    {
        return $this->container->getParameter($name);
    }

    /**
     * Saves given object using the default entity manager
     *
     * @param object $object The object to save
     * @return object The saved object, throws otherwise
     * @throws ORMException if an error has occurred
     */
    public function save($object)
    {
        
        $em = $this->entityManager;

        try {
            
            if($object->getId() === null) {

                $em->persist($object);

            }
            
            $em->flush();

            return $object;

        } catch (ORMException $ORMex) {
            throw $ORMex;
        }
    }

    /**
     * Removes given object using the default entity manager
     *
     * @param object $object The object to save
     * @return bool True if object was successfuly removed, throws otherwise
     * @throws ORMException if an error has occurred
     */
    public function remove($object)
    {
        $em = $this->entityManager;

        try {
            $em->remove($object);
            $em->flush();

            return true;

        } catch (ORMException $ORMex) {
            throw $ORMex;
        }
    }

    /**
     * Writes new log or push message to the given logfile using SLogger
     *
     * @param string $content The log content
     * @param string $logFile The log filename without ".log" extension
     * @param string $messageLevel The log message level. "NOTICE" by default
     * @param boolean $pushMessage If true, creates new log message with current date as header, push message otherwise
     */
    public function writeLog(string $content, string $logFile, string $messageLevel = Logger::NOTICE, bool $pushMessage = false)
    {
        $rootDir = $this->getParameter('root_dir');

        $logger = new SLogger($rootDir);

        $logger->writeLog($content, $logFile, $messageLevel, $pushMessage);
    }

     /**
     * @param array $data
     * @param string $type
     * @param string $format
     * @param array $options
     * @return mixed
     */
    public function deserialize(array $data, string $type, string $format = 'json', array $options = [])
    {
        return $this->serializer->deserialize(
            json_encode($data),
            $type,
            $format,
            $options
        );
    }

    /**
     * @param mixed $data
     * @param string $type
     * @return string
     */
    public function serialize($data, string $type, $context = [])
    {
        return $this->serializer->serialize($data, $type , $context);
    }

     /**
     * @param Request $request
     * @return array|mixed
     */
    public function getPostedData(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        $request->request->replace(is_array($data) ? $data : array());

        return $data;
    }

    public function generateToken()
    {
        return $this->tokenGenerator->generateToken();
    }

    public function countPagination($total,$paginate)
    {
        $totalPagination = 1 ;
        if($total >= $paginate)
        {
            $totalPaginations = $total / $paginate ;
            $totalPagination  = intdiv($total , $paginate) ;

            $tot = $total % $paginate ;

           if($tot != 0){
            
               $totalPagination = $totalPagination + 1 ;

           }
           
        }
        return $totalPagination ;
    }

    public function jsonResponseOk($datas, $message)
    {
        # code...
        return new JsonResponse([

            "data"      => json_decode($datas , true),
            "code"      => Response::HTTP_OK,
            "success"   => true,
            "message"   => $message

        ]);

    }

    public function jsonResponseNotAcceptable($message)
    {
        # code...
        return new JsonResponse([

            "data"      => [],
            "code"      => Response::HTTP_NOT_ACCEPTABLE,
            "success"   => false,
            "message"   => $message
 
        ]);

    }

    public function jsonResponseNotFound($message)
    {
        # code...
        return new JsonResponse([

            "data"      => [],
            "code"      => Response::HTTP_NOT_FOUND,
            "success"   => false,
            "message"   => $message

        ]);
    }
    
    public function jsonResponseBadRequest()
    {
        # code...
        return new JsonResponse([
            "data"      => [], 
            "code"      => Response::HTTP_BAD_REQUEST , 
            "success"   => false ,
            "message"   => "No request found" ,
    
        ]);
    }

    public function jsonResponseFailedCondition($message)
    {
        # code...
        return new JsonResponse([
            "data"      => [],
            "code"      => Response::HTTP_PRECONDITION_FAILED ,
            "success"   => false ,
            "message"   => $message ,

        ]);
    }

    public function jsonResponseUnauthorized($message)
    {
        # code...
        return new JsonResponse([
            "data"      => [],
            "code"      => Response::HTTP_UNAUTHORIZED,
            "success"   => false,
            "message"   => $message
        ]);
    }

    public function jsonResponseAuthenticatedRequired()
    {
        # code...
        return new JsonResponse([

            "data"      => [],
            "code"      => Response::HTTP_NETWORK_AUTHENTICATION_REQUIRED,
            "success"   => false,
            "message"   => "User not authenticated"
 
        ]);
    }

    /**
     * return a list of a property in a list of object.
     * @param array $objects list of object
     * @param string $propertyName
     * @return array $result list of property
     */
    public function getProperties(array $objects, string $propertyName): array
    {
        $method = 'get' . ucfirst($propertyName);
        $result = []; 

        foreach ($objects as $object) {

            $result[] = $object->$method();

        }

        return $result;
    }

    /**
     * check if objectInput is in list of object
     */
    public function in_objects($objectInput, $objects)
    {
        foreach ($objects as $object) {
            if($object->getId() === $objectInput->getId()) {
                return true;
            }
        }
        return false;
    }


    /**
     * concu pour eviter la redondance d'un objet dans un tableau
     */
    public function addObject(array $objects, $object)
    {

        foreach ($objects as $objectInlist) {
     
            if($objectInlist->getId() === $object->getId()) {

                return $objects;

            }      

        }

        $objects[] = $object;

        return $objects;

    }

    public function getObjectById($entity, int $objectId) : ? object
    {

        if(!is_null($objectId)){

            $object = $this->getRepository($entity)->findOneById($objectId);

            if(!is_null($object)){

                return $object;
            }
        }

        return null;
    }

    public function uploadFile($files , $parameter)
    {
        $datas = [] ;
        for ($i = 0; $i < count($files); $i++) {

            $file       = explode('.', $files[$i]->getClientOriginalName());
            $datas['filename']   = $file[0] . '' . uniqid() . '.' . $files[$i]->guessExtension();
            
            $files[$i]->move($this->getParameter($parameter), $datas['filename'] );
        }
        
        return $datas ;
    }


}