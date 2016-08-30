# Inventorus SDK for PHP

Welcome to Inventorus PHP SDK. This repository contains SDK and its documentation.

## Documentation

This repository contains brief documentation, we recommend reading full [here](https://inventorus.github.io).
To learn more about responses read [API documentation](https://inventorus.github.io).
For usage cases please visit [examples](https://github.com/inventorus/examples).

## Installation

The SDK has dependencies over external libraries. These dependencies
are defined in the `composer.json` file. To resolve these dependencies, we use
the *Composer* package manager. You will need internet access for this.

1. If you have not already installed Composer, [install the latest version](https://getcomposer.org/download/).
2. Once Composer is installed, from commandline, run `composer install`
    to install dependencies.

## Configuration

The SDK might need to be configured with your API credentials. To do that,
open the file "Configuration.php" and edit it's contents. You can also pass
API credentials as parameter when creating client class instance.

## Usage

For using this SDK do the following:

1. Use Composer to install the dependencies. See the section "Installation".
2. See that you have configured your SDK correctly. See the section "Configuration".
3. Depending on your project setup, you might need to include composer's autoloader
   in your PHP code to enable autoloading of classes.

   ```PHP
   require_once "vendor/autoload.php";
   ```
4. Import the SDK client in your project:

    ```PHP
    use Inventorus\InventorusClient;
    ```
5. Instantiate the client:

    ```PHP
    $client = new InventorusClient();
    ```
