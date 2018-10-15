<?php

namespace Corals\Foundation\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class LanguageController extends PublicBaseController
{
    /**
     * Set locale if it's allowed.
     * @param Request $request
     * @param $locale
     * @return \Illuminate\Http\RedirectResponse
     */
    public function setLocale(Request $request, $locale)
    {
        // Check if is allowed and set default locale if not
        if (!\Language::allowed($locale)) {
            $locale = config('app.locale');
        }

        \Language::setLanguage($locale);

        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return string
     */
    public function datatableLanguage(Request $request)
    {
        $language = \Language::getNameEnglish(\App::getLocale());

        $i18nArray = \Cache::remember('datatable_i18n_' . $language, 1440, function () use ($language) {
            $languagePath = "assets/corals/plugins/datatables.net/i18n/$language.lang";

            if (file_exists(public_path($languagePath))) {
                $languagePath = public_path($languagePath);

                $content = File::get($languagePath, true);

                $data = json_decode(cleanJSONFileContent($content), true);

                return $data;
            } else {
                return '';
            }
        });

        return $i18nArray;
    }
}
