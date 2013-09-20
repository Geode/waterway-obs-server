<?php
namespace Reporting\Form;

use Zend\Form\Form;
use Zend\Form\Element;
use Zend\Form\Element\File;

class ReportingForm extends Form
{
    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('reporting');

        $this->add(array(
            'name' => 'id',
            'type' => 'Hidden',
        ));
        $this->add(array(
            'name' => 'x',
            'type' => 'Number',
            'options' => array(
                'label' => 'x GPS coordinate',
            ),
        ));
        $this->add(array(
            'name' => 'y',
            'type' => 'Number',
            'options' => array(
                'label' => 'y GPS coordinate',
            ),
        ));
        $this->add(array(
            'name' => 'feature',
            'type' => 'Text',
            'options' => array(
                'label' => 'Category (feature)',
            ),
        ));
        $this->add(array(
			'name' => 'type',
			'type' => 'Text',
			'options' => array(
				'label' => 'Obstruction type (type)',
			),
		));
		$this->add(array(
			'name' => 'name',
			'type' => 'Text',
			'options' => array(
				'label' => '(name)',
			),
		));
		$this->add(array(
			'name' => 'location_info',
			'type' => 'Text',
			'options' => array(
				'label' => 'Location (location_info)',
			),
		));
        $this->add(array(
        		'name' => 'fishpass',
        		'type' => 'CheckBox',
        		'options' => array(
        				'label' => 'Boolean (fishpass)',
        		),
        ));
        $this->add(array(
        		'name' => 'fishpasstype',
        		'type' => 'Text',
        		'options' => array(
        				'label' => '(fishpasstype)',
        		),
        ));
        $this->add(array(
        		'name' => 'fishpass_info',
        		'type' => 'Text',
        		'options' => array(
        				'label' => '(fishpass_info)',
        		),
        ));        
        $this->add(array(
        		'name' => 'porosity_sal',
        		'type' => 'Text',
        		'options' => array(
        				'label' => ' (porosity_sal)',
        		),
        ));
		$this->add(array(
				'name' => 'porosity_trout',
				'type' => 'Text',
				'options' => array(
						'label' => ' (porosity_trout)',
				),
		));
		$this->add(array(
				'name' => 'porosity_gray',
				'type' => 'Text',
				'options' => array(
						'label' => ' (porosity_gray)',
				),
		));
		$this->add(array(
				'name' => 'porosity_rlamp',
				'type' => 'Text',
				'options' => array(
						'label' => ' (porosity_rlamp)',
				),
		));
		$this->add(array(
				'name' => 'porosity_slamp',
				'type' => 'Text',
				'options' => array(
						'label' => ' (porosity_slamp)',
				),
		));
		$this->add(array(
				'name' => 'porosity_eel',
				'type' => 'Text',
				'options' => array(
						'label' => ' (porosity_eel)',
				),
		));
		$this->add(array(
				'name' => 'porosity_cyp',
				'type' => 'Text',
				'options' => array(
						'label' => ' (porosity_cyp)',
				),
		));   
        $this->add(array(
        		'name' => 'porosity_judgement',
        		'type' => 'Text',
        		'options' => array(
        				'label' => ' (porosity_judgement)',
        		),
        ));
        $this->add(array(
        		'name' => 'local_head_drop',
        		'type' => 'Text',
        		'options' => array(
        				'label' => ' (local_head_drop)',
        		),
        ));
        $this->add(array(
        		'name' => 'porosity_info',
        		'type' => 'Text',
        		'options' => array(
        				'label' => ' (porosity_info)',
        		),
        ));        
        $this->add(array(
        		'name' => 'file_name',
        		'type' => 'Text',
        		'options' => array(
        				'label' => 'file name (read only)',
        		),
        ));        
        $this->add(array(
        		'name' => 'submit',
        		'type' => 'Submit',
        		'attributes' => array(
        				'value' => 'Go',
        				'id' => 'submitbutton',
        		),
        ));
        $this->add(array(
        		'name' => 'submit-json',
        		'type' => 'Submit',
        		'attributes' => array(
        				'value' => 'Go-json',
        				'id' => 'submitbutton-json',
        		),
        ));
        $this->add(array(
				'name' => 'image-file',
				'type' => 'File',
				'attributes' => array(
						'label' => 'Image file',
						'id' => 'image-file',
				),
		));
    }
}