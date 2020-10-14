<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class UserRegisteredEmail extends Mailable
{
    use Queueable, SerializesModels;
    
    
    private $user;
    

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
                
                ->subject('Conta criada com sucesso!')
                
                /*
                 * Passando a view a variável $user que vei no construtor,
                 * Que é um objeto do Model User.
                 * Dessa forma, eu posso acessar os atributos do usuário que acabou de se registrar
                 */
                ->view('emails.user-registered')->with(['user' => $this->user]);
    }
}
