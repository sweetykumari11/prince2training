<?php

namespace App\Observers;
use App\Models\PageContent;
class PagecontentObserver
{
    public function created(PageContent $pagecontent): void
    {
        $pagecontent->logActivities()->create([
            'activity' => 'Pagecontent '.$pagecontent->page_name . ' created',
        ]);
    }
    public function updated(PageContent $pagecontent): void
    {
        $originalAttributes = $pagecontent->getOriginal();
        foreach ($originalAttributes as $attribute => $originalValue) {
            $currentValue = $pagecontent->$attribute;

            if ($attribute === 'updated_at' && $originalValue != $currentValue) {

              continue;
            }
            if ($attribute == 'page_name' && $originalValue != $currentValue) {

                $pagecontent->logActivities()->create([
                    'activity' =>"Pagecontent Name updated from {$originalValue} to {$currentValue}",
                ]);
            }
            if ($attribute == 'section' && $originalValue != $currentValue) {

                $pagecontent->logActivities()->create([
                    'activity' =>"Pagecontent section updated from {$originalValue} to {$currentValue}",
                ]);
            }
            if ($attribute == 'sub_section' && $originalValue != $currentValue) {
                $pagecontent->logActivities()->create([
                    'activity' =>"Pagecontent sub section  updated from {$originalValue} to {$currentValue}",
                ]);
            }

            if ($attribute == 'heading' && $originalValue != $currentValue) {
                $pagecontent->logActivities()->create([
                    'activity' =>"Pagecontent heading updated from {$originalValue} to {$currentValue}",
                ]);
            }

            if ($attribute == 'content' && $originalValue != $currentValue) {
                $pagecontent->logActivities()->create([
                    'activity' =>"Pagecontent content updated from {$originalValue} to {$currentValue}",
                ]);
            }
            if ($attribute == 'page_tag_line' && $originalValue != $currentValue) {
                $pagecontent->logActivities()->create([
                    'activity' =>"Pagecontent page tag line updated from {$originalValue} to {$currentValue}",
                ]);
            }
            if ($attribute == 'image' && $originalValue != $currentValue) {
                $pagecontent->logActivities()->create([
                    'activity' =>"Pagecontent image is updated",
                ]);
            }
            if ($attribute == 'image_alt' && $originalValue != $currentValue) {
                $pagecontent->logActivities()->create([
                    'activity' =>"Pagecontent image alt is updated",
                ]);
            }
            if ($attribute == 'icon' && $originalValue != $currentValue) {
                $pagecontent->logActivities()->create([
                    'activity' =>"Pagecontent icon is  updated",
                ]);
            }
            if ($attribute == 'icon_alt' && $originalValue != $currentValue) {
                $pagecontent->logActivities()->create([
                    'activity' =>"Pagecontent icon alt is updated",
                ]);
            }
            if ($attribute == 'heading_content1' && $originalValue != $currentValue) {
                $pagecontent->logActivities()->create([
                    'activity' =>"Pagecontent heading content1 updated from {$originalValue} to {$currentValue}",
                ]);
            }
            if ($attribute == 'heading_subcontent1' && $originalValue != $currentValue) {
                $pagecontent->logActivities()->create([
                    'activity' =>"Pagecontent heading subcontent1 updated from {$originalValue} to {$currentValue}",
                ]);
            }
            if ($attribute == 'heading_content2' && $originalValue != $currentValue) {
                $pagecontent->logActivities()->create([
                    'activity' =>"Pagecontent heading content2 updated from {$originalValue} to {$currentValue}",
                ]);
            }
            if ($attribute == 'heading_subcontent2' && $originalValue != $currentValue) {
                $pagecontent->logActivities()->create([
                    'activity' =>"Pagecontent heading subcontent2 updated from {$originalValue} to {$currentValue}",
                ]);
            }
            if ($attribute == 'heading_content3' && $originalValue != $currentValue) {
                $pagecontent->logActivities()->create([
                    'activity' =>"Pagecontent heading content3 updated from {$originalValue} to {$currentValue}",
                ]);
            }
            if ($attribute == 'heading_subcontent3' && $originalValue != $currentValue) {
                $pagecontent->logActivities()->create([
                    'activity' =>"Pagecontent heading subcontent3 updated from {$originalValue} to {$currentValue}",
                ]);
            }

            if ($attribute == 'heading_content4' && $originalValue != $currentValue) {
                $pagecontent->logActivities()->create([
                    'activity' =>"Pagecontent heading content4 updated from {$originalValue} to {$currentValue}",
                ]);
            }
            if ($attribute == 'heading_subcontent4' && $originalValue != $currentValue) {
                $pagecontent->logActivities()->create([
                    'activity' =>"Pagecontent heading subcontent4 updated from {$originalValue} to {$currentValue}",
                ]);
            }

        }
    }
}
