<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Home;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Home controller.
 *
 * @Route("home")
 */
class HomeController extends Controller
{
    /**
     * Lists all home entities.
     *
     * @Route("/", name="home_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $homes = $em->getRepository('AppBundle:Home')->findAll();

        return $this->render('home/index.html.twig', array(
            'homes' => $homes,
        ));
    }

    /**
     * Finds and displays a home entity.
     *
     * @Route("/{id}", name="home_show")
     * @Method("GET")
     */
    public function showAction(Home $home)
    {

        return $this->render('home/show.html.twig', array(
            'home' => $home,
        ));
    }
}
