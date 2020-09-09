<?php
/**
 * Created by Gregoire Humeau
 * gregoire.humeau@gmail.com
 * 2020-05-28
 */

namespace App\Controller;

use App\Form\ContactType;
use App\Model\Contact;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\Mailer;
use Symfony\Contracts\Translation\TranslatorInterface;

class ContactController extends AbstractController
{
    /**
     * @var TranslatorInterface
     */
    private $translator;

    /**
     * @var Mailer
     */
    private $mailer;

    /**
     * @param TranslatorInterface $translator
     * @param MailerInterface $mailer
     */
    public function __construct(TranslatorInterface $translator, MailerInterface $mailer)
    {
        $this->translator = $translator;
        $this->mailer = $mailer;
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request)
    {
        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();

            $mailContent = $this->renderView('contact/mail.html.twig', compact('contact'));

            $email = (new Email())
                ->from($contact->getFrom())
                ->replyTo($contact->getFrom())
                ->to('contact@lafougere.org')
                ->subject($this->translator->trans('contact.email.subject'))
                ->text($mailContent)
                ->html($mailContent);

            $this->mailer->send($email);

            $this->addFlash('success', 'contact.form.success');

            return $this->redirectToRoute('contact');
        }


        return $this->render('contact/index.html.twig', [
            'slug' => 'contact',
            'form' => $form->createView(),
            'controller_name' => 'ContactController',
        ]);
    }
}
