<?php


namespace App\Controller;


use App\Entity\Contact;
use App\Entity\Cours;
use App\Entity\CoursSearch;
use App\Form\ContactType;
use App\Form\CoursSearchType;
use App\Notification\ContactNotification;
use App\Repository\CoursSearchRepository;
use App\services\Mailer;
use Cocur\Slugify\Slugify;
use App\Repository\CoursRepository;
use ContainerJzqKyrK\PaginatorInterface_82dac15;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    * @Route ("/joue-alors/cours", name="app_cours")description
    * @param CoursRepository $repository
    * @return Response
    */
    public function joueAlors(PaginatorInterface $paginator, Request $request): Response
    {
        $search = new CoursSearch();
        $form = $this->createForm(CoursSearchType::class, $search);
        $form->handleRequest($request);

        $courses = $paginator ->paginate(
            $this->repository->findAllVisibleQuery(),
            $request->query->getInt('page', 1),
            4
        );
//            $courses[1]->setFree(false);
//            $this->em->flush();
        return  $this->render('cours/joue-alors.html.twig', [
            'courses' => $courses,
            'form'    => $form->createView()
        ]);
    }

    /**
     * @Route ("/joue-alors/{slug}-{id}", name="cours.show", requirements={"slug": "[a-z0-9\-]*"})
     * @return Response
     */
   public function show(Cours $cours, string $slug, Request $request, ContactNotification $notification) : Response
   {


        if ($cours->getSlug() !== $slug) {
            return $this->redirectToRoute('cours.show', [
                'id' => $cours->getId(),
                'slug' => $cours->getSlug()

            ], 301);
        }
       $contact = new Contact();
       $contact->setCours($cours);
       $form = $this->createForm(ContactType::class, $contact);
       $form->handleRequest($request);

       if ($form->isSubmitted() && $form->isValid()) {
           $notification->notify($contact);
           $this->addFlash('success', 'Votre email a bien été envoyé');
           /*
           return $this->redirectToRoute('cours.show', [
               'id' => $cours->getId(),
                'slug' => $cours->getSlug()

            ]);
           */
       }

        return $this->render('joue-alors/show.html.twig', [
            'cours'=> $cours,
            'menu_cours' => 'courses',
            'form'      => $form->createView()


        ]);
   }


}