<?php
namespace App\Service;

use GuzzleHttp\Client;
use App\Factory\MeasurementRecordFactory;


/**
 *  A service that retrieves measurement data from the API
 */
class MeasurementsApiService
{
	/**
	 * Constructor setting basic parameters
	 * @param string $apiUrl - url with API endpoint
	 * @param string $accessToken - access token
	 * @param string $collectionName - the name of the collection to load
	 */
	public function __construct(private string $apiUrl,
	                            private string $accessToken,
	                            private string $collectionName)
	{

	}

	/**
	 * Get the last $limit of records from the API, and return them as a MeasurementRecord[] array
	 * @param int $limit - limiting the number of records returned. default = 20
	 *
	 * @return \App\Entity\MeasurementRecord[]|null
	 * @throws \GuzzleHttp\Exception\GuzzleException - An exception is thrown if loading or data transfer fails
	 */
	public function getLastRecords(int $limit = 20): ?array
	{
		// Setting parameters for sorting and limit
		$params = [
			'query' => [
				'sort' => '-id', //Sort descending by ID
				'limit' => 20,
			],
		];

		// Initializing the Guzzle client
		$client = new Client([
			'base_uri' => $this->apiUrl,
			'headers' => [
				'Authorization' => 'Bearer ' . $this->accessToken,
				'Content-Type' => 'application/json',
			],
		]);

		try {
			// API function call
			$response = $client->request('GET', '/items/' . $this->collectionName, $params);
			$body = $response->getBody();
			$data = json_decode($body, true);
			return MeasurementRecordFactory::createManyFromArray($data['data']);
		} catch (\Exception $e) {
			throw new \Exception ("Failed to load data from api" . $e->getMessage());
		}
	}
}
