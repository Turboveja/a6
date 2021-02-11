<?php

namespace App\Jobs;

use App\Mail\EnviarMailDesgloseConciertoPromotor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

/**
 * Class EnviarMailDesglosePromotorJob
 * @package App\Jobs
 */
class EnviarMailDesglosePromotorJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        \Mail::to($this->concierto->promotor->email)->send(new EnviarMailDesgloseConciertoPromotor($this->concierto, $this->desglose));
    }
}
