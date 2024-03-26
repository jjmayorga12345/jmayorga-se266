<?php

function dd($data)
{
    echo '<pre>';
    die(var_dump($data));
    echo '</pre>';

}

function ageCheck($data)
{
    if ($data > 21)
    {
        echo 'You are in!';
    }
    else if ($data < 21)
    {
        echo 'you are not in';
    }

}

