<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Event;

class EventController extends Controller
{
    /**
     * @Route("/eventi", name="events")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $events = $em->getRepository('AppBundle:Event')->getNextEvents();

        return $this->render('AppBundle:Event:index.html.twig', array(
            'events' => $events
        ));
    }

    /**
     * @Route("/evento/{id}", name="event_show")
     */
    public function showAction(Event $event)
    {
        return $this->render('AppBundle:Event:show.html.twig', array(
            'event' => $event
        ));
    }

    /**
     * @Route("/eventi-passati", name="past_events")
     */
    public function pastAction()
    {
        $em = $this->getDoctrine()->getManager();

        $events = $em->getRepository('AppBundle:Event')->getPastEvents();

        return $this->render('AppBundle:Event:past.html.twig', array(
            'events' => $events
        ));
    }

}
