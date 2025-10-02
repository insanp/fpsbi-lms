<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/silabus', 'Home::silabus');

// member section
$routes->group('member', ['namespace' => '\App\Controllers\Member'], function ($routes) {
    $routes->get('/', 'Home::index');
    $routes->get('dashboard', 'Home::dashboard');
    $routes->get('export', 'Home::export');
    $routes->post('import', 'Home::import');
    $routes->get('download/(:segment)', 'Home::download/$1');
    $routes->get('no-access', 'Home::noAccess');
    $routes->get('notes/list', 'Notes::listNotes');
});

$routes->group('member/profile', ['namespace' => '\App\Controllers\Member'], function ($routes) {
    $routes->get('/', 'Profile::index');
    $routes->post('/', 'Profile::index');
    $routes->get('edit', 'Profile::edit');
    $routes->post('update', 'Profile::update');
});

$routes->group('member/code-of-ethics', ['namespace' => '\App\Controllers\Member'], function ($routes) {
    $routes->get('/', 'CodeEthics::index');
    $routes->get('topic/(:segment)', 'CodeEthics::showTopic/$1');
    $routes->post('final-assessment/start', 'CodeEthics::startFA');
    $routes->get('final-assessment/show', 'CodeEthics::showFA');
    $routes->post('final-assessment/submit', 'CodeEthics::submitFA');
    $routes->get('final-assessment/result', 'CodeEthics::resultFA');
});

$routes->group('member/api', ['namespace' => '\App\Controllers\Member'], function ($routes) {
    $routes->get('task/load-quiz/(:segment)', 'Task::loadQuiz/$1');
    $routes->post('task/submit-mc-answer', 'Task::submitMCAnswer');
    $routes->post('task/create-attempt', 'Task::createAttempt');
    $routes->post('task/complete-quiz', 'Task::completeQuiz');
    $routes->post('task/complete-assignment', 'Task::completeAssignment');
    $routes->post('gumlet-video/get-signed-url', 'GumletVideo::getSignedUrl');
    $routes->post('gumlet-video/generate-widget', 'GumletVideo::generateGumletVideoJS');
    $routes->post('check-file-ajax', 'Home::checkFileAJAX');
    $routes->post('notes/save', 'Notes::save');
});

$routes->get('/auth/login-form', 'Auth::showLoginForm');
$routes->post('/auth/login', 'Auth::login');
$routes->get('/auth/logout', 'Auth::logout');

// admin section
$routes->get('/admin', 'Admin\Home::index');
$routes->get('/admin/dashboard', 'Admin\Home::dashboard');

$routes->group('admin/users', ['namespace' => '\App\Controllers\Admin'], function ($routes) {
    $routes->get('/', 'Users::index');
    $routes->get('create', 'Users::create');
    $routes->post('store', 'Users::store');
    $routes->get('search-suggestion', 'Users::searchSuggestion');
    $routes->get('(:segment)', 'Users::show/$1');
    $routes->get('(:segment)/edit', 'Users::edit/$1');
    $routes->post('update', 'Users::update');
});

$routes->group('admin/course-enrollments', ['namespace' => '\App\Controllers\Admin'], function ($routes) {
    $routes->get('/', 'CourseEnrollments::index');
    $routes->get('create', 'CourseEnrollments::create');
    $routes->post('store', 'CourseEnrollments::store');
    $routes->get('(:segment)', 'CourseEnrollments::show/$1');
    $routes->get('(:segment)/edit', 'CourseEnrollments::edit/$1');
    $routes->post('update', 'CourseEnrollments::update');
    $routes->delete('delete/(:num)', 'CourseEnrollments::delete/$1');
    $routes->get('user-progress/(:num)/(:num)', 'CourseEnrollments::showUserProgress/$1/$2');
    $routes->get('refresh-user-progress/(:num)/(:num)', 'CourseEnrollments::refreshUserProgress/$1/$2');
});

$routes->group('admin/topics', ['namespace' => '\App\Controllers\Admin'], function ($routes) {
    $routes->get('/', 'Topic::index');
    $routes->get('create', 'Topic::create');
    $routes->post('store', 'Topic::store');
    $routes->get('(:segment)', 'Topic::show/$1');
    $routes->get('(:segment)/edit', 'Topic::edit/$1');
    $routes->post('update', 'Topic::update');
});

$routes->group('admin/course-topics', ['namespace' => '\App\Controllers\Admin'], function ($routes) {
    $routes->get('/', 'CourseTopics::index');
    $routes->get('create', 'CourseTopics::create');
    $routes->post('store', 'CourseTopics::store');
    $routes->get('(:segment)/edit', 'CourseTopics::edit/$1');
    $routes->post('update', 'CourseTopics::update');
    $routes->delete('delete/(:segment)', 'CourseTopics::delete/$1');
    $routes->get('(:segment)', 'CourseTopics::show/$1');
});

$routes->group('admin/tasks', ['namespace' => '\App\Controllers\Admin'], function ($routes) {
    $routes->get('create/(:segment)', 'Task::create/$1');
    $routes->post('store', 'Task::store');
    $routes->get('(:segment)', 'Task::show/$1');
    $routes->get('(:segment)/edit', 'Task::edit/$1');
    $routes->post('update', 'Task::update');
    $routes->post('updateQuestions', 'Task::updateQuestions');
    $routes->delete('delete/(:segment)', 'Task::delete/$1');
});

$routes->group('admin/alumni', ['namespace' => '\App\Controllers\Admin'], function ($routes) {
    $routes->get('/', 'Alumni::index');
    $routes->get('create', 'Alumni::create');
    $routes->post('store', 'Alumni::store');
    $routes->get('(:segment)/edit', 'Alumni::edit/$1');
    $routes->post('update', 'Alumni::update');
    $routes->delete('delete/(:num)', 'Alumni::delete/$1');
});
/*
$routes->get('/informasi-program', 'Home::informasiProgram');
$routes->get('/tentang-kami', 'Home::tentangKami');
$routes->get('/kontak-kami', 'Home::kontakKami');
$routes->post('/kontak-kami', 'Home::kontakKami');
$routes->get('/faq', 'Home::faq');
$routes->get('/daftar-anggota', 'Home::daftarAnggota');
$routes->get('/member-only', 'Member::index');
$routes->get('/pendaftaran-pelatihan', 'Home::pendaftaranPelatihanNextBatch');
//$routes->get('/pendaftaran-pelatihan', 'Home::pendaftaranPelatihan');
//$routes->post('/pendaftaran-pelatihan', 'Home::pendaftaranPelatihan');

$routes->get('/client-forms/(:any)', 'ClientForms::show/$1');
$routes->post('/client-forms/(:any)', 'ClientForms::process/$1');

// other external API section
$routes->group('api/chatgpt', ['namespace' => '\App\Controllers\Api'], function ($routes) {
    $routes->post('create-thread', 'ChatGPT::createNewThread');
    $routes->delete('delete-thread/(:segment)', 'ChatGPT::deleteThread/$1');
    $routes->post('send-message/(:segment)', 'ChatGPT::sendMessage/$1');
    $routes->post('get-response', 'ChatGPT::getChatGptResponse');
});
*/