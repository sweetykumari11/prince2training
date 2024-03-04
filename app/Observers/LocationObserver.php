<?php

namespace App\Observers;

use App\Models\Region;
use App\Models\Country;
use App\Models\Location;
use Illuminate\Support\Facades\Auth;

class LocationObserver
{
    /**
     * Handle the Location "created" event.
     */
    public function created(Location $location): void
    {
        $location->logActivities()->create([
            'activity' => 'Location ' . $location->name . ' created',
        ]);
    }

    /**
     * Handle the Location "updated" event.
     */
    public function updated(Location $location): void
    {
        $originalAttributes = $location->getOriginal();

        foreach ($originalAttributes as $attribute => $originalValue) {
            $currentValue = $location->$attribute;

            if ($attribute === 'updated_at' && $originalValue != $currentValue) {
                continue;
            }

            if ($attribute === 'name' && $originalValue != $currentValue) {
                $location->logActivities()->create([
                    'activity' => "Location Name updated from {$originalValue} to {$currentValue}",
                ]);
            }

            if ($attribute === 'country_id' && $originalValue != $currentValue) {
                $oldCountryName = Country::find($originalValue)->name;
                $newCountryName = Country::find($currentValue)->name;
                $location->logActivities()->create([
                    'activity' => "Location Country updated from {$oldCountryName} to {$newCountryName}",
                ]);
            }

            if ($attribute === 'region_id' && $originalValue != $currentValue) {
                $oldRegionName = Region::find($originalValue)->name;
                $newRegionName = Region::find($currentValue)->name;
                $location->logActivities()->create([
                    'activity' => "Location Region updated from {$oldRegionName} to {$newRegionName}",
                ]);
            }

            // Add logging for other attributes as needed
            if ($attribute == 'address' && $originalValue != $currentValue) {
                $location->logActivities()->create([
                    'activity' => "Location Address updated from {$originalValue} to {$currentValue}",
                ]);
            }

            if ($attribute == 'slug' && $originalValue != $currentValue) {
                $location->logActivities()->create([
                    'activity' => "Location Slug updated from {$originalValue} to {$currentValue}",
                ]);
            }

            if ($attribute == 'phone' && $originalValue != $currentValue) {
                $location->logActivities()->create([
                    'activity' => "Location Phone updated from {$originalValue} to {$currentValue}",
                ]);
            }

            if ($attribute == 'intro' && $originalValue != $currentValue) {
                $location->logActivities()->create([
                    'activity' => "Location Intro updated from {$originalValue} to {$currentValue}",
                ]);
            }

            if ($attribute == 'image' && $originalValue != $currentValue) {
                $location->logActivities()->create([
                    'activity' => "Location Image updated",
                ]);
            }

            if ($attribute == 'location_marker' && $originalValue != $currentValue) {
                $location->logActivities()->create([
                    'activity' => "Location Location Marker updated",
                ]);
            }

            if ($attribute == 'description' && $originalValue != $currentValue) {
                $location->logActivities()->create([
                    'activity' => "Location Description updated from {$originalValue} to {$currentValue}",
                ]);
            }

            if ($attribute == 'meta_title' && $originalValue != $currentValue) {
                $location->logActivities()->create([
                    'activity' => "Location Meta Title updated from {$originalValue} to {$currentValue}",
                ]);
            }

            if ($attribute == 'meta_description' && $originalValue != $currentValue) {
                $location->logActivities()->create([
                    'activity' => "Location Meta Description updated from {$originalValue} to {$currentValue}",
                ]);
            }

            if ($attribute == 'meta_keywords' && $originalValue != $currentValue) {
                $location->logActivities()->create([
                    'activity' => "Location Meta Keywords updated from {$originalValue} to {$currentValue}",
                ]);
            }

            if ($attribute === 'is_popular') {
                if ($originalValue == 0 && $currentValue == 1) {
                    $location->logActivities()->create([
                        'activity' => 'Location popular off to on',
                    ]);
                } elseif ($originalValue == 1 && $currentValue == 0) {
                    $location->logActivities()->create([
                        'activity' => 'Location popular on to off',
                    ]);
                }

            }
        }
    }
    /**
     * Handle the Location "deleted" event.
     */
    public function deleted(Location $location): void
    {
        // You can add code here to handle the "deleted" event.
    }

    /**
     * Handle the Location "restored" event.
     */
    public function restored(Location $location): void
    {
        // You can add code here to handle the "restored" event.
    }

    /**
     * Handle the Location "force deleted" event.
     */
    public function forceDeleted(Location $location): void
    {
        // You can add code here to handle the "force deleted" event.
    }
}
