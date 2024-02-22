<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function country()
    {
        $json_data = file_get_contents('https://www.theknowledgeacademy.com/_engine/scripts/get-country-location-continent-region.php');
        $data = json_decode($json_data);

        if ($data->success = 1) {
            $this->storeContinents($data->continent);
        }
    }
    public function storeContinents($continent)
    {
        foreach ($continent as $continents) {
            $this->storeZones($continents->zone);
        }
    }
    public function storeZones($zone)
    {
        foreach ($zone as $zones) {

            $this->storeCountries($zones->country);
        }
    }

    public function storeCountries($countries)
    {
        foreach ($countries as $tkaid => $country) {
            $object = Country::updateOrCreate(
                [
                    'country_code' => $country->countryCode,
                    'tka_id' => $tkaid
                ],
                [
                    'name' => $country->name,
                    'currency' => $country->currency,
                    'currency_currency_title' => $country->currencyTitle,
                    'currency_symbol' => $country->currencySymbol,
                    'currency_symbol_html' => $country->currencySymbolHtml,
                    'iso3' => $country->iso3,
                    'sales_tax_label' => $country->salesTaxLabel,
                    'charge_vat' => $country->chargeVAT,
                    'vat_percentage' => $country->vatAmount,
                    'vat_amount_elearning' => $country->vatAmountElearning,
                    'conversion_required' => $country->conversionRequired,
                    'exchange_rate' => $country->exchangeRate,
                    'opening_hours' => $country->openingHours,
                    'opening_days' => $country->openingDays,
                    'date_format' => $country->dateFormat,
                    'isAdvert' => $country->isAdvert,
                    'map_id' => $country->mapId
                ]
            );

            $object->save();
        }
    }


    public function countrychange(Request $request)
    {
        $request->session()->get('country');
        return redirect()->route('dashboard.index');
    }
}
