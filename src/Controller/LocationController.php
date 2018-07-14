<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class LocationController extends Controller
{
    /**
     * @Route("/", name="index")
     */
    public function index(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('App:User')->findOneBy(['id' => 1]);
        if($request->request->has("submit")){
            $dataPost = array(
                'adresse' => $request->request->get("numero") . " " . $request->request->get("adresse"),
                'codePostal' => $request->request->get("codePostal"),
                'pays' => $request->request->get("pays"),
                'ville' => $request->request->get("ville")
            );
            $this->getDoctrine()->getManager()->getRepository('App:Location')->insertAddress($dataPost, $user);
            return $this->redirect("/recap");
        }
        return $this->render('location/index.html.twig');
    }
}
