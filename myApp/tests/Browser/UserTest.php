<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UserTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     */
    /* @test */

    public function testSignup(): void{
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Login')
                    ->clickLink('Not a user?')
                    ->assertPathIs('/guest')
                    ->type('firstname' , 'Mina')
                    ->type('lastname' , 'Tamer')
                    ->type('username' , 'minatamer')
                    ->type('email' , 'minatamer11@gmail.com')
                    ->press('Submit')
                    ->assertPathIs('/saveUserAccount')
                    ->assertSee('Login');
        });
    }

    public function testLogin(): void{
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Login')
                    ->type('username' , 'minatamer')
                    ->type('password' , 'Mina123')
                    ->press('Login')
                    ->assertPathIs('/user');
        });
    }
    
    public function testBookMeeting(): void{
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Login')
                    ->type('username' , 'minatamer')
                    ->type('password' , 'Mina123')
                    ->press('Login')
                    ->assertPathIs('/user')
                    ->clickLink('Book a Meeting')
                    ->assertSee('To book a meeting')
                    ->type('datetime' , '09-30-202312:59P')
                    ->type('project' , 'Web Development')
                    ->type('projectSummary' , 'summary on the project')
                    ->press('Submit')
                    ->assertDontSee('To book a meeting');

        });
    }

    public function testMoneyTransaction(): void{
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Login')
                    ->type('username' , 'minatamer')
                    ->type('password' , 'Mina123')
                    ->press('Login')
                    ->assertPathIs('/user')
                    ->clickLink('Money Transaction')
                    ->assertSee('Do a Transaction')
                    ->type('receiverUsername' , 'minatamer')
                    ->type('amountToSend' , '200')
                    ->type('nameOnCard' , 'Mina Tamer')
                    ->type('creditCardNumber' , '523484324832')
                    ->type('cvv' , '123')
                    ->press('Submit')
                    ->assertSee('Your Transaction')
                    ->assertDontSee('Receiver username does not exist.');

        });
    }

    public function testViewProjects(): void{
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Login')
                    ->type('username' , 'minatamer')
                    ->type('password' , 'Mina123')
                    ->press('Login')
                    ->assertPathIs('/user')
                    ->clickLink('Projects and Services')
                    ->assertSee('Web Development');
        });
    }
    
    public function testViewFinancialHistory(): void{
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Login')
                    ->type('username' , 'minatamer')
                    ->type('password' , 'Mina123')
                    ->press('Login')
                    ->assertPathIs('/user')
                    ->clickLink('Financial History')
                    ->assertSee('Your Financial History:');
        });
    }

    public function testRedeemBenefits(): void{
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Login')
                    ->type('username' , 'minatamer')
                    ->type('password' , 'Mina123')
                    ->press('Login')
                    ->assertPathIs('/user')
                    ->clickLink('Benefits')
                    ->assertSee('Your Benefits:')
                    ->assertSourceHas('<table class="table table-bordered bg-white">');
            
            $elementsArray = $browser->elements('.table-bordered tr');
            $numberOfRows = count($elementsArray);

            for ($rowIndex = 1; $rowIndex < $numberOfRows; $rowIndex++) {
                $benefitID = $browser->text("table tr:nth-child($rowIndex) td:first-child");
                $browser->type('benefit' , $benefitID)
                        ->press('Redeem');
            }
        });
    }

    public function testReportProblem(): void{
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Login')
                    ->type('username' , 'minatamer')
                    ->type('password' , 'Mina123')
                    ->press('Login')
                    ->assertPathIs('/user')
                    ->clickLink('Report Problem')
                    ->assertSee('Report a Problem')
                    ->type('problemTitle' , 'title of problem')
                    ->type('problemDescription' , 'description of problem')
                    ->press('Submit')
                    ->assertPathIs('/user');
        });
    }

    public function testReportFeedback(): void{
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Login')
                    ->type('username' , 'minatamer')
                    ->type('password' , 'Mina123')
                    ->press('Login')
                    ->assertPathIs('/user')
                    ->clickLink('Report Feedback')
                    ->assertSee('Provide Feedback')
                    ->type('feedbackTitle' , 'title of feedback')
                    ->type('feedbackDescription' , 'description of feedback')
                    ->press('Submit')
                    ->assertPathIs('/user');
        });
    }

    public function testChangePassword(): void{
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Login')
                    ->type('username' , 'minatamer')
                    ->type('password' , 'Mina123')
                    ->press('Login')
                    ->assertPathIs('/user')
                    ->type('password' , 'newpassword')
                    ->press('Change Password')
                    ->assertPathIs('/user/')
                    ->assertSee('newpassword')
                    //change it back to not affect other tests
                    ->type('password' , 'Mina123')
                    ->press('Change Password')
                    ->assertPathIs('/user/');
        });
    }

    public function testChangeMobile(): void{
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Login')
                    ->type('username' , 'minatamer')
                    ->type('password' , 'Mina123')
                    ->press('Login')
                    ->assertPathIs('/user')
                    ->type('mobile' , '01228414444')
                    ->click('#changeMobileButton')
                    ->assertPathIs('/user/')
                    ->assertSee('01228414444');
        });
    }
    public function testEditSlot(): void{
        //this should success if bookmeeting test succeeds
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Login')
                    ->type('username' , 'minatamer')
                    ->type('password' , 'Mina123')
                    ->press('Login')
                    ->assertPathIs('/user')
                    ->assertSourceHas('<table class="table table-bordered bg-white">');
            
            $elementsArray = $browser->elements('.table-bordered tr');
            $numberOfRows = count($elementsArray);
            $numberOfRows--;
            $slotID = $browser->text("table tr:nth-child($numberOfRows) td:first-child");
            $browser->type('slotID' , $slotID)
                    ->type('newDescription' , 'edited description for slot')
                    ->press('Submit')
                    ->assertPathIs('/user/');
            
        
        });
    }

    public function testCancelSlot(): void{
        //this should success if bookmeeting test succeeds
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Login')
                    ->type('username' , 'minatamer')
                    ->type('password' , 'Mina123')
                    ->press('Login')
                    ->assertPathIs('/user')
                    ->assertSourceHas('<table class="table table-bordered bg-white">');
            
            $elementsArray = $browser->elements('.table-bordered tr');
            $numberOfRows = count($elementsArray);
            $numberOfRows--;
            $slotID = $browser->text("table tr:nth-child($numberOfRows) td:first-child");
            $browser->type('slot' , $slotID)
                    ->press('Cancel Slot')
                    ->assertPathIs('/user/');
            
        
        });
    }

    public function testSignOut(): void{
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Login')
                    ->type('username' , 'minatamer')
                    ->type('password' , 'Mina123')
                    ->press('Login')
                    ->assertPathIs('/user')
                    ->clickLink('Sign Out')
                    ->assertSee('Login')
                    ->visit('/user')
                    ->assertSee('Cannot access this page');
        });
    }

    /*public function testForgetPassword(): void{
        //this should work if the mail part of the .env file is set correctly
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Login')
                    ->clickLink('Forgot Password')
                    ->assertSee('Forgot Password')
                    ->type('email' , 'minatamer11@gmail.com')
                    ->press('Get code')
                    ->assertDontSee('Mail doesnt exist');

        });
    }*/

    

}
