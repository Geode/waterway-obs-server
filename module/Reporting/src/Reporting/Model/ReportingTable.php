<?php
namespace Reporting\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;
use Zend\Db\ResultSet\ResultSet;

class ReportingTable
{
	protected $tableGateway;

	public function __construct(TableGateway $tableGateway)
	{
		$this->tableGateway = $tableGateway;
	}

	public function fetchAll($paginated=false, $orderBy="")
	{
		if($paginated) {
			// create a new Select object for the table album
			$select = new Select('obstruction_report');
			// put an order by clause
			if ($orderBy != "") {
				$select->order($orderBy);
			}
			// create a new result set based on the Album entity
			$resultSetPrototype = new ResultSet();
			$resultSetPrototype->setArrayObjectPrototype(new Reporting());
			// create a new pagination adapter object
			$paginatorAdapter = new DbSelect(
					// our configured select object
					$select,
					// the adapter to run it against
					$this->tableGateway->getAdapter(),
					// the result set to hydrate
					$resultSetPrototype
			);
			$paginator = new Paginator($paginatorAdapter);
			return $paginator;
		}
		$resultSet = $this->tableGateway->select();
		return $resultSet;
	}
	public function getReporting($id)
	{
		$id  = (int) $id;
		$rowset = $this->tableGateway->select(array('id' => $id));
		$row = $rowset->current();
		if (!$row) {
			throw new \Exception("Could not find reporting id $id");
		}
		return $row;
	}

	public function saveReporting(Reporting $reporting)
	{
		$data = array(
				'location_x' => $reporting->x,
				'location_y'  => $reporting->y,
				'feature' => $reporting->feature,
				'type' => $reporting->type,
				'name' => $reporting->name,
				'location_info' => $reporting->location_info,
				'fishpass' => $reporting->fishpass,
				'fishpasstype' => $reporting->fishpasstype,
				'fishpass_info' => $reporting->fishpass_info,
				'porosity_sal' => $reporting->porosity_sal,
				'porosity_trout' => $reporting->porosity_trout,
				'porosity_gray' => $reporting->porosity_gray,
				'porosity_rlamp' => $reporting->porosity_rlamp,
				'porosity_slamp' => $reporting->porosity_slamp,
				'porosity_eel' => $reporting->porosity_eel,
				'porosity_cyp' => $reporting->porosity_cyp,
				'porosity_judgement' => $reporting->porosity_judgement,
				'local_head_drop' => $reporting->local_head_drop,
				'porosity_info' => $reporting->porosity_info,
				'file_name' => $reporting->file_name,
		);
		
		$id = (int)$reporting->id;
		if ($id == 0) {
			$this->tableGateway->insert($data);
		} else {
			if ($this->getreporting($id)) {
				//pop x and y elements
				$this->tableGateway->update($data, array('id' => $id));
			} else {
				throw new \Exception('Reporting id does not exist');
			}
		}
	}

	public function deleteReporting($id)
	{
		$this->tableGateway->delete(array('id' => $id));
	}
}