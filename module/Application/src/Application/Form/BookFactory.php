<?php

namespace Application\Form;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use Application\Form\Book as BookForm,
    Application\Form\BookFilter;

class BookFactory implements FactoryInterface {

    /**
     * Default method to be used in a Factory Class
     * 
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
	public function createService(ServiceLocatorInterface $serviceLocator) {
		
        // Get dependencies from Service Manager
        $objectManager = $serviceLocator->get('doctrine.entitymanager.orm_default');
        $authorService = $serviceLocator->get('Application\Service\AuthorService');
        $bookService = $serviceLocator->get('Application\Service\BookService');
                
	    // Object graph is constructed
	    $tags = $bookService->getTagListAsArray();
	    $authors = $authorService->getAuthorListAsArray();
                
        // Create form object
	    $form = new BookForm($objectManager, $tags, $authors);
	    
        // Set input filter
	    $formFilter = new BookFilter();
	    $form->setInputFilter($formFilter);
	    
	    return $form; 
		
	}

}