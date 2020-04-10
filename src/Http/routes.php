<?php
/**
 * User: fabio
 * Date: 10.04.20
 * Time: 11:50
 */
use Illuminate\Support\Facades\Route;

Route::get('/faq', 'FaqController@index')->name('faq.index');
Route::get('/faq/antwort-{id}-{slug}', 'FaqController@show')->name('faq.show');
Route::get('/faq/suche', 'FaqController@search')->name('faq.search');
Route::get('/faq/{slug}-{id}', 'FaqController@category')->name('faq.category')->where('id', '[1-9]+');;
Route::post('/faq/like/{id}', 'FaqController@like')->name('faq.like');
Route::post('/faq/dislike/{id}', 'FaqController@dislike')->name('faq.dislike');
