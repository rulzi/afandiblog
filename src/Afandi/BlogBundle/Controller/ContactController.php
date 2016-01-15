<?php

namespace Afandi\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Afandi\BlogBundle\Entity\Contact;
use Afandi\BlogBundle\Form\Type\ContactType;
use Symfony\Component\HttpFoundation\Request;


class ContactController extends Controller
{
    public function contactAction(Request $request)
    {

    	$contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact, array(
            'method' => 'POST',
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $name = $form->getData()->getName();
            $email = $form->getData()->getEmail();
            $message = $form->getData()->getMessage();

            $mail = \Swift_Message::newInstance()
            ->setSubject('Afandi Blog Contact')
            ->setFrom('noreply@gmail.com')
            ->setTo('science.afandi@gmail.com')
            ->setBody(
                $this->renderView(
                    'AfandiBlogBundle:Email:contact.html.twig',
                    array(
                        'name' => $name,
                        'email' => $email,
                        'message' => $message
                        )
                ),
                'text/html'
            )
        ;
        $this->get('mailer')->send($mail);

        $this->addFlash(
            'notice',
            'Your message were sent!'
        );

        }

        return $this->render('AfandiBlogBundle:Contact:contact.html.twig', array(
        	'form' => $form->createView()
        ));
    }

}
