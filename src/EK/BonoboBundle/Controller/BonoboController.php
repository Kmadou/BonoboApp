<?php
/**
 * Created by PhpStorm.
 * User: Karim
 * Date: 15/01/2017
 * Time: 23:52
 */

namespace EK\BonoboBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\User;

class BonoboController extends Controller
{
    /**
     * @Route("/index")
     */
    public function indexAction()
    {
        return $this->render('EKBonoboBundle:Index:index.html.twig');
    }

    /**
     * @Route("/liste")
     */
    public function listeAction()
    {
        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:User');
        // find *all* products
        $users = $repository->findAll();



        return $this->render('EKBonoboBundle:Bonobo:lister.html.twig', array('users' => $users));
    }

    /**
     * @Route("/vue/{id}")
     */
    public function profileAction($id)
    {
        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:User');
        // find *all* products
        $user = $repository->find($id);

        if (!$user) {
            throw $this->createNotFoundException(
                'Aucun bonobo trouvé pour l\'id '.$id
            );
        }

        return $this->render('EKBonoboBundle:Bonobo:profile.html.twig', array('user' => $user));
    }

    /**
     * @Route("/add/{$userId}")
     */
    public function addAction($userId)
    {
        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:User');
        // find *all* products
        $user = $repository->find($userId);

        if (!$user) {
            throw $this->createNotFoundException(
                'Aucun bonobo trouvé pour l\'id '.$userId
            );
        }

        $me = $this->container->get('security.token_storage')->getToken()->getUser();

        $me->addAmi($user);

        // Jointure des tables avec DOCTRINE a faire ...
        // pour l'ajout d'un ami

        return $this->render('EKBonoboBundle:Index:index.html.twig');
    }
}
