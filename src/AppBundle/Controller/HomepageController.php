<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class HomepageController extends Controller
{
    /**
     * @Route("/homepage")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Homepage:index.html.twig', array(
            // ...
        ));
    }

}
