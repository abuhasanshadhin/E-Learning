<?php

function text_short($text, $limit)
{
    $text = substr($text, 0, $limit);
    $text = substr($text, 0, strrpos($text, ' '));
    $text = $text." . ..";
    return $text;
}

?>