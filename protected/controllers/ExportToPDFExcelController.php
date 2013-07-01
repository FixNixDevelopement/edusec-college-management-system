<?php

class ExportToPDFExcelController extends RController
{
	public $layout='//layouts/column2';

	 //Uncomment the following methods and override them if needed
	
	public function filters()
	{
		return array(
			'rights', // perform access control for CRUD operations
		);
	}

	 public function behaviors()
	 {
		return array(
		    'eexcelview'=>array(
		        'class'=>'ext.eexcelview.EExcelBehavior',
		    ),
		);
	 }
	
//*****************Master Table*************************//


//=============== AcademicTermName===============
	
	    public function actionAcademicTermExportToPdf() 
	    {
		
             	if(isset($_SESSION['academic_term_records']))
               	{
		 	$d = $_SESSION['academic_term_records'];
		 	$model = array();

			if($d->data)
			$model[]=array_keys($d->data[0]->attributes);//headers: cols name
			else
			{
				$this->render('no_data_found',array('last_page'=>$_SERVER['HTTP_REFERER'],));
				exit;			
			}

			foreach ($d->data as $item)
			{
			    $model[] = $item->attributes;
			}
	         }
		           
		$html = $this->renderPartial('/academicTerm/academicTermGeneratePdf', array(
			'model'=>$model
		), true);
		$this->exporttopdf('Semester Report','Semester.pdf',$html);	       
	
	}

	public function actionAcademicTermExportToExcel()
	{
	    	$this->toExcel($_SESSION['academic_term_records'],
		
		array(
			'academic_term_name',
			'academic_term_start_date', 	
			'academic_term_end_date',
			'academicTermPeriod.academic_term_period',
			'current_sem::Current Sem',
			'Rel_org.organization_name',
			
		),
		'Semester',
		array(
		    'creator' => 'Rudrasoftech',
		),
		'Excel2007'
	    );
	}
	
	public function actionAcademicTermPeriodExportToPdf() 
	{
             	if(isset($_SESSION['academic_term_period_records']))
              	{
		 	$d = $_SESSION['academic_term_period_records'];
		 	$model = array();

			if($d->data)
			$model[]=array_keys($d->data[0]->attributes);//headers: cols name
			else
			{
				$this->render('no_data_found',array('last_page'=>$_SERVER['HTTP_REFERER'],));
				exit;			
			}

			foreach ($d->data as $item)
			{
			    $model[] = $item->attributes;
			}
	         }
		           
		$html = $this->renderPartial('/academicTermPeriod/academicTermPeriodGeneratePdf', array(
			'model'=>$model
		), true);
		$this->exporttopdf('Academic Year Report','AcademicTermPeriod.pdf',$html);

	}
	public function actionAcademicTermPeriodExportToExcel()
	{
	
		$this->toExcel($_SESSION['academic_term_period_records'],
			array(
			//'academic_terms_period_id',
			'academic_term_period',
			'Rel_user.user_organization_email_id::Created By',
			'Rel_org.organization_name',
			//'Rel_user.user_organization_email_id',
			
		),
		'Academic Year',
		array(
		    'creator' => 'Rudrasoftech',
		),
		'Excel2007'
	    );
	}


//===============BranchPassoutsemTag===============

	 public function actionBranchPassoutsemTagExportToPdf() 
	 {
             	if(isset($_SESSION['branch_tag_records']))
               	{
		 	$d = $_SESSION['branch_tag_records'];
		 	$model = array();

			if($d->data)
			$model[]=array_keys($d->data[0]->attributes);//headers: cols name
			else
			{
				$this->render('no_data_found',array('last_page'=>$_SERVER['HTTP_REFERER'],));
				exit;			
			}

			foreach ($d->data as $item)
			{
			    $model[] = $item->attributes;
			}
	         }
		           
		$html = $this->renderPartial('/branchPassoutsemTagTable/branchPassoutsemTagGeneratePdf', array(
			'model'=>$model
		), true);
		$this->exporttopdf('Branch Tags Report','BranchTag.pdf',$html);
	}	
	public function actionBranchPassoutsemTagExportToExcel()
	{
		$this->toExcel($_SESSION['branch_tag_records'],
		array(
			'branch_tag_name',
			'pass_out_sem',	
			'Rel_user.user_organization_email_id:Created By',
			'Rel_org.organization_name::Organization Name',	
			
		),
		'BranchTag',
		array(
		    'creator' => 'RudraSoftech',
		),
		'Excel2007'
	    );
	 }

//===============Branch===============

	public function actionBranchExportToPdf() 
	{
             	if(isset($_SESSION['branch_records']))
               	{
		 	$d = $_SESSION['branch_records'];
		 	$model = array();

			if($d->data)
			$model[]=array_keys($d->data[0]->attributes);//headers: cols name
			else
			{
				$this->render('no_data_found',array('last_page'=>$_SERVER['HTTP_REFERER'],));
				exit;			
			}

			foreach ($d->data as $item)
			{
			    $model[] = $item->attributes;
			}
	         }
		           
		$html = $this->renderPartial('/branch/branchGeneratePdf', array(
			'model'=>$model
		), true);
		$this->exporttopdf('Branch Report','Branch.pdf',$html);
	}
	public function actionBranchExportToExcel()
	{
	
		$this->toExcel($_SESSION['branch_records'],
		array(
			'branch_name::Branch Name',
			'branch_alias',		
			'branch_code',
			'Rel_Branch_Tag.branch_tag_name',
			'Rel_user.user_organization_email_id::Created By',
			'Rel_org.organization_name',
			
		),
		'Branch',
		array(
		    'creator' => 'RudraSoftech',
		),
		'Excel2007'
	    );
	}
//===============Division===============	    


	 public function actionDivisionExportToPdf() 
	 {
	  	if(isset($_SESSION['division_data']))
               	{
		 	$d = $_SESSION['division_data'];
		 	$model = array();

			if($d->data)
			$model[]=array_keys($d->data[0]->attributes);//headers: cols name
			else
			{
				$this->render('no_data_found',array('last_page'=>$_SERVER['HTTP_REFERER'],));
				exit;			
			}

			foreach ($d->data as $item) {
		    	$model[] = $item->attributes;
		}
               }
              
	$html = $this->renderPartial('/division/DivisionExportPdf', array(
			'model'=>$model
		), true);
		$this->exporttopdf('Division Report','Division.pdf',$html);
	}
	public function actionDivisionExportToExcel()
	{
	    	$this->toExcel($_SESSION['division_data'],
		array(
			'division_name::Division Name',
			'division_code',
			'Rel_Branch.branch_name::Branch Name',
			'Rel_user.user_organization_email_id::Created By',
			'Rel_org.organization_name::Organization Name',
				
        		),	
		'Division',
		array(
		    'creator' => 'Rudrasoftech',
		),
		'Excel2007'
	    );
	}
	
   
//===============Batch===============

	public function actionBatchExportToPdf() 
	{
             	if(isset($_SESSION['batch_records']))
               	{
		 	$d = $_SESSION['batch_records'];
		 	$model = array();

			if($d->data)
			$model[]=array_keys($d->data[0]->attributes);//headers: cols name
			else
			{
				$this->render('no_data_found',array('last_page'=>$_SERVER['HTTP_REFERER'],));
				exit;			
			}

			foreach ($d->data as $item)
			{
			    $model[] = $item->attributes;
			}
	         }
		           
		$html = $this->renderPartial('/batch/batchGeneratePdf', array(
			'model'=>$model
		), true);
		$this->exporttopdf('Batch Report','Batch.pdf',$html);
	}	
	public function actionBatchExportToExcel()
	{
		$this->toExcel($_SESSION['batch_records'],
		array(
			'batch_code',
			'rel_branch.branch_name',
			'rel_division.division_code',
			'Rel_user.user_organization_email_id:Created By',
			'Rel_org.organization_name',
		),
		'Batch',
		array(
		    'creator' => 'RudraSoftech',
		),
		'Excel2007'
	    );
	}
	    	    
//===============Category===============

	public function actionCategoryExportToPdf() 
	{
             	if(isset($_SESSION['category_records']))
               	{
		 	$d = $_SESSION['category_records'];
		 	$model = array();

			if($d->data)
			$model[]=array_keys($d->data[0]->attributes);//headers: cols name
			else
			{
				$this->render('no_data_found',array('last_page'=>$_SERVER['HTTP_REFERER'],));
				exit;			
			}

			foreach ($d->data as $item)
			{
			    $model[] = $item->attributes;
			}
	         }
		           
		$html = $this->renderPartial('/category/categoryGeneratePdf', array(
			'model'=>$model
		), true);
		$this->exporttopdf('Category Report','Category.pdf',$html);
	
	}

