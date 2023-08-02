<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use App\Models\System_Accounts;
use App\Models\Admin;
use App\Models\Super_Admin;
use App\Models\Account_Manager;
use App\Models\Projects_and_Services;
use Illuminate\Support\Facades\Crypt;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        System_Accounts::create([
            'username' => 'admin',
            'password' => Crypt::encrypt('admin'),
            'email' => Crypt::encrypt('admin@gmail.com'),
            'mobile' => '0000000',
            'type' => 'Admin' 
  
        ]);

        System_Accounts::create([
            'username' => 'superadmin',
            'password' => Crypt::encrypt('superadmin'),
            'email' => Crypt::encrypt('superadmin@gmail.com'),
            'mobile' => '0000000',
            'type' => 'Super Admin' 
  
        ]);

        Admin::create([
            'username' => 'admin',
            'password' => Crypt::encrypt('admin'),
            'email' => Crypt::encrypt('admin@gmail.com'),
            'mobile' => '0000000',
            'type' => 'Admin' 
  
        ]);

        Super_Admin::create([
            'username' => 'superadmin',
            'password' => Crypt::encrypt('superadmin'),
            'email' => Crypt::encrypt('superadmin@gmail.com'),
            'mobile' => '0000000',
  
        ]);

        Account_Manager::create([
            'email' => 'mohamed@gmail.com',
            'name' => 'Mohamed'
        ]);

        Account_Manager::create([
            'email' => 'ahmed@gmail.com',
            'name' => 'Ahmed'
        ]);

        Projects_and_Services::create([
            'name' => 'Web Development',
            'description' => 'Our team of highly skilled and innovative developers is dedicated to
             delivering cutting-edge solutions that not only elevate 
            your online presence but also drive meaningful results. 
            With a customer-centric approach, we prioritize collaboration, attention to detail, 
            and a seamless user experience, ensuring that your website stands out in a competitive digital landscape. 
            Trust us to transform your vision into a reality, and let our exceptional web development service empower your 
            business to thrive in the digital world.'
        ]);

        Projects_and_Services::create([
            'name' => 'Mobile App Development',
            'description' => 'Our team of skilled and innovative app developers is committed to creating engaging and user-friendly mobile applications across various platforms, be it iOS or Android. With a keen focus on user experience, performance, and security, our mobile apps are designed to elevate your brand visibility and facilitate seamless interactions with your audience. Whether it is a native, hybrid, or cross-platform app, we deliver tailored solutions that align perfectly with your business objectives. Embrace the future of mobile technology with our cutting-edge mobile app development service and empower your business to thrive in the fast-paced digital era.'
        ]);
        
        Projects_and_Services::create([
            'name' => 'Game Development',
            'description' => 'Our team of passionate and talented game developers is dedicated to creating immersive and captivating gaming experiences across multiple platforms. With a deep understanding of gameplay mechanics, graphics, and audio, we craft engaging games that keep players coming back for more. From mobile games to console and PC titles, we leverage the latest technologies and industry best practices to bring your creative vision to life. Embrace the thrill of interactive storytelling, stunning visuals, and addictive gameplay with our cutting-edge game development service. Let us take your gaming ideas from concept to reality, and together, let us redefine the boundaries of entertainment in the gaming world.'
        ]);
      


    }
}
