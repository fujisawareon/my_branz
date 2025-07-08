<?php

declare(strict_types=1);

namespace App\Providers\Repositories;

return [
    [
        'interface' => \App\Repositories\Interfaces\AppLogRepositoryInterface::class,
        'class' => \App\Repositories\AppLogRepository::class,
    ],
    [
        'interface' => \App\Repositories\Interfaces\InformationRepositoryInterface::class,
        'class' => \App\Repositories\InformationRepository::class,
    ],
    [
        'interface' => \App\Repositories\Interfaces\SystemAdminPasswordResetRepositoryInterface::class,
        'class' => \App\Repositories\SystemAdminPasswordResetRepository::class,
    ],
    [
        'interface' => \App\Repositories\Interfaces\FloorTypeLogRepositoryInterface::class,
        'class' => \App\Repositories\FloorTypeLogRepository::class,
    ],
    [
        'interface' => \App\Repositories\Interfaces\MovieRepositoryInterface::class,
        'class' => \App\Repositories\MovieRepository::class,
    ],
    [
        'interface' => \App\Repositories\Interfaces\CustomerBuildingRepositoryInterface::class,
        'class' => \App\Repositories\CustomerBuildingRepository::class,
    ],
    [
        'interface' => \App\Repositories\Interfaces\ShareContentStatusRepositoryInterface::class,
        'class' => \App\Repositories\ShareContentStatusRepository::class,
    ],
    [
        'interface' => \App\Repositories\Interfaces\ImageGalleryRepositoryInterface::class,
        'class' => \App\Repositories\ImageGalleryRepository::class,
    ],
    [
        'interface' => \App\Repositories\Interfaces\ShareItemCustomerRepositoryInterface::class,
        'class' => \App\Repositories\ShareItemCustomerRepository::class,
    ],
    [
        'interface' => \App\Repositories\Interfaces\PasswordResetRepositoryInterface::class,
        'class' => \App\Repositories\PasswordResetRepository::class,
    ],
    [
        'interface' => \App\Repositories\Interfaces\MasterDataRepositoryInterface::class,
        'class' => \App\Repositories\MasterDataRepository::class,
    ],
    [
        'interface' => \App\Repositories\Interfaces\OnlineSeminarVideoRepositoryInterface::class,
        'class' => \App\Repositories\OnlineSeminarVideoRepository::class,
    ],
    [
        'interface' => \App\Repositories\Interfaces\FloorTypeRepositoryInterface::class,
        'class' => \App\Repositories\FloorTypeRepository::class,
    ],
    [
        'interface' => \App\Repositories\Interfaces\OptionContentsRepositoryInterface::class,
        'class' => \App\Repositories\OptionContentsRepository::class,
    ],
    [
        'interface' => \App\Repositories\Interfaces\BinderCategoryRepositoryInterface::class,
        'class' => \App\Repositories\BinderCategoryRepository::class,
    ],
    [
        'interface' => \App\Repositories\Interfaces\ManagerRepositoryInterface::class,
        'class' => \App\Repositories\ManagerRepository::class,
    ],
    [
        'interface' => \App\Repositories\Interfaces\MailLogRepositoryInterface::class,
        'class' => \App\Repositories\MailLogRepository::class,
    ],
    [
        'interface' => \App\Repositories\Interfaces\BuildingInvitationRepositoryInterface::class,
        'class' => \App\Repositories\BuildingInvitationRepository::class,
    ],
    [
        'interface' => \App\Repositories\Interfaces\DashboardSelectBuildingRepositoryInterface::class,
        'class' => \App\Repositories\DashboardSelectBuildingRepository::class,
    ],
    [
        'interface' => \App\Repositories\Interfaces\BuildingRepositoryInterface::class,
        'class' => \App\Repositories\BuildingRepository::class,
    ],
    [
        'interface' => \App\Repositories\Interfaces\BinderRepositoryInterface::class,
        'class' => \App\Repositories\BinderRepository::class,
    ],
    [
        'interface' => \App\Repositories\Interfaces\CustomerPinsRepositoryInterface::class,
        'class' => \App\Repositories\CustomerPinsRepository::class,
    ],
    [
        'interface' => \App\Repositories\Interfaces\BuildingSettingRepositoryInterface::class,
        'class' => \App\Repositories\BuildingSettingRepository::class,
    ],
    [
        'interface' => \App\Repositories\Interfaces\MovieCategoryRepositoryInterface::class,
        'class' => \App\Repositories\MovieCategoryRepository::class,
    ],
    [
        'interface' => \App\Repositories\Interfaces\LocalPhotoRepositoryInterface::class,
        'class' => \App\Repositories\LocalPhotoRepository::class,
    ],
    [
        'interface' => \App\Repositories\Interfaces\AreaMapCategoryRepositoryInterface::class,
        'class' => \App\Repositories\AreaMapCategoryRepository::class,
    ],
    [
        'interface' => \App\Repositories\Interfaces\SalesFileRepositoryInterface::class,
        'class' => \App\Repositories\SalesFileRepository::class,
    ],
    [
        'interface' => \App\Repositories\Interfaces\SalesScheduleRepositoryInterface::class,
        'class' => \App\Repositories\SalesScheduleRepository::class,
    ],
    [
        'interface' => \App\Repositories\Interfaces\CustomerSessionsRepositoryInterface::class,
        'class' => \App\Repositories\CustomerSessionsRepository::class,
    ],
    [
        'interface' => \App\Repositories\Interfaces\LoanSimulationLogRepositoryInterface::class,
        'class' => \App\Repositories\LoanSimulationLogRepository::class,
    ],
    [
        'interface' => \App\Repositories\Interfaces\CustomerRepositoryInterface::class,
        'class' => \App\Repositories\CustomerRepository::class,
    ],
    [
        'interface' => \App\Repositories\Interfaces\SalesPriceDataRepositoryInterface::class,
        'class' => \App\Repositories\SalesPriceDataRepository::class,
    ],
];