	public function actionCategoryExportToExcel()
	{
	    	$this->toExcel($_SESSION['category_records'],
		array(
			//'category_id',
			'category_name',
			'Rel_user.user_organization_email_id:Created By',
			//'Rel_org.organization_name',	
			
		),
		'Category',
		array(
		    'creator' => 'RudraSoftech',
		),
		'Excel2007'
	    );
	}	    
//===============Department===============

	public function actionDepartmentExportToPdf() 
	{
             	if(isset($_SESSION['department_records']))
               	{
		 	$d = $_SESSION['department_records'];
		 	$model = array();

			if($d->data)
			$model[]=array_keys($d->data[0]->attributes);//headers: cols name
			else
			{
				$this->render('no_data_found',array('last_page'=>$_SERVER['HTTP_REFERER'],));
				exit;			
			}

			foreach ($d->data as $item)
			{
			    $model[] = $item->attributes;
			}
	         }
		           
		$html = $this->renderPartial('/department/departmentGeneratePdf', array(
			'model'=>$model
		), true);
		$this->exporttopdf('Department Report','Department.pdf',$html);
		
	}
	public function actionDepartmentExportToExcel()
	{
		$this->toExcel($_SESSION['department_records'],
		array(
			
			'department_name::Department Name',
			'Rel_user.user_organization_email_id:Created By',
			'Rel_org.organization_name',	
		),
		'Department',
		array(
		    'creator' => 'RudraSoftech',
		),
		'Excel2007'
	    );
	}	    
//===============Designation===============


	 public function actionEmployeeDesignationExportToPdf() 
	 {
             	if(isset($_SESSION['designation_records']))
               	{
		 	$d = $_SESSION['designation_records'];
		 	$model = array();

			if($d->data)
			$model[]=array_keys($d->data[0]->attributes);//headers: cols name
			else
			{
				$this->render('no_data_found',array('last_page'=>$_SERVER['HTTP_REFERER'],));
				exit;			
			}

			foreach ($d->data as $item)
			{
			    $model[] = $item->attributes;
			}
	         }
		           
		$html = $this->renderPartial('/employeeDesignation/employeeDesignationGeneratePdf', array(
			'model'=>$model
		), true);
		$this->exporttopdf('Employee Designation Report','Designation.pdf',$html);
	}
	public function actionEmployeeDesignationExportToExcel()
	{
		$this->toExcel($_SESSION['designation_records'],
		array(
			//'employee_designation_id',
			'employee_designation_name::Designation Name',		
			'employee_designation_level',
			'Rel_user.user_organization_email_id:Created By',
			'Rel_org.organization_name',	
			
		),
		'Designation',
		array(
		    'creator' => 'RudraSoftech',
		),
		'Excel2007'
	    );
	}	    
//===============Nationality===============

	public function actionNationalityExportToPdf() 
	{
             	if(isset($_SESSION['nationality_records']))
               	{
		 	$d = $_SESSION['nationality_records'];
		 	$model = array();

			if($d->data)
			$model[]=array_keys($d->data[0]->attributes);//headers: cols name
			else
			{
				$this->render('no_data_found',array('last_page'=>$_SERVER['HTTP_REFERER'],));
				exit;			
			}

			foreach ($d->data as $item)
			{
			    $model[] = $item->attributes;
			}
	         }
		           
		$html = $this->renderPartial('/nationality/nationalityGeneratePdf', array(
			'model'=>$model
		), true);
		$this->exporttopdf('Nationality Report','Nationality.pdf',$html);
	}
	public function actionNationalityExportToExcel()
	{
		$this->toExcel($_SESSION['nationality_records'],
		array(
			//'nationality_id::SN',
			'nationality_name',
			'Rel_user.user_organization_email_id:Created By',
			
		
		),
		'Nationality',
		array(
		    'creator' => 'RudraSoftech',
		),
		'Excel2007'
	    );
	}	    
//===============Quota===============

	public function actionQuotaExportToPdf() 
	{
             	if(isset($_SESSION['quota_records']))
               	{
		 	$d = $_SESSION['quota_records'];
		 	$model = array();

			if($d->data)
			$model[]=array_keys($d->data[0]->attributes);//headers: cols name
			else
			{
				$this->render('no_data_found',array('last_page'=>$_SERVER['HTTP_REFERER'],));
				exit;			
			}

			foreach ($d->data as $item)
			{
			    $model[] = $item->attributes;
			}
	         }
		           
		$html = $this->renderPartial('/quota/quotaGeneratePdf', array(
			'model'=>$model
		), true);
		$this->exporttopdf('Quota Report','Quota.pdf',$html);
		
	}
	public function actionQuotaExportToExcel()
	{
		$this->toExcel($_SESSION['quota_records'],
		array(
			//'quota_id::SN',
			'quota_name::Quota Name',
			'Rel_user.user_organization_email_id:Created By',
			'Rel_org.organization_name',
		),
		'Quota',
		array(
		    'creator' => 'RudraSoftech',
		),
		'Excel2007'
	    );
	}	    
//===============Religion===============

	public function actionReligionExportToPdf() 
	{
             	if(isset($_SESSION['religion_data']))
               	{
		 	$d = $_SESSION['religion_data'];
		 	$model = array();

			if($d->data)
			$model[]=array_keys($d->data[0]->attributes);//headers: cols name
			else
			{
				$this->render('no_data_found',array('last_page'=>$_SERVER['HTTP_REFERER'],));
				exit;			
			}

			foreach ($d->data as $item) {
		    	$model[] = $item->attributes;
			}
               }
              
		$html = $this->renderPartial('/religion/ReligionExportPdf', array(
			'model'=>$model
		), true);
		
		$this->exporttopdf('Religion Report','Religion.pdf',$html);
		
	}
	public function actionReligionExportToExcel()
	{
		$this->toExcel($_SESSION['religion_data'],
		array(
			//'religion_id::SN',
			'religion_name',
			//'Rel_org.organization_name',
			'Rel_user.user_organization_email_id:Created By',
        		),
		'religion',
		array(
		    'creator' => 'Rudrasoftech',
		),
		'Excel2007'
	    );
	}	    
//===============Shift===============

	public function actionShiftExportToPdf() 
	{
             	if(isset($_SESSION['shift_data']))
               	{
		 	$d = $_SESSION['shift_data'];
		 	$model = array();

			if($d->data)
			$model[]=array_keys($d->data[0]->attributes);//headers: cols name
			else
			{
				$this->render('no_data_found',array('last_page'=>$_SERVER['HTTP_REFERER'],));
				exit;			
			}

			foreach ($d->data as $item) {
		    	$model[] = $item->attributes;
			}
               }
              
		$html = $this->renderPartial('/shift/ShiftExportPdf', array(
			'model'=>$model
		), true);
		
		$this->exporttopdf('Shift Report','Shift.pdf',$html);
	}	
	public function actionShiftExportToExcel()
	{
	    	$this->toExcel($_SESSION['shift_data'],
		array(
			//'shift_id',
			'shift_type',
			'shift_start_time',
			'shift_end_time',
			'Rel_user.user_organization_email_id:Created By',
			'Rel_org.organization_name',
        		),
		'shift',
		array(
		    'creator' => 'Rudrasoftech',
		),
		'Excel2007'
	    );
	}
	 	    
//===============Country===============

	public function actionCountryExportToPdf() 
	{
             	if(isset($_SESSION['country_data']))
               	{
		 	$d = $_SESSION['country_data'];
		 	$model = array();

			if($d->data)
			$model[]=array_keys($d->data[0]->attributes);//headers: cols name
			else
			{
				$this->render('no_data_found',array('last_page'=>$_SERVER['HTTP_REFERER'],));
				exit;			
			}

			foreach ($d->data as $item) {
		    	$model[] = $item->attributes;
			}
			//print_r($model);exit;
               }
              
		$html = $this->renderPartial('/country/CountryExportPdf', array(
			'model'=>$model
		), true);
		
		$this->exporttopdf('Country Report','Country.pdf',$html);
	}
	public function actionCountryExportToExcel()
	{
	    	$this->toExcel($_SESSION['country_data'],
		array(
			//'id',
			'name',
			
        		),
		'country',
		array(
		    'creator' => 'Rudrasoftech',
		),
		'Excel2007'
	    );
	}	    
//===============State===============

