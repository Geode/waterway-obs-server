<?php
namespace Reporting\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Reporting\Model\Reporting;
use Reporting\Form\ReportingForm;
use Reporting\Model\Insertview;
use Zend\View\Model\JsonModel;

class ReportingController extends AbstractActionController
{
	protected $reportingTable; //used to read data
	protected $insertviewTable; //used to create data (a view based on the previous table)
	
	public function indexAction()
	{
		$page = (int) $this->params()->fromRoute('id', 0);
		$order = (string) $this->params()->fromRoute('order', "id_DESC");
		
		$order = str_replace(array("_","%20","-"), " ", str_replace(array(0," ", " "),"",$order));
		// grab the paginator from the Reportings
		$paginator = $this->getReportingTable()->fetchAll(true, $order);
		// set the current page to what has been passed in query string, or to 1 if none set
		$paginator->setCurrentPageNumber($page);
		// set the number of items
		$paginator->setItemCountPerPage(50);
		return new ViewModel(array(
				'reportings' => $paginator,
				'order' 	 => $order,
		));
	}

    public function addAction()
    {
        $form = new ReportingForm();
        $form->get('submit')->setValue('Add');
        

        $request = $this->getRequest();
        
        if ($request->isPost()) {
            $insert_view = new Reporting();
            $form->setInputFilter($insert_view->getInputFilter());
            $form->setData($request->getPost());
            
            //@todo: image management store image on a public www and create field and store filename into database
            $post = array_merge_recursive(
            		$request->getPost()->toArray(),
            		$request->getFiles()->toArray()
            );
            
            if ($form->isValid()) {
            	$myFormData = $form->getData();
                //image stuff:
                $imageFile = $post['image-file'];
                if ($imageFile == "" || $imageFile['error'] >= 1 || $imageFile['tmp_name'] == "")
                {
                	// no image uploaded
			$filename ="";
                }
                else 
                {
	                if ($imageFile['error'] == 1 || $imageFile['tmp_name'] == "")
	                {
	                	if ($myFormData['submit-json'] != "")
	                	{
	                		$result = new JsonModel(array('result'=>false, 'msg'=>'Image upload error, perhaps image size is too large!'.$imageFile['error']));
	                		return $result;
	                	}
	                	else
	                	{
	                		throw new \Exception("image upload error, perhaps image size is too large!");
	                	}
	                }
	                
	                if ($imageFile['error'] != "image/jpeg")
	                {
	                	if ($myFormData['submit-json'] != "")
	                	{
	                		$result = new JsonModel(array('result'=>false, 'msg'=>'image upload error, must be a jpeg image!'));
	                		return $result;
	                	}
	                	else
	                	{
	                		throw new \Exception("image upload error, must be a jpeg image!");
	                	}
	                }
	                $filename = date("Y-m-d_H-i-s").".jpg";
	                move_uploaded_file($imageFile['tmp_name'], "public/obstructions/" . $filename);
	                //move_uploaded_file($imageFile['tmp_name'], $_ENV['OPENSHIFT_DATA_DIR'] . "images/" . $filename);
                }
                //@todo: manage errors in a json way:
            	$insert_view->exchangeArray($form->getData());
            	$insert_view->setFileName($filename);
            	
                $this->getInsertviewTable()->saveReporting($insert_view);
                if ($myFormData['submit-json'] != "")
                {
                	$result = new JsonModel(array('result'=>true));
            		//return $result;
                }
                
                return $this->redirect()->toRoute('reporting');
            }
            else
            {
            	$myFormData = $form->getData();
            	if ($myFormData['submit-json'] != "")
            	{
	            	$result = new JsonModel(array('result'=>false, 'msg'=>'data validation not passed!'));
	                return $result;
            	}
            }
        }
        return array('form' => $form);
    }

	public function editAction()
	{
	    $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('reporting', array(
                'action' => 'add'
            ));
        }

        // Get the Reporting with the specified id.  An exception is thrown
        // if it cannot be found, in which case go to the index page.
        try {
            $reporting = $this->getReportingTable()->getReporting($id);
        }
        catch (\Exception $ex) {
            return $this->redirect()->toRoute('reporting', array(
                'action' => 'index'
            ));
        }

        $form  = new ReportingForm();
        $form->bind($reporting);
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($reporting->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $this->getReportingTable()->saveReporting($reporting);

                // Redirect to list of albums
                return $this->redirect()->toRoute('reporting');
            }
        }

        return array(
            'id' => $id,
            'form' => $form,
        );
    }


	public function deleteAction()
	{
		//throw new \Exception("The reporting cannot be deleted!");
		
		$id = (int) $this->params()->fromRoute('id', 0);
		if (!$id) {
			return $this->redirect()->toRoute('reporting');
		}
	
		$request = $this->getRequest();
		if ($request->isPost()) {
			$del = $request->getPost('del', 'No');
	
			if ($del == 'Yes') {
				$id = (int) $request->getPost('id');
				throw new \Exception("The reporting cannot be deleted!");
				$this->getReportingTable()->deleteReporting($id);
			}
	
			// Redirect to list of albums
			return $this->redirect()->toRoute('reporting');
		}
	
		return array(
				'id'    => $id,
				'reporting' => $this->getReportingTable()->getReporting($id)
		);
	}
	

	public function getInsertviewTable()
	{
		if (!$this->insertviewTable) {
			$sm = $this->getServiceLocator();
			$this->insertviewTable = $sm->get('Reporting\Model\InsertviewTable');
		}
		return $this->insertviewTable;
	}
		
	public function getReportingTable()
	{
		if (!$this->reportingTable) {
			$sm = $this->getServiceLocator();
			$this->reportingTable = $sm->get('Reporting\Model\ReportingTable');
		}
		return $this->reportingTable;
	}
}
