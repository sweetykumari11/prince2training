<?php

namespace App\Observers;

use App\Models\Region;
use App\Models\Country;
use Illuminate\Support\Facades\Auth;

class RegionObserver
{
    /**
     * Handle the Region "created" event.
     */
    public function created(Region $region): void
    {
        //$created_by =  ?? NULL;
        $region->logActivities()->create([
            'activity' => 'Region ' . $region->name . ' created',
        ]);
    }

    /**
     * Handle the Region "updated" event.
     */
    public function updated(Region $region): void
    {
        $originalAttributes = $region->getOriginal();

        foreach ($originalAttributes as $attribute => $originalValue) {
            $currentValue = $region->$attribute;

            if ($attribute === 'updated_at' && $originalValue != $currentValue) {
                continue;
            }

            if ($attribute == 'name' && $originalValue != $currentValue) {
                $region->logActivities()->create([
                    'activity' => "Region Name updated from {$originalValue} to {$currentValue}",
                ]);
            }

            // Add logging for the "country_id" attribute specifically
            if ($attribute === 'country_id' && $originalValue != $currentValue) {
                $oldCountryName = Country::find($originalValue)->name;
                $newCountryName = Country::find($currentValue)->name;
                $region->logActivities()->create([
                    'activity' => "Region Country updated from {$oldCountryName} to {$newCountryName}",
                ]);
            }
        }
    }

    /**
     * Handle the Region "deleted" event.
     */
    public function deleted(Region $region): void
    {
        // You can add code here to handle the "deleted" event.
    }

    /**
     * Handle the Region "restored" event.
     */
    public function restored(Region $region): void
    {
        // You can add code here to handle the "restored" event.
    }

    /**
     * Handle the Region "force deleted" event.
     */
    public function forceDeleted(Region $region): void
    {
        // You can add code here to handle the "force deleted" event.
    }
}
