Racing PHP CLI Game
===

## Instructions

1. Create an interactive PHP CLI race game
2. Request the number of vehicles that will participate in the race
3. Request the user to pick a vehicle from a list built using the different vehicles from the JSON objects provided under `data/vehicles` folder
4. Request the user to enter the race distance
5. Calculate which vehicle will win the race
6. Display how long took each to complete the distance and the winner

## Notes

You might need these formulas to calculate time, distance and velocity:

v = x/t

### Legend

x = distance (m)
v = velocity (m/s)
t = time (s)

You can use https://github.com/wp-cli/php-cli-tools to help build a nice CLI UX.

## Requirements

1. The system can be extended with many different vehicles and each with its own properties following the template JSON schema (`data/vehicle_template.json`)
2. We will check the code adheres to the following principles & standards:
   1. SOLID
   2. KISS
   3. YAGNI
   4. DRY
   5. Composition over inheritance
   6. Expressive code over comments
3. The game must be in working conditions
4. Unit & integration tests are good to have