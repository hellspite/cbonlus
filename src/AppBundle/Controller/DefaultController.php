<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Contact;
use AppBundle\Form\ContactType;
use AppBundle\Entity\Post;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $posts = $em->getRepository('AppBundle:Post')->orderedByDate(3);

        $event = $em->getRepository('AppBundle:Event')->getNextEvents(1);

        $links = $em->getRepository('AppBundle:Link')->findAll();

        return $this->render('default/index.html.twig', array(
            'posts' => $posts,
            'event' => $event,
            'links' => $links
        ));
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

    /**
     * @Route("/area-riabilitativa", name="riabilitativa")
     */
    public function riabilitativaAction(Request $request){
        return $this->render('default/riabilitativa.html.twig');
    }
}
