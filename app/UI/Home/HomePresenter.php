<?php

namespace App\UI\Home;

use App\Service\MeasurementsApiService;

/**
 * Home presenter
 */
class HomePresenter extends \Nette\Application\UI\Presenter
{
	/**
	 * @var \stdClass
	 * @property string $property
	 */
	protected $template;


	/**
	 * constructor
	 * @param \App\Service\MeasurementsApiService $measurementsApi - a service that loads data from the API is passed via DI
	 */
	public function __construct(private MeasurementsApiService $measurementsApi)
	{
	}

	/**
	 * Rendering the main page, the method retrieves the data from the api and passes it to the template in the $measurementRecords variable
	 * @return void
	 */
	public function renderDefault()
	{
		try{
			$this->template->measurementRecords = $this->measurementsApi->getLastRecords();
		}
		catch(\Exception $e){
			$this->flashMessage($e->getMessage(),"error");
		}
	}
}
