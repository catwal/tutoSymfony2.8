<?php

namespace OC\PlatformBundle\DoctrineListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use OC\PlatformBundle\Entity\Application;

class ApplicationNotification
{
    private $mailer;

    /**
     * ApplicationNotification constructor.
     *
     * @param \Swift_Mailer $mailer
     */
    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        //envoie email que pour entités applications
        if (!$entity instanceof Application) {

            return;
        }

        $message = new \Swift_Message(
            'nouvelle candidature',
            'Vous avez reçu une nouvelle candidature.'
        );

        $message->addTo($entity->getAdvert()->getAuhor())->addFrom('admin@site.com');

        $this->mailer->send($message);
    }

}