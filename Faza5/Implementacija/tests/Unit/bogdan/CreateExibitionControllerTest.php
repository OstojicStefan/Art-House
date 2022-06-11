<?php
// Bogdan Arsic 329/19
// Testovi za stefan\CreateExibitionController
namespace Tests\Unit\bogdan;

use Tests\TestCase;
use App\Models\bogdan\SviKorisnici;
use App\Models\stefan\AllExhibitions;
use App\Models\stefan\AllImages;

class CreateExibitionControllerTest extends TestCase
{
    protected $user;
    protected $exibition1;
    protected $image1;
    protected $image2;

    protected function setUp(): void
    {
        parent::setUp();
            $this->user = SviKorisnici::factory()->create([
                'Username'=>"bogdan321",
	            'E_mail' => "bog@gmail.com",
	            'Balance' => 11,
	            'CardNmber' => 777,
	            'Password' => "xxx",
	            'IsBanned' => 0,
	            'CCV' => 222,
	            'FlagHotAuctions' => 0,
	            'FlagNotifyEnding' => 0
            ]);

            $this->image1 = AllImages::factory()->create([
                'Imagee' => "Mona Liza",
                'IDUser' => $this->user->IDUser,
                'IsPhysical' => 1
            ]);   

            $this->image2 = AllImages::factory()->create([
                'Imagee' => 'Girl with Pearl Earing',
                'IDUser' => $this->user->IDUser,
                'IsPhysical' => 1
            ]);
    
            $this->exibition1 = AllExhibitions::factory()->create([
                'Name' => 'egzibicija 1',
                'ImageNumber' => 1,
                'Song' => 'egz1 song',
                'FlagDonations' => 1,
                'AccumulatedDonations' => 0,
                'Date' => '11.12.2022',
                'IsActive' => 1,
                'IDUser'=> $this->user->IDUser,
                'Rating' => 1,
                'RatingCount' => 5
            ]); 
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->exibition1->delete();
        $this->image1->delete();
        $this->image2->delete();
        $this->user->delete();
    }
    
    //test za createExhibition
    public function test_createExhibition()
    {        
        $response = $this->withSession(['privilegije' => 'Obicni', 'IDUser' => $this->user->IDUser, 'E-mail' => $this->user->E_mail, 'Username' => $this->user->Username])
                         ->withoutMiddleware()
                         ->get('createExhibition');
        
        $response->assertSee('Mona Liza');
        $response->assertSee('Girl with Pearl Earing');
        $response->assertStatus(200);
    }
}
