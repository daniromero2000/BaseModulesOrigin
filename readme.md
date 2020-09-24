## Test register
## Test register 2 - Jsoe
<p align="center">
<a href=""><img src="" alt=""></a>
</p>

<p align="center">
<a href=""><img src="" alt=""></a>
<a href=""><img src="" alt=""></a>
<a href=""><img src="" alt=""></a>
<a href=""><img src="" alt=""></a>
<a href=""><img src="" alt=""></a>
</p>

## Topics
1. [Introduction](#introduction)
2. [Documentation](#documentation)
3. [Requirements](#requirements)
4. [Installation & Configuration](#installation-and-configuration)
5. [License](#license)
6. [Security Vulnerabilities](#security-vulnerabilities)
7. [Miscellaneous](#miscellaneous)

### Introduction

[SmartCommerce](https://www..com) is a hand tailored E-Commerce framework built on some of the hottest opensource technologies
such as [Laravel](https://laravel.com) (a [PHP](https://secure.php.net/) framework) and [Vue.js](https://vuejs.org)
a progressive Javascript framework.

**SmartCommerce can help you to cut down your time, cost, and workforce for building online stores or migrating from physical stores
to the ever demanding online world. Your business -- whether small or huge -- can benefit. And it's very simple to set it up.**

**Read our documentation: [SmartCommerce Docs](https://devdocs..com/)**

**For Developers**:
Take advantage of two of the hottest frameworks used in this project -- Laravel and Vue.js -- both of which have been used in SmartCommerce.

### Documentation

#### SmartCommerce Documentation [https://devdocs..com](https://devdocs..com)

### Requirements

* **OS**: Ubuntu 16.04 LTS or higher / Windows 7 or Higher (WampServer / XAMPP).
* **SERVER**: Apache 2 or NGINX.
* **RAM**: 4 GB or higher.
* **PHP**: 7.3.0 or higher.
* **Processor**: Clock Cycle 1 Ghz or higher.
* **For MySQL users**: 5.7.23 or higher.
* **For MariaDB users**: 10.2.7 or Higher.
* **Node**: 8.11.3 LTS or higher.
* **Composer**: 1.6.5 or higher.

### Installation and Configuration

**1. You can install SmartCommerce by using the console installer.**

##### a. Create a new laravel Project

composer create-project --prefer-dist laravel/laravel [project name]

##### b. Install required packages

Edit composer.json adding the following pakages:
* **kalnoy/nestedset**: composer require kalnoy/nestedset (https://packagist.org/packages/kalnoy/nestedset).
* **laravel/helpers**: composer require laravel/helpers (https://laravel.com/docs/7.x/helpers).
* **nwidart/laravel-modules**: composer require nwidart/laravel-modules (https://nwidart.com/laravel-modules/v6/introduction).
* **santigarcor/laratrust**: composer require santigarcor/laratrust THEN php artisan vendor:publish --tag="laratrust" (https://laratrust.santigarcor.me/).
* **barryvdh/laravel-debugbar**: composer require barryvdh/laravel-debugbar --dev (https://github.com/barryvdh/laravel-debugbar).
* **laravel/ui**: composer require laravel/ui (https://laravel.com/docs/7.x/authentication).
* **nicolaslopezj/searchable**: Simply add the package to your composer.json file and run composer update "nicolaslopezj/searchable": "1.*" (https://github.com/nicolaslopezj/searchable).
* **maatwebsite/excel**: composer require maatwebsite/excel (https://docs.laravel-excel.com/3.1/getting-started/installation.html).

##### c. clone smartCommerce Modules

1. Create a folder in project root called "Modules".
2. Clone the smartcommerce Modules into that folder.
3. Extract the folders in "smartcommerce" and paste it into "Modules". check for hidden files and folders... those need to be moved to.

##### d. setting up .env file:

1. Copy the .env file content a paste it in the .env of the project.
2. Set up all project config parameters in the .env project file (database connection)

##### e. setting up modules:

1. Run composer dump-autoload for data recongnition.
2. Run php artisan module:list for modules recognition. at this point every module is disabled.

##### e. setting up Generals module:

1. Run php artisan module:enable Generals.
2. Run php artisan vendor:publish and publish the module content.
3. php artisan module:publish Generals
4. Run php artisan optimize for config recognition.

##### f. setting up Companies module:

1. Run php artisan module:enable Companies.
2. Run php artisan vendor:publish and publish the module content.
3. In the config folder is a new file called companies... copy the content of this file into the laratrust and the auth file and into the specific places.
4. Run php artisan optimize for config recognition.

##### g. setting up Customers module:

1. Run php artisan module:enable Customers.
2. Run php artisan vendor:publish and publish the module content.
3. Run php artisan optimize for config recognition.

##### h. setting up Ecommerce module:

1. Run php artisan module:enable Ecommerce.
2. Run php artisan vendor:publish and publish the module content.
3. Run php artisan optimize for config recognition.

##### i. setting up Pqrs module:

1. Run php artisan module:enable Pqrs.
2. Run php artisan vendor:publish and publish the module content.
3. Run php artisan optimize for config recognition.

##### J. setting up Courses module:

1. Run php artisan module:enable Courses.
2. Run php artisan vendor:publish and publish the module content.
3. Run php artisan optimize for config recognition.

##### K. Migrating the Database:

1. create a new database.
2. register database config in .env file of the project
3. Run php artisan migrate
4. Run php artisan module:migrate --seed [module name]. Is necesary to migrate every module enabled.
5. Module migration order: Generals, Customers, Companies, Ecommerce, Pqrs, Courses

##### k. Setting up VueJs:

1. Run npm install --save
2. Run npm install vue
3. Run npm install vuex --save
4. Run npm install vue bootstrap-vue bootstrap
5. Run npm install --save vuedraggable
6. Run npm run dev

##### l. Setting up VueJs on Customers module:

1. Check if the file exists in public/js customers.js, if it doesn't exist, proceed to create it.
2. Run npm run dev

##### M. Setting up VueJs on Ecommerce module:

1. Check if the file exists in public/js ecommerce.js, if it doesn't exist, proceed to create it.
2. Run npm run dev


**To execute SmartCommerce**:

##### On server:

Warning: Before going into production mode we recommend you uninstall developer dependencies.
In order to do that, run the command below:

> composer install --no-dev

~~~
Open the specified entry point in your hosts file in your browser or make an entry in hosts file if not done.
~~~

##### On local:

~~~
php artisan serve
~~~


**How to log in as admin:**

> *http(s)://example.com/admin/login*

~~~
email:desarrollo@smartcommerce.com.co
password:secret
~~~

### License
SmartCommerce is a truly opensource E-Commerce framework which will always be free under the [MIT License](https://github.com/SmartCommerce/SmartCommerce/blob/master/LICENSE).

### Security Vulnerabilities
Please don't disclose security vulnerabilities publicly. If you find any security vulnerability in SmartCommerce then please email us: mailto:support@SmartCommerce.com.

