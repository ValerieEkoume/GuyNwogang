<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AboutController extends AbstractController
{
    /**
     * @Route("/about", name="app_about", methods={"GET"})
     */
    public function about(){
        return $this->render('GuyNwogang/about.html.twig');
    }
}