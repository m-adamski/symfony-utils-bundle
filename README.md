# Utils Bundle for Symfony

A collection of additional Symfony 4 tools that are small enough to create separate packages for them.

This bundle is compatible with Symfony 4.1 and Symfony 5.0. Symfony 3.4 compatibility abandoned.

## Installation

This bundle can be installed by Composer:

```
$ composer require m-adamski/symfony-utils-bundle
```

## What's included?

The package includes the following tools and helpers:

| Name               | Category              | Description                                             |
| ------------------ | --------------------- | ------------------------------------------------------- |
| AssetHashExtension | Twig Extension        | The tool adds an MD5 checksum to the indicated resource |
| SymfonyStyle       | Console Symfony Style | Console Symfony Style with additional functionalities   |

### AssetHashExtension

An additional Twig function named ``asset_hash`` is registered, which inserts the path to the indicated resource, and additionally inserts the MD5 checksum of the resource.

Example:

```(html)
<script type="text/javascript" src="{{ asset_hash('assets/js/vendor.min.js') }}"></script>
```

The result of the function will be the path to the resource and its checksum.

```(html)
<script type="text/javascript" src="/assets/js/vendor.min.js?78743b772817efd0530ca37eb28faf15"></script>
```

### SymfonyStyle

A class that extends the capabilities of the core Symfony Console Style.
It contains additional functions that will help in the presentation of information returned to the user.

## License

MIT
