<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 02.09.18
 * Time: 00:45
 */

namespace AppBundle\Controller;


use AppBundle\Exception\NoObjectException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class Helper extends Controller {

    /**
     * @param $entity
     * @throws NoObjectException
     */
    public function simpleSaveEntity($entity) {
        if (!is_object($entity)) {
            throw new NoObjectException('The given variable is not an object.');
        }
        $em = $this->getDoctrine()->getManager();
        $em->persist($entity);
        $em->flush();
    }
}