	public function actionStateExportToPdf() 
	{
             	if(isset($_SESSION['state_data']))
               	{
		 	$d = $_SESSION['state_data'];
		 	$model = array();

			if($d->data)
			$model[]=array_keys($d->data[0]->attributes);//headers: cols name
			else
			{
				$this->render('no_data_found',array('last_page'=>$_SERVER['HTTP_REFERER'],));
				exit;			
			}

			foreach ($d->data as $item) {
		    	$model[] = $item->attributes;
			}
               }
              
		$html = $this->renderPartial('/state/StateExportPdf', array(
			'model'=>$model
		), true);
		
		$this->exporttopdf('State Report','State.pdf',$html);
	}	
	public function actionStateExportToExcel()
	{
		$this->toExcel($_SESSION['state_data'],
		array(
			//'state_id',
			'state_name',
			'Rel_country.name',
			
        		),
		'state',
		array(
		    'creator' => 'Rudrasoftech',
		),
		'Excel2007'
	    );
	}    
//===============City===============

	public function actionCityExportToPdf() 
	{
             	if(isset($_SESSION['city_data']))
               	{
		 	$d = $_SESSION['city_data'];
		 	$model = array();

			if($d->data)
			$model[]=array_keys($d->data[0]->attributes);//headers: cols name
			else
			{
				$this->render('no_data_found',array('last_page'=>$_SERVER['HTTP_REFERER'],));
				exit;			
			}

			foreach ($d->data as $item) {
		    	$model[] = $item->attributes;
			}
               }
              
		$html = $this->renderPartial('/city/CityExportPdf', array(
			'model'=>$model
		), true);
		
		$this->exporttopdf('City Report','City.pdf',$html);
	}

	public function actionCityExportToExcel()
	{
		$this->toExcel($_SESSION['city_data'],
		array(
			//'city_id',
			'city_name',
			'Rel_state.state_name',
			'Rel_country.name',			
        		),
		'City',
		array(
		    'creator' => 'Rudrasoftech',
		),
		'Excel2007'
	    );
	}	    
//===============Bank Master===============

	public function actionBankMasterExportToPdf() 
	{
             	if(isset($_SESSION['bankmaster_data']))
               	{
		 	$d = $_SESSION['bankmaster_data'];
		 	$model = array();

			if($d->data)
			$model[]=array_keys($d->data[0]->attributes);//headers: cols name
			else
			{
				$this->render('no_data_found',array('last_page'=>$_SERVER['HTTP_REFERER'],));
				exit;			
			}

			foreach ($d->data as $item) {
		    	$model[] = $item->attributes;
			}
               }
              
		$html = $this->renderPartial('/bankMaster/BankMasterExportToPdf', array(
			'model'=>$model
		), true);
		
		$this->exporttopdf('Bank Master Report','BankMaster.pdf',$html);
	}	    
	public function actionBankMasterExportToExcel()
	{
		$this->toExcel($_SESSION['bankmaster_data'],
		array(
			//'bank_id',
			'bank_full_name',
			'bank_short_name',
			//'Rel_org.organization_name',			
        		),
		'bankmaster',
		array(
		    'creator' => 'Rudrasoftech',
		),
		'Excel2007'
	    );
	}	
//===============Languages===============
	public function actionLanguageExportToPdf() 
	{
             	if(isset($_SESSION['language_data']))
               	{
		 	$d = $_SESSION['language_data'];
		 	$model = array();

			if($d->data)
			$model[]=array_keys($d->data[0]->attributes);//headers: cols name
			else
			{
				$this->render('no_data_found',array('last_page'=>$_SERVER['HTTP_REFERER'],));
				exit;			
			}

			foreach ($d->data as $item) {
		    	$model[] = $item->attributes;
			}
               	}
              
		$html = $this->renderPartial('/languages/LanguageExportPdf', array(
			'model'=>$model
		), true);
		
		$this->exporttopdf('Language Report','Language.pdf',$html);
	}	    
	public function actionLanguageExportToExcel()
	{
		$this->toExcel($_SESSION['language_data'],
		array(
			//'languages_id',
			'languages_name',
			'Rel_user.user_organization_email_id:Created By',
			//'Rel_org.organization_name',			
        		),
		'Languages',
		array(
		    'creator' => 'Rudrasoftech',
		),
		'Excel2007'
	    );
	}

	 
//===============Education===============

	
	public function actionEducationExportToPdf() 
	{
             	if(isset($_SESSION['eduboard_data']))
               	{
		 	$d = $_SESSION['eduboard_data'];
		 	$model = array();

			if($d->data)
			$model[]=array_keys($d->data[0]->attributes);//headers: cols name
			else
			{
				$this->render('no_data_found',array('last_page'=>$_SERVER['HTTP_REFERER'],));
				exit;			
			}

			foreach ($d->data as $item) {
		    	$model[] = $item->attributes;
			}
               }
              
		$html = $this->renderPartial('/eduboard/EducationExportPdf', array(
			'model'=>$model
		), true);
		
		$this->exporttopdf('Education Report','Education.pdf',$html);
	}
	public function actionEducationExportToExcel()
	{
		$this->toExcel($_SESSION['eduboard_data'],
		array(
			//'eduboard_id',
			'eduboard_name',
			//'Rel_org.organization_name',
			'Rel_user.user_organization_email_id::Created By',
						
        		),
		'education',
		array(
		    'creator' => 'Rudrasoftech',
		),
		'Excel2007'
	    );
	}
	 	    
//===============Qualification===============	

	public function actionQualificationExportToPdf() 
	{
             	if(isset($_SESSION['qua_data']))
               	{
		 	$d = $_SESSION['qua_data'];
		 	$model = array();

			if($d->data)
			$model[]=array_keys($d->data[0]->attributes);//headers: cols name
			else
			{
				$this->render('no_data_found',array('last_page'=>$_SERVER['HTTP_REFERER'],));
				exit;			
			}

			foreach ($d->data as $item) {
		    	$model[] = $item->attributes;
			}
               }
              
		$html = $this->renderPartial('/qualification/gridview_export_report', array(
			'model'=>$model
		), true);
		
		$this->exporttopdf('Course Report','Qualification.pdf',$html);
	}
	public function actionQualificationExportToExcel()
	{
		$this->toExcel($_SESSION['qua_data'],
		array(
			//'qualification_id',
			'qualification_name',
			//'Rel_org.organization_name',
			'Rel_user.user_organization_email_id:Created By',	
		),
		'Course',
		array(
		    'creator' => 'RudraSoftech',
		),
		'Excel2007'
	    );
	}    
//===============Miscellineous Fees Master===============

	 public function actionMiscellaneousFeesExportToPdf() 
	 {
             	if(isset($_SESSION['miscellaneousfees_data']))
               	{
		 	$d = $_SESSION['miscellaneousfees_data'];
		 	$model = array();

			if($d->data)
			$model[]=array_keys($d->data[0]->attributes);//headers: cols name
			else
			{
				$this->render('no_data_found',array('last_page'=>$_SERVER['HTTP_REFERER'],));
				exit;			
			}

			foreach ($d->data as $item) {
		    	$model[] = $item->attributes;
			}
               }
              
		$html = $this->renderPartial('/miscellaneousFeesMaster/MiscellaneousFeesExportPdf', array(
			'model'=>$model
		), true);
		
		$this->exporttopdf('Miscellaneous Fees Report','MiscellaneousFees.pdf',$html);
	}
	public function actionMiscellaneousFeesExportToExcel()
	{
		$this->toExcel($_SESSION['miscellaneousfees_data'],
		array(
			//'miscellaneous_fees_id',
			'miscellaneous_fees_name',
			'Rel_user.user_organization_email_id::Created By',
			'Rel_org.organization_name',			
        		),
		'Miscellaneousfees',
		array(
		    'creator' => 'Rudrasoftech',
		),
		'Excel2007'
	    );
	}	    

//===============Student Status===============
	public function actionStudentStatusExportToPdf() 
	{
             	if(isset($_SESSION['status_data']))
               	{
		 	$d = $_SESSION['status_data'];
		 	$model = array();

			if($d->data)
			$model[]=array_keys($d->data[0]->attributes);//headers: cols name
			else
			{
				$this->render('no_data_found',array('last_page'=>$_SERVER['HTTP_REFERER'],));
				exit;			
			}

			foreach ($d->data as $item) {
		    	$model[] = $item->attributes;
			}
               }
              
		$html = $this->renderPartial('/studentstatusmaster/gridview_export_report', array(
			'model'=>$model
		), true);
		
		$this->exporttopdf('Student Status Report','StudentStatus.pdf',$html);
		
	}
	public function actionStudentStatusExportToExcel()
	{
	
		$this->toExcel($_SESSION['status_data'],
		array(
			//'id',		
			'status_name',
			//'Rel_org.organization_name',
			'Rel_user.user_organization_email_id:Created By',
		),
		'Student-Status',
		array(
		    'creator' => 'RudraSoftech',
		),
		'Excel2007'
	    );
	}	    
//===============Year===============

