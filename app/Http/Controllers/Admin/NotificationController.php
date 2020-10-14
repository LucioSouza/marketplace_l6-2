<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller {
    /*
     * Recupera o usuário logado e retorna as notificações não lidas do mesmo
     */

    public function index() {


        /*
         * Recuperando uma collection de todas as notificações do usuário logado que não foram lidas
         */
        $userUnreadNotifications = auth()->user()->unreadNotifications;

        return view('admin.notifications.index', compact('userUnreadNotifications'));
    }

    public function markAllAsRead() {

        /*
         * Recuperando uma collection de todas as notificações do usuário logado que não foram lidas
         */
        $userUnreadNotifications = auth()->user()->unreadNotifications;


        /*
         * Através do método 'each' eu atualizado cada notificação de não lida para lida
         */
        $userUnreadNotifications->each(function ($notification) {
            $notification->markAsRead();
        });


        flash('Todas as notificações foram marcadas como lida')->success();
        return redirect()->back();
    }
    
    public function markSingleRead($notification) {
        
        
        $notification = auth()->user()->notifications()->find($notification);
        
        $notification->markAsRead();
        
        
        flash('Notificação foi marcada como lida')->success();
        return redirect()->back();
    }

}
