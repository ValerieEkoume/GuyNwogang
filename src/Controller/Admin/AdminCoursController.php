<?php


namespace App\Controller\Admin;


use App\Entity\Cours;
use App\Form\CoursType;
use App\Repository\CoursRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminCoursController extends AbstractController
{
    /**
     * @var CoursRepository
     */
    private $repository;
    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(CoursRepository $repository, EntityManagerInterface $em)
    {

        $this->repository=$repository;
        $this->em=$em;
    }

    /**
     * @Route("/admin", name="admin.cours.accueil")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function accueil()
    {
        #$this->denyAccessUnlessGranted('ROLE_ADMIN');
        $courses = $this->repository->findAll();
        return $this->render('admin/cours/accueil.html.twig', compact('courses'));

    }

//    public function adminDashboard()
//    {
//        $this->denyAccessUnlessGranted('ROLE_ADMIN');
//
//        // or add an optional message - seen by developers
//        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'User tried to access a page without having ROLE_ADMIN');
//    }

    /**
     * @Route("/admin/cours/create", name="admin.cours.new")
     */
    public function new(Request $request)
    {
        $cours = new Cours();
        $form = $this->createForm(CoursType::class, $cours);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($cours);
            $this->em->flush();
            $this->addFlash('success', 'Leçon créée avec succès');
            return $this->redirectToRoute('admin.cours.accueil');
        }
        return $this->render('admin/cours/new.html.twig', [
            'cours' => $cours,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/cours/edit/{id}", name="admin.cours.edit", methods="GET|POST")
     * @param Cours $cours
     * @return \Symfony\component\HttpFoundation\Response
     */
    public function edit(Cours $cours, Request $request)
    {
        $form = $this->createForm(CoursType::class, $cours);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $this->addFlash('success', 'Leçon modifiée avec succès');
            return $this->redirectToRoute('admin.cours.accueil');
        }

        return $this->render('admin/cours/edit.html.twig', [
            'cours' => $cours,
            'form' => $form->createView()
        ]);
    }

    /**
     *  @Route("/admin/couts/delete/{id}", name="admin.cours.delete", methods="DELETE")
     * @param Cours $cours
     * @return \Symfony\component\HttpFoundation\Response
     */
    public function delete(Cours $cours, Request $request)
    {
        if ($this->isCsrfTokenValid('delete' . $cours->getId(), $request->get('token'))) {
            $this->em->remove($cours);
            $this->em->flush();
            $this->addFlash('success', 'Leçon supprimée avec succès');

        }
 return $this->redirectToRoute('admin.cours.accueil');


    }

}