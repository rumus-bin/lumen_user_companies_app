<?php

namespace App\Console\Commands;

use App\Models\Company\Company;
use App\Models\Company\Repositories\CompanyRepository;
use App\Models\User\Repositories\UserRepository;
use App\Models\User\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CreateUserWithCompanyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user_with_company:create';

    private readonly UserRepository $userRepository;

    private readonly CompanyRepository $companyRepository;

    public function __construct(UserRepository $userRepository, CompanyRepository $companyRepository)
    {
        $this->userRepository = $userRepository;
        parent::__construct();
    }

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new user';

    public function handle(): void
    {
        $name = $this->ask('What is user name?');
        $email = $this->ask('What is user email?');
        $password = $this->secret('What is user password?');

        $user = new User([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        $user = $this->userRepository->store($user);

        $company = new Company(
            [
                Company::TITLE => Str::random(6) . ' company',
                Company::DESCRIPTION => Str::random(10) . ' description'
            ]
        );

        $this->userRepository->saveCompany($user, $company);


        $this->info("User {$user->name} with email {$user->email} and company {$company->title} created!");
    }
}
