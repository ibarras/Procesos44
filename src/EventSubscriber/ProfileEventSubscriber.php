<?php

namespace App\EventSubscriber;

use App\Entity\FosUser;
use App\Repository\IcFosPerfilRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\Security\Core\Security;
use Twig\Environment;


class ProfileEventSubscriber implements EventSubscriberInterface
{
    private $profile;
    public $twig;
    private $security;

    public function __construct(Environment $twig, IcFosPerfilRepository $icFosPerfilRepository , Security  $security)
    {
        $this->profile = $icFosPerfilRepository;
        $this->twig = $twig;
        $this->security = $security;

    }
    public function  onKernelController(ControllerEvent $event)
    {
        $user = $this->security->getUser();

        if($user instanceof FosUser ){
            $this->twig->addGlobal('profile', $this->profile->findOneBy(['idFos' => $user->getId() ]));

        }
    }

    public static function getSubscribedEvents()
    {
        return [
            'kernel.controller' => 'onKernelController',
        ];
    }
}
