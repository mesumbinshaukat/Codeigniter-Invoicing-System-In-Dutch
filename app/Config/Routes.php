<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'FormController::index');
$routes->get('form', 'FormController::index');
$routes->post('form/submit', 'FormController::submit');
$routes->get('form/success', 'FormController::success');

$routes->get('admin/login', 'Admin\AuthController::login');
$routes->post('admin/authenticate', 'Admin\AuthController::authenticate');
$routes->get('admin/logout', 'Admin\AuthController::logout');

$routes->get('admin/dashboard', 'Admin\AdminController::dashboard');
$routes->get('admin/submissions', 'Admin\AdminController::submissions');
$routes->get('admin/submissions/archive', 'Admin\AdminController::archivedSubmissions');
$routes->get('admin/submission/view/(:num)', 'Admin\AdminController::viewSubmission/$1');
$routes->get('admin/submission/edit/(:num)', 'Admin\AdminController::editSubmission/$1');
$routes->post('admin/submission/update/(:num)', 'Admin\AdminController::updateSubmission/$1');
$routes->post('admin/submission/copy/(:num)', 'Admin\AdminController::copySubmission/$1');
$routes->post('admin/submission/archive/(:num)', 'Admin\AdminController::archiveSubmission/$1');
$routes->post('admin/submission/restore/(:num)', 'Admin\AdminController::restoreSubmission/$1');
$routes->post('admin/submission/delete/(:num)', 'Admin\AdminController::deleteSubmission/$1');

$routes->get('admin/offers', 'Admin\AdminController::offers');
$routes->get('admin/offer/view/(:num)', 'Admin\AdminController::viewOffer/$1');
$routes->get('admin/offer/edit/(:num)', 'Admin\OfferController::edit/$1');
$routes->post('admin/offer/update/(:num)', 'Admin\OfferController::update/$1');
$routes->post('admin/offer/delete/(:num)', 'Admin\OfferController::delete/$1');
$routes->post('admin/offer/copy/(:num)', 'Admin\OfferController::copy/$1');

$routes->get('admin/offer/create/(:num)', 'Admin\OfferController::create/$1');
$routes->post('admin/offer/store', 'Admin\OfferController::store');
$routes->get('admin/offer/generate-pdf/(:num)', 'Admin\OfferController::generatePdf/$1');
$routes->get('admin/offer/download/(:num)', 'Admin\OfferController::download/$1');
$routes->get('admin/offer/email/(:num)', 'Admin\OfferController::email/$1');

$routes->get('offer/respond/(:segment)', 'OfferResponseController::show/$1');
$routes->match(['get', 'post'], 'offer/respond/(:segment)/(:alpha)', 'OfferResponseController::respond/$1/$2');
