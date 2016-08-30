![Inventorus](https://cloud.githubusercontent.com/assets/6654344/18091957/ce15e09c-6eca-11e6-9ccc-b83338b52718.png)

# Inventorus PHP SDK

Welcome to Inventorus PHP SDK. This repository contains SDK and its documentation.

If you already have installed Composer, run `composer require inventorus/api-php-sdk`
to install Inventorus SDK.

## Documentation

This repository contains brief documentation, we recommend reading full [here](https://inventorus.github.io).

To learn more about responses read [API documentation](https://inventorus.github.io).

For use cases please visit [examples](https://github.com/inventorus/examples).

## Installation

The SDK has dependencies over external libraries. These dependencies
are defined in the `composer.json` file. To resolve these dependencies, we use
the *Composer* package manager. You will need internet access for this.

1. If you have not already installed Composer, [install the latest version](https://getcomposer.org/download/).
2. Once Composer is installed, from commandline, run `composer require inventorus/api-php-sdk` in your project folder.

## Usage

For using this SDK do the following:

1. Use Composer to install the SDK. See the section "Installation".
2. Depending on your project setup, you might need to include composer's autoloader
   in your PHP code to enable autoloading of classes.

   ```PHP
   require_once "vendor/autoload.php";
   ```
3. Import the SDK client in your project:

    ```PHP
    use Inventorus\InventorusClient;
    ```
4. Instantiate the client:

    ```PHP
    $client = new InventorusClient($yourApiKey);
    ```
