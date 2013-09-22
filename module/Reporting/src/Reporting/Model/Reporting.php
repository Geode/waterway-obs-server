<?php
namespace Reporting\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Reporting implements InputFilterAwareInterface
{
	public $id;

	public $feature; //varchar(255),
	public $type; //varchar(255),
	public $name; //varchar(255),
	public $location_info; // text,
	
	public $fishpass; // boolean,
	public $fishpasstype; // varchar(255),
	public $fishpass_info; // text,
	
	public $porosity_sal; // varchar(255),
	public $porosity_trout; // varchar(255),
	public $porosity_gray; // varchar(255),
	public $porosity_rlamp; // varchar(255),
	public $porosity_slamp; // varchar(255),
	public $porosity_eel; // varchar(255),
	public $porosity_cyp; // varchar(255),
	
	public $porosity_judgement; // varchar(255),
	public $local_head_drop; // float8,
	public $porosity_info; // text,
	
	public $file_name;
	
	//public $location; // geometry,
	public $x;
	public $y;
		
	protected $inputFilter;
	protected $editFilter;
	
	public function exchangeArray($data)
	{
		$this->id     = (!empty($data['id'])) ? $data['id'] : null;
		$this->x = (!empty($data['x'])) ? $data['x'] : null;
		$this->y  = (!empty($data['y'])) ? $data['y'] : null;
		//throw new \Exception("Who wants that!!!!!");
		$this->feature  = (!empty($data['feature'])) ? $data['feature'] : null;
		$this->type  = (!empty($data['type'])) ? $data['type'] : null;
		$this->name  = (!empty($data['name'])) ? $data['name'] : null;
		$this->location_info  = (!empty($data['location_info'])) ? $data['location_info'] : null;
		$this->fishpass  = (!empty($data['fishpass'])) ? $data['fishpass'] : null;
		$this->fishpassid  = (!empty($data['fishpassid'])) ? $data['fishpassid'] : null;
		$this->fishpasstype  = (!empty($data['fishpasstype'])) ? $data['fishpasstype'] : null;
		$this->fishpass_info  = (!empty($data['fishpass_info'])) ? $data['fishpass_info'] : null;
		$this->porosity_sal  = (!empty($data['porosity_sal'])) ? $data['porosity_sal'] : null;
		$this->porosity_trout  = (!empty($data['porosity_trout'])) ? $data['porosity_trout'] : null;
		$this->porosity_gray  = (!empty($data['porosity_gray'])) ? $data['porosity_gray'] : null;
		$this->porosity_rlamp  = (!empty($data['porosity_rlamp'])) ? $data['porosity_rlamp'] : null;
		$this->porosity_slamp  = (!empty($data['porosity_slamp'])) ? $data['porosity_slamp'] : null;
		$this->porosity_eel  = (!empty($data['porosity_eel'])) ? $data['porosity_eel'] : null;
		$this->porosity_cyp  = (!empty($data['porosity_cyp'])) ? $data['porosity_cyp'] : null;

		$this->porosity_judgement  = (!empty($data['porosity_judgement'])) ? $data['porosity_judgement'] : null;
		$this->local_head_drop  = (!empty($data['local_head_drop'])) ? $data['local_head_drop'] : null;
		$this->porosity_info  = (!empty($data['porosity_info'])) ? $data['porosity_info'] : null;
		$this->file_name  = (!empty($data['file_name'])) ? $data['file_name'] : null;
		
	}
	
	public function setFileName($fileNamr)
	{
		$this->file_name = $fileNamr;
	}

	public function getArrayCopy()
	{
		return get_object_vars($this);
	}
	
	// Add content to these methods:
	public function setInputFilter(InputFilterInterface $inputFilter)
	{
		throw new \Exception("Not used");
	}
	
	public function getInputFilter()
	{
		if (!$this->inputFilter) {
			$this->inputFilter = $this->getFilter(false);
		}
		return $this->inputFilter;
	}
	
