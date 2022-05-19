<?php

declare(strict_types=1);

namespace App\Controller;

use Sonata\AdminBundle\Controller\CRUDController;

final class ComprasController extends CRUDController
{

    /**
     * @param $id
     */
    public function recepcionAction($id): Response
    {
        $object = $this->admin->getSubject();

        if (!$object) {
            throw new NotFoundHttpException(sprintf('unable to find the object with id: %s', $id));
        }

        // Be careful, you may need to overload the __clone method of your object
        // to set its id to null !
        /*$clonedObject = clone $object;

        $clonedObject->setName($object->getName().' (Clone)');

        $this->admin->create($clonedObject);

        $this->addFlash('sonata_flash_success', 'Cloned successfully');*/

        return new RedirectResponse($this->admin->generateUrl('list'));
    }
}
