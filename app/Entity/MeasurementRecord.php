<?php

namespace App\Entity;

/**
* Entity of one measurement record. The data retrieved from the api looks like this
*
*   [id] => 25997
* 	[sort] =>
* 	[user_created] =>
* 	[date_created] => 2023-11-06T07:22:47.126Z
* 	[user_updated] =>
* 	[date_updated] =>
*	[HEX] => 3C0202090015004D000200040A063A0702
* 	[temperature] => 10.60000
* 	[co2] => 521
* 	[c2ho] => 21
* 	[humidity] => 58.70000
* 	[check] => 2
* 	[pm10] => 4
* 	[pm25] => 2
* 	[tvoc] => 77
* 	[valid] => 1
*/
class MeasurementRecord
{
	public ?int $id;
	public ?string $sort; // Unused
	public ?string $user_created;
	public null|string|\DateTime $date_created;
	public ?string $user_updated;
	public null|string|\DateTime $date_updated;
	public ?string $HEX;
	public ?float $temperature;
	public ?int $co2;
	public ?int $c2ho;
	public ?float $humidity;
	public ?int $check;
	public ?int $pm10;
	public ?int $pm25;
	public ?int $tvoc;
	public ?int $valid;

	/**
	 * A magic method that sets property values
	 * properties date_created and date_updated are automatically converted from string to DateTime
	 *
	 * @param string $name  - property name
	 * @param mixed  $value - property value
	 *
	 * @return void
	 * @throws \Exception - If the property does not exist, an exception is raised. If date_created or date_updated
	 *                    fails to convert to DateTime, an exception is thrown
	 */
	public function __set(string $name, mixed $value): void
	{
		if (property_exists($this, $name)) {
			if ($name == "date_created" or $name == "date_updated") {
				if (is_string($value)) {
					$this->$name = new \DateTime($value, new \DateTimeZone('UTC'));
				} elseif ($value instanceof \DateTime) {
					$this->$name = $value;
				} else {
					throw new \Exception("Property '$name' is not a valid string or date/time object");
				}
			} else {
				$this->$name = $value;
			}
		} else {
			throw new \Exception("Property $name not found");
		}
	}

	/**
	 * A magic method that returns a property value
	 *
	 * @param string $name - property name
	 *
	 * @return mixed - property value
	 * @throws \Exception - if the property does not exist, an exception is thrown
	 */
	public function __get(string $name): mixed
	{
		if (property_exists($this, $name)) {
			return $this->$name;
		} else {
			throw new \Exception("Property $name not found");
		}

	}
}
