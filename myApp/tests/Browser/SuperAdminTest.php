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
                    ->type('username' , 'superadmin')
                    ->type('password' , 'superadmin')
                    ->press('Login')
                    ->assertPathIs('/superadmin');
        });
    }
    
    public function testViewProblems(): void{
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Login')
                    ->type('username' , 'superadmin')
                    ->type('password' , 'superadmin')
                    ->press('Login')
                    ->assertPathIs('/superadmin')
                    ->clickLink('View Problems')
                    ->assertSee('Problems reported from all the Users:');
        });
    }

    public function testViewFeedback(): void{
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Login')
                    ->type('username' , 'superadmin')
                    ->type('password' , 'superadmin')
                    ->press('Login')
                    ->assertPathIs('/superadmin')
                    ->clickLink('View Feedback')
                    ->assertSee('Feedback from all the Users:');
        });
    }

    public function testSignOut(): void{
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Login')
                    ->type('username' , 'superadmin')
                    ->type('password' , 'superadmin')
                    ->press('Login')
                    ->assertPathIs('/superadmin')
                    ->clickLink('Sign Out')
                    ->assertSee('Login')
                    ->visit('/superadmin')
                    ->assertSee('Cannot access this page');
        });
    }

    public function testViewUser(): void{
        //this test will assume that there is atleast one user registered on the system
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Login')
                    ->type('username' , 'superadmin')
                    ->type('password' , 'superadmin')
                    ->press('Login')
                    ->assertPathIs('/superadmin')
                    ->clickLink('Manage Users')
                    ->assertSee('List of all the Users:')
                    ->assertSourceHas('<table class="table table-bordered bg-white">');
            
            $elementsArray = $browser->elements('.table-bordered tr');
            $numberOfRows = count($elementsArray);
            $numberOfRows--;
            $userID = $browser->text("table tr:nth-child($numberOfRows) td:first-child");
            $browser->type('userID' , $userID)
                    ->press('View')
                    ->assertPathIs('/viewUserData');            
        });
    }

    public function testAddUser(): void{
        //this test will assume that there is atleast one user registered on the system
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Login')
                    ->type('username' , 'superadmin')
                    ->type('password' , 'superadmin')
                    ->press('Login')
                    ->assertPathIs('/superadmin')
                    ->clickLink('Manage Users')
                    ->assertSee('List of all the Users:')
                    ->type('username' , 'mosalahLV')
                    ->type('password' , 'mo123')
                    ->type('email' , 'mo@gmail.com')
                    ->press('Add')
                    ->assertPathIs('/addUser');      
        });
    }
    public function testAssignManager(): void{
        //this test will assume that there is atleast one user registered on the system
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Login')
                    ->type('username' , 'superadmin')
                    ->type('password' , 'superadmin')
                    ->press('Login')
                    ->assertPathIs('/superadmin')
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
                    ->assertPathIs('/assignManager') 
                    ->assertSee('ahmed@gmail.com');    
        });
    }

    public function testDeleteUser(): void{
        //this test will assume that there is atleast one user registered on the system
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Login')
                    ->type('username' , 'superadmin')
                    ->type('password' , 'superadmin')
                    ->press('Login')
                    ->assertPathIs('/superadmin')
                    ->clickLink('Manage Users')
                    ->assertSee('List of all the Users:')
                    ->assertSourceHas('<table class="table table-bordered bg-white">');
            
            $elementsArray = $browser->elements('.table-bordered tr');
            $numberOfRows = count($elementsArray);
            $numberOfRows--;
            $userID = $browser->text("table tr:nth-child($numberOfRows) td:first-child");
            $browser->type('userID2' , $userID)
                    ->press('Delete')
                    ->assertPathIs('/deleteUser');     
        });
    }
    

    public function testAddAdmin(): void{
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Login')
                    ->type('username' , 'superadmin')
                    ->type('password' , 'superadmin')
                    ->press('Login')
                    ->assertPathIs('/superadmin')
                    ->clickLink('Manage Admins')
                    ->assertSee('List of all the Admins:')
                    ->type('username' , 'klopp')
                    ->type('password' , 'klopp123')
                    ->type('email' , 'klopp@gmail.com')
                    ->type('mobile' , '01234567890')
                    ->press('Add Admin')
                    ->assertPathIs('/addAdmin')
                    ->assertSee('klopp');      
        });
    }

    public function testEditAdmin(): void{
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Login')
                    ->type('username' , 'superadmin')
                    ->type('password' , 'superadmin')
                    ->press('Login')
                    ->assertPathIs('/superadmin')
                    ->clickLink('Manage Admins')
                    ->assertSee('List of all the Admins:');
                $elementsArray = $browser->elements('#adminTable tr');
                $numberOfRows = count($elementsArray);
                $numberOfRows--;
                $adminID = $browser->text("table tr:nth-child($numberOfRows) td:first-child");
                $browser->type('adminID2' , $adminID)
                        ->type('newEmail' , 'newemail@gmail.com')
                        ->type('newMobile' , '00000000')
                        ->press('Save Admin')
                        ->assertPathIs('/editAdmin');
  
        });
    }

    public function testDeleteAdmin(): void{
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Login')
                    ->type('username' , 'superadmin')
                    ->type('password' , 'superadmin')
                    ->press('Login')
                    ->assertPathIs('/superadmin')
                    ->clickLink('Manage Admins')
                    ->assertSee('List of all the Admins:');
                $elementsArray = $browser->elements('#adminTable tr');
                $numberOfRows = count($elementsArray);
                $numberOfRows--;
                $adminID = $browser->text("table tr:nth-child($numberOfRows) td:first-child");
                $browser->type('adminID' , $adminID)
                        ->press('Delete Admin')
                        ->assertPathIs('/deleteAdmin');
  
        });
    }


    public function testAddSuperAdmin(): void{
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Login')
                    ->type('username' , 'superadmin')
                    ->type('password' , 'superadmin')
                    ->press('Login')
                    ->assertPathIs('/superadmin')
                    ->clickLink('Manage Admins')
                    ->assertSee('List of all the Admins:')
                    ->type('superAdminUsername' , 'superklopp')
                    ->type('superAdminPassword' , 'superklopp123')
                    ->type('superAdminEmail' , 'superklopp@gmail.com')
                    ->type('superAdminMobile' , '01234567890')
                    ->press('Add Super Admin')
                    ->assertPathIs('/addSuperAdmin')
                    ->assertSee('superklopp');      
        });
    }

    public function testEditSuperAdmin(): void{
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Login')
                    ->type('username' , 'superadmin')
                    ->type('password' , 'superadmin')
                    ->press('Login')
                    ->assertPathIs('/superadmin')
                    ->clickLink('Manage Admins')
                    ->assertSee('List of all the Admins:');
                $elementsArray = $browser->elements('#superAdminTable tr');
                $numberOfRows = count($elementsArray);
                $numberOfRows--;
                $adminID = $browser->text("table tr:nth-child($numberOfRows) td:first-child");
                $browser->type('superadminID2' , $adminID)
                        ->type('newSuperAdminEmail' , 'newemail@gmail.com')
                        ->type('newSuperAdminMobile' , '00000000')
                        ->press('Save Super Admin')
                        ->assertPathIs('/editSuperAdmin');
  
        });
    }

    public function testDeleteSuperAdmin(): void{
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Login')
                    ->type('username' , 'superadmin')
                    ->type('password' , 'superadmin')
                    ->press('Login')
                    ->assertPathIs('/superadmin')
                    ->clickLink('Manage Admins')
                    ->assertSee('List of all the Admins:');
                $elementsArray = $browser->elements('#superAdminTable tr');
                $numberOfRows = count($elementsArray);
                $numberOfRows--;
                $adminID = $browser->text("table tr:nth-child($numberOfRows) td:first-child");
                $browser->type('superadminID' , $adminID)
                        ->press('Delete Super Admin')
                        ->assertPathIs('/deleteSuperAdmin');
  
        });
    }

    public function testAddProject(): void{
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Login')
                    ->type('username' , 'superadmin')
                    ->type('password' , 'superadmin')
                    ->press('Login')
                    ->assertPathIs('/superadmin')
                    ->clickLink('Manage Projects/Services')
                    ->assertSee('All the Projects/Services:')
                    ->type('name' , 'added project')
                    ->type('description' , 'description of project')
                    ->press('Add')
                    ->assertPathIs('/addProject')
                    ->assertSee('added project');      
        });
    }

    public function testEditProject(): void{
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Login')
                    ->type('username' , 'superadmin')
                    ->type('password' , 'superadmin')
                    ->press('Login')
                    ->assertPathIs('/superadmin')
                    ->clickLink('Manage Projects/Services')
                    ->assertSee('All the Projects/Services:');
            $projectsAndServices = Projects_and_Services::all();
            $projectIDs = $projectsAndServices->pluck('prod_id')->toArray();
            $browser->type('projID2' , end($projectIDs))
                    ->type('newName' , 'edited project name')
                    ->type('newDescription' , 'edited project description')
                    ->press('Save')
                    ->assertPathIs('/editProject');
  
        });
    }

    public function testDeleteProject(): void{
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Login')
                    ->type('username' , 'superadmin')
                    ->type('password' , 'superadmin')
                    ->press('Login')
                    ->assertPathIs('/superadmin')
                    ->clickLink('Manage Projects/Services')
                    ->assertSee('All the Projects/Services:');
            $projectsAndServices = Projects_and_Services::all();
            $projectIDs = $projectsAndServices->pluck('prod_id')->toArray();
            $browser->type('projID' , end($projectIDs))
                    ->press('Delete')
                    ->assertPathIs('/deleteProject');


  
        });
    }

    public function testApproveBrief(): void{
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Login')
                    ->type('username' , 'superadmin')
                    ->type('password' , 'superadmin')
                    ->press('Login')
                    ->assertPathIs('/superadmin')
                    ->clickLink('Manage Briefs')
                    ->assertSee('List of all the Briefs:');
            $elementsArray = $browser->elements('.table-bordered tr');
            $numberOfRows = count($elementsArray);
            $numberOfRows--;
            if ($numberOfRows>=1){
                $briefID = $browser->text("table tr:nth-child($numberOfRows) td:first-child");
                $browser->type('briefID' , $briefID)
                        ->press('Approve')
                        ->assertPathIs('/approveBrief'); 
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
                    ->type('username' , 'superadmin')
                    ->type('password' , 'superadmin')
                    ->press('Login')
                    ->assertPathIs('/superadmin')
                    ->clickLink('Manage Briefs')
                    ->assertSee('List of all the Briefs:');
            $elementsArray = $browser->elements('.table-bordered tr');
            $numberOfRows = count($elementsArray);
            $numberOfRows--;
            if ($numberOfRows>=1){
                $briefID = $browser->text("table tr:nth-child($numberOfRows) td:first-child");
                $browser->type('briefID2' , $briefID)
                        ->press('Deny')
                        ->assertPathIs('/denyBrief'); 
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
                    ->type('username' , 'superadmin')
                    ->type('password' , 'superadmin')
                    ->press('Login')
                    ->assertPathIs('/superadmin')
                    ->clickLink('Manage AccountManagers')
                    ->assertSee('List of all the Account Managers:')
                    ->type('email' , 'sawires@gmail.com')
                    ->type('name' , 'sawires')
                    ->press('Add')
                    ->assertPathIs('/addManager'); 
  
        });
    }


    public function testDeleteManager(): void{
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Login')
                    ->type('username' , 'superadmin')
                    ->type('password' , 'superadmin')
                    ->press('Login')
                    ->assertPathIs('/superadmin')
                    ->clickLink('Manage AccountManagers')
                    ->assertSee('List of all the Account Managers:');
            $elementsArray = $browser->elements('.table-bordered tr');
            $numberOfRows = count($elementsArray);
            $numberOfRows--;
            $managerEmail = $browser->text("table tr:nth-child($numberOfRows) td:first-child");
            $browser->type('email2' , $managerEmail)
                    ->press('Delete')
                    ->assertPathIs('/deleteManager'); 
  
        });
    }



}
