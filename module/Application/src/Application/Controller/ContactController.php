<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;

use MailMan\Message;

class ContactController extends AbstractActionController
{
    protected $translator;

    public function indexAction()
    {
        return new ViewModel();
    }

    public function sendAction()
    {
        $request = $this->getRequest();

        if ($request->isXmlHttpRequest()) {
            $postData = $request->getPost()->toArray();

            $result = $this->validate($postData);

            if (isset($result['success'])) {
                // send message
                $message = new Message();

                $message->addTextPart($postData['message']);
                $message->setSubject($postData['subject']);
                $message->addFrom('site@versover.com', 'Site');
                $message->addReplyTo($postData['email'], $postData['name']);
                $message->addTo('versoverteam@gmail.com', 'Versover');
                /** @var \MailMan\Service\MailService $mailService */

                $mailService = $this->getServiceLocator()->get('MailMan\SMTP');

                $mailService->send($message);
            }

            return new JsonModel($result);
        }

        return $this->redirect()->toRoute('contact');
    }

    protected function validate($data)
    {
        $result = [];

        if (!empty($data['email']) && !empty($data['name']) && !empty($data['message']) && !empty($data['subject'])) {
            if (filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                array_walk($data, function (&$item) {
                    $item = strip_tags($item);
                });

                $result['success'] = $this->getTranslator()->translate('Your mail was sent. We will contact you soon.');
            } else {
                $result['error'] = $this->getTranslator()->translate('Invalid email.');
            }
        } else {
            $result['error'] = $this->getTranslator()->translate('All fields are required.');
        }

        return $result;
    }

    public function getTranslator()
    {
        if (null === $this->translator) {
            $this->translator = $this->getServiceLocator()->get('translator');
        }

        return $this->translator;
    }
}
