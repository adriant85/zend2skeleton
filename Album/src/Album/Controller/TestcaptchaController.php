<?php

namespace Album\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Album\Form\TestCaptchaForm;

class TestcaptchaController extends AbstractActionController
{

    public function generateAction()
    {
        $response = $this->getResponse();
        $response->getHeaders()->addHeaderLine('Content-Type', "image/png");
        
        $id = $this->params('id', false);
        var_dump($id);die();
        if ($id) {
            $image = './data/captcha/' . $id;
            
            if (file_exists($image) !== false) {
                $fp        = fopen($image,"r");
                $imageread = fpassthru($fp);
                
                $response->setStatusCode(200);
                $response->setContent($imageread); 
         
                if (file_exists($image) == true) {
                    unlink($image);
                }
            }
            
        }
        
        return $response;
    }
    public function formAction()
    {
        //var_dump($this->getRequest()->getBaseUrl());
        $uri = $this->getRequest()->getUri();
        $scheme = $uri->getScheme();
        $host = $uri->getHost();
        $base = sprintf('%s://%s', $scheme, $host);
        $form = new TestCaptchaForm($base.'/images/captcha/');
        
        $request = $this->getRequest();
        
        if ($request->isPost()) {
            //set data post
            $form->setData($request->getPost());

            if ($form->isValid()) {
                echo "captcha is valid ";
            }
            
        }
        return array('form' => $form);
    }
}
