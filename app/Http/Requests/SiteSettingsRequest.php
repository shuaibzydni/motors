<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SiteSettingsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'siteName' => 'required|string|max:50',
            'siteDescription' => 'required|string',
            'siteEmail' => 'required|email',
            'sitePhone' => 'required|string',
            'appGooglePlay' => 'required|url',
            'appAppStore' => 'required|url',
            'aboutUs' => 'required|string',
            'contactUs' => 'required|string',
            'terms' => 'required|string',
            'homePageTitle' => 'required|string',
            'homePageSubTitle' => 'required|string',
            'topRecommendationHeader' => 'required|string',
            'howItWorkHeader' => 'required|string',
             'hitw_first_q' => 'required|string',
             'hitw_second_q' => 'required|string',
             'hitw_third_q' => 'required|string',
             'hitw_first_a' => 'required|string',
             'hitw_second_a' => 'required|string',
             'hitw_third_a' => 'required|string',
        ];
    }
}
