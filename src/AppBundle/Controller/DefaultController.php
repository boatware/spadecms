<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller {
    /**
     * @Route("/", name="homepage")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request) {
        /*
        $text_post = new TextPost();
        $text_post_form = $this->createForm(TextPostType::class, $text_post);
        $text_post_form->handleRequest($request);
        if ($text_post_form->isSubmitted() && $text_post_form->isValid()) {
            $text_post->setCreatedAt(new \DateTime());
            $text_post->setUpdatedAt(new \DateTime());
            $em = $this->getDoctrine()->getManager();
            $em->persist($text_post);
            $em->flush();
        }
        */

        // replace this example code with whatever you need
        $securityContext = $this->container->get('security.authorization_checker');
        if (!$securityContext->isGranted('ROLE_USER')) {
            $this->redirectToRoute("login");
        }

        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
}
