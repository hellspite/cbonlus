<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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

        $posts = $em->getRepository('AppBundle:Post')->orderedByDate(1);

        $event = $em->getRepository('AppBundle:Event')->getNextEvents(1);

        $links = $em->getRepository('AppBundle:Link')->findAll();

        return $this->render('default/index.html.twig', array(
            'posts' => $posts,
            'event' => $event,
            'links' => $links
        ));
    }

    /**
     * @Route("/dropzone", name="dropzone")
     */
    public function dropAction(Request $request)
    {

        return $this->render('default/drop.html.twig');
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
     * @Route("/servizi", name="servizi")
     */
    public function serviziAction(Request $request){
        return $this->render('default/servizi.html.twig');
    }

    /**
     * @Route("/area-riabilitativa", name="riabilitativa")
     */
    public function riabilitativaAction(Request $request){
        return $this->render('default/riabilitativa.html.twig');
    }

    /**
     * @Route("/area-psicologica", name="psicologica")
     */
    public function psicologicaAction(Request $request){
        return $this->render('default/psicologica.html.twig');
    }

    /**
     * @Route("/area-psicopedagogica", name="psicopedagogica")
     */
    public function psicopedagogicaAction(Request $request){
        return $this->render('default/psicopedagogica.html.twig');
    }

    /**
     * @Route("/area-formativa", name="formativa")
     */
    public function formativaAction(Request $request){
        return $this->render('default/formativa.html.twig');
    }

    /**
     * @Route("/admin-update-sort", name="sort-update")
     */
    public function updateSortAction(Request $request)
    {
        $ids = $request->request->get('ids');

        $em = $this->getDoctrine()->getManager();

        for($i = 0; $i < count($ids); $i++){
            $photo = $em->getRepository('AppBundle:Photo')->find($ids[$i]);
            $photo->setPosition($i);

            $em->persist($photo);
        }

        $em->flush();

        $response = array('code' => 100, 'success' => true);

        return new Response(json_encode($response));
    }
}
