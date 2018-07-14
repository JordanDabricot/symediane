<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RecapController extends Controller
{
    /**
     * @Route("/recap", name="recap")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $shippings = $em->getRepository('App:Location')->getAddress();

        return $this->render('recap/index.html.twig', [
            'shippings' => $shippings,
        ]);
    }
}
