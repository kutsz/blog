<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Home;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * Home controller.
 *
 * @Route("home")
 */
class HomeController extends Controller {

    /**
     * Lists all home entities.
     *
     * @Route("/", name="home_index")
     * @Method("GET")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        /*
         * When you query for a particular type of object, you always use what's known as its "repository". You can
          think of a repository as a PHP class whose only job is to help you fetch entities of a certain class.
         * 
         * AppBundle:   ~   AppBundle\Entity\Home
         * 
         * 
         */
        $homes = $em->getRepository('AppBundle:Home')->findAll();




        if (!$homes) {
            throw $this->createNotFoundException('No product found for id ');
        }
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
    public function showAction(Home $home) {

        return $this->render('home/show.html.twig', array(
                    'home' => $home,
        ));
    }

    /**
     * add new data.
     *
     * @Route("/{title}/{text}", 
     * name="home_add"
     * )
     * @Method("GET")
     */
    public function addAction($title, $text) {
        $data = new Home();

        $data->setTitle($title);
        $data->setText($text);

        $em = $this->getDoctrine()->getManager();

        // tells Doctrine you want to (eventually) save the Product (no queries yet)
        $em->persist($data); //сообщает Doctrine команду на 'управление' объектом

        /*
         * When the flush() method is called, Doctrine looks through all of the objects that it's
          managing to see if they need to be persisted to the database. In this example, the $product
          object's data doesn't exist in the database, so the entity manager executes an INSERT query,
          creating a new row in the product table.
         */
        // actually executes the queries (i.e. the INSERT query)
        $em->flush();

        return new Response('Saved new data with id ' . $data->getId());
    }

    /**
     * update data.
     *
     * @Route("/update/update/{homeId}", 
     * name="home_update"
     * )
     * @Method("GET")
     */
    public function updateAction($homeId) {


        $em = $this->getDoctrine()->getManager();
        $homes = $em->getRepository('AppBundle:Home')->find($homeId);

        if (!$homes) {
            throw $this->createNotFoundException('No product found for id ' . $homeId);
        }

        $homes->setTitle('New title for '.$homeId);

        $em->flush();

        return $this->redirectToRoute('homepage');

        /*
          Updating an object involves just three steps:

          1. fetching the object from Doctrine;
          2. modifying the object;
          3. calling flush() on the entity manager

          Notice that calling $em->persist($homes) isn't necessary. Recall(вспомните) that this method simply tells
          Doctrine to manage(управлять) or "watch"(наблюдать) the $homes object. In this case, since you fetched(получен) the $homes object
          from Doctrine, it's already managed(управляемый).
         */
    }

    /**
     * update data.
     *
     * @Route("/remove/remove/{homeId}", 
     * name="home_remove"
     * )
     * @Method("GET")
     */
    public function removeAction($homeId) {


        $em = $this->getDoctrine()->getManager();
        $homes = $em->getRepository('AppBundle:Home')->find($homeId);

        if (!$homes) {
            throw $this->createNotFoundException('No product found for id ' . $homeId);
        }

        $em->remove($homes);
        
        $em->flush();



        /*
          As you might expect, the remove() method notifies Doctrine that you'd like to remove the given object
          from the database. The actual DELETE query, however, isn't actually executed until the flush() method
          is called.
         */
        
        return new Response('Removed data with id ...');
    }
    
    
    /**
     * List of titles.
     *
     * @Route("/title/1/2/title", name="home_title")
     * @Method("GET")
     */
    public function getTitlecAtion() {
        $em = $this->getDoctrine()->getManager();
        
        $homes = $em->getRepository('AppBundle:Home')->findAllTitle();// see HomeRepository.php

        if (!$homes) {
            throw $this->createNotFoundException('No title found');
        }
        return $this->render('home/title.html.twig', array(
                    'homes' => $homes
        ));
    }
    
    

}
