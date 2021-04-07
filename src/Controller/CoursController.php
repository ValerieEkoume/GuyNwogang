<?php


namespace App\Controller;


use App\Entity\Cours;
use App\Repository\CoursRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use PhpParser\Builder\Property;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CoursController extends AbstractController
{

    /**
     * @var CoursRepository
     */
    private $repository;

    /**
     * @var ObjectManager
     */
    private $em;

    public function  __construct(CoursRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em=$em;
    }

   /**
    * @Route ("/joue-alors", name="cours.joueAlors")description
    * @return Response
    */
   public function joueAlors(): Response
   {
//      $cours = $this->repository->findAllVisible();
//      $cours[0]->setFree(true);
//      $this->em->flush();
       return  $this->render('cours/joue-alors.html.twig', [
           'menu_cours' => 'cours'
       ]);
   }

}