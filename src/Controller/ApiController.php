<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations as FOSRest;
use App\Entity\Bien;
use App\Entity\Client;
use App\Entity\Image;
use App\Entity\Localite;
use App\Entity\Reservation;
use App\Entity\TypeBien;




class ApiController extends Controller
{
    /**
     * @Route("/api", name="api")
     */
    public function index()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ApiController.php',
        ]);
    }

 /**
     * Lists all bien.
     * @FOSRest\Get("/bien")
     *
     * @return array
     */
    public function getListAction()
    {
        $repository = $this->getDoctrine()->getRepository(Bien::class);
        
        // query for a single Product by its primary key (usually "id")
        $bien = $repository->findall();

        if(!count($bien)){
        $response =array(
        "code"=>false,
        "msg"=>"liste des client",
        "error"=>null,
        "data"=>null,
        
        );
        return new JsonResponse($response);
        }
        
        $data = $this->get('jms_serializer')->serialize($bien, 'json');
        
        $response =array(
        "code"=>true,
        "msg"=>"liste des client",
        "error"=>null,
        "data"=>json_decode($data)
        );
        return new JsonResponse($response,Response::HTTP_OK );
    }
/**
     * Lists all Biens
     * @FOSRest\Get("/biens")
     *
     * @return array
     */
    public function getBienAction( Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Bien::class);
         $repository = $this->getDoctrine()->getRepository(Image::class);
        
         //query for a single Product by its primary key (usually "id");
        $bien = $repository->findBy(['etat'=>0]);
        
        foreach($bien as $key=>$values){
            foreach($values->getImages() as $key1=>$images){ 
                $images->setImage(base64_encode(stream_get_contents($images->getImage())));
            }
        }
        if ($request->isMethod('POST')) {
            if ($_POST['localite'] != '' && $_POST['typebien'] != '' && $_POST['prixlocation'] != ''  ) {
                $listbien = $repository->findBySearch($_POST['localite'], $_POST['typebien'],$_POST['prixlocation']);   
            }
    
        }
       
        if(!count($bien)){
            $response =array(
                "code"=>false,
                "msg"=>"liste des biens",
                "error"=>null,
                "data"=>null,
               
            );
            return new JsonResponse($response);
        }  
                
        $data = $this->get('jms_serializer')->serialize($bien, 'json'); 

            $response =array(
                "code"=>true,
                "msg"=>"liste des client",
                "error"=>null,
                "data"=>json_decode($data)
            );
            return new JsonResponse($response,Response::HTTP_OK  );
        
 
    
    }

/**
     * add bien.
     * @FOSRest\Post("/add")
     *
     * @return array
     */
    public function postaddAction(Request $request)
    {
        $bien = new Bien();
        $bien->setNumeropiece($request->get('num_piece'));
        $bien->setNomclient($request->get('nomclient'));
        $bien->setTelclient($request->get('telclient'));
        $bien->setAdresseclient($request->get('adresseclient'));
        $bien->setEmailclient($request->get('emailclient'));
        $bien->setPassword($request->get('password'));
        $em = $this->getDoctrine()->getManager();
        $em->persist($bien);
        $em->flush();
        return new Response('', Response::HTTP_CREATED);
      
    }
   
}


