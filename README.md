# command-validation
Enable a method for Artisan Commands to validate the output of methods like `ask`.

## Installing

Install using Composer `composer require larapack/command-validation 1.*`.

## Usage

First add the trait `Validateable` to your Artisan Command.
```
<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Larapack/CommandValidation/Validateable;

class ExampleCommand extends Command
{
  use Validateable;
  
  // ...
}
```

Then use the `validate`-method:
```
  public function fire()
  {
    // We want to get the age from the user, but we would like to validate it.
    // So we use the validate method.
    $age = $this->validate(function() {
      // Here we ask the question we want and return the output
      // Any method returning a value from the command line input can be used here.
      return $this->ask('What is your age?', null);
    }, function($value) {
      // Here we validate the value
      // If the value is NOT valid, we should return a error message.
      // If the value is valid, we don't need to return anything.
      // NOTE: Returning true will also be valid.
      if (!is_numeric($value)) return "Age [{$value}] is not numeric.";
    });
    
    // Once we are here you will have the validage age
    $this->info("So you are {$age} years old.");
  }
```

It will look like this:
![Command Line Example](http://static-content.webman.io/github.com/larapack/command-validation/command-line.png)
