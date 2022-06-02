<?php
// Bogdan Arsic 329/19
// Komanda koja ce update-ovati aktivnost aukcija na svaka 24h
namespace App\Console\Commands;

use App\Http\Controllers\nikola\EmailController;
use Illuminate\Console\Command;
use App\Models\bogdan\SveAukcije;
use App\Models\bogdan\SviKorisnici;

class AutoDatabaseUpdateAuctions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'AutoDatabaseUpdate:Auctions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Artisan command to update auctions every day';

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
        $sveAukcije = SveAukcije::all();
        date_default_timezone_set("Europe/Belgrade");
        $ec = new EmailController();
        foreach ($sveAukcije as $aukcija) {
            if ($aukcija->Duration == 0) {
                if ($aukcija->IsActive == 1) {
                    $ec->sendAuctionInfo($aukcija->IDAuc);
                }
                $aukcija->IsActive = 0;
            }
            if ($aukcija->Duration > 0) {
                $aukcija->Duration--;
            }
            $aukcija->save();
        }

        $sviKorisnici = SviKorisnici::all();
        foreach ($sviKorisnici as $korisnik) {
            if ($korisnik->FlagHotAuctions == '1' && $korisnik->IsBanned == '0') {
                $ec->sendNewsletter($korisnik->IDUser);
            }
        }
        echo 'Successfull Auction Table Update|' . date("Y-m-d H:i:s", time()) . '||';
    }
}
