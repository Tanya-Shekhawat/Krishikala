<?php
$mysqli = new mysqli('localhost', 'root', '', 'police_system');
if (isset($_GET['date'])) {
    $date = $_GET['date'];
    $stmt = $mysqli->prepare("select * FROM appointments where date = ?");
    $stmt->bind_param('s', $date);
    $bookings = array();
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $bookings[] = $row['timeslot'];
            }
            $stmt->close();
        }
    }
}
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $agegroup = $_POST['agegroup'];

    $timeslot = $_POST['timeslot'];
    $place = "BHOPAL";
    $caseby = "BY USER";
    $stat = "Not Confirm";
    $disease = "Typhoid";
    $stmt = $mysqli->prepare("select * from appointments where date = ? AND timeslot=?");
    $stmt->bind_param('ss', $date, $timeslot);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $msg = "<div class='alert alert-danger'>Already Booked</div>";
        } else {
            $stmt = $mysqli->prepare("INSERT INTO appointments (name, phone,gender,agegroup,place,date,caseby,stat,gmail,timeslot,disease) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
            $stmt->bind_param('sssssssssss', $name, $phone, $gender, $agegroup, $place, $date, $caseby, $stat, $email, $timeslot, $disease);
            $stmt->execute();
            $msg = "<div class='alert alert-success'>Booking Successfull</div>";
            $bookings[] = $timeslot;
            $stmt->close();
            $mysqli->close();
        }
    }
}



$duration = 15;
$cleanup = 0;
$start = "10:00";
$end = "12:00";

function timeslots($duration, $cleanup, $start, $end)
{
    $start = new DateTime($start);
    $end = new DateTime($end);
    $interval = new DateInterval("PT" . $duration . "M");
    $cleanupInterval = new DateInterval("PT" . $cleanup . "M");
    $slots = array();

    for ($intStart = $start; $intStart < $end; $intStart->add($interval)->add($cleanupInterval)) {
        $endPeriod = clone $intStart;
        $endPeriod->add($interval);
        if ($endPeriod > $end) {
            break;
        }

        $slots[] = $intStart->format("H:iA") . " - " . $endPeriod->format("H:iA");
    }

    return $slots;
}



?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment</title>
    <link rel="stylesheet" href="http://localhost/CureForSure/resources/css/header.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>


<body>
    <div style="margin-top: 170px; margin-bottom: 200px;" class="container">
        <h1 class="text-center" style="color: white">Book for Date: <?php echo date('m/d/Y', strtotime($date)); ?></h1>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <?php echo (isset($msg)) ? $msg : ""; ?>
            </div>
            <?php $timeslots = timeslots($duration, $cleanup, $start, $end);
            foreach ($timeslots as $ts) {
            ?>
                <div class="col-md-2">
                    <div class="form-group">
                        <?php if (in_array($ts, $bookings)) { ?>
                            <button class="btn btn-danger mt-1"><?php echo $ts; ?></button>
                        <?php } else { ?>
                            <button onclick="openCustumModal('<?= $ts ?>')" class="btn btn-success book mt-1" data-timeslot="<?php echo $ts; ?>"><?php echo $ts; ?></button>
                        <?php }  ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>


    <div id="myModal" class="modal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Booking for: <span id="slot"></span></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="saveappointment" method="post">
                                <!-- <?php $_SESSION['token '] = md5(uniqid(mt_rand(), true)); ?>
                                <input type="" name="_token" value="<?php echo $_SESSION['token '] ?>"> -->
                                <input type="hidden" name="_token" value="<?= csrf_token() ?>">
                                <div class="form-group">
                                    <label for="">Time Slot</label>
                                    <input readonly type="text" class="form-control" id="timeslot" name="timeslot">
                                </div>
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input required type="text" class="form-control" name="name">
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input required type="email" class="form-control" name="gmail">
                                </div>
                                <div class="form-group">
                                    <label for="">Phone</label>
                                    <input required type="number" class="form-control" name="phone">
                                </div>
                                <div class="form-group">
                                    <label for="">Address</label>
                                    <input required type="text" class="form-control" name="place">
                                </div>
                                <div class="form-group">
                                    <label for="">Gender</label>
                                    <!-- <input required type="number" class="form-control" name="phone"> -->
                                    <select name="gender" class="form-control" required>
                                        <option value selected>Select Value</option>
                                        <option value="male">male</option>
                                        <option value="female">female</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Age Group</label>
                                    <!-- <input required type="number" class="form-control" name="phone"> -->
                                    <select name="agegroup" class="form-control" required>
                                        <option value selected>Select Value</option>
                                        <option value="14-17">14-17</option>
                                        <option value="18-21">18-21</option>
                                        <option value="22-25">22-25</option>
                                        <option value="26-29">26-29</option>
                                        <option value="30-33">30-33</option>
                                        <option value="34-37">34-37</option>
                                        <option value="38-41">38-41</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Diseases</label>
                                    <br>
                                    <a href="http://127.0.0.1:5000/" class="button">Check Disease</a>
                                </div>

                                <div class="form-group pull-right mt-1">
                                    <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script>
        $(".book").click(function() {
            var timeslot = $(this).attr('data-timeslot');
            $("#slot").html(timeslot);
            $("#timeslot").val(timeslot);
            $("#myModal").modal("show");
        });

        document.getElementById("myModal").style.display = "none"

        function openCustumModal(time) {
            // alert("fjk")
            document.getElementById("myModal").style.display = "block";
        }

        <?php if (isset($_SESSION['save_message'])) { ?>
            Swal.fire({
                icon: 'success',
                title: 'Appointment Booked',
                text: <?= $_SESSION['save_message'] ?>,
            });
        <?php session_destroy(); } ?>
    </script>