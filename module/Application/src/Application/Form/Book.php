<?php

namespace Application\Form;

use Zend\Form\Form,
    Zend\Form\Element,
    Zend\Validator;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class Book extends Form {
    	
    public function __construct(ObjectManager $objectManager, array $tagList, array $authorList) {
        
        parent::__construct();
        
        // set for hydrator
        $this->setHydrator(new DoctrineHydrator($objectManager, '\Application\Entity\Book'));
        
        // set form appearance
        $this->setAttribute('class', 'form-horizontal');
        
        $title = new Element\Text('title');
        $title->setAttributes(array('id'    => 'title',
                                    'class' => 'input-xxlarge',
                             ))
              ->setLabel('Book title')
              ->setLabelAttributes(array('class' => 'control-label'));
        $this->add($title);
        
        
        $summary = new Element\Textarea('summary');
        $summary->setAttributes(array('id'    => 'summary',
                                      'rows'  => '8', 
                                      'class' => 'input-xxlarge',
                                ))
                ->setLabel('Abstract')
                ->setLabelAttributes(array('class' => 'control-label'));
        $this->add($summary);
        
        
        $author = new Element\Select('author');
        $author->setAttributes(array('id' => 'author'))
               ->setLabel('Author')
               ->setLabelAttributes(array('class' => 'control-label'))
               ->setEmptyOption('Please choose...')
               ->setValueOptions($authorList);
        $this->add($author);
        
        
        $publicationDate = new Element\Date('publicationdate');
        $publicationDate->setAttributes(array('id' => 'publicationdate',
                                       'class' => 'input-medium',
                                ))
                        ->setLabel('Publication Date')
                        ->setLabelAttributes(array('class' => 'control-label'));
        $this->add($publicationDate);
        
        
        $isonsale = new Element\Checkbox('isonsale');
        $isonsale->setAttributes(array('id'    => 'isonsale',
                                       'class' => 'input-small',
                                       ))
                        ->setLabel('Is it on sale?')
                        ->setLabelAttributes(array('class' => 'control-label'));
        $this->add($isonsale);
        
                
        $tags = new \DoctrineModule\Form\Element\ObjectMultiCheckbox('tags');
        $tags->setLabel('Tags')
             ->setValueOptions($tagList)
             ->setOptions(array('object_manager' => $objectManager,
                                'target_class'   => 'Application\Entity\Tag'));
        $this->add($tags);
        
        
        $submit = new Element\Button('submit');
        $submit->setAttributes(array('type'  => 'submit', 
                                     'class' => 'btn'
                              ))
               ->setLabel('Save');
        $this->add($submit);

   	}	  
}