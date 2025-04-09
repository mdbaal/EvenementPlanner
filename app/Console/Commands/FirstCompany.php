<?php

namespace App\Console\Commands;

use App\Models\EventCompany;
use App\Models\User;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class FirstCompany extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:first-company';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create the first company then creates the admin user for that company';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if(EventCompany::all()->count() > 0){
            $this->error("There is already a registered company");
            return 1;
        }

        // Create roles
        $manager = Role::create(['name' => 'manager']);
        $companyManager = Role::create(['name' => 'company-manager']);
        $administrator = Role::create(['name' => 'administrator']);

        $manageEvents = Permission::create(['name' => "manage events"]);
        $manageCompany = Permission::create(['name' => "manage company"]);
        $manageAll = Permission::create(['name' => "manage all"]);

        $manager->givePermissionTo($manageEvents);

        $companyManager->givePermissionTo($manageEvents);
        $companyManager->givePermissionTo($manageCompany);

        $administrator->givePermissionTo($manageAll);

        $name = null;
        $desc = null;
        $email = null;

        while($name == null)
            $name = $this->ask("What is the company called?");

        while($desc == null)
            $desc = $this->ask("Describe the company");

        while($email == null)
            $email = $this->ask("What the company's email?");

        $phone = $this->ask("What is the company's phone number? (Press enter to skip)");

        $company = EventCompany::create([
            "name" => $name,
            "description" => $desc,
            "phone" => $phone,
            "email" => $email,
        ]);

        $this->info("Company created with ID: " . $company->id );

        $this->info("Creating admin user...");

        $this->call("make:filament-user");

        $firstUser = User::all()->first();
        $firstUser->update([
           "company_id" => (int)$company->id,
        ]);

        $firstUser->assignRole($administrator);

        $firstUser->save();
        $firstUser = $firstUser->fresh();

        $this->info("Assigned user " . $firstUser->name . " to company ID: " . $firstUser->company_id);

        return 0;
    }
}
