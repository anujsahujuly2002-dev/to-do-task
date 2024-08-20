<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Destination;
use App\Models\Facilitiy;
use App\Models\Status;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserCreateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       /*  $user=User::create([
            'title'=>"Mr.",
            'name'=>"Anuj",
            'last_name'=>"Kumar",
            'date_of_birth'=>"1998-08-11",
            "profile_picture"=>"dhjsdhjsdjsdjsdhjsdhjsd",
            "mobile_no"=>"9305238392",
            "department_id"=>"1",
            "designation_id"=>"1",
            "email"=>"admin@gmail.com",
            "password"=>Hash::make('Admin@123#'),
        ]);

        $user->assignRole(['Admin']); */

        // User::factory()->count(1000)->create();
        /* $users = User::where('id','>','1')->get();
        foreach($users as $user):
            $user->assignRole(['Manager']);
        endforeach; */
        /* Designation::create([
            'name'=>"Designation 1"
        ]);
        Designation::create([
            'name'=>"Designation 2"
        ]);
        Designation::create([
            'name'=>"Designation 3"
        ]);
        Department::create([
            'name'=>"Department 1"
        ]);
        Department::create([
            'name'=>"Department 2"
        ]);
        Department::create([
            'name'=>"Department 3"
        ]); */
       /*  Role::create([
            "name"=>"Admin"
        ]);
        Role::create([
            "name"=>"Manager"
        ]);
        Role::create([
            "name"=>"Operation"
        ]); */


        /* Category::create([
            'name'=>"Category 1"
        ]);
        Category::create([
            'name'=>"Category 2"
        ]);
        Category::create([
            'name'=>"Category 3"
        ]);
        Category::create([
            'name'=>"Category 4"
        ]); */

       /*  Status::create([
            'name'=>'new',
        ]);
        Status::create([
            'name'=>'in Progress',
        ]);
        Status::create([
            'name'=>'completed',
        ]);
        Status::create([
            'name'=>'trash',
        ]);
        Status::create([
            'name'=>'important',
        ]); */

      /*   for($i=1; $i<=5;$i++):
            echo $i;
            dd("s;d's;d'sd");
            Facilitiy::create([
                'name'=>'facilities '.$i
            ]);
        endfor;
        for($i=1;$i<=5;$i++):
            Tag::create([
                'name'=>'Tag '.$i
            ]);
        endfor; */
        for($i=1;$i<=10;$i++):
            Destination::create([
                'name'=>'destinations '.$i
            ]);
        endfor;

       
    }
}
