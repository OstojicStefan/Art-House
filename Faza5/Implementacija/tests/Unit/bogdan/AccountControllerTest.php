<?php

namespace Tests\Unit\bogdan;

use Tests\TestCase;
use App\Models\stefan\AllImages;
use App\Models\bogdan\SviKorisnici;
use App\Models\stefan\AllAuctions;

class AccountControllerTest extends TestCase
{
    protected $user;
    protected $image;
    protected $image2;
    protected $auction;
    protected $auction2;

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

            $this->image = AllImages::factory()->create([
                'Imagee' => 'Mona Liza',
                'IDUser' => $this->user->IDUser,
                'IsPhysical' => 1
            ]);   

            $this->image2 = AllImages::factory()->create([
                'Imagee' => 'Girl with Pearl Earing',
                'IDUser' => $this->user->IDUser,
                'IsPhysical' => 1
            ]); 
    
            $this->auction = AllAuctions::factory()->create([
                'Name' => 'aukcija Prefinjena',
                'Description' => 'Desc',
                'Author' => 'Stole',
                'Year' => "2022",
                'IDIm' => $this->image->IDIm,
                //'IDTag' => $tag->IDTag,
                'Price' => 1111,
                'Duration' => 22,
                'IsActive'=> 1,
                'Owner' => $this->user->IDUser,
                'ViewCount' => 2,
                'HighestBidder'=> $this->user->IDUser
            ]); 

            $this->auction2 = AllAuctions::factory()->create([
                'Name' => 'aukcija Barbarska',
                'Description' => 'Lepa',
                'Author' => 'Bole',
                'Year' => "1999",
                'IDIm' => $this->image2->IDIm,
                //'IDTag' => $tag->IDTag,
                'Price' => 1111,
                'Duration' => 9,
                'IsActive'=> 1,
                'Owner' => $this->user->IDUser,
                'ViewCount' => 2,
                'HighestBidder'=> $this->user->IDUser
            ]);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->auction->delete();
        $this->auction2->delete();
        $this->image->delete();
        $this->image2->delete();
        $this->user->delete();
    }

    public function test_myAccount()
    {
        $response = $this->withSession(['privilegije' => 'Obicni', 'IDUser' => $this->user->IDUser, 'Username' => $this->user->Username])
                         ->withoutMiddleware()
                         ->get('/myAccount');
                    
        $response->assertSee('Mona Liza');
        $response->assertSee('Girl with Pearl Earing');
        $response->assertSee('aukcija Barbarska');
        $response->assertSee('aukcija Prefinjena');
        $response->assertSee('bogdan321');
        $response->assertStatus(200);
    }

    public function test_myAccountSettings()
    {
        $response = $this->withSession(['privilegije' => 'Obicni', 'IDUser' => $this->user->IDUser, 'E-mail' => $this->user->E_mail, 'Username' => $this->user->Username])
                         ->withoutMiddleware()
                         ->get('/myAccount/settings');
                    
        $response->assertSee($this->user->Username);
        $response->assertSee($this->user->E_mail);
        $response->assertSee($this->user->Balance);
        $response->assertStatus(200);
    }
    
    public function test_settingsSubmit()
    {
        $requestTest = [
            'hotAuctions' => 1,
            'notifyEnding' => 1,
            'userID' => $this->user->IDUser
        ];
        
        $response = $this->withSession(['privilegije' => 'Obicni', 'IDUser' => $this->user->IDUser, 'E-mail' => $this->user->E_mail, 'Username' => $this->user->Username])
                         ->withoutMiddleware()
                         ->post('settingsSubmit', $requestTest);
        
        $response->assertStatus(302);
        $response->assertRedirect("myAccount/settings");
        $response->assertSee($this->user->Name);
    }
}
