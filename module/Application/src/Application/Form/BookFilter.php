<?php

namespace Application\Form;

use Zend\InputFilter\InputFilter;

class BookFilter extends InputFilter {
    	
    public function __construct() {   	
		
		$this->add(array(
            'name'       => 'title',
            'required'   => true,
            'filters' => array(
                array('name' => 'StringTrim'),
                array('name' => 'StripTags'),
            ),
            'validators' => array(
            	array(
	                'name' => 'not_empty',
	            ),                
            ),
        ));
        
        $this->add(array(
            'name'       => 'summary',
            'required'   => true,
            'filters' => array(
                array('name' => 'StringTrim'),
                array('name' => 'StripTags'),
            ),
            'validators' => array(
            	array(
	                'name' => 'not_empty',
	            ),                
            ),
        ));
        
			
    }
}
