<?php
/* Behzad Ghabaei
 * CS 85_projects/module5
 * MyObject.php
 * Module 5 Assign 5A
 * Designing Your Own Object Oriented World
 * Instructor Seno
 * 7/6/2026
 * github repository: https://github.com/Ghabaei-Behzad/cs85-module5b-oopworld.git
 * XAMPP URL: http://localhost/cs85_projects/module5/MyObject.php

 */
?>


<?php
/* The opening PHP tag will tell the server to start reading the following text as PHP code
 instead of plain HTML.  This class will build a system to track gym sessions. */
class WorkoutLog { //A class acts as a blueprint or a template for creating individual objects (like a specific exercise entry)
    // 5 Properties
    public string $exerciseName;  //This creates a variable (called a property when inside a class) to hold the name of the exercise.
    public int $sets;  //public, means this data can be accessed from anywhere outside of the class. This sets up a property to track how many rounds of the exercise you do.
    public int $reps;  //int, stands for integer, meaning this property must be a whole number.  This sets up a property to track the number of repetitions inside each set.
    public int $weightInLbs; //This tracks the amount of weight used during the exercise, measured in pounds.
    public bool $isCompleted; //This tracks whether you finished the workout entry or not.  Using bool, is boolean, meaning it can only be true or false.

    // Constructor to initialize data, and runs automatically the exact moment you create a new workout entry.
    // double underscore __ means it's a "magic method" that PHP triggers automatically when you type new WorkoutLog()
    public function __construct(string $exerciseName, int $sets, int $reps, int $weightInLbs, bool $isCompleted = false) {  //These are the inputs (called parameters) that you must pass into the class when creating a workout.  False is a default value of $isCompleted, meaning if you do not specify if the workout is finished, PHP automatically assumes it is false (not completed yet).
        $this->exerciseName = $exerciseName;  //This takes the incoming text argument and saves it into the class property we defined earlier.
        $this->sets = $sets; //$this is a special keyword that means "this specific workout object right here."  This saves the incoming set number into this specific workout's $sets property.
        $this->reps = $reps;  //This saves the incoming repetition number into this specific workout's $reps property.
        $this->weightInLbs = $weightInLbs;  //This saves the incoming weight value into this specific workout's $weightInLbs property.
        $this->isCompleted = $isCompleted; //This saves the completion status (either the true/false provided, or the default false).
    }

    // Method 1: Summary display method.   
    // It's job is to take all the stored workout data and format
    // it into a clean, easy-to-read HTML string.
    public function getSummary() {  //It uses a shortcut called a ternary operator (the ? and : symbols), which acts like a quick if/else statement.
        $status = $this->isCompleted ? "<span style='color:green;'>Completed</span>" : "Pending";  //If $this->isCompleted is true, make $status look green, styled HTML word "Completed". Otherwise (if false), make it say "Pending".
        return "Exercise: <strong>{$this->exerciseName} </strong>| Sets: {$this->sets} | Reps: {$this->reps} | Status: {$status}<br>";  //The return keyword sends the final formatted string back to whoever asked for it.
    } //The double quotes " " allow PHP to look inside the string and swap out variables like {$this->exerciseName} with their actual values (a process called string interpolation).

    // Method 2: Calculated value method (Total weight lifted)  
    // Using a class to handle calculations. Instead of manually multiplying
    // gym stats every time, this function calculates the total workout volume
    // (the total weight moved during that exercise).
    public function calculateTotalVolume() {
        return $this->sets * $this->reps * $this->weightInLbs; //It doesn't need any inputs inside the parentheses () because it already has access to all the data it needs inside the class object itself.
    }

    // Method 3: Change a property value (Mark workout as done)
    // a setter or a state-changing method. Its only job is to update the status
    // of the workout from "Pending" to "Completed" without requiring to manually
    // rewrite the whole object.
    public function completeWorkout() {  //It does not need any inputs inside the parentheses () because its only task is to switch a switch that already exists inside the object.
        $this->isCompleted = true;  //This targets the $isCompleted property for this specific workout and changes its value to true.Even if the workout started as false when you created it, calling this method flips it to "Completed".
    }  //This method does not use a return keyword.

   
    // Method 4: Decision logic (AI Generated)
    // An example of conditional logic (making decisions based on data). It looks at the weight stored in the
    // object and categorizes your workout intensity into one of three levels.
    public function evaluateIntensity() {
        if ($this->weightInLbs >= 200) {  //It doesn't need any external inputs because it evaluates the internal $weightInLbs property.
            return "Heavy lifting intensity."; //If the first condition is true, PHP stops here and sends back this text string. It will skip all the other checks below it.
        } elseif ($this->weightInLbs >= 100) { //only runs if the first condition was false 
            return "Moderate intensity.";
        } else {
            return "Light intensity."; // It only runs if both previous conditions were completely false.
        }
    }


