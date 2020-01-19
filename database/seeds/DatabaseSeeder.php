<?php

use App\Admin;
use App\HomeSlider;
use App\SiteSettings;
use App\Testimonial;
use App\TestimonialReviews;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class
DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $permissions = [

            'admin_control','subadmin_control','vendor'

        ];
        foreach ($permissions as $permission) {

            Permission::create(['name' => $permission,

                'guard_name' => 'admin']);
        }
        $role = Role::create([
            'name'=>'super admin',
            'guard_name'=>'admin'
        ]);
        $permission = Permission::findOrFail(1);
        TestimonialReviews::create(['name'=>'adeel','review'=>'great service','image'=>'testimonial_reviews\xVyqVItCuPtLThRmxChb1552129040hire-me-pic.png']);
        $role->givePermissionTo($permission);
        $user = Admin::findOrFail(1);
        $roleTo = Role::findOrFail($role->id);
        $user->assignRole($roleTo);
        HomeSlider::create(['title'=>'some title','subtitle'=>'some subtitle','image'=>'homeSliders\GP37FlnAhdbanner.jpg']);
        SiteSettings::create(['facebook_link' => 'www.facebook.com','twitter_link'=>'www.twitter.com','instagram_link'=>'www.instagram.com','logo_header'=>'sitesettings_image\QJnpfvGLj0logo.png','email'=>'some@some.com','phonenumber'=>'033 033033033',]);
        Testimonial::create(['title' => 'testimonial', 'image'=>'testimonial/testimonial_image']);
    }
}
