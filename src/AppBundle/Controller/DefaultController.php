<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Contact;
use AppBundle\Form\ContactType;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/presentazione", name="mission")
     */
    public function missionAction(Request $request){
        return $this->render('default/mission.html.twig');
    }

    /**
     * @Route("/contatti", name="contact")
     */
    public function contactAction(Request $request){

        $address = $this->getParameter('delivery_address');

        $contact = new Contact();
        $form = $this->createForm(ContactType::Class, $contact);

        $formView = $form->createView();


        $form->handleRequest($request);

        /**
         * TODO: sistemare validazione e catalogo locale
         */
        if($form->isSubmitted() && $form->isValid()){
            $mailer = $this->get('mailer');
            $message = $mailer->createMessage()
                ->setSubject('Contatto Cavallino Bianco Onlus')
                ->setFrom($contact->getEmail())
                ->setTo($address)
                ->setBody(
                    $this->renderView(
                        'default/email.html.twig', 
                        array(
                            'name' => $contact->getName(),
                            'phone' => $contact->getPhone(),
                            'message' => $contact->getMessage()
                        )
                    ),               
                    'text/html'
                );

            $mailer->send($message);

            return $this->redirect($this->generateUrl('mail_sent'));

        }
        

        return $this->render('default/contact.html.twig', array(
            'form' => $formView
        ));
    }

    /**
     * @Route("/messaggio-inviato", name="mail_sent")
     */
    public function sentAction()
    {
    
        return $this->render('default/sent.html.twig');
    }

    /**
     * @Route("/donazioni", name="donate")
     */
    public function donateAction(){

        return $this->render('default/donate.html.twig');
    }

}
