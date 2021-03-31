<?php


namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NwogangController
{
    /**
     * @Route("/")
     */
    public function homepage()
    {
        return new Response('Première page je vais y arriver !!');
    }

    /**
     * @Route("/joue-alors")
     */
    public function joueAlors()
    {
    return new Response('Page de présentation futur de l\'app joue alors');
    }

    /**
     * @Route("/joue-alors/{slug}")
     */
    public function categories($slug)
    {
        return new Response(sprintf('Page qui liste de toutes les "%s"',
          ucwords(str_replace('-', '', $slug))
        ));
    }

}