	public function getEditFilter()
	{
		if (!$this->editFilter) {
			$this->editFilter = $this->getFilter(true);
		}
		//dont know why but isValid method from form will ask inputFilters, workaround here (to delete when fixed) :
		$this->inputFilter = $this->editFilter;
		return $this->editFilter;
	}
	
	
	private function getFilter($edit)
	{
		$inputFilter = new InputFilter();

		$inputFilter->add(array(
				'name'     => 'id',
				'required' => true,
				'filters'  => array(
						array('name' => 'Int'),
				),
		));

		//only when adding data :
		if ($edit == false)
		{
			$inputFilter->add(array(
					'name'     => 'x',
					'required' => false,
					'filters'  => array(
							array('name' => 'StripTags'),
							array('name' => 'StringTrim'),
					),
					'validators' => array(
							array(
									'name'    => 'Between',
									'options' => array(
											'min'      => -360,
											'max'      => 360,
									),
							),
					),
			));
	
			$inputFilter->add(array(
					'name'     => 'y',
					'required' => false,
					'filters'  => array(
							array('name' => 'StripTags'),
							array('name' => 'StringTrim'),
					),
					'validators' => array(
							array(
									'name'    => 'Between',
									'options' => array(
											'min'      => -360,
											'max'      => 360,
									),
							),
					),
			));
		}
		
		$inputFilter->add(array(
				'name'     => 'feature',
				'required' => false,
				'filters'  => array(
						array('name' => 'StripTags'),
						array('name' => 'StringTrim'),
				),
				'validators' => array(
						array(
								'name'    => 'StringLength',
								'options' => array(
										'encoding' => 'UTF-8',
										'min'      => 0,
										'max'      => 255,
								),
						),
				),
		));

		$inputFilter->add(array(
				'name'     => 'name',
				'required' => false,
				'filters'  => array(
						array('name' => 'StripTags'),
						array('name' => 'StringTrim'),
				),
				'validators' => array(
						array(
								'name'    => 'StringLength',
								'options' => array(
										'encoding' => 'UTF-8',
										'min'      => 0,
										'max'      => 255,
								),
						),
				),
		));
		

		$inputFilter->add(array(
				'name'     => 'location_info',
				'required' => false,
				'filters'  => array(
						array('name' => 'StripTags'),
						array('name' => 'StringTrim'),
				),
				'validators' => array(
						array(
								'name'    => 'StringLength',
								'options' => array(
										'encoding' => 'UTF-8',
										'min'      => 0,
										'max'      => 2048,
								),
						),
				),
		));

		$inputFilter->add(array(
				'name'     => 'fishpass',
				'required' => false,
				'filters'  => array(
						array('name' => 'StripTags'),
						array('name' => 'StringTrim'),
				),
				'validators' => array(
						array(
								'name'    => 'StringLength',
								'options' => array(
										'encoding' => 'UTF-8',
										'min'      => 0,
										'max'      => 1,
								),
						),
				),
		));
		

		$inputFilter->add(array(
				'name'     => 'fishpasstype',
				'required' => false,
				'filters'  => array(
						array('name' => 'StripTags'),
						array('name' => 'StringTrim'),
				),
				'validators' => array(
						array(
								'name'    => 'StringLength',
								'options' => array(
										'encoding' => 'UTF-8',
										'min'      => 0,
										'max'      => 255,
								),
						),
				),
		));
		

		$inputFilter->add(array(
				'name'     => 'fishpass_info',
				'required' => false,
				'filters'  => array(
						array('name' => 'StripTags'),
						array('name' => 'StringTrim'),
				),
				'validators' => array(
						array(
								'name'    => 'StringLength',
								'options' => array(
										'encoding' => 'UTF-8',
										'min'      => 0,
										'max'      => 2048,
								),
						),
				),
		));
		
		$inputFilter->add(array(
				'name'     => 'porosity_sal',
				'required' => false,
				'filters'  => array(
						array('name' => 'StripTags'),
						array('name' => 'StringTrim'),
				),
				'validators' => array(
						array(
								'name'    => 'StringLength',
								'options' => array(
										'encoding' => 'UTF-8',
										'min'      => 0,
										'max'      => 255,
								),
						),
				),
		));
		

		$inputFilter->add(array(
				'name'     => 'porosity_trout',
				'required' => false,
				'filters'  => array(
						array('name' => 'StripTags'),
						array('name' => 'StringTrim'),
				),
				'validators' => array(
						array(
								'name'    => 'StringLength',
								'options' => array(
										'encoding' => 'UTF-8',
										'min'      => 0,
										'max'      => 255,
								),
						),
				),
		));
		

		$inputFilter->add(array(
				'name'     => 'porosity_gray',
				'required' => false,
				'filters'  => array(
						array('name' => 'StripTags'),
						array('name' => 'StringTrim'),
				),
				'validators' => array(
						array(
								'name'    => 'StringLength',
								'options' => array(
										'encoding' => 'UTF-8',
										'min'      => 0,
										'max'      => 255,
								),
						),
				),
		));
		

		$inputFilter->add(array(
				'name'     => 'porosity_rlamp',
				'required' => false,
				'filters'  => array(
						array('name' => 'StripTags'),
						array('name' => 'StringTrim'),
				),
				'validators' => array(
						array(
								'name'    => 'StringLength',
								'options' => array(
										'encoding' => 'UTF-8',
										'min'      => 0,
										'max'      => 255,
								),
						),
				),
		));
		

		$inputFilter->add(array(
				'name'     => 'porosity_slamp',
				'required' => false,
				'filters'  => array(
						array('name' => 'StripTags'),
						array('name' => 'StringTrim'),
				),
				'validators' => array(
						array(
								'name'    => 'StringLength',
								'options' => array(
										'encoding' => 'UTF-8',
										'min'      => 0,
										'max'      => 255,
								),
						),
				),
		));
		

		$inputFilter->add(array(
				'name'     => 'porosity_eel',
				'required' => false,
				'filters'  => array(
						array('name' => 'StripTags'),
						array('name' => 'StringTrim'),
				),
				'validators' => array(
						array(
								'name'    => 'StringLength',
								'options' => array(
										'encoding' => 'UTF-8',
										'min'      => 0,
										'max'      => 255,
								),
						),
				),
		));
					
		$inputFilter->add(array(
				'name'     => 'porosity_cyp',
				'required' => false,
				'filters'  => array(
						array('name' => 'StripTags'),
						array('name' => 'StringTrim'),
				),
				'validators' => array(
						array(
								'name'    => 'StringLength',
								'options' => array(
										'encoding' => 'UTF-8',
										'min'      => 0,
										'max'      => 255,
								),
						),
				),
		));
			
		$inputFilter->add(array(
				'name'     => 'porosity_judgement',
				'required' => false,
				'filters'  => array(
						array('name' => 'StripTags'),
						array('name' => 'StringTrim'),
				),
				'validators' => array(
						array(
								'name'    => 'StringLength',
								'options' => array(
										'encoding' => 'UTF-8',
										'min'      => 0,
										'max'      => 255,
								),
						),
				),
		));
			
		$inputFilter->add(array(
				'name'     => 'local_head_drop',
				'required' => false,
				'filters'  => array(
						array('name' => 'StripTags'),
						array('name' => 'StringTrim'),
				),
		));
			
		$inputFilter->add(array(
				'name'     => 'porosity_info',
				'required' => false,
				'filters'  => array(
						array('name' => 'StripTags'),
						array('name' => 'StringTrim'),
				),
				'validators' => array(
						array(
								'name'    => 'StringLength',
								'options' => array(
										'encoding' => 'UTF-8',
										'min'      => 0,
										'max'      => 2048,
								),
						),
				),
		));
	
		return $inputFilter;
	}
}
