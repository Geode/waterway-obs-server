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
        		'type' => 'Zend\Form\Element\Select',
        		'name' => 'feature',
        		'options' => array(
        				'label' => 'Category',
        				'value_options' => array(
        						'UNKNOWN' => 'Unknown',
        						'WATERFALL' => 'Waterfall',
        						'WEIR' => 'Weir',
        						'WILL' => 'Mil',
        						'LOCK' => 'Lock',
        						'DAM' => 'Dam',
        						'BARRAGE' => 'Barrage',
        				),
        		)
        ));
        

        $this->add(array(
        		'type' => 'Zend\Form\Element\Select',
        		'name' => 'type',
        		'options' => array(
        				'label' => 'Obstruction type (type)',
        				'value_options' => array(
        						'UNKNOWN' => 'Unknown',
        						'ARTIFICIAL' => 'Artificial',
        						'NATURAL' => 'Natural',
        				),
        		)
        ));
		$this->add(array(
			'name' => 'name',
			'type' => 'Text',
			'options' => array(
				'label' => 'Site name',
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
        				'label' => 'Fishpass present ?',
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
        		'type' => 'Zend\Form\Element\Select',
        		'name' => 'porosity_sal',
        		'options' => array(
        				'label' => 'Passability Salmon',
        				'value_options' => array(
        						'UNKNOWN' => 'Unknown',
        						'COMPLETE_BARRIER' => 'Impassable',
        						'PARTIAL_BARRIER_LOW_IMPACT' => 'Partial barrier (low impact)',
        						'PARTIAL_BARRIER_HIGH_IMPACT' => 'Partial barrier (high impact)',
        						'NO_BARRIER' => 'No Barrier',
        				),
        		)
        ));

        $this->add(array(
        		'type' => 'Zend\Form\Element\Select',
        		'name' => 'porosity_trout',
        		'options' => array(
        				'label' => 'Passability Trout',
        				'value_options' => array(
        						'UNKNOWN' => 'Unknown',
        						'COMPLETE_BARRIER' => 'Impassable',
        						'PARTIAL_BARRIER_LOW_IMPACT' => 'Partial barrier (low impact)',
        						'PARTIAL_BARRIER_HIGH_IMPACT' => 'Partial barrier (high impact)',
        						'NO_BARRIER' => 'No Barrier',
        				),
        		)
        ));

        $this->add(array(
        		'type' => 'Zend\Form\Element\Select',
        		'name' => 'porosity_gray',
        		'options' => array(
        				'label' => 'Passability Gray',
        				'value_options' => array(
        						'UNKNOWN' => 'Unknown',
        						'COMPLETE_BARRIER' => 'Impassable',
        						'PARTIAL_BARRIER_LOW_IMPACT' => 'Partial barrier (low impact)',
        						'PARTIAL_BARRIER_HIGH_IMPACT' => 'Partial barrier (high impact)',
        						'NO_BARRIER' => 'No Barrier',
        				),
        		)
        ));

        $this->add(array(
        		'type' => 'Zend\Form\Element\Select',
        		'name' => 'porosity_rlamp',
        		'options' => array(
        				'label' => 'Passability River Lamprey',
        				'value_options' => array(
        						'UNKNOWN' => 'Unknown',
        						'COMPLETE_BARRIER' => 'Impassable',
        						'PARTIAL_BARRIER_LOW_IMPACT' => 'Partial barrier (low impact)',
        						'PARTIAL_BARRIER_HIGH_IMPACT' => 'Partial barrier (high impact)',
        						'NO_BARRIER' => 'No Barrier',
        				),
        		)
        ));

        $this->add(array(
        		'type' => 'Zend\Form\Element\Select',
        		'name' => 'porosity_slamp',
        		'options' => array(
        				'label' => 'Passability Sea Lamprey',
        				'value_options' => array(
        						'UNKNOWN' => 'Unknown',
        						'COMPLETE_BARRIER' => 'Impassable',
        						'PARTIAL_BARRIER_LOW_IMPACT' => 'Partial barrier (low impact)',
        						'PARTIAL_BARRIER_HIGH_IMPACT' => 'Partial barrier (high impact)',
        						'NO_BARRIER' => 'No Barrier',
        				),
        		)
        ));

        $this->add(array(
        		'type' => 'Zend\Form\Element\Select',
        		'name' => 'porosity_eel',
        		'options' => array(
        				'label' => 'Passability Juvenile eel',
        				'value_options' => array(
        						'UNKNOWN' => 'Unknown',
        						'COMPLETE_BARRIER' => 'Impassable',
        						'PARTIAL_BARRIER_LOW_IMPACT' => 'Partial barrier (low impact)',
        						'PARTIAL_BARRIER_HIGH_IMPACT' => 'Partial barrier (high impact)',
        						'NO_BARRIER' => 'No Barrier',
        				),
        		)
        ));

        $this->add(array(
        		'type' => 'Zend\Form\Element\Select',
        		'name' => 'porosity_cyp',
        		'options' => array(
        				'label' => 'Passability Cyprinids and juvenile salmonids',
        				'value_options' => array(
        						'UNKNOWN' => 'Unknown',
        						'COMPLETE_BARRIER' => 'Impassable',
        						'PARTIAL_BARRIER_LOW_IMPACT' => 'Partial barrier (low impact)',
        						'PARTIAL_BARRIER_HIGH_IMPACT' => 'Partial barrier (high impact)',
        						'NO_BARRIER' => 'No Barrier',
        				),
        		)
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