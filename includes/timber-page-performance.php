<?php
/**
 * Console Log
 *
 * Takes array of strings and returns a javascript console.log.
 */
function console_log($args, $delimiter = ' ') {
    $s = '<script>console.log("';
    $s.= join($delimiter, $args);
        $s.= '")</script>';

    return $s;
}

/**
 * Stop Timber Timer
 *
 * A timer is started at the beginning of every page load that times how long it
 * takes to generate a page. This function stops the timer and reports the
 * following stats using the console_log function:
 *
 * - How long the page took to generate
 * - How many database queries did it take
 */
function stop_timber_timer() {
    $context = Timber::get_context();

    return console_log([
        'Page generated in ' . Timber\Helper::stop_timer($context['page_stats']),
        get_num_queries() . ' database queries'
    ]);
}
