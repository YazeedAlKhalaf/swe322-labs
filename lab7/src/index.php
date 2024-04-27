<?php
$db_host = getenv("DB_HOST");
$db_user = getenv("DB_USER");
$db_pass = getenv("DB_PASS");
$db_name = getenv("DB_NAME");
$db_port = getenv("DB_PORT");

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name, $db_port);

class PatientB
{
    public string $first_name;
    public string $last_name;
    public string $phone_number;
}

class DoctorD
{
    public string $first_name;
    public string $last_name;
    public string $email;
}

class PatientF
{
    public string $first_name;
    public string $address;
}

/**
 * Insert new patients into the database.
 * @param mysqli $conn The database connection.
 * @return bool True if the operation was successful, false otherwise.
 */
function runA(mysqli $conn): bool
{
    $query = "INSERT INTO `patient` (`first_name`, `last_name`, `dob`, `gender`, `address`, `phone_number`, `email`) VALUES
    ('Walid', 'Ahmad', '2008-01-05', 'M', 'Kuwait', '+966535999564', 'walid@yu.edu.sa'),
    ('Sarah', 'Dyyat', '2010-04-05', 'F', 'Qatar', '+966535555564', 'sarah@yu.edu.sa');";

    $result = mysqli_query($conn, $query);
    return $result ? true : false;
}

/**
 * Retrieve a list of patients from the database.
 * @param mysqli $conn The database connection.
 * @return array List of PatientB objects representing patients.
 */
function runB(mysqli $conn): array
{
    $query = "SELECT first_name, last_name, phone_number FROM patient;";

    $result = mysqli_query($conn, $query);

    $patients = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $patient = new PatientB();
        $patient->first_name = $row["first_name"];
        $patient->last_name = $row["last_name"];
        $patient->phone_number = $row["phone_number"];

        $patients[] = $patient;
    }

    return $patients;
}

/**
 * Insert new doctors into the database.
 * @param mysqli $conn The database connection.
 * @return bool True if the operation was successful, false otherwise.
 */
function runC(mysqli $conn): bool
{
    $query = "INSERT INTO `doctor` (`first_name`, `last_name`, `specialization`, `phone_number`, `email`) VALUES
    ('Madji', 'Arood', 'Cardiology', '+966545987654', 'majdi@gmail.com'),
    ('Asma', 'Nidal', 'Pediatrics', '+966595987999', 'asma@gmail.com');";

    $result = mysqli_query($conn, $query);
    return $result ? true : false;
}

/**
 * Retrieve a list of doctors from the database.
 * @param mysqli $conn The database connection.
 * @return array List of DoctorD objects representing doctors.
 */
function runD(mysqli $conn): array
{
    $query = "SELECT first_name, last_name, email FROM doctor;";

    $result = mysqli_query($conn, $query);

    $doctors = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $doctor = new DoctorD();
        $doctor->first_name = $row["first_name"];
        $doctor->last_name = $row["last_name"];
        $doctor->email = $row["email"];

        $doctors[] = $doctor;
    }

    return $doctors;
}

/**
 * Delete patients from the database based on a specific condition.
 * @param mysqli $conn The database connection.
 * @return bool True if the operation was successful, false otherwise.
 */
function runE(mysqli $conn): bool
{
    $query = "DELETE FROM patient WHERE address = 'Qatar';";

    $result = mysqli_query($conn, $query);
    return $result ? true : false;
}

/**
 * Retrieve a list of patients' first names and addresses from the database.
 * @param mysqli $conn The database connection.
 * @return array List of PatientF objects representing patients' first names and addresses.
 */
function runF(mysqli $conn): array
{
    $query = "SELECT first_name, address FROM patient;";

    $result = mysqli_query($conn, $query);

    $patients = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $patient = new PatientF();
        $patient->first_name = $row["first_name"];
        $patient->address = $row["address"];

        $patients[] = $patient;
    }

    return $patients;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Results</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h1>Database Results</h1>

    <?php
    // Run functions and get results
    $isSuccessfulA = runA($conn);
    $bPatients = runB($conn);
    $isSuccessfulC = runC($conn);
    $dDoctors = runD($conn);
    $isSuccessfulE = runE($conn);
    $fPatients = runF($conn);

    // Display results
    echo "<h2>Results of Operation A (Insert into Patient)</h2>";
    echo $isSuccessfulA ? "<p>Operation A was successful.</p>" : "<p>Operation A failed.</p>";

    echo "<h2>Results of Operation B (Select Patients)</h2>";
    if (count($bPatients) > 0) {
        echo "<table>";
        echo "<tr><th>First Name</th><th>Last Name</th><th>Phone Number</th></tr>";
        foreach ($bPatients as $patient) {
            echo "<tr><td>{$patient->first_name}</td><td>{$patient->last_name}</td><td>{$patient->phone_number}</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No patients found.</p>";
    }

    echo "<h2>Results of Operation C (Insert into Doctor)</h2>";
    echo $isSuccessfulC ? "<p>Operation C was successful.</p>" : "<p>Operation C failed.</p>";

    echo "<h2>Results of Operation D (Select Doctors)</h2>";
    if (count($dDoctors) > 0) {
        echo "<table>";
        echo "<tr><th>First Name</th><th>Last Name</th><th>Email</th></tr>";
        foreach ($dDoctors as $doctor) {
            echo "<tr><td>{$doctor->first_name}</td><td>{$doctor->last_name}</td><td>{$doctor->email}</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No doctors found.</p>";
    }

    echo "<h2>Results of Operation E (Delete Patients)</h2>";
    echo $isSuccessfulE ? "<p>Operation E was successful.</p>" : "<p>Operation E failed.</p>";

    echo "<h2>Results of Operation F (Select Patients' First Names and Addresses)</h2>";
    if (count($fPatients) > 0) {
        echo "<table>";
        echo "<tr><th>First Name</th><th>Address</th></tr>";
        foreach ($fPatients as $patient) {
            echo "<tr><td>{$patient->first_name}</td><td>{$patient->address}</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No patients found.</p>";
    }
    ?>

</body>

</html>