<?php
// Bogdan Arsic 329/19
// Komanda koja ce ubdate-ovati aktivnost izlozbi svaki minut
namespace App\Console\Commands;

use App\Http\Controllers\nikola\EmailController;
use Illuminate\Console\Command;
use App\Models\bogdan\SveIzlozbe;

class AutoDatabaseUpdateExhibition extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'AutoDatabaseUpdate:Exhibition';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Artisan command to update exhibitions to active when nedded';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $sveIzl = SveIzlozbe::all();
        date_default_timezone_set("Europe/Belgrade");
        $ec = new EmailController();
        foreach ($sveIzl as $jedna) {
            if ($jedna->IsActive == '0') {
                if (strtotime($jedna->Date) <= time() && strtotime($jedna->Date) + (60 * 60 * 24 * 7) > time()) {
                    $jedna->IsActive = '1';
                    $jedna->save();
                }
            } else {
                if (strtotime($jedna->Date) + (60 * 60 * 24 * 7) <= time()) {
                    if ($jedna->IsActive == 1) {
                        $ec->sendExhibitionInfo($jedna->IDExh);
                    }
                    $jedna->IsActive = '0';
                    $jedna->save();
                }
            }
        }
        echo "Successfull Ehxibition Table Update|" . date("Y-m-d H:i:s", time()) . '||';
    }
}
