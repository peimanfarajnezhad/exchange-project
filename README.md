# Exchange Project

## Setup scheduling
add a crone to your crontab
```
* * * * * cd /absolute/path/to/project && php artisan schedule:run >> /dev/null 2>&1
```
