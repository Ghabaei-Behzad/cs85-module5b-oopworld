<?php
/* Behzad Ghabaei
 * CS 85_projects/module5
 * MyObject.php
 * Module 5 Assign 5A
 * Designing Your Own Object Oriented World
 * Instructor Seno
 * 7/6/2026

 */
?>


<?php

class WorkoutTracker {
    // 5 Properties
    public string $exerciseName;
    public int $sets;
    public int $reps;
    public int $weightInLbs;
    public bool $isCompleted;

    // Constructor to initialize data
    public function __construct(string $exerciseName, int $sets, int $reps, int $weightInLbs, bool $isCompleted = false) {
        $this->exerciseName = $exerciseName;
        $this->sets = $sets;
        $this->reps = $reps;
        $this->weightInLbs = $weightInLbs;
        $this->isCompleted = $isCompleted;
    }

    // Method 1: Summary display method
    public function getSummary() {
        $status = $this->isCompleted ? "<span style=color:green;>Completed</span>" : "Pending";
        return "Exercise: <strong>{$this->exerciseName} </strong>| Sets: {$this->sets} | Reps: {$this->reps} | Status: {$status}<br>";
    }

    // Method 2: Calculated value method (Total weight lifted)
    public function calculateTotalVolume() {
        return $this->sets * $this->reps * $this->weightInLbs;
    }

    // Method 3: Change a property value (Mark workout as done)
    public function completeWorkout() {
        $this->isCompleted = true;
    }

     // Method 4: Decision logic (AI Generated)
    public function evaluateIntensity() {
        if ($this->weightInLbs >= 200) {
            return "Heavy lifting intensity.";
        } elseif ($this->weightInLbs >= 100) {
            return "Moderate intensity.";
        } else {
            return "Light intensity.";
        }
    }
}

// ==========================================
// PREDICTIONS
// ==========================================
/*
Prediction 1: Object 1 summary should display Bench Press with 3 sets, 10 reps, and Pending status.
Prediction 2: Object 1 total volume should calculate to 4500 (3 * 10 * 150).
Prediction 3: Object 2 intensity should return 'Light intensity' because 45 lbs is less than 100.
*/

// ==========================================
// OBJECT INSTANTIATION and TESTING
// ==========================================

// Keeping in mind that the constructor parameters are:
// string $exerciseName, 
// int $sets, 
// int $reps, 
// int $weightInLbs, 
// bool $isCompleted = false

// Create Object 1 (Using your own realistic data)
$workout1 = new WorkoutTracker("Bench Press", 3, 10, 150); 
echo $workout1->getSummary(); 
echo "Total Volume Lifted: " . $workout1->calculateTotalVolume() . " lbs<br>";
echo "Intensity level: " . $workout1->evaluateIntensity() . "<br>";

echo "<hr>";

// Create Object 2
$workout2 = new WorkoutTracker("Bicep Curls", 3, 12, 45);
echo $workout2->getSummary();
echo "Total volume lifted. " . $workout2->calculateTotalVolume() . " lbs<br>";
echo "Intensity Level: " . $workout2->evaluateIntensity() . "<br>";

echo "<hr>";

// Create Object 3
$workout3 = new WorkoutTracker("Push Ups", 5, 10, 30);
echo $workout3->getSummary();
echo "Total volume lifted. " . $workout3->calculateTotalVolume() . " lbs<br>";
echo "Intensity Level: " . $workout3->evaluateIntensity() . "<br>";

echo "<hr>";

// Test changing a property value for $wokout1. completeWorkout() function will make the workout completed.
echo "Updating (workout 1) Bench Press status...<br>";
$workout1->completeWorkout();
echo $workout1->getSummary(); // Should now say Completed
echo "Total Volume Lifted: " . $workout1->calculateTotalVolume() . " lbs<br>";
echo "Intensity level: " . $workout1->evaluateIntensity()  . "| in LBs: " .  $workout1->weightInLbs ;;

echo "<hr>";

// Test changing a property value for $workout2. completeWorkout() function will make the workout completed.
echo "Updating (workout 2) Bicep Curls status...<br>";
$workout2->completeWorkout();
echo $workout2->getSummary(); // Should now say Completed
echo "Total Volume Lifted: " . $workout2->calculateTotalVolume() . " lbs<br>";
echo "Intensity level: " . $workout2->evaluateIntensity()  . "| in LBs: " .  $workout2->weightInLbs ;;

echo "<hr>";

echo "Updating (workout 3) Push Ups status...<br>";
$workout3->completeWorkout();
echo $workout3->getSummary();
echo "Total Volume Lifted: " . $workout3->calculateTotalVolume() . " lbs<br>";
echo "Intensity Level: " . $workout3->evaluateIntensity() . "| in LBs: " .  $workout3->weightInLbs ;

echo "<hr>";

echo "<p> Total workouts done: </p>";
echo  "<li>" . $workout1->exerciseName . "</li>" ;
echo  "<li>" . $workout2->exerciseName . "</li> ";
echo  "<li>" . $workout3->exerciseName . "</li> ";
echo"<br>";
echo "<p>Total Volume Lifted. </p>";
$total = $workout1->calculateTotalVolume() + $workout2->calculateTotalVolume() + $workout3->calculateTotalVolume();
echo $total . " LBs";
