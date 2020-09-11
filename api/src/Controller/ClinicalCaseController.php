<?php

namespace App\Controller;

use App\Entity\ClinicalCase;
use App\Entity\Notation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClinicalCaseController extends AbstractController
{
    /**
     * @Route("/clinical_cases/search/{slug}", name="clinical_case_search")
     */
    public function searchBySlug($slug)
    {

        $em = $this->getDoctrine()->getManager();
        $repoClinicalCases= $em->getRepository(ClinicalCase::class);

        $resultClinicalCase = $repoClinicalCases->findOneBy(['slug' => $slug]);
        dump($resultClinicalCase);
        $array = json_decode($this->container->get('serializer')->serialize($resultClinicalCase, 'json'));
        dump($array);
        $asArray = $resultClinicalCase->getNotations()->getValues();
        dump($asArray);
        die();
        //dump($array['presentation']);


        if ($resultClinicalCase == null){
            $resultClinicalCase =  "Aucun cas clinique trouvé";
        }


        $serializedEntity = $this->container->get('serializer')->serialize($resultClinicalCase, 'json');
        return new Response($serializedEntity);


        die();

    }
}
