<?php

namespace Tests\Unit\bogdan;

use Tests\TestCase;
use App\Models\bogdan\SviKorisnici;
use App\Models\stefan\AllExhibitions;

class ChatControllerTest extends TestCase
{
    protected $user;
    protected $exibition1;

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
        $this->user->delete();
    }
    
    public function test_sendMessageSubmit()
    {        
        $requestTest = [
            'userID' => $this->user->IDUser,
            'exhID' => $this->exibition1->IDExh,
            'textMsg' => "Poruka"
        ];

        $response = $this->withSession(['privilegije' => 'Obicni', 'IDUser' => $this->user->IDUser, 'E-mail' => $this->user->E_mail, 'Username' => $this->user->Username])
                         ->withoutMiddleware()
                         ->post('sendMessageSubmit', $requestTest);
        
        $response->assertStatus(302);
        $response->assertRedirect("exhibition/" . $this->exibition1->IDExh);
    }
}
