<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\NexmoMessage;

class StoreReceiveNewOrder extends Notification {

    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct() {
        //
    }

    /**
     * Get the notification's delivery channels.
     * 'database' => Salva no banco de dados
     * 'mail' => Envia e-mail
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable) {
        /*
         * ['nexmo'] => utilizado para enviar sms..... antes tem que rodar no terminal: 
         * composer require laravel/nexmo-notification-channel
         * 
         */
//        return ['database', 'mail', 'nexmo']; 

        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable) {
        return (new MailMessage)
                        ->subject('Novo pedido recebido')
                        ->line('Você recebeu um novo pedido na loja.')
                        ->action('Ver pedido', route('admin.orders.my'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable) {
        /*
         * Será salvo na coluna 'data' da tabela 'notifications'
         */
        return [
            'message' => 'Você tem um novo pedido'
        ];
    }

    /**
     * Envia sms (nexmo) se a function via contiver a chave '[nexmo]'
     */
    public function toNexmo($notifiable) {

        return (new NexmoMessage)
                        ->content('Você recebeu um novo pedido')
                        ->from('5541996286883')
                        ->unicode(); //Para caractéres especiais
    }

}
