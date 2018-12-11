<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FormController extends Controller
{
    // row
    public function row($form)
    {
        return "<div class='row'>$form</div>";
    }
    // input wrapHalf
    public function wrapHalf($input)
    {
        return "<div class='col-md-6'><div class='form-group'>$input</div></div>";
    }
    // input wrap
    public function wrap($input)
    {
        return "<div class='form-group'>$input</div>";
    }
    // input text
    public function inputText($name,$value,$attributes,$errors)
    {

    }
    // input select
    // input date
    // input nbr
    // input file
}
