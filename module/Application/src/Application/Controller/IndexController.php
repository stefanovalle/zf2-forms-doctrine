<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Application\Service\BookService;
use Application\Form\Book as BookForm;
use Application\Entity\Book;

class IndexController extends AbstractActionController
{
    
    /**
     * Book creation and edit Form 
     *  
     * @var \Zend\Form\Form
     */
    private $form;
    
    /**
     * Main service for handling books
     * 
     * @var \Application\Service\BookService
     */
    private $bookService;
    
    /**
     * Class constructor
     * 
     * @param \Application\Service\BookService $bookService
     * @param \Zend\Form\Form $form
     */
    public function __construct(BookService $bookService, BookForm $form) 
    {
        $this->bookService = $bookService;
        $this->form = $form;
    }
    
    /**
     * Returns a list of books, as fethched from model
     * 
     * @return \Zend\View\Model\ViewModel
     */
    public function indexAction() {
        
    	return new ViewModel(array('books' => $this->bookService->getFullList()));
        
    }
    
    /**
     * Add new book
     *
     * @return \Zend\View\Model\ViewModel
     */
    public function addAction() {
        
        $book = new Book();
        
        // bind entity values to form
        $this->form->bind($book);
        
        $view = $this->processForm($book);
        
        if (!$view instanceof ViewModel) {
        
            $view = new ViewModel(array('form' => $this->form, 
                                        'title' => 'New book'));
            $view->setTemplate('application/index/book-form');
            
        }
        
        return $view;
        
    }
    
    public function editAction() {
        
        $book = $this->getBookFromQuery();
        
        // bind entity values to form
        $this->form->bind($book);
        
        $view = $this->processForm($book);
        
        if (!$view instanceof ViewModel) {
            
            $view = new ViewModel(array('form' => $this->form, 
                                        'title' => 'Edit book ' . $book->getTitle()));
            $view->setTemplate('application/index/book-form');
            
        }
        
        return $view;
        
    }
    

    public function removeAction() {
        $book = $this->getBookFromQuery();
                
        $this->bookService->removeBook($book);
        
        return $this->redirect()->toRoute('home');
    }
    
    
    /*
     * Private methods
     */
    
    private function processForm(Book $book) {
        
        if ($this->request->isPost()) {
            
            // bind entity values to form
            if ($book instanceof Book) {
                $confirmMessage = 'Book ' . $book->getTitle() . ' updated successfully';
            } else {
                $confirmMessage = 'Book inserted successfully';
            }
            
            // get post data
            $post = $this->request->getPost()->toArray();
            
            // fill form
            $this->form->setData($post);
        
            // check if form is valid
            if(!$this->form->isValid()) {
                
                // prepare view
                $view = new ViewModel(array('form'  => $this->form,
                                            'title' => 'Some errors during book processing'));
                $view->setTemplate('application/index/book-form');
                
                return $view;
        
            }
        
            // use service to save data
            $book = $this->bookService->upsertBook($this->form->getData());
        
            $this->flashMessenger()->setNamespace('book-form')->addMessage($confirmMessage);
            
            // redirect to books list
            return $this->redirect()->toRoute('home');
            
        }
        
    }
    
    private function getBookFromQuery() {
    
        $id = (int)$this->params('id');
    
        if (empty($id) || $id <= 0){
            throw new \Exception("Wrong book ID format");
        }
    
        $book = $this->bookService->getBook($id);
    
        if ($book === null){
            throw new \Exception('Book not found');
        }
    
        return $book;
    
    }
    
}
