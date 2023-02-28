<?php
/**
 * Routes configuration.
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * It's loaded within the context of `Application::routes()` method which
 * receives a `RouteBuilder` instance `$routes` as method argument.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;

return static function (RouteBuilder $routes) {
    /*
     * The default class to use for all routes
     *
     * The following route classes are supplied with CakePHP and are appropriate
     * to set as the default:
     *
     * - Route
     * - InflectedRoute
     * - DashedRoute
     *
     * If no call is made to `Router::defaultRouteClass()`, the class used is
     * `Route` (`Cake\Routing\Route\Route`)
     *
     * Note that `Route` does not do any inflections on URLs which will result in
     * inconsistently cased URLs when used with `{plugin}`, `{controller}` and
     * `{action}` markers.
     */
    $routes->setRouteClass(DashedRoute::class);

    $routes->scope('/', function (RouteBuilder $builder) {
        /*
         * Here, we are connecting '/' (base path) to a controller called 'Pages',
         * its action called 'display', and we pass a param to select the view file
         * to use (in this case, templates/Pages/home.php)...
         */
        $builder->connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);

        /*
         * ...and connect the rest of 'Pages' controller's URLs.
         */
        $builder->connect('/pages/*', 'Pages::display');

        /*
         * Connect catchall routes for all controllers.
         *
         * The `fallbacks` method is a shortcut for
         *
         * ```
         * $builder->connect('/{controller}', ['action' => 'index']);
         * $builder->connect('/{controller}/{action}/*', []);
         * ```
         *
         * You can remove these routes once you've connected the
         * routes you want in your application.
         */
        $builder->fallbacks();
    });


      $routes->scope('/api' , ["prefix"=>'Api'], function (RouteBuilder $builder) {
      
        $builder->setExtensions(['json', 'xml']);

      //Users
      $builder->connect('/login', ['controller' => 'Users', 'action' => 'login'])->setMethods(['POST']);
      $builder->connect('/users/index', ['controller' => 'Users', 'action' => 'index'])->setMethods(['GET']);

      //Categories
      $builder->connect('/categories/create', ['controller' => 'Categories', 'action' => 'create'])->setMethods(['POST']);
      $builder->connect('/categories/update/:id', ['controller' => 'Categories', 'action' => 'update'])->setPass(['id'])->setMethods(['POST']);
      $builder->connect('/categories/delete/:id', ['controller' => 'Categories', 'action' => 'delete'])->setPass(['id'])->setMethods(['DELETE']);
      $builder->connect('/categories/view/:id', ['controller' => 'Categories', 'action' => 'view'])->setPass(['id'])->setMethods(['GET']);
      $builder->connect('/categories/index', ['controller' => 'Categories', 'action' => 'index'])->setMethods(['GET']);
    
      //Articles
      $builder->connect('/articles/create', ['controller' => 'Articles', 'action' => 'create'])->setMethods(['POST']);
      $builder->connect('/articles/update/:id', ['controller' => 'Articles', 'action' => 'update'])->setPass(['id'])->setMethods(['POST']);
      $builder->connect('/articles/delete/:id', ['controller' => 'Articles', 'action' => 'delete'])->setPass(['id'])->setMethods(['DELETE']);
      $builder->connect('/articles/view/:id', ['controller' => 'Articles', 'action' => 'view'])->setPass(['id'])->setMethods(['GET']);
      $builder->connect('/articles/index', ['controller' => 'Articles', 'action' => 'index'])->setMethods(['GET']);
    
    
      //Advertises
      $builder->connect('/advertises/create', ['controller' => 'Advertises', 'action' => 'create'])->setMethods(['POST']);
      $builder->connect('/advertises/update/:id', ['controller' => 'Advertises', 'action' => 'update'])->setPass(['id'])->setMethods(['POST']);
      $builder->connect('/advertises/delete/:id', ['controller' => 'Advertises', 'action' => 'delete'])->setPass(['id'])->setMethods(['DELETE']);
      $builder->connect('/advertises/view/:id', ['controller' => 'Advertises', 'action' => 'view'])->setPass(['id'])->setMethods(['GET']);
      $builder->connect('/advertises/index', ['controller' => 'Advertises', 'action' => 'index'])->setMethods(['GET']);
    
      
    
      //Comments 
      $builder->connect('/comments/active-and-block/:commentID', ['controller' => 'Comments', 'action' => 'activeAndBlock'])->setPass(['commentID'])->setMethods(['PUT']);
      $builder->connect('/comments/index', ['controller' => 'Comments', 'action' => 'index'])->setMethods(['GET']);
    
    
      //Contacts 
      $builder->connect('/contacts/index', ['controller' => 'Contacts', 'action' => 'index'])->setMethods(['GET']);
    
    
      //EmailList 
      $builder->connect('/email-list/index', ['controller' => 'EmailList', 'action' => 'index'])->setMethods(['GET']);
    
    
    
      //About 
      $builder->connect('/about/view/:id', ['controller' => 'About', 'action' => 'view'])->setPass(['id'])->setMethods(['GET']);
      $builder->connect('/about/update/:id', ['controller' => 'About', 'action' => 'update'])->setPass(['id'])->setMethods(['POST']);
      $builder->connect('/homepage', ['controller' => 'About', 'action' => 'homepage'])->setMethods(['GET']);
    
      
      });
    

      //////////////mobile api 

      $routes->scope('/api-mobile' , ["prefix"=>'ApiMobile'], function (RouteBuilder $builder) {
      
        $builder->setExtensions(['json', 'xml']);

      //articles
      $builder->connect('/homepage', ['controller' => 'Articles', 'action' => 'homepage'])->setMethods(['GET']);
      $builder->connect('/videos', ['controller' => 'Articles', 'action' => 'videos'])->setMethods(['GET']);
      $builder->connect('/article-details/:articleID', ['controller' => 'Articles', 'action' => 'articleDetails'])->setPass(['articleID'])->setMethods(['GET']);

      //users
      $builder->connect('/users/register', ['controller' => 'Users', 'action' => 'register'])->setMethods(['POST']);
      $builder->connect('/users/login', ['controller' => 'Users', 'action' => 'login'])->setMethods(['POST']);
      $builder->connect('/users/profile', ['controller' => 'Users', 'action' => 'profile'])->setMethods(['GET']);

    });

    //////////////////
    $routes->scope('/api-website' , ["prefix"=>'ApiWebsite'], function (RouteBuilder $builder) {
      
      $builder->setExtensions(['json', 'xml']);

    //articles
    $builder->connect('/homepage', ['controller' => 'Articles', 'action' => 'homepage'])->setMethods(['GET']);
    $builder->connect('/videos', ['controller' => 'Articles', 'action' => 'videos'])->setMethods(['GET']);
    $builder->connect('/article-details/:id', ['controller' => 'Articles', 'action' => 'articleDetails'])->setPass(['id'])->setMethods(['GET']);
    //email list
    $builder->connect('/email-list', ['controller' => 'Articles', 'action' => 'emailList'])->setMethods(['POST']);
   //comments
   $builder->connect('/add-comment', ['controller' => 'Comments', 'action' => 'addComment'])->setMethods(['POST']);
   //about
   $builder->connect('/about', ['controller' => 'About', 'action' => 'about'])->setMethods(['GET']);
   $builder->connect('/contact', ['controller' => 'About', 'action' => 'contact'])->setMethods(['POST']);

   
  });
    //////////////////
};
