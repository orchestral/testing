---
title: Testing Change Log

---

## Version 3.2 {#v3-2}

### v3.2.3 {#v3-2-3}

* Import missing `Orchestra\Installation\Installation`.
* Run `migrate:rollback` on test `tearDown()` method.
* Add `doctrine/dbal` as a dependency.

### v3.2.2 {#v3-2-2}

* Update changes to Orchestra Platform v3.2.5.
* Add `Orchestra\Testing\TestCase::makeInstaller()`.

### v3.2.1 {#v3-2-1}

* Update changes to Orchestra Platform v3.2.2.

### v3.2.0 {#v3-2-0}

* Update support to Orchestra Platform v3.2.
* Remove disabling route filter as it's no longer available.
* Move `Orchestra\Testing\ApplicationTestCase::createApplication()` to `Orchestra\Testing\TestCase::createApplication()`.

## Version 3.1 {#v3-1}

### v3.1.4 {#v3-1-4}

* Update changes to Orchestra Platform v3.1.9.

### v3.1.3 {#v3-1-3}

* Bump `orchestra/testbench` minimum version to `v3.1.3`.
* Update changes to Orchestra Platform v3.1.4.

### v3.1.2 {#v3-1-2}

* Move `Orchestra\Testing\ApplicationTestCase::createApplication()` to `Orchestra\Testing\TestCase::createApplication()`.

### v3.1.1 {#v3-1-1}

* Update changes to Orchestra Platform v3.1.3.

### v3.1.0 {#v3-1-0}

* Update support to Orchestra Platform v3.1.
* Add option to specify application base namespace via `Orchestra\Testing\ApplicationTestCase::$baseNamespace`.

## Version 3.0 {#v3-0}

### v3.0.3 {#v3-0-3}

* Update changes to Laravel Framework v5.0.15, move generated `compiled.php` and `routes.php` to `vendor` directory.
* Move `orchestra/foundation` to suggested requirement because it's mainly useful for extension development.

### v3.0.2 {#v3-0-2}

* Update configuration and views based on Orchestra Platform v3.0.2.

### v3.0.1 {#v3-0-1}

* Update configuration based on Orchestra Platform v3.0.1.

### v3.0.0 {#v3-0-0}

* Initial release for Orchestra Platform v3.0.
* Add `Orchestra\Testing\TestCase` and `Orchestra\Testing\ApplicationTestCase`.
