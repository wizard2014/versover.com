<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;

use MailMan\Message;
use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\Mail\Transport\SmtpOptions;

class ContactController extends AbstractActionController
{
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
        $result = array();

        if (!empty($data['email']) && !empty($data['name']) && !empty($data['message']) && !empty($data['subject'])) {
            if (filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                array_walk($data, function(&$item) {
                    $item = strip_tags($item);
                });

                $result['success'] = 'Ваше письмо отправлено. Мы свяжемся с вами в ближайшее время.';
            } else {
                $result['error'] = 'Некорректный email адрес.';
            }
        } else {
            $result['error'] = 'Все поля обязательны для заполнения.';
        }

        return $result;
    }
}
