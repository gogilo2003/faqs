<?php
if (!function_exists('get_questions')) {
    function get_questions()
    {
        return Ogilo\Faqs\Models\Question::where('published',1)->get();
    }
}
