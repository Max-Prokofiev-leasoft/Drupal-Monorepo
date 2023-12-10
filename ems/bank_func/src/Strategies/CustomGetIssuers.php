<?php

namespace Drupal\commerce_ginger\Strategies;

use Drupal\commerce_ginger\Interface\GetIssuersStrategy;

class CustomGetIssuers implements GetIssuersStrategy
{

  public function getIssuers(): array
  {
    $list = [[
      "id"=> "sdfsdf",
      "list_type"=> "Nederland",
      "name"=> "Test 1"],
      [
        "id"=> "cvxbnvg",
        "list_type"=> "Nederland",
        "name"=> "Test 2"]];
    return $list;
  }
}
