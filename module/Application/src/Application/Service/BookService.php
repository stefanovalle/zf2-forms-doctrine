<?php

namespace Application\Service;

use Application\Entity\Book;

/**
 * Handles interaction with books
 *
 * @author Stefano Valle
 *
 */
class BookService {
    
    private $entityManager;
    
    private $bookRepository;
    
    private $tagRepository;
    
    public function __construct($entityManager) {

        $this->entityManager = $entityManager;

        $this->bookRepository = $this->entityManager->getRepository('Application\Entity\Book');
        
        $this->tagRepository = $this->entityManager->getRepository('Application\Entity\Tag');
        
    }
	
     /**
     * Gets a specific Book
     *
     * @param string $id
     * @return \Application\Entity\Book
     */
    public function getBook($id) {
       
        return $this->bookRepository->find($id);
        
    }
    
    public function getFullList() {
        
        return $this->bookRepository->findAll();
        
    }
           
    /**
     * Inserts or updates a book
     *
     * @param \Application\Entity\Book $book
     * @return \Application\Entity\Book
     */
    public function upsertBook(Book $book) {
        
        $this->entityManager->persist($book);
        $this->entityManager->flush();
        
        return $book;
        
    }
    
    /**
     * Removes a book from db
     * 
     * @param \Application\Entity\Book $book
     */
    public function removeBook(Book $book) {
        
        $this->entityManager->remove($book);
        $this->entityManager->flush();
        
    }
    
    public function getTagListAsArray() {
        
        $tags = $this->tagRepository->findAll();
        
        $result = array();
        foreach ($tags as $tag) {
            $result[$tag->getId()] = $tag->getName();
        }
        
        return $result;
        
    }
    
}