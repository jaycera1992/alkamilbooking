<?php


// -----------------------------------------------------------------------------
// TEST ROUTES
// -----------------------------------------------------------------------------

$app->group('/test', function () {
    $this->map(['GET'], '/redis', 'TestController:testRedis');
    $this->map(['POST'], '', 'UserController:blabla');
    $this->map(['POST'], '/invoice', 'Paypal:createCreditCardPayment' );

    $this->map(['GET'], '/es', 'ElasticController:testEs' );
});

// -----------------------------------------------------------------------------
// Routes
// -----------------------------------------------------------------------------

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header("Access-Control-Allow-Headers: cache-control, X-Requested-With, Authorization, content-type");

// -----------------------------------------------------------------------------
// PUBLIC ROUTES
// -----------------------------------------------------------------------------

$app->group('/open', function () {
    $this->map(['POST'], '/authenticate', 'AuthController:checkUserLogin');

    
    $this->group('/reference', function () {
        $this->map(['GET'], '/time', 'BookingController:getBookingTime');
    }); 
});
// -----------------------------------------------------------------------------
// SECURE ROUTES - JWT Required
// -----------------------------------------------------------------------------

$app->group('/secure', function () {
    $this->group('/{user_id}', function () {
        $this->group('/user', function () {
            $this->map(['GET'], '/{offset}', 'UserController:getUsers' );
            $this->map(['GET'], '/approval/{offset}', 'UserController:getApproveLogs' );
            $this->map(['GET'], '/approval-count/{offset}', 'UserController:getApproveLogsCount' );
            $this->map(['POST'], '/add', 'UserController:addUsers' );
            $this->map(['DELETE'], '/{delete_user_id}', 'UserController:deleteUser');
            $this->map(['PUT'], '/{update_user_id}', 'UserController:updateUser');
        }); 
        
        $this->map(['GET'], '/total', 'UserController:getTotalUsers' );
        $this->map(['GET'], '/total/deleted', 'UserController:getDeletedTotalUsers' );
        $this->map(['GET'], '/total/active', 'UserController:getActiveTotalUsers' );
        $this->map(['GET'], '/total/staff', 'UserController:getTotalStaff' );

        $this->group('/company', function () {
            $this->map(['GET'], '/get-reference', 'CompanyController:getCompanyReference' );
            $this->map(['POST'], '/add', 'CompanyController:addCompany' );
            $this->map(['GET'], '/{offset}', 'CompanyController:getCompany' );
            $this->map(['DELETE'], '/{delete_company_id}', 'CompanyController:deleteCompany');
            $this->map(['PUT'], '/{update_company_id}', 'CompanyController:updateCompany');
            $this->group('/total', function () {
                $this->map(['GET'], '/total', 'CompanyController:getTotalCompany' );
                $this->map(['GET'], '/deleted', 'CompanyController:getTotalDeletedCompany' );
                $this->map(['GET'], '/active', 'CompanyController:getTotalActiveCompany' );
            });
        }); 

        $this->group('/category', function () {
            $this->map(['GET'], '/get-reference', 'CategoryController:getCategoryReference' );
            $this->map(['POST'], '/add', 'CategoryController:addCategory' );
            $this->map(['POST'], '/add-grocery', 'CategoryController:addGroceryMarket' );
            $this->map(['GET'], '/{offset}', 'CategoryController:getCategoryData' );
            $this->map(['GET'], '/generate-data/sql', 'CategoryController:generateData' );
            $this->group('/total', function () {
                $this->map(['GET'], '/category', 'CategoryController:getTotalCategory' );
                $this->map(['GET'], '/category/{category_id}', 'CategoryController:getCategoryCount' );
            }); 
        });     
    });
})->add($jwt);
