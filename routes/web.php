<?php

use App\Http\Controllers\AgentLoginController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\TicketController;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [MainController::class, 'index'])->name('home');




Route::prefix('agent')->group(function () {

    Route::get('login', [AgentLoginController::class, 'login'])->name('agent.login')->middleware('guest');
    Route::post('login', [AgentLoginController::class, 'loginAgent'])->name('agent.login')->middleware('guest');
    Route::get('dashboard', [AgentLoginController::class, 'dashboard'])->name('agent.dashboard')->middleware('auth');
    Route::get('logout', [AgentLoginController::class, 'logout'])->name('agent.logout')->middleware('auth');
    
});

Route::prefix('reply')->group(function () {

    Route::post('create', [ReplyController::class, 'create'])->name('reply.create')->middleware('auth');
});

Route::prefix('ticket')->group(function () {
    Route::get('index', [TicketController::class, 'index'])->name('ticket.index')->middleware('auth');
    Route::get('reply/{ticket}', [TicketController::class, 'replyTicket'])->name('ticket.reply')->middleware('auth');


    Route::get('search', [TicketController::class, 'ticketSearch'])->name('ticket.search');
    Route::post('create', [TicketController::class, 'create'])->name('ticket.create');
    Route::get('{ticket}', [TicketController::class, 'viewTicket'])->name('ticket.view');

   
});