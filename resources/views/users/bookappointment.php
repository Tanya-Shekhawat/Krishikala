<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment</title>
    <link rel="stylesheet" href="http://localhost/CureForSure/resources/css/header.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<style>
    @media only screen and (max-width: 760px),
    (min-device-width: 802px) and (max-device-width: 1020px) {

        table,
        thead,
        tbody,
        th,
        td,
        tr {
            display: block;
        }

        .empty {
            display: none;
        }

        th {
            position: absolute;
            top: -9999px;
            left: -9999px;
        }

        tr {
            border: 1px solid #ccc;
        }

        td {
            border: none;
            border-bottom: 1px solid #eee;
            position: relative;
            padding-left: 50%;
        }

        td:nth-of-type(1):before {
            content: "Sunday";
        }

        td:nth-of-type(2):before {
            content: "Monday";
        }

        td:nth-of-type(3):before {
            content: "Tuesday";
        }

        td:nth-of-type(4):before {
            content: "Wednesday";
        }

        td:nth-of-type(5):before {
            content: "Thursday";
        }

        td:nth-of-type(6):before {
            content: "Friday";
        }

        td:nth-of-type(7):before {
            content: "Saturday";
        }


    }

    @media only screen and (min-device-width: 320px) and (max-device-width: 480px) {
        body {
            padding: 0;
            margin: 0;
        }
    }

    @media only screen and (min-device-width: 802px) and (max-device-width: 1020px) {
        body {
            width: 495px;
            color: aliceblue;
        }
    }

    @media (min-width:641px) {
        table {
            table-layout: fixed;
        }

        td {
            width: 33%;
        }
    }

    .row {
        margin-top: 20px;
    }
</style>

<body>

    <div style="margin-top: 70px" class="bradcam_area breadcam_bg1">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="bradcam_text text-center">
                        <h3>Appointment Form</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    function build_calendar($month, $year)
    {
        // echo"fjkef";
        $mysqli = new mysqli('localhost', 'root', '', 'police_system');
        $daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);
        $numberDays = date('t', $firstDayOfMonth);
        $dateComponents = getdate($firstDayOfMonth);
        $monthName = $dateComponents['month'];
        $dayOfWeek = $dateComponents['wday'];
        $datetoday = date('Y-m-d');
        $calendar = "<table class='table table-bordered'>";
        $calendar .= "<center><h2>$monthName $year</h2>";
        $calendar .= "<a class='btn btn-xs btn-warning' href='?month=" . date('m', mktime(0, 0, 0, $month - 1, 1, $year)) . '&year=' . date('Y', mktime(0, 0, 0, $month - 1, 1, $year)) . "'>Previous Month</a> ";
        $calendar .= " <a href='bookappointment' class='btn btn-xs btn-warning' data-month='" . date('m') . "' data-year='" . date('Y') . "'>Current Month</a> ";
        $calendar .= "<a href='?month=" . date('m', mktime(0, 0, 0, $month + 1, 1, $year)) . '&year=' . date('Y', mktime(0, 0, 0, $month + 1, 1, $year)) . "' class='btn btn-xs btn-warning'>Next Month</a></center><br>";
        $calendar .= '<tr>';
        foreach ($daysOfWeek as $day) {
            $calendar .= "<th  class='header'>$day</th>";
        }
        $currentDay = 1;
        $calendar .= '</tr><tr>';
        if ($dayOfWeek > 0) {
            for ($k = 0; $k < $dayOfWeek; $k++) {
                $calendar .= "<td  class='empty'></td>";
            }
        }
        $month = str_pad($month, 2, '0', STR_PAD_LEFT);
        while ($currentDay <= $numberDays) {
            if ($dayOfWeek == 7) {
                $dayOfWeek = 0;
                $calendar .= '</tr><tr>';
            }
            $currentDayRel = str_pad($currentDay, 2, '0', STR_PAD_LEFT);
            $date = "$year-$month-$currentDayRel";
            $dayname = strtolower(date('l', strtotime($date)));
            $eventNum = 0;
            $today = $date == date('Y-m-d') ? 'today' : '';
            if ($date < date('Y-m-d')) {
                $calendar .= "<td><h4>$currentDay</h4> <button class='btn btn-danger btn-xs'>N/A</button>";
            } else {
                $totalbookings = checkSlots($mysqli, $date);
                if ($totalbookings == 8) {
                    $calendar .= "<td class='$today'><h4>$currentDay</h4> <a href='#' class='btn btn-danger btn-xs'>Booked</a>";
                } else {
                    $availableslot = 8 - $totalbookings;
                    $calendar .= "<td class='$today'><h4>$currentDay</h4> <a href='timeslot?date=" . $date . "' class='btn btn-success btn-xs'>Book</a><small><i><b>$availableslot slot left</b></small></i>";
                }
            }
            $calendar .= '</td>';
            $currentDay++;
            $dayOfWeek++;
        }
        if ($dayOfWeek != 7) {
            $remainingDays = 7 - $dayOfWeek;
            for ($l = 0; $l < $remainingDays; $l++) {
                $calendar .= "<td class='empty'></td>";
            }
        }
        $calendar .= '</tr>';
        $calendar .= '</table>';
        return $calendar;
    }
    ?>

    <?php
    function checkSlots($mysqli, $date)
    {
        $stmt = $mysqli->prepare('select * from appointments where date = ? ');
        $stmt->bind_param('s', $date);
        $totalbookings = 0;
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $totalbookings++;
                }
                $stmt->close();
            }
        }
        return $totalbookings;
    }
    ?>

    <div style="margin-top: 0px;" class="container">
        <div class="row">
            <div class="col-md-12">
                <div id="calendar">
                    <?php
                    $dateComponents = getdate();
                    if (isset($_GET['month']) && isset($_GET['year'])) {
                        $month = $_GET['month'];
                        $year = $_GET['year'];
                    } else {
                        $month = $dateComponents['mon'];
                        $year = $dateComponents['year'];
                    }
                    echo build_calendar($month, $year);
                    ?>
                </div>
            </div>
        </div>
    </div>

</body>

</html>