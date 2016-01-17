<?php

class AdminUsersTest extends TestCase {

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testUserList()
    {
        $UserAdmin = \App\User::whereHas('role', function($q){
            $q->where('admin', true);
        })->first();

        $this->be($UserAdmin);
        $response = $this->call('GET', route('admin.users.list'));

        $this->assertResponseOk();
    }

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testUserEdit()
    {
        $UserAdmin = \App\User::whereHas('role', function($q){
            $q->where('admin', true);
        })->first();

        $this->be($UserAdmin);
        $User = \App\User::first();
        $response = $this->call('GET', route('admin.users.edit', $User));

        $this->assertResponseOk();
    }

//    /**
//     * A basic functional test example.
//     *
//     * @return void
//     */
//    public function testUserUpdate()
//    {
//        $UserAdmin = \App\User::whereHas('role', function($q){
//            $q->where('admin', true);
//        })->first();
//
//        $this->be($UserAdmin);
//        $User = \App\User::first();
//        $response = $this->call('POST', route('admin.users.update', $User), ['first_name' => 'New User name', 'last_name' => 'New last name', '_token' => csrf_token()]);
//    echo $response;
//        $this->assertRedirectedToRoute('admin.users.list');
//    }

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testUserDelete()
    {
        $UserAdmin = \App\User::whereHas('role', function($q){
            $q->where('admin', true);
        })->first();

        $this->be($UserAdmin);
        $User = \App\User::create([
            'email' => str_random(5).'@'.str_random(3).'.com'
        ]);
        $this->call('GET', route('admin.users.delete', $User));

        $this->assertRedirectedToRoute('admin.users.list');
    }

    public function testUserRestore(){
        $UserAdmin = \App\User::whereHas('role', function($q){
            $q->where('admin', true);
        })->first();

        $this->be($UserAdmin);
        $User = \App\User::create([
            'email' => str_random(5).'@'.str_random(3).'.com'
        ]);
        $id = $User->id;
        $User = \App\User::withTrashed()->where('id', $id)->first();
        $this->call('GET', route('admin.users.restore', $User->id));
        $User->forceDelete();
        $this->assertRedirectedToRoute('admin.users.list');


    }

}
