<?php

namespace App\Providers;

use App\Bus\Command\CommandBus;
use App\Bus\Command\IlluminateCommandBus;
use App\Bus\Query\IlluminateQueryBus;
use App\Bus\Query\QueryBus;
use App\Domains\Customer\Commands\CreateCustomerCommand;
use App\Domains\Customer\Commands\CreateCustomerCommandHandler;
use App\Domains\Customer\Commands\DeleteCustomerCommand;
use App\Domains\Customer\Commands\DeleteCustomerCommandHandler;
use App\Domains\Customer\Commands\UpdateCustomerCommand;
use App\Domains\Customer\Commands\UpdateCustomerCommandHandler;
use App\Domains\Customer\Queries\AllCustomersQuery;
use App\Domains\Customer\Queries\AllCustomersQueryHandler;
use App\Domains\Customer\Queries\FindCustomerQuery;
use App\Domains\Customer\Queries\FindCustomerQueryHandler;
use App\Domains\Customer\Repositories\Contracts\ReadCustomerRepositoryContract;
use App\Domains\Customer\Repositories\Contracts\WriteCustomerRepositoryContract;
use App\Domains\Customer\Repositories\ReadCustomerRepository;
use App\Domains\Customer\Repositories\WriteCustomerRepository;
use App\Domains\Customer\Services\Contracts\CustomerServiceContract;
use App\Domains\Customer\Services\CustomerService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $singletons = [
            CommandBus::class => IlluminateCommandBus::class,
            QueryBus::class => IlluminateQueryBus::class,
        ];

        foreach ($singletons as $abstract => $concrete) {
            $this->app->singleton(
                $abstract,
                $concrete,
            );
        }


        $this->app->bind(
            ReadCustomerRepositoryContract::class,
            ReadCustomerRepository::class,
        );
        $this->app->bind(
            WriteCustomerRepositoryContract::class,
            WriteCustomerRepository::class,
        );

        $this->app->bind(
            CustomerServiceContract::class,
            CustomerService::class,
        );

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $commandBus = app(CommandBus::class);

        $commandBus->register([
            CreateCustomerCommand::class => CreateCustomerCommandHandler::class,
            UpdateCustomerCommand::class => UpdateCustomerCommandHandler::class,
            DeleteCustomerCommand::class => DeleteCustomerCommandHandler::class,
        ]);

        $queryBus = app(QueryBus::class);

        $queryBus->register([
            AllCustomersQuery::class => AllCustomersQueryHandler::class,
            FindCustomerQuery::class => FindCustomerQueryHandler::class,
        ]);
    }
}
