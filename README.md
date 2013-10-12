What is this package
====================

Many packages need the project hosting them to have some secret key or some unique key.
For instance, you can use this key to prefix your cache keys if you cache system is shared with other applications.

This package contains a Mouf installer that will create a `SECRET` constant in your `config.php` and initialize
it to some random value each time you install the application.

Mouf package
------------

This package is part of Mouf (http://mouf-php.com), an effort to ensure good developing practices by providing a graphical dependency injection framework.
