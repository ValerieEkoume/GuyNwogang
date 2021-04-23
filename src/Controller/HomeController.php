<?php


namespace App\Controller;


use App\Repository\CoursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    /**
     * @Route("/", name="app_home", methods={"GET"})
     * @param CoursRepository $repository
     * @return Response
     */
    public function home(CoursRepository $repository):Response
    {

        return $this->render('GuyNwogang/home.html.twig');
    }



}