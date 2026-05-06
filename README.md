# Mini DataTables

A lightweight Laravel DataTables package inspired by Yajra DataTables.

---

## Features

- Simple JSON response
- Query Builder support
- Search support
- Pagination
- Sorting
- Custom columns
- Laravel auto-discovery

---

# Installation

Install package via Composer:

```bash
composer require crushjs/mini-datatables
```

---

# Laravel Auto Discovery

The package supports Laravel auto-discovery.

No manual provider registration required.

---

# Usage

## Basic Example

```php
use App\Models\User;
use Crushjs\MiniDataTables\MiniDataTables;

Route::get('/users', function () {
    return MiniDataTables::of(
        User::query()
    )->make();
});
```

---

# Response Example

```json
{
  "data": [
    {
      "id": 1,
      "name": "John"
    },
    {
      "id": 2,
      "name": "Jane"
    }
  ]
}
```

---

# Search

## URL

```txt
/users?search=john
```

## Example

```php
return MiniDataTables::of(
    User::query()
)
->search('name')
->make();
```

---

# Pagination

## Example

```php
return MiniDataTables::of(
    User::query()
)
->paginate(10)
->make();
```

---

# Sorting

## URL

```txt
/users?sort=id
```

## Example

```php
return MiniDataTables::of(
    User::query()
)
->sort()
->make();
```

---

# Add Custom Column

```php
return MiniDataTables::of(
    User::query()
)
->addColumn('action', function ($user) {
    return '<button>Edit</button>';
})
->make();
```

---

# Edit Column

```php
return MiniDataTables::of(
    User::query()
)
->editColumn('name', function ($user) {
    return strtoupper($user->name);
})
->make();
```

---

# Full Example

```php
use App\Models\User;
use Crushjs\MiniDataTables\MiniDataTables;

Route::get('/users', function () {

    return MiniDataTables::of(
        User::query()
    )
    ->search('name')
    ->sort()
    ->paginate(10)
    ->addColumn('action', function ($user) {
        return '<button>Edit</button>';
    })
    ->make();

});
```

---

# Package Structure

```txt
mini-datatables/
 ├── composer.json
 ├── README.md
 └── src/
      ├── MiniDataTables.php
      ├── MiniDataTablesServiceProvider.php
      └── Facades/
           └── MiniTable.php
```

---

# Local Development

Clone repository:

```bash
git clone https://github.com/crushjs/mini-datatables.git
```

Install dependencies:

```bash
composer install
```

---

# Testing Inside Laravel

Add local repository to Laravel project:

```json
"repositories": [
    {
        "type": "path",
        "url": "./packages/crushjs/mini-datatables"
    }
]
```

Then install:

```bash
composer require crushjs/mini-datatables:@dev
```

---

# Requirements

- PHP 8.1+
- Laravel 10+
- Laravel 11+
- Laravel 12+

---

# Roadmap

- Global search
- Multi-column sorting
- Export CSV
- Export Excel
- API Resources
- Vue support
- React support

---

# License

MIT License

---

# Author

Crushjs

GitHub:
https://github.com/crushjs

```
