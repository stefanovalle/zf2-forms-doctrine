<?php

namespace Application\Controller;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use Application\Controller\IndexController;

class IndexControllerFactory implements FactoryInterface {

    /**
     * Default method to be used in a Factory Class
     * 
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
	public function createService(ServiceLocatorInterface $serviceLocator) {
		
	    // dependency is fetched from Service Manager
	    $bookService = $serviceLocator->getServiceLocator()->get('Application\Service\BookService');
	    $form = $serviceLocator->getServiceLocator()->get('Application\Form\Book');
                
	    // Controller is constructed, dependencies are injected (IoC in action)
	    return new IndexController($bookService, $form); 
		
	}

}