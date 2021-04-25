<?php


namespace App\Controller;


use App\Entity\Cours;
use Cocur\Slugify\Slugify;
use App\Repository\CoursRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
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

//   /**
//    * @Route ("/joue-alors", name="cours.joueAlors")description
//    * @return Response
//    */
//   public function joueAlors(): Response
//   {
//      $cours = $this->repository->findAllVisible();
////      $cours[1]->setFree(true);
//      $this->em->flush();
//       return  $this->render('cours/joue-alors.html.twig', [
//           'courses' => 'courses'
//       ]);
//   }

    /**
     * @Route ("/joue-alors/{slug}-{id}", name="cours.show", requirements={"slug": "[a-z0-9\-]*"})
     * @return Response
     */
   public function show(Cours $cours, string $slug) : Response
   {
        if ($cours->getSlug() !== $slug) {
            return $this->redirectToRoute('cours.show', [
                'id' => $cours->getId(),
                'slug' => $cours->getSlug()
            ], 301);
        }


        return $this->render('joue-alors/show.html.twig', [
            'cours'=> $cours,
            'menu_cours' => 'courses'

        ]);
   }


}