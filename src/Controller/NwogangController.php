<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NwogangController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function homepage()
    {
        return new Response('Première page je vais y arriver !!');
    }

//    /**
//     * @Route("/joue-alors")
//     */
//    public function joueAlors()
//    {
//
//    return new Response('Page de présentation futur de l\'app joue alors');
//    }

    /**
     * @Route("/joue-alors/{slug}")
     */
    public function categorie($slug)
    {
        $niveaux = [
            'KopS',
            'KopSS',
            'KopSSS',

            ];

        return $this->render( 'joue-alors/categorie.html.twig', [
            'joueAlors' => ucwords(str_replace('-', '', $slug)),
            'niveaux' => $niveaux,
        ]);
    }

}