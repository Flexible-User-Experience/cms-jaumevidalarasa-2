<?php

namespace App\Manager;

use App\Entity\Contact;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bridge\Twig\Mime\NotificationEmail;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

class MailManager
{
    /**
     * @var MailerInterface
     */
    private $ms;

    /**
     * @var string
     */
    private $adminEmailAddress;

    /**
     * Methods
     */

    /**
     * MailerManager constructor.
     *
     * @param MailerInterface $ms
     * @param string          $adminEmailAddress
     */
    public function __construct(MailerInterface $ms, string $adminEmailAddress)
    {
        $this->ms = $ms;
        $this->adminEmailAddress = $adminEmailAddress;
    }

    /**
     * @param Contact $contact
     *
     * @return bool
     */
    public function sendCmsAdminEmailNotification(Contact $contact)
    {
        try {
            $email = (new TemplatedEmail())
                ->from($this->adminEmailAddress)
                ->to($this->adminEmailAddress)
                ->subject('Missatge de contacte pàgina web')
                ->htmlTemplate('mails/notification.html.twig')
                ->context([
                    'importance' => NotificationEmail::IMPORTANCE_HIGH,
                    'contact' => $contact,
                ])
            ;
            $this->ms->send($email);
            $result = true;
        } catch (TransportExceptionInterface $e) {
            $result = false;
        }

        return $result;
    }
}
