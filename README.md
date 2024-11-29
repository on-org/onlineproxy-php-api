# OnlineProxy PHP API

[![Packagist](https://img.shields.io/packagist/v/on-org/onlineproxy-php.svg)](https://packagist.org/packages/on-org/onlineproxy-php)

A PHP wrapper for managing proxies from [OnlineProxy.io](https://onlineproxy.io).

## 🌟 Features

- 🌐 **Proxy Management**: Easily manage proxies from OnlineProxy.io in your PHP projects.
- 🛠️ **Simple Integration**: Straightforward setup and usage with clear, concise methods.
- 📚 **Comprehensive API Support**: Access to a wide range of API functionalities, including managing proxies, fetching user balance, and ordering proxies.
- 🐞 **Bug Reporting**: Quickly report issues through GitHub.

## ✨ Introduction

`OnlineProxy PHP API` simplifies the integration of proxy management services into PHP applications. Its intuitive methods and straightforward design allow developers to focus on building applications without worrying about low-level HTTP integrations.

## ⚙️ Installation

To use the library in your PHP project, simply include the classes manually or through a PSR-4 autoloader (e.g., Composer):

```bash
composer require on-org/onlineproxy-php-api
```

## 🗂 Quick Setup

### Initialize the API Client

```php
require 'vendor/autoload.php';

use onOrg\OnlineProxyApi\OnlineProxyApi;

$apiKey = 'your_api_key_here';
$locale = 'en'; // 'en', 'ru', or null for default
$devId = null;  // Optional developer ID

$client = new OnlineProxyApi($apiKey, $locale, $devId);
```

## 🛠️ Methods

### 🌍 `getProxyList`

- **Description**: Retrieves a list of all available proxies.
- **Documentation**: [[ru](https://onlineproxy.io/ru/documentation/api/get/proxies)] [[en](https://onlineproxy.io/documentation/api/get/proxies)].
- **Example**:

```php
$proxies = $client->getProxyList();
print_r($proxies);
```

---

### 🌐 `getProxy`

- **Description**: Retrieves details about a specific proxy by its ID.
- **Documentation**: [[ru](https://onlineproxy.io/ru/documentation/api/get/proxies_id_)] [[en](https://onlineproxy.io/documentation/api/get/proxies_id_)].
- **Parameters**:
    - `id` (string): The ID of the proxy.
- **Example**:

```php
$proxyId = 'proxy_id_here';
$proxy = $client->getProxy($proxyId);
print_r($proxy);
```

---

### 💰 `getUserBalance`

- **Description**: Retrieves the current user balance.
- **Documentation**: [[ru](https://onlineproxy.io/ru/documentation/api/get/balance)] [[en](https://onlineproxy.io/documentation/api/get/balance)].
- **Example**:

```php
$balance = $client->getUserBalance();
print_r($balance);
```

---

### 🔄 `rotateProxy`

- **Description**: Rotates the IP address of an active proxy.
- **Documentation**: [[ru](https://onlineproxy.io/ru/documentation/api/get/rotate)] [[en](https://onlineproxy.io/documentation/api/get/rotate)].
- **Example**:

```php
$rotationResult = $client->rotateProxy();
print_r($rotationResult);
```

---

### 💬 `createOrUpdateProxyComment`

- **Description**: Adds or updates a comment for a specific proxy.
- **Documentation**: [[ru](https://onlineproxy.io/ru/documentation/api/post/proxies_id__comment)] [[en](https://onlineproxy.io/documentation/api/post/proxies_id__comment)].
- **Parameters**:
    - `id` (string): The ID of the proxy.
    - `comment` (string): The comment to add or update.
- **Example**:

```php
$proxyId = 'proxy_id_here';
$comment = 'New comment';
$result = $client->createOrUpdateProxyComment($proxyId, $comment);
print_r($result);
```

---

### 📋 `getAvailableProxiesForOrder`

- **Description**: Fetches a list of proxies available for order.
- **Documentation**: [[ru](https://onlineproxy.io/ru/documentation/api/get/filters)] [[en](https://onlineproxy.io/documentation/api/get/filters)].
- **Example**:

```php
$availableProxies = $client->getAvailableProxiesForOrder();
print_r($availableProxies);
```

---

### 🛒 `orderProxy`

- **Description**: Orders a new proxy.
- **Documentation**: [[ru](https://onlineproxy.io/ru/documentation/api/post/order)] [[en](https://onlineproxy.io/documentation/api/post/order)].
- **Parameters**:
    - `orderData` (array): An array of order details.
- **Example**:

```php
$orderData = [
    'proxyType' => 'HTTP',
    'quantity' => 1,
    'location' => 'USA',
];
$orderResult = $client->orderProxy($orderData);
print_r($orderResult);
```

---

### 📊 `getProxyTariffs`

- **Description**: Retrieves available proxy tariffs.
- **Documentation**: [[ru](https://onlineproxy.io/ru/documentation/api/get/tariffs)] [[en](https://onlineproxy.io/documentation/api/get/tariffs)].
- **Example**:

```php
$tariffs = $client->getProxyTariffs();
print_r($tariffs);
```

---

## 📚 Additional Resources

- **[OnlineProxy.io](https://onlineproxy.io)**: Official website for managing proxies.
- **[GitHub Repository](https://github.com/on-org/onlineproxy-php-api)**: View the source code and contribute to the project.
- **[Documentation](https://docs.onlineproxy.io)**: Comprehensive API documentation.

## 🐞 Reporting Issues

If you encounter any issues or have suggestions for improvements, please create an issue on our [GitHub repository](https://github.com/on-org/onlineproxy-php-api/issues).

---

Happy coding with `OnlineProxy PHP API`!
