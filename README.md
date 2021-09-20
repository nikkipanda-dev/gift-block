# E-Commerce App 
## Table of Contents
1. [Introduction](#introduction)
2. [Technologies](#technologies)
3. [Installation](#installation)
4. [Seeding](#seeding)


## Introduction

A sample e-commerce app.


## Technologies

Built with
- [Laravel 8](https://laravel.com/docs/8.x)


## Installation

1. [Click here](https://laravel.com/docs/8.x/installation/) for the Laravel installation guide.
2. Clone the repository.
3. Switch to the repository folder.
4. Install all dependencies.
5. Set up database connection in the **.env** file.
6. Run migrations.
7. Access the server using the following command:


## Seeding

1. Optionally, you may seed the database by generating a Laravel model factory for testing purposes:
```bash
php artisan make:factory [factoryName]
```
> e.g. php artisan make:factory UserFactory

2. To define a model factory, [click here](https://laravel.com/docs/8.x/database-testing#defining-model-factories).
3. Once the model factory has been defined, generate a seeder class to easily populate the database:
```bash
php artisan make:seeder [seederName]
```
> e.g. php artisan make:seeder UserSeeder

4. Switch to the created seeder file and import your desired model:
```bash
use App\Models\User;
```
5. To define the method inside the seeder class:
```bash
public function run()
{
    User::factory()
            ->count(50)
            ->hasPosts(1)
            ->create();
}
```

6. You may now populate your database using the command below:
```bash
php artisan db:seed
```
<br />

For additional information about database seeding, [click here](https://laravel.com/docs/8.x/seeding#introduction).
