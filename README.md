# Installation:

1.  Configure the laravel project and it's database.
2.  Run in project directory:
*  `composer require scary-layer/hush`
*  `php artisan vendor:publish --tag=hush --force` - be careful, it may replace some of your existing files.
*  `php artisan migrate --seed` - it will also create dev, admin and simple user.
3.  Edit User model.
*  Inherit ```ScaryLayer\Hush\Traits\Permissiable``` trait by your User model.
*  Also you may add field `role` to fillable array.

You should have something like:

```php
<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use ScaryLayer\Hush\Traits\Permissiable;

class User extends Authenticatable
{
    use Notifiable;
    use Permissiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
```

### Congrats, you have successfully installed Hush!
If you encounter any problems, please, notify us. You can do that by creating an issue or by sending email to maintainer.
