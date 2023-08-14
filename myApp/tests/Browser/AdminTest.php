<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\Projects_and_Services;

class SuperAdminTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     */
    /* @test */
    public function testLogin(): void{
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Login')
                    ->type('username' , 'admin')
                    ->type('password' , 'admin')
                    ->press('Login')
                    ->assertPathIs('/admin');
        });
    }
    
    public function testViewProblems(): void{
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Login')
                    ->type('username' , 'admin')
                    ->type('password' , 'admin')
                    ->press('Login')
                    ->assertPathIs('/admin')
                    ->clickLink('View Problems')
                    ->assertSee('Problems reported from all the Users:');
        });
    }

    public function testViewFeedback(): void{
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Login')
                    ->type('username' , 'admin')
                    ->type('password' , 'admin')
                    ->press('Login')
                    ->assertPathIs('/admin')
                    ->clickLink('View Feedback')
                    ->assertSee('Feedback from all the Users:');
        });
    }

    public function testSignOut(): void{
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Login')
                    ->type('username' , 'admin')
                    ->type('password' , 'admin')
                    ->press('Login')
                    ->assertPathIs('/admin')
                    ->clickLink('Sign Out')
                    ->assertSee('Login')
                    ->visit('/admin')
                    ->assertSee('Cannot access this page');
        });
    }

    public function testViewUser(): void{
        //this test will assume that there is atleast one user registered on the system
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Login')
                    ->type('username' , 'admin')
                    ->type('password' , 'admin')
                    ->press('Login')
                    ->assertPathIs('/admin')
                    ->clickLink('Manage Users')
                    ->assertSee('List of all the Users:')
                    ->assertSourceHas('<table class="table table-bordered bg-white">');
            
            $elementsArray = $browser->elements('.table-bordered tr');
            $numberOfRows = count($elementsArray);
            $numberOfRows--;
            $userID = $browser->text("table tr:nth-child($numberOfRows) td:first-child");
            $browser->type('userID' , $userID)
                    ->press('View')
                    ->assertPathIs('/viewUserData-Admin');            
        });
    }

    public function testAddUser(): void{
        //this test will assume that there is atleast one user registered on the system
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Login')
                    ->type('username' , 'admin')
                    ->type('password' , 'admin')
                    ->press('Login')
                    ->assertPathIs('/admin')
                    ->clickLink('Manage Users')
                    ->assertSee('List of all the Users:')
                    ->type('username' , 'mosalahLV')
                    ->type('password' , 'mo123')
                    ->type('email' , 'mo@gmail.com')
                    ->press('Add')
                    ->assertPathIs('/addUser-Admin');      
        });
    }
    public function testAssignManager(): void{
        //this test will assume that there is atleast one user registered on the system
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Login')
                    ->type('username' , 'admin')
                    ->type('password' , 'admin')
                    ->press('Login')
                    ->assertPathIs('/admin')
                    ->clickLink('Manage Users')
                    ->assertSee('List of all the Users:')
                    ->assertSourceHas('<table class="table table-bordered bg-white">');
            
            $elementsArray = $browser->elements('.table-bordered tr');
            $numberOfRows = count($elementsArray);
            $numberOfRows--;
            $userID = $browser->text("table tr:nth-child($numberOfRows) td:first-child");
            $browser->type('userID3' , $userID)
                    ->type('managerEmail' , 'ahmed@gmail.com')
                    ->press('Submit')
                    ->assertPathIs('/assignManager-Admin') 
                    ->assertSee('ahmed@gmail.com');    
        });
    }

    public function testDeleteUser(): void{
        //this test will assume that there is atleast one user registered on the system
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Login')
                    ->type('username' , 'admin')
                    ->type('password' , 'admin')
                    ->press('Login')
                    ->assertPathIs('/admin')
                    ->clickLink('Manage Users')
                    ->assertSee('List of all the Users:')
                    ->assertSourceHas('<table class="table table-bordered bg-white">');
            
            $elementsArray = $browser->elements('.table-bordered tr');
            $numberOfRows = count($elementsArray);
            $numberOfRows--;
            $userID = $browser->text("table tr:nth-child($numberOfRows) td:first-child");
            $browser->type('userID2' , $userID)
                    ->press('Delete')
                    ->assertPathIs('/deleteUser-Admin');     
        });
    }
    
    public function testAddProject(): void{
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Login')
                    ->type('username' , 'admin')
                    ->type('password' , 'admin')
                    ->press('Login')
                    ->assertPathIs('/admin')
                    ->clickLink('Manage Projects/Services')
                    ->assertSee('All the Projects/Services:')
                    ->type('name' , 'added project')
                    ->type('description' , 'description of project')
                    ->press('Add')
                    ->assertPathIs('/addProject-Admin')
                    ->assertSee('added project');      
        });
    }

    public function testEditProject(): void{
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Login')
                    ->type('username' , 'admin')
                    ->type('password' , 'admin')
                    ->press('Login')
                    ->assertPathIs('/admin')
                    ->clickLink('Manage Projects/Services')
                    ->assertSee('All the Projects/Services:');
            $projectsAndServices = Projects_and_Services::all();
            $projectIDs = $projectsAndServices->pluck('prod_id')->toArray();
            $browser->type('projID2' , end($projectIDs))
                    ->type('newName' , 'edited project name')
                    ->type('newDescription' , 'edited project description')
                    ->press('Save')
                    ->assertPathIs('/editProject-Admin');
  
        });
    }

    public function testDeleteProject(): void{
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Login')
                    ->type('username' , 'admin')
                    ->type('password' , 'admin')
                    ->press('Login')
                    ->assertPathIs('/admin')
                    ->clickLink('Manage Projects/Services')
                    ->assertSee('All the Projects/Services:');
            $projectsAndServices = Projects_and_Services::all();
            $projectIDs = $projectsAndServices->pluck('prod_id')->toArray();
            $browser->type('projID' , end($projectIDs))
                    ->press('Delete')
                    ->assertPathIs('/deleteProject-Admin');


  
        });
    }

    public function testApproveBrief(): void{
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Login')
                    ->type('username' , 'admin')
                    ->type('password' , 'admin')
                    ->press('Login')
                    ->assertPathIs('/admin')
                    ->clickLink('Manage Briefs')
                    ->assertSee('List of all the Briefs:');
            $elementsArray = $browser->elements('.table-bordered tr');
            $numberOfRows = count($elementsArray);
            $numberOfRows--;
            if ($numberOfRows>=1){
                $briefID = $browser->text("table tr:nth-child($numberOfRows) td:first-child");
                $browser->type('briefID' , $briefID)
                        ->press('Approve')
                        ->assertPathIs('/approveBrief-Admin'); 
            }
            else{
                print('IMPORTANT NOTE: There are no existing briefs, try test again when a user submits a brief' . "\n");
                assertPathIs('/forcefailTest');
            }

  
        });
    }

    public function testDenyBrief(): void{
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Login')
                    ->type('username' , 'admin')
                    ->type('password' , 'admin')
                    ->press('Login')
                    ->assertPathIs('/admin')
                    ->clickLink('Manage Briefs')
                    ->assertSee('List of all the Briefs:');
            $elementsArray = $browser->elements('.table-bordered tr');
            $numberOfRows = count($elementsArray);
            $numberOfRows--;
            if ($numberOfRows>=1){
                $briefID = $browser->text("table tr:nth-child($numberOfRows) td:first-child");
                $browser->type('briefID2' , $briefID)
                        ->press('Deny')
                        ->assertPathIs('/denyBrief-Admin'); 
            }
            else{
                print('IMPORTANT NOTE: There are no existing briefs, try test again when a user submits a brief');
                assertPathIs('/forcefailTest');
            }

  
        });
    }


    public function testAddManager(): void{
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Login')
                    ->type('username' , 'admin')
                    ->type('password' , 'admin')
                    ->press('Login')
                    ->assertPathIs('/admin')
                    ->clickLink('Manage AccountManagers')
                    ->assertSee('List of all the Account Managers:')
                    ->type('email' , 'sawires@gmail.com')
                    ->type('name' , 'sawires')
                    ->press('Add')
                    ->assertPathIs('/addManager-Admin'); 
  
        });
    }


    public function testDeleteManager(): void{
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Login')
                    ->type('username' , 'admin')
                    ->type('password' , 'admin')
                    ->press('Login')
                    ->assertPathIs('/admin')
                    ->clickLink('Manage AccountManagers')
                    ->assertSee('List of all the Account Managers:');
            $elementsArray = $browser->elements('.table-bordered tr');
            $numberOfRows = count($elementsArray);
            $numberOfRows--;
            $managerEmail = $browser->text("table tr:nth-child($numberOfRows) td:first-child");
            $browser->type('email2' , $managerEmail)
                    ->press('Delete')
                    ->assertPathIs('/deleteManager-Admin'); 
  
        });
    }



}
