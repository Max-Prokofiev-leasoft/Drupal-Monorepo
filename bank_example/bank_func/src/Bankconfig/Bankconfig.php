<?php

namespace Drupal\commerce_ginger\Bankconfig;

use Symfony\Component\Yaml\Yaml;

/**
 * Class Bankconfig.
 *
 * This class contain configs for a bank
 *
 * @package Drupal\commerce_ginger\Builder
 */
class Bankconfig
{

  const PLATFORM_NAME = 'Drupal10';

  const PLUGIN_NAME = 'privat24-Drupal10';

  const ENDPOINT = 'https://api.dev.gingerpayments.com';

  const LOGGER_CHANEL = 'example_plugin';

  /**
   * @return mixed|string
   */
  public static function getPluginVersion(): mixed
  {
    $pluginInfo = Yaml::parseFile(
      DRUPAL_ROOT.'/modules/contrib/ginger_drupal_commerce/commerce_ginger.info.yml'
    );

    return $pluginInfo['version'] ?? '1.0.0';
  }

  /**
   * @return string
   */
  public static function getPluginName(): string
  {
    return self::PLUGIN_NAME;
  }

  /**
   * @return string
   */
  public static function getPlatformName(): string
  {
    return self::PLATFORM_NAME;
  }

  /**
   * @return string
   */
  public static function getEndpoint(): string
  {
    return self::ENDPOINT;
  }

  /**
   * @return string
   */
  public static function getLoggerChanel(): string
  {
    return self::LOGGER_CHANEL;
  }

  /**
   * @param  string  $lang
   *
   * @return string
   */
  public static function getAfterPayTermsLink(string $lang): string
  {
    $lang == 'nl' ?
      $link = 'https://www.afterpay.nl/nl/algemeen/betalen-met-afterpay/betalingsvoorwaarden' :
      $link = 'https://www.afterpay.nl/en/about/pay-with-afterpay/payment-conditions';

    return $link;
  }

}
