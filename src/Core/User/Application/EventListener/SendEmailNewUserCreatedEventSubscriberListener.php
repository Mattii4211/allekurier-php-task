<?php

declare(strict_types=1);

namespace App\Core\User\Application\EventListener;

use App\Core\User\Domain\Event\UserCreatedEvent;
use App\Common\Mailer\MailerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class SendEmailNewUserCreatedEventSubscriberListener implements EventSubscriberInterface
{
    public function __construct(private readonly MailerInterface $mailer)
    {
    }

    public function send(UserCreatedEvent $event): void
    {
        $this->mailer->send(
            $event->user->getEmail(),
            'Utworzono konto',
            'Zarejestrowano konto w systemie. Aktywacja konta trwa do 24h'
        );
    }

    public static function getSubscribedEvents(): array
    {
        return [
            UserCreatedEvent::class => 'send'
        ];
    }
}
