<?php

namespace App\Observers;

use App\Models\Country;
use App\Models\Coursedetail;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class CoursedetailObserver
{
    /**
     * Handle the Coursedetail "created" event.
     */
    public function created(Coursedetail $coursedetail): void
    {
       // $created_by = Auth::user()->id ?? NULL;
        $coursedetail->logActivities()->create([
            'activity' => 'CourseDetail '.$coursedetail->name.' created',
        ]);
    }

    /**
     * Handle the Coursedetail "updated" event.
     */
    public function updated(Coursedetail $coursedetail): void
    {
        $originalAttributes = $coursedetail->getOriginal();

        foreach ($originalAttributes as $attribute => $originalValue) {
            $currentValue = $coursedetail->$attribute;
            if ($attribute === 'updated_at' && $originalValue != $currentValue) {
                continue;
            }
            if ($attribute == 'course_id' && $originalValue != $currentValue) {
                $oldCourseName = Course::find($originalValue)->name;
                $newCourseName = Course::find($currentValue)->name;
                $coursedetail->logActivities()->create([
                    'activity' =>"Course updated from {$oldCourseName} to {$newCourseName}",
                ]);
            }

            if ($attribute == 'country_id' && $originalValue != $currentValue) {
                $oldCountryName = Country::find($originalValue)->name;
                $newCountryName = Country::find($currentValue)->name;
                $coursedetail->logActivities()->create([
                    'activity' =>"Country updated from {$oldCountryName} to {$newCountryName}",
                ]);
            }
            if ($attribute == 'heading' && $originalValue != $currentValue) {
                $coursedetail->logActivities()->create([
                    'activity' =>"CourseDetail Heading updated from {$originalValue} to {$currentValue}",
                ]);
            }
            if ($attribute == 'summary' && $originalValue != $currentValue) {
                $coursedetail->logActivities()->create([
                    'activity' =>"CourseDetail Summary updated from {$originalValue} to {$currentValue}",
                ]);
            }
            if ($attribute == 'detail' && $originalValue != $currentValue) {
                $coursedetail->logActivities()->create([
                    'activity' =>"CourseDetail Detail updated from {$originalValue} to {$currentValue}",
                ]);
            }
            if ($attribute == 'overview' && $originalValue != $currentValue) {
                $coursedetail->logActivities()->create([
                    'activity' =>"CourseDetail Overview updated from {$originalValue} to {$currentValue}",
                ]);
            }
            if ($attribute == 'whats_included' && $originalValue != $currentValue) {
                $coursedetail->logActivities()->create([
                    'activity' =>"CourseDetail What's included updated from {$originalValue} to {$currentValue}",
                ]);
            }

            if ($attribute == 'pre_requisite' && $originalValue != $currentValue) {
                $coursedetail->logActivities()->create([
                    'activity' =>"CourseDetail Pre-requisite updated from {$originalValue} to {$currentValue}",
                ]);
            }

            if ($attribute == 'who_should_attend' && $originalValue != $currentValue) {
                $coursedetail->logActivities()->create([
                    'activity' =>"CourseDetail Who should Attend updated from {$originalValue} to {$currentValue}",
                ]);
            }

            if ($attribute == 'meta_title' && $originalValue != $currentValue) {
                $coursedetail->logActivities()->create([
                    'activity' =>"CourseDetail Meta Title updated from {$originalValue} to {$currentValue}",
                ]);
            }
            if ($attribute == 'meta_keywords' && $originalValue != $currentValue) {
                $coursedetail->logActivities()->create([
                    'activity' =>"CourseDetail Meta Keywords updated from {$originalValue} to {$currentValue}",
                ]);
            }
            if ($attribute == 'meta_description' && $originalValue != $currentValue) {
                $coursedetail->logActivities()->create([
                    'activity' =>"CourseDetail Meta Description updated from {$originalValue} to {$currentValue}",
                ]);
            }

            if ($attribute == 'is_active' && $originalValue != $currentValue) {
                if ($originalValue == 0 && $currentValue == 1) {
                    $coursedetail->logActivities()->create([
                        'activity' => 'CourseDetail status Deactivate to Activated',
                    ]);
                } elseif ($originalValue == 1 && $currentValue == 0) {
                    $coursedetail->logActivities()->create([
                        'activity' => 'CourseDetail status Activate to Deactivated',
                    ]);
                }
            }
        }
    }

    /**
     * Handle the Coursedetail "deleted" event.
     */
    public function deleted(Coursedetail $coursedetail): void
    {
        //
    }

    /**
     * Handle the Coursedetail "restored" event.
     */
    public function restored(Coursedetail $coursedetail): void
    {
        //
    }

    /**
     * Handle the Coursedetail "force deleted" event.
     */
    public function forceDeleted(Coursedetail $coursedetail): void
    {
        //
    }
}
