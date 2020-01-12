<?php
use Illuminate\Support\Facades\Route;

Route::group(['middleware'=>'web','as'=>'admin','prefix'=>'admin','namespace'=>'Ogilo\Faqs\Http\Controllers'],function(){
    Route::group(['middleware'=>'auth:admin','as'=>'-faqs','prefix'=>'faqs'],function(){
        Route::get('',['uses'=>'QuestionController@getQuestions']);
        Route::get('add',['as'=>'-add','uses'=>'QuestionController@getAdd']);
        Route::post('add',['as'=>'-add','uses'=>'QuestionController@postAdd']);
        Route::get('edit/{id?}',['as'=>'-edit','uses'=>'QuestionController@getEdit']);
        Route::post('edit',['as'=>'-edit-post','uses'=>'QuestionController@postEdit']);
        Route::post('publish',['as'=>'-publish','uses'=>'QuestionController@postPublish']);
        Route::post('delete',['as'=>'-delete','uses'=>'QuestionController@postDelete']);
    });
});

Route::group([
    'middleware'=>'web','namespace'=>'Ogilo\Faqs\Http\Controllers'],function(){
    Route::get('faqs',['as'=>'faqs','uses'=>'HomeController@getQuestions']);
    Route::get('faq/{slug}/{page_name?}',['as'=>'faq','uses'=>'HomeController@getQuestion']);
});
