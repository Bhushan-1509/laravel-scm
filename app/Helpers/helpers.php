<?php

use SimpleSoftwareIO\QrCode\Facades\QrCode;
use BaconQrCode\Writer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;

if (!function_exists('settings')) {
    function settings() {
        $settings = cache()->remember('settings', 24*60, function () {
            //return \Modules\Setting\Entities\Setting::firstOrFail();
        });

        return $settings;
    }
}

if(!function_exists('generateQrCode')){
    function generateQrCode($inputString)
    {
        $svgImageBackend = new SvgImageBackEnd();

        $rendererStyle = new RendererStyle(200, 0);

        $imageRenderer = new ImageRenderer($rendererStyle, $svgImageBackend);

        $writer = new Writer($imageRenderer);
        $qrCode = $writer->writeString($inputString);

        return $qrCode;
    }
}

if(!function_exists('generatePincode')){
    function generatePincode($length = 4) {
        $pin = "";
        for ($i = 0; $i < $length; $i++) {
            $pin .= mt_rand(0, 9);
        }
        return $pin;
    }
}

if(!function_exists('generateGstNo')){
    function generateGstNo() {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $gst_number = 'GST';
        for ($i = 0; $i < 10; $i++) {
            $gst_number .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $gst_number;
    }
}

if (!function_exists('format_currency')) {
    function format_currency($value, $format = true) {
        if (!$format) {
            return $value;
        }

        $settings = settings();
        $position = $settings->default_currency_position ?? '2';
        $symbol = $settings->currency->symbol ?? ' $';
        $decimal_separator = $settings->currency->decimal_separator ?? '.';
        $thousand_separator = $settings->currency->thousand_separator ?? ',';

        if ($position == 'prefix') {
            $formatted_value = $symbol . number_format((float) $value, 2, $decimal_separator, $thousand_separator);
        } else {
            $formatted_value = number_format((float) $value, 2, $decimal_separator, $thousand_separator) . $symbol;
        }

        return $formatted_value;
    }
}

if (!function_exists('make_reference_id')) {
    function make_reference_id($prefix, $number) {
        $padded_text = $prefix . '-' . str_pad($number, 5, 0, STR_PAD_LEFT);

        return $padded_text;
    }
}

if (!function_exists('array_merge_numeric_values')) {
    function array_merge_numeric_values() {
        $arrays = func_get_args();
        $merged = array();
        foreach ($arrays as $array) {
            foreach ($array as $key => $value) {
                if (!is_numeric($value)) {
                    continue;
                }
                if (!isset($merged[$key])) {
                    $merged[$key] = $value;
                } else {
                    $merged[$key] += $value;
                }
            }
        }

        return $merged;
    }
}
