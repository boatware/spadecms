<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 02.09.18
 * Time: 00:43
 */

namespace AppBundle\Controller\Security;

use AppBundle\Form\Security\RegisterForm;
use AppBundle\Entity\User;
use AppBundle\Entity\Role;
use AppBundle\Service\ValidationService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterController extends Controller {
    /**
     * @Route("/register", name="register")
     */
    public function registerAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        // 1) check if the user is already logged in
        if (
            $this->container->get('security.authorization_checker')->isGranted('ROLE_USER') ||
            $this->container->get('security.authorization_checker')->isGranted('ROLE_ADMIN')
        )
        {
            return $this->redirectToRoute("homepage");
        }

        $error = '';

        // 2) build the form
        $user = new User();
        $form = $this->createForm(RegisterForm::class, $user);

        // 3) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            // 4) Make sure the password matches the conventions
            $uppercase = preg_match('@[A-Z]@', $user->getPlainPassword());
            $lowercase = preg_match('@[a-z]@', $user->getPlainPassword());
            $number    = preg_match('@[0-9]@', $user->getPlainPassword());

            if(
                !$uppercase ||
                !$lowercase ||
                !$number ||
                strlen($user->getPlainPassword()) < 8 ||
                $user->getPlainPassword() == $user->getEmail()
            )
            {
                $error = 'Your password seems to be insecure';

                return $this->render(
                    'registration/register.html.twig',
                    array(
                        'form' => $form->createView(),
                        'error' => $error,
                    )
                );
            }

            // 5) Encode the password (you could also do this via Doctrine Listener)
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            // 6) Set the users default role (ROLE_USER)
            $defaultRole = 'ROLE_USER';
            $role = $this->getDoctrine()
                ->getRepository('AppBundle:Role')
                ->findOneBy(array('role' => $defaultRole));
            /** @var Role $role */
            $user->addRole($role);

            // 6.1) Add default times (created, updated)
            $user->setCreatedAt(new \DateTime());
            $user->setUpdatedAt(new \DateTime());

            // 7) save the User!
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user

            return $this->redirectToRoute('homepage');
        }

        return $this->render(
            'security/register.html.twig',
            array(
                'form' => $form->createView(),
                'error' => $error,
            )
        );
    }
}