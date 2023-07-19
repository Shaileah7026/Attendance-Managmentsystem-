<?php
function filterstd($batch, $enrollment, $name)
{
    global $conn; 

    $query = "SELECT * FROM studentinfo WHERE 1";

    if (!empty($batch)) {
        $query .= " AND LOWER(batch) LIKE LOWER('%$batch%')";
    }

    if (!empty($srenrollment)) {
        $query .= " AND `enrollment no` = '$enrollment'";
    }

    if (!empty($name)) {
        $query .= " AND LOWER(name) LIKE LOWER('%$name%')";
    }

    $result = $conn->query($query . " ORDER BY `enrollment no` ASC");

    if ($result && $result->num_rows > 0) {
        echo '<table class="table table-striped table-hover">';
        echo '<thead>';
        echo '<tr>';
        echo '<th scope="col">Enrollment No.</th>';
        echo '<th scope="col">Name</th>';
        echo '<th scope="col">Batch</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        while ($data = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $data['enrollment no'] . '</td>';
            echo '<td>' . $data['name'] . '</td>';
            echo '<td>' . $data['batch'] . '</td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
    } else {
        echo "<p>No results found.</p>";
    }
}
?>