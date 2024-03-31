<?php

require 'functions.php';

for ($i = 1; $i <= 100; $i++)
{
    echo "<li>". fizzBuzz($i) . "</li>";
}

require 'index.view.php';