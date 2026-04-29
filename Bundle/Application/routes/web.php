<?php

use App\Models\Contact;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    //TODO: временное
//    $c = new Contact();
//    $c->temp();
//    $c = new \App\Models\User();
//    dd($c);
    //return view('welcome');
    $contact = Contact::query()->first();
    dd($contact);
});
