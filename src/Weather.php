<?php

namespace ElliotMassen\WeatherLibrary;

// src/Weather.php

class SeasonException extends \Exception {}

interface WeatherInterface {
  /**
  *	@param  int  $month  An integer in the range of 1, 2, ..., 11, 12
  *	@return  string  A string of "WINTER", "SPRING", "SUMMER", or "AUTUMN"
  *	@throws  SeasonException
  */
  public static function getSeason(int $month): string;
}

class Weather implements WeatherInterface {
  public const WINTER = 'WINTER';
  public const SPRING = 'SPRING';
  public const SUMMER = 'SUMMER';
  public const AUTUMN = 'AUTUMN';

  /**
  *	{@inheritDoc}
  */
  public static function getSeason(int $month): string
  {
    if ($month < 1) {
      throw new SeasonException("The given month must be greater than or equal to 1.");
    }

    if ($month > 12) {
      throw new SeasonException("The given month must be less than or equal to 12.");
    }

    if (in_array($month, [12, 1, 2])) {
      return self::WINTER;
    } else if (in_array($month, [2, 3, 4])) {
      return self::SPRING;
    } else if (in_array($month, [5, 6, 7])) {
      return self::SUMMER;
    } else {
      return self::AUTUMN;
    }
  }
}