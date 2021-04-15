<?php


namespace App\Controller;


use App\Repository\CoursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    /**
     * @Route ("/joue-alors", name="app_joue-alors")
     * @param CoursRepository $repository
     * @return Response
     */
    public function accueil(CoursRepository $repository):Response
    {
        $courses = $repository->findLatest();
        return $this->render('cours/accueil.html.twig', [
            'courses' => $courses
        ]);

    }



}