	public function actionYearExportToPdf() 
	{
             	if(isset($_SESSION['year_data']))
               	{
		 	$d = $_SESSION['year_data'];
		 	$model = array();

			if($d->data)
			$model[]=array_keys($d->data[0]->attributes);//headers: cols name
			else
			{
				$this->render('no_data_found',array('last_page'=>$_SERVER['HTTP_REFERER'],));
				exit;			
			}

			foreach ($d->data as $item) {
		    	$model[] = $item->attributes;
			}
               }
              
		$html = $this->renderPartial('/year/gridview_export_report', array(
			'model'=>$model
		), true);
		
		$this->exporttopdf('Year Report','Year.pdf',$html);
	}
	public function actionYearExportToExcel()
	{
	    	$this->toExcel($_SESSION['year_data'],
		array(
		//'year_id::SN',
		'year',
		),
		'Year Report',
		array(
		    'creator' => 'RudraSoftech',
		),
		'Excel2007'
	    );
	}	    
//===============Terms And Condition===============

	public function actionTermExportToPdf() 
	{
             	if(isset($_SESSION['term_data']))
               	{
		 	$d = $_SESSION['term_data'];
		 	$model = array();

			if($d->data)
			$model[]=array_keys($d->data[0]->attributes);//headers: cols name
			else
			{
				$this->render('no_data_found',array('last_page'=>$_SERVER['HTTP_REFERER'],));
				exit;			
			}

			foreach ($d->data as $item) {
		    	$model[] = $item->attributes;
			}
               }
              
		$html = $this->renderPartial('/feesTermsAndCondition/gridview_export_report', array(
			'model'=>$model
		), true);
		
		$this->exporttopdf('Fees Terms and Condition Report','FeesTermsAndCondition.pdf',$html);
		
	}
	public function actionTermExportToExcel()
	{
		$this->toExcel($_SESSION['term_data'],
		array(
		//'id',
		'term',
		'Rel_user.user_organization_email_id::Created By',
		),
		'Fees Terms And Condition',
		array(
		    'creator' => 'RudraSoftech',
		),
		'Excel2007'
	    );
	}	    


//************************************************Main Menu*******************************************************//

//===============Employee Transaction===============
 	
	public function actionEmployeeExportToPdf() 
	{
		if(isset($_SESSION['employee_records']))
		{
		 	$d = $_SESSION['employee_records'];
		 	$model = array();

			if($d->data)
			$model[]=array_keys($d->data[0]->attributes);//headers: cols name
			else
			{
				$this->render('no_data_found',array('last_page'=>$_SERVER['HTTP_REFERER'],));
				exit;			
			}

		foreach ($d->data as $item)
		{
		    $model[] = $item->attributes;
		}
               }
              
		$html = $this->renderPartial('/employeeTransaction/expenseGridtoReport', array(
			'model'=>$model
		), true);
		
		$this->exporttopdf('Employee Report','Employee.pdf',$html);
	}

