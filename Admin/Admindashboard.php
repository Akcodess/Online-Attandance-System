<?php
session_start();
define('TITLE', 'Dashboard');
define('PAGE', 'Admindashboard');
include('includes/header.php');
include('../dbcon.php');
if(isset($_SESSION['is_adminlogin']))
{
    $aemail = $_SESSION['aEmail'];
}
else
{
    header('location:login.php');
}
?>

    <div class="col-sm-9 col-md-10"> <!--Start Dashboard 2nd column -->
    <div class="row text-center mx-5">
        <div class="col-sm-4 mt-5">
            <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                <div class="card-header">Total Teacher</div>
                <div class="card-body">
                <?php

                    $query = "SELECT id FROM registration_tb ORDER BY id";
                    $query_run = mysqli_query($con, $query);

                    $row = mysqli_num_rows($query_run);
                    echo '<h4 class="card-title">'.$row.'</h4>';
                ?>
                <a class="btn text-white" href="AllTeachers.php">View</a>
                </div>
            </div>
        </div>

        <div class="col-sm-4 mt-5">
            <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                <div class="card-header">Total Student</div>
                <div class="card-body">
                <?php

                    $query = "SELECT student_id FROM student_tb ORDER BY student_id";
                    $query_run = mysqli_query($con, $query);

                    $row = mysqli_num_rows($query_run);
                    echo '<h4 class="card-title">'.$row.'</h4>';
                ?>
                <a class="btn text-white" href="AllStudent.php">View</a>
                </div>
            </div>
        </div>

        <div class="col-sm-4 mt-5">
            <div class="card text-white bg-info mb-3" style="max-width: 18rem;">
                <div class="card-header">Total Number Of Reports</div>
                <div class="card-body">
                <?php

                    $query = "SELECT id FROM attendance_records_tb ORDER BY id";
                    $query_run = mysqli_query($con, $query);

                    $row = mysqli_num_rows($query_run);
                    echo '<h4 class="card-title">'.$row.'</h4>';
                ?>
                <a class="btn text-white" href="AllAttendanceReports.php">View</a>
                </div>
            </div>
        </div>
    </div>
    <div class="mx-5 mt-5 text-center">
        <p class="bg-dark text-white p-2">List of Teachers</p>
        <?php
        $sql = "SELECT * FROM registration_tb";
        $result = mysqli_query($con, $sql);
        if(mysqli_num_rows($result)>0){
            echo '
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Teacher ID</th>
                        <th scope="col">Teacher Name</th>
                        <th scope="col">Teacher Email</th>
                        <th scope="col">Teacher Mobile</th>
                        <th scope="col">Teacher Status</th>
                        <th scope="col">Register Date</th>
                    </tr>
                </thead>
                <tbody>';
                while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                 echo '<td>'.$row["id"].'</td>';
                 echo '<td>'.$row["username"].'</td>';
                 echo '<td>'.$row["email"].'</td>';
                 echo '<td>'.$row["mobile"].'</td>';
                 echo '<td>'.$row["status"].'</td>';
                 echo '<td>'.$row["register_date"].'</td>';
                echo '</tr>';
                }
                echo '</tbody>
            </table>
            ';
        }
        else
        {
            echo '0 Result';
        }

        ?>

    </div>
    </div> <!--End Dashboard 2nd column -->

<?php 
include('includes/footer.php'); 
?>