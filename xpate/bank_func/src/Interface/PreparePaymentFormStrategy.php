<?php

namespace Drupal\commerce_ginger\Interface;

interface PreparePaymentFormStrategy extends BaseStrategy
{
    public function prepareKlarnaLaterForm(array $form);
    public function prepareAfterpayForm(array $form);

}