   // An extra Method: Accepts an array of workouts and returns an HTML list.
   // This method introduces loops (foreach) and arrays to this class.
   // It allows a collection of different workouts into the function
   // and get back a clean, bulleted HTML list of all the exercises performed.
public function getExerciseNamesList(array $myWorkouts)  {  //Inside the parentheses, array $myWorkouts means this function will pass a collection (an array) of multiple workout objects.
    $output = "<h3>--- My Exercises Are: ---</h3><ul>";  //This creates a starter text variable called $output.
    
    // The loop code is now safely inside the function body!
    foreach ($myWorkouts as $workout) {  //This starts a loop that will look at every single item inside the array, one by one and reads: "For each individual item inside the $myWorkouts array, temporarily call it $workout and run the code inside these curly braces.
        // Use the object's property to get the name
        $output .= "<li>" . $workout->exerciseName . " " . $workout->weightInLbs . " lbs.</li>";  //The .= operator means "add this onto the end of what is already stored in $output" (concatenation).
    }
    
    $output .= "</ul>"; //Once the loop finishes checking every workout, this line adds the closing HTML list tag (</ul>) to complete the list structure.
    return $output;  //the complete, finished HTML bulleted list back to the main program.
}

// An extra static Method to simplify adding up totals from an array of objects.
// when a function operates on a collection of objects rather than just one single instance, 
// making it static means it belongs to the class template itself.
// This means you will no longer need to use an individual exercise object to trigger them. Instead, you can call
// them directly using the class name: WorkoutLog::getExerciseNamesList().
// take an entire array of different workout objects, look inside each one to find its individual
// total volume, and sum them all up into a single grand total.
public static function calculateGrandVolume(array $arrayOfWorkouts) {
    // 1. Create a variable ONLY for the math tracking
    $grandTotal = 0;  //This initializes a counter variable called $grandTotal and sets it to zero.

    // 2. Loop through and add up the numbers safely
    foreach ($arrayOfWorkouts as $workout) {  //This starts a foreach loop to process each workout in the array one at a time.
        $grandTotal += $workout->calculateTotalVolume();  //The += operator means "take the current value of $grandTotal and add this new number to it."
    }

    // 3. Combine your text and the final calculated number at the very end
    $output = "<p>Total Volume Lifted.</p>";  //After the math is fully completed, this creates an $output string variable starting with a paragraph (<p>) label.
    $output .= "<p>" . $grandTotal . " LBs</p>";  //This appends a second paragraph to the string, inserting the final accumulated $grandTotal number followed by the text " LBs".

    return $output; //This returns the fully built HTML string back to the program.
}

} //end of class

/*
PREDICTIONS:
Object 1: 
getSummary() - this should display everything after the return statement in the getSummary() function. The string 
includes, Exercise: | Sets: | Reps: | Status: 
Exercise output will be in bold and the Status will be green only after the isCompleted() function is invoked.
These constructor parameters "Bench Press", 3, 10, 150 will return as:
Exercise: Bench Press | Sets: 3 | Reps: 10 | Status: Pending

calculateTotalVolume() - This is a math function and will multiply $sets, $reps and $weightInLbs, which are listed in the
constructor parameters of new WorkoutLog(). Then the parameters "Bench Press", 3, 10, 150 will return,
4500 = 3 * 10 * 150. Thus returns 4500 lbs. Total Volume Lifted: 4500 LBs.

evaluateIntensity() - This AI generated decision logic will return if the input parameter weight is 
heavy lifting intensity, moderate intensity, or light intensity. Since the parameters input will be
"Bench Press", 3, 10, 150, the last integer 150 will return moderate intensity, because 150 > 100 is true..
Intensity Level: Moderate Intensity.

Object 2:
getSummary() - the constructor parmeters are, "Bicep Curls", 3, 12, 45, so the string will return
Exercise: Bicep Curls | Sets: 3 | Reps: 12 | Status: Pending

calculateTotalVolume() - Integer multiplication, 1620 lbs. = 3 * 12 * 45
thus, Total Volume Lifted: 1620 lbs.

evaluateIntensity() - 45 >= 100 is false, thus the code will trigger, Intensity Level: light intensity.

Object 3:
getSummay() - The constructor parameters are "Push Ups", 5, 10, 30, thus the string will return,
Exercise: Push Ups | Sets: 5 | Reps: 10 | Status: Pending

calculateTotalVolume() -  Total Volume lifted: 1500 lbs. because 1500 =  5 * 10 * 30.

evaluateIntensity() - Intensity Level: light Intensity  because 30 >= 100 is false.

Object 4:
getSummary() -  The constructor parameters are: "Squats", 5, 5, 200
Exercise: Squats | Sets: 5 | Reps: 5 | Status: Pending

calculateIntensity() - Total Volume lifted: 5000 lbs.

evaluateIntensity() - Intensity Level: Heavy lifting Intensity

Objects 1 2 3 4:
completeWorkout() - this is a state - changing setter method which changes the property value from false to true,
thus the getSummary() method will display "Completed" in green, rather than "Pending."
for example,
$workout1->completeWorkout();
echo $workout1->getSummary(); This will now say:
Exercise: Bench Press | Sets: 3 | Reps: 10 | Status: Completed (in green)
Exercise: Bicep Curls | ... Status: Completed
Exercise: Push Ups | ... Status: Completed
Exercise: Squats | ... Status: Completed

Objects 1 2 3 4:
getExercisenamesList() - This will return a list with a heading and after each exercise from each object,
the weight used for each exercise. Thus, "My Exercises Are:" will display each object parameter listed with weight,
Bench Press 150 LBs.
Bicep Curls 45 LBs.
Push Ups 30LBs.
Squats 200 LBs.

Object 1 2 3 4:
calculateGrandVolume() - this is a static function that calculates the entire amount of weight 
combining calculateTotalWeight() for each object.  The objects called, workout 1 2 3 4, are stored as an array of objects called $myWorkouts and looped
to add up the weightInLbs from each exercise. 12620 LBs.= 4500 + 1620 + 1500 + 5000
*/

