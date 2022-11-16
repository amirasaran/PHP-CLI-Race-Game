README
===

## Instructions

1. Checkout the project
2. Execute `composer install`
3. To use the project execute `php src/manager.php`

## Tests

```php
php vendor/bin/phpunit
```

## Building Docker Image

```shell
DOCKER_BUILDKIT=0 docker build . -t race-game:latest
```

## Run with docker

After building the above docker image you can run this command

### Run the game
```shell
docker run -it race-game:latest php src/manager.php race --number-of-vehicle 4
```

### Tests with docker
```shell
docker run -it race-game:latest php vendor/bin/phpunit
```



## Example outputs

### Invalid Command:

```shell
$ docker run -it race-game:latest php src/manager.php
#################################
Hello welcome to the Actineo Race Game
Available commands:
   - race
   - help
This messages shows because of your request help
or the requested command is not found
#################################
```

### Invalid Arguments:

```shell
$ docker run -it race-game:latest php src/manager.php race
The required argument --number-of-vehicle is not present. How many vehicles will participate in the race?
there is some errors in running command
```

### A valid running:

```shell
$ docker run -it race-game:latest php src/manager.php race --number-of-vehicle 4
CLI Race Game
=============
4 vehicle(s) in the race
  1. boat
  2. car
  3. rocket
  4. scooter

Pick a vehicle(Participate Number #1): 1
  1. boat
  2. car
  3. rocket
  4. scooter

Pick a vehicle(Participate Number #2): 2
  1. boat
  2. car
  3. rocket
  4. scooter

Pick a vehicle(Participate Number #3): 3
  1. boat
  2. car
  3. rocket
  4. scooter

Pick a vehicle(Participate Number #4): 4
What distance in meters does cover the race? 50
+----------------------+----------------------+----------------------+
| name                 | time                 | status               |
+----------------------+----------------------+----------------------+
| boat                 | 1028.89              | loser                |
| car                  | 1666.67              | loser                |
| rocket               | 603504               | loser                |
| scooter              | 625                  | winner               |
+----------------------+----------------------+----------------------+

```


### Tests output:

```shell
$ docker run -it race-game:latest php vendor/bin/phpunit
PHPUnit 9.5.26 by Sebastian Bergmann and contributors.

.....                                                               5 / 5 (100%)

Time: 00:00.003, Memory: 6.00 MB

OK (5 tests, 18 assertions)
```
