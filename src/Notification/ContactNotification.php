<?php


namespace App\Notification;




use App\Entity\Contact;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Twig\Environment;

class ContactNotification {


    /**
     * @var MailerInterface
     */
    private $mailer;

    /**
     * @var Environment
     */
    private $renderer;

    public function __construct(MailerInterface $mailer, Environment $renderer)
    {
        $this->mailer = $mailer;
        $this->renderer = $renderer;
    }

    public function notify(Contact $contact)
    {
        $message = (new TemplatedEmail())
            ->from('noreply@joue-alors.com')
            ->to(new Address('contact@joue-alors.com'))
            ->replyTo($contact->getEmail())
            // path of the Twig template to render
            ->htmlTemplate('emails/contact.html.twig')

        ;

        $this->mailer->send($message);

    }
}