	public function actionEmployeeExportToExcel()
	{
	    	$this->toExcel($_SESSION['employee_records'],
		array(
		'Rel_Emp_Info.employee_no',
		'Rel_Emp_Info.employee_name_alias',
		'Rel_Emp_Info.employee_joining_date',
		'Rel_Emp_Info.employee_probation_period',
		'Rel_Designation.employee_designation_name::Designation',
		'Rel_Department.department_name::Department',
		'Rel_Shift.shift_type::Shift',
		'Rel_Emp_Info.title',
		//'Rel_Branch.branch_name',
		'Rel_Emp_Info.employee_first_name::First Name',
		'Rel_Emp_Info.employee_middle_name::Middle Name',
		'Rel_Emp_Info.employee_last_name::Last Name',
		//'',//mother name
		'Rel_Emp_Info.employee_dob::Birthdate',
		'Rel_Emp_Info.employee_birthplace::BirthPlace',
		'Rel_Emp_Info.employee_gender::Gender',
		'Rel_Emp_Info.employee_bloodgroup::Bloodgroup',		
		'Rel_Nationality.nationality_name::Nationality',
		'Rel_Emp_Info.employee_marital_status',
		'Rel_Religion.religion_name',
		'Rel_Emp_Info.employee_pancard_no',
		'Rel_Emp_Info.employee_account_no::Bank Acc. No',
		'Rel_Category.category_name::Category',
		'Rel_Emp_Info.employee_private_email::Private Email',
		'Rel_Emp_Info.employee_private_mobile::Private Mobile',
		'Rel_Emp_Info.employee_organization_mobile::Organization Mobile',
		'Rel_Photo.employee_photos_path',
		'Rel_Emp_Info.employee_guardian_name::Guardian Name',
		'Rel_Emp_Info.employee_guardian_relation::Guardian Relation',
		'Rel_Emp_Info.employee_guardian_qualification::Guardian Qualification',		
		'Rel_Emp_Info.employee_guardian_occupation::Guardian Occupation',
		'Rel_Emp_Info.employee_guardian_home_address::Guardian Address',
		'Rel_Emp_Info.employee_guardian_occupation_address::Guardian Occupation Address',
		'Rel_Emp_Info.Rel_g_city.city_name::Guardian City',
		'Rel_Emp_Info.employee_guardian_city_pin',
		'Rel_Emp_Info.employee_guardian_mobile1::Guardian Mobile1',
		'Rel_Emp_Info.employee_guardian_mobile2::Guardian Mobile2',		
		'Rel_Emp_Info.employee_guardian_phone_no::Guardian Phone',
		'Rel_Emp_Info.employee_attendance_card_id',
		'Rel_Emp_Info.employee_faculty_of::Faculty Of',
		'Rel_Emp_Info.employee_curricular',
		'Rel_Emp_Info.employee_project_details',
		'Rel_Emp_Info.employee_technical_skills',
		'Rel_Emp_Info.employee_hobbies',		
		'Rel_Lang.Rel_Langs1.languages_name',
		'Rel_Lang.Rel_Langs2.languages_name',
		'Rel_Lang.Rel_Langs3.languages_name',
		'Rel_Lang.Rel_Langs4.languages_name',
		'Rel_Emp_Info.employee_reference',
		'Rel_Emp_Info.employee_refer_designation',

		'Rel_Employee_Address.employee_address_c_line1::Current Address Line1',
		'Rel_Employee_Address.employee_address_c_line2::Current Address Line2',
		'Rel_Employee_Address.Rel_c_city.city_name::Current Address City',
		'Rel_Employee_Address.employee_address_c_pincode',
		'Rel_Employee_Address.Rel_c_state.state_name::Current Address State',
		'Rel_Employee_Address.Rel_c_country.name::Current Address Country',
		
		'Rel_Employee_Address.employee_address_p_line1::Parmenent Address Line1',
		'Rel_Employee_Address.employee_address_p_line2::Parmenent Address Line2',			
		'Rel_Employee_Address.Rel_p_city.city_name::Parmenent Address City',
		'Rel_Employee_Address.Rel_p_state.state_name::Parmenent Address State',
		'Rel_Employee_Address.Rel_p_country.name::Parmenent Address Country',
		
		'Rel_Employee_Address.employee_address_phone',
		'Rel_Employee_Address.employee_address_mobile',
		'Rel_Emp_Info.employee_type',
	
		),
		'Employee',
		array(
		    'creator' => 'Rudrasoftech',
		),
		'Excel2007'
	    );
	}
		/*  Teaching staff detail report */
	public function actionEmployeedataExportToExcel()
	{
		 
	 	 $des_name = "L.A.";
		 $designation = EmployeeDesignation::model()->findByAttributes(array('employee_designation_name'=>$des_name,'employee_designation_organization_id'=>Yii::app()->user->getState('org_id')));
		 $des_id = $designation['employee_designation_id'];
		 if($des_id)
		 {
		 $org = Yii::app()->user->getState('org_id');
		 $emp_data = EmployeeTransaction::model()->findAll(array('condition' => 't.employee_transaction_designation_id <> :name and t.employee_transaction_organization_id = :org and employee_transaction_id IN(select employee_info_transaction_id from employee_info where employee_type =1)',
'params' => array(':name' => $des_id,':org'=>$org)));
		if($emp_data)
		{
	    	$this->toExcel($emp_data,
		array(
			'Rel_Emp_Info.title::Title',
			'Rel_Emp_Info.employee_last_name::Surname',
			'Rel_Emp_Info.employee_first_name::First Name',
			'Rel_Emp_Info.employee_middle_name::Middle Name',
			'Rel_Emp_Info.employee_gender::Gender',
			'Rel_Emp_Info.employee_middle_name::Father Name',
			'Rel_Emp_Info.employee_mother_name::Mother Name',
			
			'Rel_Employee_Address.employee_address_c_line1::Address Line 1',
			'Rel_Employee_Address.employee_address_c_line2::Address Line 2',
			'Rel_Employee_Address.employee_address_c_pincode::Postal Code',
			'Rel_Employee_Address.Rel_c_city.city_name::City/Village',
			'Rel_Employee_Address.Rel_c_state.state_name::State',
			'Rel_Religion.religion_name::Religion',
			'Rel_Category.category_name::Caste',
			'Rel_Emp_Info.employee_dob::Date of Birth',
			'Rel_Emp_Info.employee_pancard_no::PAN',
			'std_code::STD Code',
			'landline::Land Line #',
			'Rel_Emp_Info.employee_private_mobile::Mobile Phone #',
			'Rel_Emp_Info.employee_private_email::Email Address',
			'fax_phone::Fax Phone #',
			'Rel_Designation.employee_designation_name::Exact Designation',
			'applointment::Appointment FT/PT',
			'gross_per_month::Gross Pay Per Month',
			'appointment_type::Appointment Type',
			'faculty_type::Faculty Type',
			'payscale::PayScale',
			'programme::Programme',
			'course::Course',
			'salary_mode::Salary Mode',
			'pf_number::PF Number',	
			'Rel_Emp_Info.employee_joining_date::Date of Joining',		
			'doctrate_degree::Doctorate Degree',
			'pg_degree::PG Degree',
			'ug_degree::UG Degree',
			'other_qualification::Other Qualification',
			'area_specialization::Area Of Specialization',
			'teaching_exp::Teaching Experiece In Years',
			'total_exp::Total Experiece In Years',
			'research_exp::Research Experience in Years',
			'Rel_Emp_Info.employee_account_no::BankAccountNumber',
			'bank_name::BankName',
			'bank_branch_name::Bank Branch Name',
			'ifsc_code::IFSC Code',
			'national_publication::National Publications',
			'patent::Patents',
			'no_pg_prj_guided::No. Of PG Project Guided:',
			'no_dr_prj_guided::No. Of PG Doctorate Guided',
			'international_publication::International Publications',
			'no_of_books_pub::No Of books Published',
			'Physical_hd::Is Physically handicapped',
			'minority_indicator::Minority Indicator',
			'fy_teacher::First Yr Teacher',
			'fy_common_teacher::FY/Common Subject Teacher?',
			'fy_common_subject::FY/Common Subject',
			'expert_mem_aicte::Would you like to work as Expert Member on various committees of AICTE',
			'aicte_grant_apply::Have you ever applied to AICTE for any grants/assistance',
			'basic_pay_rs::Basic Pay in Rs.',
			'da::DA %',
			'hra_rs::HRA in Rs.',
			'other_allowance_rs::Other Allowances in Rs.',
		),
		'Employeedata',
		array(
		    'creator' => 'Rudrasoftech',
		),
		'Excel2007'
	    );	
		}	
		else
		{
			echo "No data Found"."</br>";
			echo CHtml::link('GO BACK',Yii::app()->createUrl('/site/newdashboard'));
			break;

		}
		}
		else
		{
			echo "No data Found"."</br>";
			echo CHtml::link('GO BACK',Yii::app()->createUrl('/site/newdashboard'));
			break;

		}
	}
	/* Admin(Non- Teaching) staff detail report*/
	public function actionAdminlibdataExportToExcel()
	{
		
		$dep_name = "Admin Department";
		$department = Department::model()->findByAttributes(array('department_name'=>$dep_name,'department_organization_id'=>Yii::app()->user->getState('org_id')));
		$dep_id = $department['department_id'];
		if($dep_id)
		{
		$emp_data = EmployeeTransaction::model()->findAll('employee_transaction_organization_id = '.Yii::app()->user->getState('org_id').' AND employee_transaction_department_id = '.$dep_id);
		if($emp_data)
		{
	    	$this->toExcel($emp_data,
		array(
			'Rel_Emp_Info.title::Title',
			'Rel_Emp_Info.employee_first_name::First Name',
			'Rel_Emp_Info.employee_middle_name::Middle Name',
			'Rel_Emp_Info.employee_last_name::Surname',
			'Rel_Emp_Info.employee_mother_name::Mother Name',
			'Rel_Emp_Info.employee_middle_name::Father Name',
			'Rel_Employee_Address.employee_address_c_line1::Address Line 1',
			'Rel_Employee_Address.employee_address_c_line2::Address Line 2',
			'Rel_Employee_Address.Rel_c_city.city_name::City/Village',
			'Rel_Employee_Address.Rel_c_state.state_name::State',
			'Rel_Employee_Address.employee_address_c_pincode::Postal Code',
			'res_phone::Res Phone',
			'Rel_Emp_Info.employee_private_mobile::Mobile Phone #',
			'Rel_Emp_Info.employee_dob::Date of Birth',
			'Rel_Emp_Info.employee_gender::Gender',
			'phd::PhD',
			'master_degree::Master Degree',
			'bachelor_degree::Bachelor Degree',
			'diploma::Diploma',
			'other::Other',
			'Rel_Designation.employee_designation_name::Exact Designation',
			'appointment_type::Appointment Type',
			'Rel_Emp_Info.employee_joining_date::Date of Joining',
			'pf_number::PF Number',
			'salary_type::Salary Type',
			'salary_mode::Salary Mode',
			'gross_per_month::Gross Pay Per Month',
			'bank_name::Bank Name',
			'Rel_Emp_Info.employee_account_no::Bank Account Number',
			'ifsc_code::IFSC Code',
			'Rel_Emp_Info.employee_private_email::Email',
			'Rel_Emp_Info.employee_pancard_no::PAN',
			
		),
		'AdminLibStaffExcel',
		array(
		    'creator' => 'Rudrasoftech',
		),
		'Excel2007'
	    );
		}	
		else
		{
			echo "No data Found"."</br>";
			echo CHtml::link('GO BACK',Yii::app()->createUrl('/site/newdashboard'));
			break;

		}
		}
		else
		{
			echo "No data Found"."</br>";
			echo CHtml::link('GO BACK',Yii::app()->createUrl('/site/newdashboard'));
			break;

		}
	}
/* Technical staff detail report */
	public function actionTechnicalstaffdataExportToExcel()
	{
		$des_name = "L.A.";
		$designation = EmployeeDesignation::model()->findByAttributes(array('employee_designation_name'=>$des_name,'employee_designation_organization_id'=>Yii::app()->user->getState('org_id')));
		$des_id = $designation['employee_designation_id'];
		if($des_id)
		{
		$emp_data = EmployeeTransaction::model()->findAll('employee_transaction_organization_id = '.Yii::app()->user->getState('org_id').' AND employee_transaction_designation_id = '.$des_id);
		if($emp_data)
		{	    	
		$this->toExcel($emp_data,
		array(
			'Rel_Emp_Info.title::Title',
			'Rel_Emp_Info.employee_first_name::First Name',
			'Rel_Emp_Info.employee_middle_name::Middle Name',
			'Rel_Emp_Info.employee_last_name::Surname',
			'Rel_Emp_Info.employee_mother_name::Mother Name',
			'Rel_Emp_Info.employee_middle_name::Father Name',
			'Rel_Employee_Address.employee_address_c_line1::Address Line 1',
			'Rel_Employee_Address.employee_address_c_line2::Address Line 2',
			'Rel_Employee_Address.Rel_c_city.city_name::City/Village',
			'Rel_Employee_Address.Rel_c_state.state_name::State',
			'Rel_Employee_Address.employee_address_c_pincode::Postal Code',
			'res_phone::Res Phone',
			'Rel_Emp_Info.employee_private_mobile::Mobile Phone #',
			'Rel_Emp_Info.employee_dob::Date of Birth',
			'Rel_Emp_Info.employee_gender::Gender',
			'programme::Program',
			'course::Course',
			'level::Level',
			'Rel_Department.department_name::Department',
			
			'phd::PhD',
			'master_degree::Master Degree',
			'bachelor_degree::Bachelor Degree',
			'diploma::Diploma',
			'other::Other',
			'Rel_Designation.employee_designation_name::Exact Designation',
			'appointment_type::Appointment Type',
			'Rel_Emp_Info.employee_joining_date::Date of Joining the Institute',
			'pf_number::PF Number',
			'salary_type::Salary Type',
			'salary_mode::Salary Mode',
			'gross_per_month::Gross Pay Per Month',
			'bank_name::Bank Name',
			'Rel_Emp_Info.employee_account_no::Bank Account Number',
			'ifsc_code::IFSC Code',
			
			'Rel_Emp_Info.employee_pancard_no::PAN Number',
			
		),
		'TechnicalStaffExcel',
		array(
		    'creator' => 'Rudrasoftech',
		),
		'Excel2007'
	    );
		}	
		else
		{
			echo "No data Found"."</br>";
			echo CHtml::link('GO BACK',Yii::app()->createUrl('/site/newdashboard'));
			break;
		}
		}
		else
		{
			echo "No data Found"."</br>";
			echo CHtml::link('GO BACK',Yii::app()->createUrl('/site/newdashboard'));
			break;
		}
	}
	
//===============Student Transaction===============

