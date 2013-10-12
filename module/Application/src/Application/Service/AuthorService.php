<?php

namespace Application\Service;

use Application\Entity\Book;

/**
 * Handles interaction with authors
 *
 * @author Stefano Valle
 *
 */
class AuthorService {
    
    private $entityManager;
    
    private $authorRepository;
    
    public function __construct($entityManager) {

        $this->entityManager = $entityManager;

        $this->authorRepository = $this->entityManager->getRepository('Application\Entity\Author');
        
    }
	
    public function getFullList() {
        
        return $this->authorRepository->findAll();
        
    }
    
    public function getAuthorListAsArray() {
        
        $authors = $this->getFullList();
        
        $result = array();
        foreach ($authors as $author) {
            $result[$author->getId()] = $author->getName();
        }
        
        return $result;
        
    }
    
}