<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// AUTH
$routes->get('/login', 'AuthController::loginView');
$routes->post('/login/submit', 'AuthController::loginAuth');
$routes->get('/register', 'AuthController::registerView');
$routes->post('/register/submit', 'AuthController::registerAuth');
$routes->get('/logout', 'AuthController::logout');

$routes->group('/', function ($routes) {
  $routes->get('', 'HomeController::index');
  $routes->get('success-payment', 'PaymentController::successPaymentView');
  $routes->post('payment', 'PaymentController::payment');
  $routes->get('cart', 'CartController::cartView');
  $routes->get('cart/get', 'CartController::getCart');
  $routes->post('add-to-cart/(:num)', 'CartController::addToCart/$1');
});

$routes->group('/admin', function ($routes) {
  $routes->get('manage-product', 'ProductController::manageProduct');
  $routes->get('product/create', 'ProductController::createProduct');
  $routes->post('product/create/submit', 'ProductController::submitCreateProduct');
});