	 public function actionStudentTransactionExportPdf() 
   	 {
	    	if(isset($_SESSION['Student_records']))
	       	{
		 	$d = $_SESSION['Student_records'];
		 	$model = array();
			if($d->data)
			$model[]=array_keys($d->data[0]->attributes);//headers: cols name
			else
			{
				$this->render('no_data_found',array('last_page'=>$_SERVER['HTTP_REFERER'],));
				exit;			
			}

			foreach ($d->data as $item) {
		    		$model[] = $item->attributes;
			}
	
	       }
			   
		$html = $this->renderPartial('/studentTransaction/StudentTransactionExportPdf', array(
			'model'=>$model
		), true);
		$this->exporttopdf('Student Report','Student.pdf',$html);	
	}
	public function actionStudentTransactionExportExcel()
	{
	    	$this->toExcel($_SESSION['Student_records'],
		array(
			'Rel_Stud_Info.student_roll_no',
			'Rel_Stud_Info.student_gr_no',
			'Rel_Stud_Info.student_merit_no',
			'Rel_Stud_Info.student_adm_date',
			'Rel_Stud_Info.student_enroll_no',
			'Rel_Stud_Info.student_first_name',
			//'Rel_Stud_Info.student_middle_name',
			'Rel_Stud_Info.student_last_name',
			'Rel_Stud_Info.student_mother_name',
			'Rel_Stud_Info.title',
			'Rel_Stud_Info.student_gender',
			'Rel_Stud_Info.student_birthplace',
			'Rel_Stud_Info.student_dob',
			'Rel_Nationality.nationality_name',
			'Rel_Religion.religion_name',
			'Rel_Quota.quota_name::Quota',
			'Rel_Branch.branch_name::Branch',
			'Rel_Category.category_name::Category',
			'Rel_student_academic_terms_period_name.academic_term_period::Term Period',
			'Rel_student_academic_terms_name.academic_term_name',
			'Rel_Stud_Info.student_guardian_name::Guardian Name',
			'Rel_Stud_Info.student_guardian_relation::Guardian Relation',
			'Rel_Stud_Info.student_guardian_qualification::Guardian Qualification',
			'Rel_Stud_Info.student_guardian_mobile::Guardian Mobile',
			'Rel_Stud_Info.student_guardian_occupation::Guardian Occupation',
			'Rel_Stud_Info.student_guardian_income::Guardian Income',
			'Rel_Stud_Info.student_guardian_occupation_address::Guardian Occupation Address',
			'Rel_Stud_Info.student_guardian_home_address::Guardian Home Address',
			'Rel_Stud_Info.Rel_gardian_city.city_name::Guardian::City',
			'Rel_Stud_Info.student_guardian_city_pin',
			'Rel_Stud_Info.student_guardian_phoneno',
			'Rel_Stud_Info.student_email_id_1',
			'Rel_Stud_Info.student_email_id_2',
			'Rel_Stud_Info.student_bloodgroup',
			'Rel_Batch.batch_name::Batch',
			'Rel_Shift.shift_type',
			'Rel_language.Rel_language_known1.languages_name',
			'Rel_language.Rel_language_known2.languages_name',
			'Rel_language.Rel_language_known3.languages_name',
			'Rel_language.Rel_language_known4.languages_name',
			'Rel_Student_Address.student_address_c_line1::Current Address Line1',
			'Rel_Student_Address.student_address_c_line2::Current Address Line2',
			'Rel_Student_Address.Rel_c_city.city_name::Current Address City',
			'Rel_Student_Address.student_address_c_pin::Current Address City Pin ',
			'Rel_Student_Address.student_address_c_taluka',
			'Rel_Student_Address.student_address_c_district',
			'Rel_Student_Address.Rel_c_state.state_name::Current Address State',
			'Rel_Student_Address.Rel_c_country.name::Current Address Country',
			'Rel_Student_Address.student_address_p_line1::Permanent Address Line1',
			'Rel_Student_Address.student_address_p_line2::Permanent Address Line2',
			'Rel_Student_Address.Rel_p_city.city_name::Permanent Address City',
			'Rel_Student_Address.student_address_p_pin::Permanent Address Line1',
			'Rel_Student_Address.student_address_p_taluka',
			'Rel_Student_Address.student_address_p_district',
			'Rel_Student_Address.Rel_p_state.state_name::Permanent Address State',
			'Rel_Student_Address.Rel_p_country.name::Permanent Address Country',
			'Rel_Student_Address.student_address_phone',
			'Rel_Student_Address.student_address_mobile',
			'Rel_Stud_Info.student_living_status',
			),
			'studenttransaction',
			array(
			    'creator' => 'Rudrasoftech',
			),
			'Excel2007'
		    );
		}
	public function actionStudentdataExportExcel()
	{
		
		$stud_data = StudentTransaction::model()->findAll('student_transaction_organization_id = '.Yii::app()->user->getState('org_id'));
		
		if($stud_data)
		{
	    	$this->toExcel($stud_data,
		array(
			'Rel_Stud_Info.title::Title',
			'Rel_Stud_Info.student_first_name::First Name',
			'Rel_Stud_Info.student_middle_name::Middle Name',
			'Rel_Stud_Info.student_last_name::Surname / Family Name',
			'year1::Year1 (% marks)',
			'year2::Year2 (% marks)',
			'year3::Year3 (% marks)',
			'year4::Year4 (% marks)',
			'year5::Year5 (% marks)',
			'Rel_Stud_Info.student_mother_name::Mother Name',
			'Rel_Stud_Info.student_father_name::Father Name',
			'Rel_Stud_Info.student_guardian_phoneno::Res Phone',
			'Rel_Stud_Info.student_mobile_no::Mobile Number',
			'Rel_Stud_Info.student_gender::Gender',
			'Rel_Stud_Info.student_dob::Date of Birth(dd/mm/yyyy)',
			'program::Program',
			'course::Course',		
			'level::Level',
			'Rel_Stud_Info.student_adm_date::Date of joining(dd/mm/yyyy)',
			'admission::Admitted To',
			'Rel_Stud_Info.student_roll_no::Roll Number',
			'Rel_Stud_Info.student_email_id_1::Email Address',
			'Rel_Religion.religion_name::Religion',
			'Rel_Category.category_name::Caste',
			'reserve_category::Reserve Category',
			'phy_hand::Is Physically Handicapped',
			'econ_back::Econ Backward',
			'Rel_Stud_Info.student_living_status::Home',
			'institute_fees::Institute Fees Paid',
			'hostel_fees::Hostel Fees/Month',
			'gate_score::Gate Score',
			'gate_exam_number::Gate Exam Number',
			'gate_score_validfrom::Gate Score- Year Valid From',
			'gate_score_validto::Gate Score- Year Valid To',
			'aadharcard::Aadhaar Card',
			'Rel_Stud_Info.student_enroll_no::Enrolment Id(EID)',
				
			),
			'studentdata',
			array(
			    'creator' => 'Rudrasoftech',
			),
			'Excel2007'
		    );
		}
		else
		{
			echo "No data Found"."</br>";
			echo CHtml::link('GO BACK',Yii::app()->createUrl('/site/newdashboard')); 
			break;
		}
		}


//===============Fees Master===============

