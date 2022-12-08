<?php

namespace ElliotMassen\WeatherLibrary;

// src/Weather.php

class SeasonException extends \Exception {}

interface WeatherInterface {
  /**
  *	@return  string  A string of "WINTER", "SPRING", "SUMMER", or "AUTUMN"
  */
  public function getSeason(): string;

  /**
  *	@return  bool  Whether the month is in winter.
  */
  public function isWinter(): bool;
}

class Weather implements WeatherInterface {
  public const WINTER = 'WINTER';
  public const SPRING = 'SPRING';
  public const SUMMER = 'SUMMER';
  public const AUTUMN = 'AUTUMN';

  protected int $month;
  protected string $season;

  /**
  * @throws  SeasonException
  */
  public function __construct(int $month)
  {
    if ($month < 1) {
      throw new SeasonException("The given month must be greater than or equal to 1.");
    }

    if ($month > 12) {
      throw new SeasonException("The given month must be less than or equal to 12.");
    }

    $this->month = $month;
    $this->season = $this->determineSeason();
  }

	protected function determineSeason(): string
  {
    if (in_array($this->month, [12, 1, 2])) {
      return self::WINTER;
    } else if (in_array($this->month, [2, 3, 4])) {
      return self::SPRING;
    } else if (in_array($this->month, [5, 6, 7])) {
      return self::SUMMER;
    } else {
      return self::AUTUMN;
    }
  }

  /**
  *	{@inheritDoc}
  */
  public function getSeason(): string
  {
    return $this->season;
  }

  /**
  *	{@inheritDoc}
  */
  public function isWinter(): bool
  {
    return $this->season === self::WINTER;
  }
}