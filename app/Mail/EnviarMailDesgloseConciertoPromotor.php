<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class EnviarMailDesgloseConciertoPromotor
 * @package App\Mail
 */
class EnviarMailDesgloseConciertoPromotor extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var
     */
    public $concierto, $desglose;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Concierto $concierto, Desglose $desglose)
    {
        $this->concierto = $concierto;
        $this->desglose = $desglose;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(trans('strings.subject_mail_desglose_concierto'))
            ->view('mails.mail_desglose_concierto');
    }
}