	public function actionFeesMasterExportPdf() 
   	 {
	    	if(isset($_SESSION['fees_master']))
	       	{
		 	$d = $_SESSION['fees_master'];
		 	$model = array();
			if($d->data)
			$model[]=array_keys($d->data[0]->attributes);//headers: cols name
			else
			{
				$this->render('no_data_found',array('last_page'=>$_SERVER['HTTP_REFERER'],));
				exit;			
			}

			foreach ($d->data as $item) {
		    		$model[] = $item->attributes;
			}
	
	       }
			   
		$html = $this->renderPartial('/feesMaster/gridview_export_report', array(
			'model'=>$model
		), true);
		$this->exporttopdf('Fees Category Report','FeesMaster.pdf',$html);
			
	}
	public function actionFeesMasterExportToExcel()
	{
	
		$this->toExcel($_SESSION['fees_master'],
			array(
			'fees_master_name',
			'Rel_fees_quota.quota_name::Quota Name',
			//'fees_master_created_date',
			'Rel_user.user_organization_email_id::Created By',
			'Rel_fees_org.organization_name',
			
		),
		'Fees Category',
		array(
		    'creator' => 'Rudrasoftech',
		),
		'Excel2007'
	    );
	}		
	


//===============user===============
	public function actionuserExportToExcel()
	{
	    	$this->toExcel($_SESSION['user_data'],
		array(
			'user_organization_email_id',
				
			'user_type',
			'rel_user_email.user_organization_email_id',
			'user_creation_date',
			'rel_user_organization.organization_name',
		),
		'User',
		array(
		    'creator' => 'Rudrasoftech',
		),
		'Excel2007'
	    );
	}
	
	public function actionuserExportToPdf() 
	{
             	if(isset($_SESSION['user_data']))
              	{
		 	$d = $_SESSION['user_data'];
		 	$model = array();

			if($d->data)
			$model[]=array_keys($d->data[0]->attributes);//headers: cols name
			else
			{
				$this->render('no_data_found',array('last_page'=>$_SERVER['HTTP_REFERER'],));
				exit;			
			}

			foreach ($d->data as $item)
			{
			    $model[] = $item->attributes;
			}
	         }
		           
		$html = $this->renderPartial('/user/userGeneratePdf', array(
			'model'=>$model
		), true);
		$this->exporttopdf('User Report','user.pdf',$html);
		
	}

//=============== login user ===============
	public function actionloginExportToExcel()
	{
	    	$this->toExcel($_SESSION['login_data'],
		array(
			'login_user.user_organization_email_id',
			'status',
			'log_in_time',
			'log_out_time', 	
			'user_ip_address', 
			'login_org.organization_name',
		),
		'Login user',
		array(
		    'creator' => 'Rudrasoftech',
		),
		'Excel2007'
	    );
	}
	
	public function actionloginExportToPdf() 
	{
		if(isset($_SESSION['login_data']))
              	{
		 	$d = $_SESSION['login_data'];
		 	$model = array();

			if($d->data)
			$model[]=array_keys($d->data[0]->attributes);//headers: cols name
			else
			{
				$this->render('no_data_found',array('last_page'=>$_SERVER['HTTP_REFERER'],));
				exit;			
			}

			foreach ($d->data as $item)
			{
			    $model[] = $item->attributes;
			}
	         }
		           
		$html = $this->renderPartial('/loginUser/loginGeneratePdf', array(
			'model'=>$model
		), true);
		$this->exporttopdf('Login user Report','Login_user.pdf',$html);
		
	}

	//-----------------------mismiscellenous fees-----------------------------------------
	public function actionmis_feesExportToPdf($id) 
	{
             $cash_data = MiscellaneousFeesPaymentCash::model()->findAll('miscellaneous_fees_payment_cash_student_id='.$id);
	     $cheque_data = MiscellaneousFeesPaymentCheque::model()->findAll('miscellaneous_fees_payment_cheque_student_id='.$id);
              
		$html = $this->renderPartial('/miscellaneousFeesPaymentTransaction/mis_pdf', array(
			'cash_data'=>$cash_data,'cheque_data'=>$cheque_data,'id'=>$id,
		), true);
		
		$this->exporttopdf('Miscellenous Fees  Report','MiscellenousFees.pdf',$html);
	}
	public function actionmis_feesExportToExcel($id)
	{
		$cash_data = MiscellaneousFeesPaymentCash::model()->findAll('miscellaneous_fees_payment_cash_student_id='.$id);
	     $cheque_data = MiscellaneousFeesPaymentCheque::model()->findAll('miscellaneous_fees_payment_cheque_student_id='.$id);
              
		Yii::app()->request->sendFile(date('YmdHis').'.xlsx',
                           $this->renderPartial('/miscellaneousFeesPaymentTransaction/mis_pdf', array(
			'cash_data'=>$cash_data,'cheque_data'=>$cheque_data,'id'=>$id,
		), true)
                       );
		
	}
		
	public function actionUserTypeExportToPdf() 
	{
             	if(isset($_SESSION['user_type_records']))
               	{
			$d = $_SESSION['user_type_records'];
			$model = array();

			if($d->data)
			$model[]=array_keys($d->data[0]->attributes);//headers: cols name
			else
			{
				$this->render('no_data_found',array('last_page'=>$_SERVER['HTTP_REFERER'],));
				exit;			
			}

			foreach ($d->data as $item) {
		    	$model[] = $item->attributes;
			}
               }
              
		$html = $this->renderPartial('/userType/userTypeGeneratePdf', array(
			'model'=>$model
		), true);
		
		$this->exporttopdf('UserType Report','UserType.pdf',$html);
	}
	public function actionUserTypeExportToExcel()
	{
	    	$this->toExcel($_SESSION['user_type_records'],
		array(
		'user_type_name', 	
		'Rel_user.user_organization_email_id:Created By',
		//'Rel_org.organization_name',
		),
		'UserType',
		array(
		    'creator' => 'RudraSoftech',
		),
		'Excel2007'
	    );
	}
	public function actionFeesPaymentTypeExportToPdf() 
	{
             	if(isset($_SESSION['fees_pay_type_records']))
               	{
			$d = $_SESSION['fees_pay_type_records'];
			$model = array();

			if($d->data)
			$model[]=array_keys($d->data[0]->attributes);//headers: cols name
			else
			{
				$this->render('no_data_found',array('last_page'=>$_SERVER['HTTP_REFERER'],));
				exit;			
			}

			foreach ($d->data as $item) {
		    	$model[] = $item->attributes;
			}
               }
              
		$html = $this->renderPartial('/feesPaymentType/feesPaymentTypeGeneratePDF', array(
			'model'=>$model
		), true);
		
		$this->exporttopdf('FeesPaymentType Report','FeesPayment.pdf',$html);
	}
	public function actionFeesPaymentTypeExportToExcel()
	{
	    	$this->toExcel($_SESSION['fees_pay_type_records'],
		array(
		'fees_type_name', 	
		
		'Rel_org.organization_name',
		),
		'FeesPayment',
		array(
		    'creator' => 'RudraSoftech',
		),
		'Excel2007'
	    );
	}
	public function actionGtuNoticeExportToPdf() 
	{
             	if(isset($_SESSION['gtu_notice_records']))
               	{
			$d = $_SESSION['gtu_notice_records'];
			$model = array();

			if($d->data)
			$model[]=array_keys($d->data[0]->attributes);//headers: cols name
			else
			{
				$this->render('no_data_found',array('last_page'=>$_SERVER['HTTP_REFERER'],));
				exit;			
			}

			foreach ($d->data as $item) {
		    	$model[] = $item->attributes;
			}
               }
              
		$html = $this->renderPartial('/gtunotice/gtuNoticeGeneratePDF', array(
			'model'=>$model
		), true);
		$this->exporttopdf('GTU Notice Report','GTUNotice.pdf',$html);
		
	}
	public function actionGtuNoticeExportToExcel()
	{
	    	$this->toExcel($_SESSION['gtu_notice_records'],
		array(
		'Description',
		'Link',
		'Rel_user.user_organization_email_id::Created By', 	
		'Rel_org.organization_name::Organization',
		
		),
		'GTUNotice',
		array(
		    'creator' => 'RudraSoftech',
		),
		'Excel2007'
	    );
	}
	public function actionImportantNoticeExportToPdf() 
	{
             	if(isset($_SESSION['important_notice_records']))
               	{
			$d = $_SESSION['important_notice_records'];
			$model = array();

			if($d->data)
			$model[]=array_keys($d->data[0]->attributes);//headers: cols name
			else
			{
				$this->render('no_data_found',array('last_page'=>$_SERVER['HTTP_REFERER'],));
				exit;			
			}

			foreach ($d->data as $item) {
		    	$model[] = $item->attributes;
			}
               }
              
		$html = $this->renderPartial('/importantNotice/importantNoticeGeneratePDF', array(
			'model'=>$model
		), true);
		
		$this->exporttopdf('Important Notice Report','ImportantNotice.pdf',$html);
	}
	public function actionImportantNoticeExportToExcel()
	{
	    	$this->toExcel($_SESSION['important_notice_records'],
		array(
		'notice', 
		'Rel_user.user_organization_email_id::Created By',	
		'Rel_org.organization_name',
		
		),
		'ImportantNotice',
		array(
		    'creator' => 'RudraSoftech',
		),
		'Excel2007'
	    );
	}

