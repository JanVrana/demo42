<?php

namespace App\Factory;

use App\Entity\MeasurementRecord;

/**
 * Factory class creating App\Entity\MeasurementRecord objects
 */
class MeasurementRecordFactory
{
	/**
	 * Creates a single App\Entity\MeasurementRecord object from the array.
	 *
	 * @param array $data - Array of values where the key corresponds to the name of the property. Non-existent
	 *                    properties are omitted.
	 *
	 * @return \App\Entity\MeasurementRecord
	 */
	public static function createOneFromArray(array $data): MeasurementRecord
	{
		$measurementRecord = new MeasurementRecord();
		foreach ($data as $property => $value) {
			if (property_exists($measurementRecord, $property)) {
				$measurementRecord->{$property} = $value;
			}
		}
		return $measurementRecord;
	}

	/**
	 * Creates an array of a MeasurementRecord object from an array of arrays
	 *
	 * @param array $data - Array that contains the measurement Arrays, individual records will be processed by the
	 *                    self::createOneFromArray function
	 *
	 * @return MeasurementRecord[]
	 */
	public static function createManyFromArray(array $data): array
	{
		$collection = [];
		foreach ($data as $record) {
			$collection[] = self::createOneFromArray($record);
		}
		return $collection;
	}
}
