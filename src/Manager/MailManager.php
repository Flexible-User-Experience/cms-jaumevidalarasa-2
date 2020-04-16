<?php

namespace App\Manager;

use App\Entity\Contact;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

class MailManager
{
    /**
     * @var Swift_Mailer
     */
    private $ms;

    /**
     * Methods
     */

    public function __construct()
    {
        $this->ms = new Swift_Mailer(new Swift_SmtpTransport());
    }

    /**
     * @param Contact $contact
     *
     * @return bool
     */
    public function sendCmsAdminEmailNotification(Contact $contact)
    {
        $message = (new Swift_Message('Missatge de contacte pàgina web'))
            ->setFrom('send@example.com')
            ->setTo('recipient@example.com')
            ->setBody(
                $this->renderView(
                // templates/emails/registration.html.twig
                    'emails/registration.html.twig',
                    [
                        'name' => $contact->getName(),
                        'email' => $contact->getEmail(),
                        'message' => $contact->getMessage(),
                    ]
                ),
                'text/html'
            )
        ;
        $sendedEmailsAmount = $this->ms->send($message);

        return $sendedEmailsAmount > 0;
    }
}
