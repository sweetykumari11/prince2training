<?php

namespace App\Observers;
use App\Models\Country;
class CountryObserver
{
    public function created(country $country): void
    {
        $country->logActivities()->create([
            'activity' => 'Country '.$country->name . ' created',
        ]);
    }
    public function updated(country $country): void
    {
        $originalAttributes = $country->getOriginal();
        foreach ($originalAttributes as $attribute => $originalValue) {
            $currentValue = $country->$attribute;

            if ($attribute === 'updated_at' && $originalValue != $currentValue) {

              continue;
            }
            if ($attribute == 'name' && $originalValue != $currentValue) {

                $country->logActivities()->create([
                    'activity' =>"Country Name updated from {$originalValue} to {$currentValue}",
                ]);
            }
            if ($attribute == 'country_code' && $originalValue != $currentValue) {
                $country->logActivities()->create([
                    'activity' =>"Country code  updated from {$originalValue} to {$currentValue}",
                ]);
            }
            if ($attribute == 'description' && $originalValue != $currentValue) {
                $country->logActivities()->create([
                    'activity' =>"Country description updated from {$originalValue} to {$currentValue}",
                ]);
            }

            if ($attribute == 'iso3' && $originalValue != $currentValue) {
                $country->logActivities()->create([
                    'activity' =>"Country iso3 updated from {$originalValue} to {$currentValue}",
                ]);
            }
            if ($attribute == 'currency' && $originalValue != $currentValue) {
                $country->logActivities()->create([
                    'activity' =>"Country currency updated from {$originalValue} to {$currentValue}",
                ]);
            }
            if ($attribute == 'currency_symbol' && $originalValue != $currentValue) {
                $country->logActivities()->create([
                    'activity' =>"Country currency_symbol updated from {$originalValue} to {$currentValue}",
                ]);
            }
            if ($attribute == 'currency_symbol_html' && $originalValue != $currentValue) {
                $country->logActivities()->create([
                    'activity' =>"Country currency_symbol_html updated from {$originalValue} to {$currentValue}",
                ]);
            }
            if ($attribute == 'currency_title' && $originalValue != $currentValue) {
                $country->logActivities()->create([
                    'activity' =>"Country currency_title updated from {$originalValue} to {$currentValue}",
                ]);
            }
            if ($attribute == 'flagimage' && $originalValue != $currentValue) {
                $country->logActivities()->create([
                    'activity' =>"Country Flag image is updated",
                ]);
            }

            if ($attribute === 'is_active') {
                if ($originalValue == 0 && $currentValue == 1) {
                    $country->logActivities()->create([
                        'activity' => 'Country status Deactivate to Activated',
                    ]);
                } elseif ($originalValue == 1 && $currentValue == 0) {
                    $country->logActivities()->create([
                        'activity' => 'Country status Activate to Deactivated',
                    ]);
                }
            }
            if ($attribute === 'is_popular') {
                if ($originalValue == 0 && $currentValue == 1) {
                    $country->logActivities()->create([
                        'activity' => 'Country popular off to on',
                    ]);
                } elseif ($originalValue == 1 && $currentValue == 0) {
                    $country->logActivities()->create([
                        'activity' => 'Country popular on to off',
                    ]);
                }
            }


        }
    }
}
