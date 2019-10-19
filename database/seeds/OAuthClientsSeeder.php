<?php

use Illuminate\Database\Seeder;

class OAuthClientsSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        DB::table('oauth_clients')->delete();

        $oauth_clients = [
            [
                'name' => 'Personal Access Client',
                'secret' => 'icIsKqmCPqx9pt0Kirg2GUeGuent1Ke5CLwKqhQM',
                'redirect' => 'http://localhost/',
                'personal_access_client' => 1,
                'password_client' => 0,
                'revoked' => 0
            ],
            [
                'name' => 'Password Grant Client',
                'secret' => 'LM6a0hnAgF5HHmLrkUXrhSO8tKcW492GY8406Dic',
                'redirect' => 'http://localhost/',
                'personal_access_client' => 0,
                'password_client' => 1,
                'revoked' => 0
            ]
        ];

        DB::table('oauth_clients')->insert($oauth_clients);
    }
}