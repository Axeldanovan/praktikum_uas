<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
	public function run()
	{
		$model = model('UserModel');
		$model->insert([
		'username' => 'axeldanovan',
		'useremail' => 'axeldanovan222@gmail.com',
		'userpassword' => password_hash('123456', PASSWORD_DEFAULT),
		]);