<?php

namespace App\Controller;

use App\Form\RegistrationType;
use App\Entity\User;
use App\Repository\UserRepository;
use App\services\Mailer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;



class SecurityController extends AbstractController
{
    private $passwordEncoder;
    /**
     * @var Mailer
     */
    private Mailer $mailer;
    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;


    public function __construct(UserPasswordEncoderInterface $passwordEncoder, Mailer $mailer,
                                UserRepository $userRepository)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->mailer=$mailer;
        $this->userRepository = $userRepository;
    }

    /**
     * @Route("/inscription", name="app_register")
     * @param Request $request
     * @return Response
     */
    public function register(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $user->setPassword(
                $this->passwordEncoder->encodePassword($user, $form->get("password")->getData())
            );
            $user->setToken($this->generateToken());
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            $this->mailer->sendEmail($user->getEmail(), $user->getToken());
            $this->addFlash("success", "Inscription réussie ! Vous allez recevoir un mail pour activer votre compte");

        }

        return $this->render('security/register.html.twig', [
            'registrationForm' => $form->createView()

            ]);

        }

    /**
     * @Route ("/confirmer-mon-compte/{token}", name="app_confirm_compte")
     * @param string $token
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
        public function confirmAccount(string $token): RedirectResponse
        {
            $user = $this->userRepository->findOneBy(["token" => $token]);

            if ($user){
                $user->setToken(true);
                $user->setEnabled(true);
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $this->addFlash("success", "Votre compte est activé, connectez-vous !");
                $em->flush();
                return $this->redirectToRoute("app_login");

            } else {
                $this->addFlash("error", "Ce compte n'existe pas !");
                return $this->redirectToRoute("app_register");

            }

        }


    /**
     * @return string
     * @throws  \Exception
     */
    private function generateToken()
    {
        return rtrim(strtr(base64_encode(random_bytes(32)), '+/', '-_')
        );

    }


    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {


        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();


        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout", methods={"GET"})
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout 
        key on your firewall.');
    }
}