	public function actionFeedbackMasterExportToPdf() 
	{
             	if(isset($_SESSION['feedback_records']))
               	{
			$d = $_SESSION['feedback_records'];
			$model = array();

			if($d->data)
			$model[]=array_keys($d->data[0]->attributes);//headers: cols name
			else
			{
				$this->render('no_data_found',array('last_page'=>$_SERVER['HTTP_REFERER'],));
				exit;			
			}

			foreach ($d->data as $item) {
		    	$model[] = $item->attributes;
			}
               }
              
		$html = $this->renderPartial('/feedbackMaster/feedbackMasterGeneratePDF', array(
			'model'=>$model
		), true);
		
		$this->exporttopdf('Feedback Report','Feedback.pdf',$html);
	}
	public function actionFeedbackMasterExportToExcel()
	{
	    	$this->toExcel($_SESSION['feedback_records'],
		array(
		'feedback_start_date',
		'feedback_end_date',
		'feedback_name',
		'Rel_emp_id.employee_first_name',
		'Rel_branch_id.branch_name',
		'Rel_academic_term_id.academic_term_name',
		'Rel_academic_term_period_id.academic_terms_period_name',
		'Rel_subject_id.subject_master_name',
		'Rel_department_id.department_name',
		'remark',
		'Rel_org.organization_name',
		
		),
		'Feedback',
		array(
		    'creator' => 'RudraSoftech',
		),
		'Excel2007'
	    );
	}
	public function actionOrganizationExportToPdf() 
	{
             	if(isset($_SESSION['organization_records']))
               	{
			$d = $_SESSION['organization_records'];
			$model = array();

			if($d->data)
			$model[]=array_keys($d->data[0]->attributes);//headers: cols name
			else
			{
				$this->render('no_data_found',array('last_page'=>$_SERVER['HTTP_REFERER'],));
				exit;			
			}

			foreach ($d->data as $item) {
		    	$model[] = $item->attributes;
			}
               }
              
		$html = $this->renderPartial('/organization/OrganizationGeneratePDF', array(
			'model'=>$model
		), true);
		$this->exporttopdf('Organization Report','Organization.pdf',$html);
	}
	public function actionOrganizationExportToExcel()
	{
	    	$this->toExcel($_SESSION['organization_records'],
		array(
		'organization_name',
		'address_line1',
		'Rel_org_city.city_name',
		'Rel_org_state.state_name',
		'Rel_org_country.name',
		'pin',
		'phone',
		'website',
		'email',
		'fax_no',
		'Rel_user.user_organization_email_id',
		'organization_creation_date',
		
		),
		'Organization',
		array(
		    'creator' => 'RudraSoftech',
		),
		'Excel2007'
	    );
	}

	public function actionStudentFinalViewExportToPdf($id)
	    {
		$student_docs = StudentDocsTrans::model()->findAll('student_docs_trans_user_id='.$id);	
		$studentqualification = StudentAcademicRecordTrans::model()->findAll('student_academic_record_trans_stud_id='.$id);
		$student_transaction = StudentTransaction::model()->findAll('student_transaction_id='.$id);		 
		$studentfeedbackdetailstable = FeedbackDetailsTable::model()->findAll('feedback_details_table_student_id='.$id);
		$html = $this->renderPartial('/studentTransaction/studentfinalview', array(
		    'student_docs'=>$student_docs,
		    'studentqualification'=>$studentqualification,
		    'student_transaction'=>$student_transaction,
		    'studentfeedbackdetailstable'=>$studentfeedbackdetailstable,
		), true);

		$this->exporttopdf('Stundent Report','StundentFinalView.pdf',$html);	       
	    }
	//feedbackcategorymaster//////////////////////////
	public function actionFeedbackcategoryExportToPdf() 
	{
             	if(isset($_SESSION['feedbackcategory']))
               	{
			$d = $_SESSION['feedbackcategory'];
			$model = array();

			if($d->data)
			$model[]=array_keys($d->data[0]->attributes);//headers: cols name
			
			else
			{
				$this->render('no_data_found',array('last_page'=>$_SERVER['HTTP_REFERER'],));
				exit;			
			}
			foreach ($d->data as $item) {
		    	$model[] = $item->attributes;
			}
		}
		$html = $this->renderPartial('/feedbackCategoryMaster/FeedbackCategoryGeneratePdf', array(
			'model'=>$model
		), true);
		$this->exporttopdf('Feedback Category Master Report','StudentPerformanceReport.pdf',$html);	       
	}
	public function actionFeedbackcategoryExportToExcel()
	{
	    	$this->toExcel($_SESSION['feedbackcategory'],
		array(
		'feedback_category_name',
		'Rel_user_feedback.user_organization_email_id::Created By',
		//'feedback_category_creation_date',
		'Rel_org_feedback.organization_name',
		),
		'StudentPerformanceReport',
		array(
		    'creator' => 'RudraSoftech',
		),
		'Excel2007'
	    );

	}
	public function actionEmployeeFinalViewExportToPdf($id)
	    {
		$employee_transaction = EmployeeTransaction::model()->findAll(' 	employee_transaction_id='.$id);
		$employee_docs = EmployeeDocsTrans::model()->findAll('employee_docs_trans_user_id='.$id);
		$employee_qual = EmployeeAcademicRecordTrans::model()->findAll('employee_academic_record_trans_user_id='.$id);
		$employee_exp = EmployeeExperienceTrans::model()->findAll('employee_experience_trans_user_id='.$id);

		$html = $this->renderPartial('/employeeTransaction/employeeFinalView', array(
		    'employee_docs'=>$employee_docs,
		    'employee_qual'=>$employee_qual,
		    'employee_transaction'=>$employee_transaction,
		    'emp_exp'=>$employee_exp,
		), true);
		$this->exporttopdf('Employee Report','Employee.pdf',$html);	              
	    }

	public function actionmessageExportToPdf() 
	{
             	if(isset($_SESSION['message']))
               	{
			$d = $_SESSION['message'];
			$model = array();

			if($d->data)
			$model[]=array_keys($d->data[0]->attributes);//headers: cols name
			else
			{
				$this->render('no_data_found',array('last_page'=>$_SERVER['HTTP_REFERER'],));
				exit;			
			}

			foreach ($d->data as $item) {
		    	$model[] = $item->attributes;
			}
               }
              
		$html = $this->renderPartial('/messageOfDay/messageGeneratePDF', array(
			'model'=>$model
		), true);
		$this->exporttopdf('Message Report','Message.pdf',$html);	
	}
	public function actionmessageExportToExcel()
	{
	    	$this->toExcel($_SESSION['message'],
		array(
		'message',
		//'creation_date',
		'Rel_user_message.user_organization_email_id::Created By',
		),
		'Message',
		array(
		    'creator' => 'RudraSoftech',
		),
		'Excel2007'
	    );
	}
	
	protected function exporttopdf($title,$filename,$html)
	{
		Yii::import('application.extensions.tcpdf.*');
		require_once('tcpdf/tcpdf.php');
		require_once('tcpdf/config/lang/eng.php');

		 ob_clean();
		$pdf = new TCPDF();
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor(Yii::app()->name);
		$pdf->SetTitle($title);
		$pdf->SetSubject($title);
		$pdf->SetKeywords('example, text, report');
		$pdf->SetHeaderData('', 0, $title, '');
		//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, "Example Report by ".Yii::app()->name, "");
		$pdf->setHeaderFont(Array('helvetica', '', 8));
		$pdf->setFooterFont(Array('helvetica', '', 6));
		$pdf->SetMargins(15, 18, 15);
		$pdf->SetHeaderMargin(5);
		$pdf->SetFooterMargin(10);
		$pdf->SetAutoPageBreak(TRUE, 15);
		$pdf->SetFont('dejavusans', '', 7);
		$resolution= array(150, 150);
		$pdf->AddPage('P', $resolution);
		$pdf->writeHTML($html, true, false, true, false, '');
		$pdf->LastPage();
		$pdf->Output($filename, "I");
	}


      
}
