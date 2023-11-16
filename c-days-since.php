<?php
/*
Plugin Name: ✅ Days Since
Plugin URI: #
Description: Usage: <code>[c_days_since date='1/1/1990' format='true']</code> <code>[c_days_since date='Jan 1 1990' format='false']</code>
Author: conner
Author URI: #
version: 1.0.0
*/

/**
 * Prevent direct access to this file.
 */
if (!defined('ABSPATH')) {
    die;
}

add_shortcode('cwp_days_since', 'cwp_register_shortcode_days_since');

function cwp_register_shortcode_days_since($atts)
{
    $format_number = false;

    if (isset($atts['format'])) {
        $att_format = $atts['format'];
        $format_number = ($att_format == 'true' || $att_format == 'yes');
    }

    if (isset($atts['date'])) {
        $date = $atts['date'];

        $dateFormats = [
            'M d Y',
            'm/d/Y',
            'm-d-Y',
            'd M Y',
            'M d Y',
            'd/m/Y',
            'd-m-Y',
            'd M Y',
        ];

        foreach ($dateFormats as $format) {
            $dateTime = DateTime::createFromFormat($format, $date);
            if ($dateTime !== false) {

                $currentDate = new DateTime();
                $interval = $currentDate->diff($dateTime);
                $days = $interval->days;
                return $format_number ? number_format($days) : $days;
            }
        }

        return "Invalid date format";
    }
    return "Usage: <code>[c_days_since date='1/1/1990' format='true']</code> <code>[c_days_since date='Jan 1 1990' format='false']</code>";
}
