<?php

namespace App\Console\Commands;

use App\Models\EventCompany;
use App\Models\User;
use Illuminate\Console\Command;

class FirstCompany extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:first-company {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create the first company then creates the first user for that company';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if(EventCompany::all()->count() > 0){
            $this->error("There is already a registered company");
            return 1;
        }

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
           "role" => 2 // Set the first user to administrator
        ]);

        $firstUser->save();
        $firstUser = $firstUser->fresh();

        $this->info("Assigned user " . $firstUser->name . " to company ID: " . $firstUser->company_id);

        return 0;
    }
}
