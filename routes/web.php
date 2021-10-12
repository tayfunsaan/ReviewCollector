<?php

use App\Http\Controllers\ExcelController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\UpdateController;

//Home
Route::get('/', [HomeController::class, 'index'])->name('Home');

//Links
Route::get('links', [LinkController::class, 'index'])->name('links');
Route::get('links-edit', [LinkController::class, 'edit'])->name('links.edit');
Route::get('links-delete/{id}', [LinkController::class, 'delete'])->name('links.delete');
Route::get('links-save', [LinkController::class, 'save'])->name('links.save');

//Tables
Route::get('table/{id}', [TableController::class, 'index'])->name('table');

//Update
Route::get('update/{link}/{lang}', [UpdateController::class, 'index'])->name('update');

//Excel
Route::get('excel/single/{id}/{lang}', [ExcelController::class, 'single'])->name('excel.single');
Route::get('excel/all', [ExcelController::class, 'all'])->name('excel.all');