// OBJECT INSTANTIATION and TESTING
// Keeping in mind that the constructor parameters are:
// string $exerciseName, 
// int $sets, 
// int $reps, 
// int $weightInLbs, 
// bool $isCompleted = false

// Create Object 1 (Using your own realistic data)
$workout1 = new WorkoutLog("Bench Press", 3, 10, 150); 
echo $workout1->getSummary(); //will say, Exercise: Bench Press | Sets: 3 | Reps: 10 | Status: Pending
echo "Total Volume Lifted: " . $workout1->calculateTotalVolume() . " lbs<br>";
echo "Intensity level: " . $workout1->evaluateIntensity() . "<br>";

echo "<hr>";

// Create Object 2
$workout2 = new WorkoutLog("Bicep Curls", 3, 12, 45);
echo $workout2->getSummary(); //will say Exercise: Bicep Curls | Sets: 3 | Reps: 12 | Status: Pending
echo "Total volume lifted. " . $workout2->calculateTotalVolume() . " lbs<br>";
echo "Intensity Level: " . $workout2->evaluateIntensity() . "<br>";

echo "<hr>";

// Create Object 3
$workout3 = new WorkoutLog("Push Ups", 5, 10, 30);
echo $workout3->getSummary(); //Exercise: Push Ups | Sets: 5 | Reps: 10 | Status: Pending
echo "Total volume lifted. " . $workout3->calculateTotalVolume() . " lbs<br>";
echo "Intensity Level: " . $workout3->evaluateIntensity() . "<br>";

echo "<hr>";

// Create Object 4
$workout4 = new WorkoutLog("Squats", 5, 5, 200);
echo $workout4->getSummary(); //Exercise: Squats | Sets: 5 | Reps: 5 | Status: Pending
echo "Total volume lifted. " . $workout4->calculateTotalVolume() . " lbs<br>"; //Total Volume lifted: 5000 lbs.
echo "Intensity Level: " . $workout4->evaluateIntensity() . "<br>"; //Intensity Level: Heavy lifting Intensity

echo "<hr>";

// Test changing a property value for $wokout1. completeWorkout() function will make the workout completed.
echo "Updating (workout 1) Bench Press status...<br>";
$workout1->completeWorkout();
echo $workout1->getSummary(); // Should now say, Exercise: Bench Press | Sets: 3 | Reps: 10 | Status: Completed (in green )

echo "<hr>";

// Test changing a property value for $workout2. completeWorkout() function will make the workout completed.
echo "Updating (workout 2) Bicep Curls status...<br>";
$workout2->completeWorkout();
echo $workout2->getSummary(); // Should now say, Exercise: Bicep Curls | Sets: 3 | Reps: 12 | Status: Completed (in green)

echo "<hr>";

echo "Updating (workout 3) Push Ups status...<br>";
$workout3->completeWorkout(); 
echo $workout3->getSummary(); //Should now say "Completed" in green

echo "<hr>";

echo "Updating (workout 4) Squats status...<br>";
$workout4->completeWorkout();
echo $workout4->getSummary(); //Should now say "Completed" in green

echo "<hr>";

// 1. Put all your objects into a standard PHP array
$myWorkouts = [$workout1, $workout2, $workout3, $workout4];

// 2. Call the function using any objects and pass the array into it
echo $workout1->getExerciseNamesList($myWorkouts); // should say...
//My Exercises Are:
//Bench Press 150 LBs.
//Bicep Curls 45 LBs.
//Push Ups 30LBs.
//Squats 200 LBs.

// 3. use WorkoutLog:: (the scope resolution operator) to call the static helper function.
echo WorkoutLog::calculateGrandVolume($myWorkouts); //should say 12620 LBs.
