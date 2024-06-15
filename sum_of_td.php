<?php
session_start();
include "dbconnect1.php";
// if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin'] == true) {
//     echo '<script>
//     window.location="projectlogin.php";
//     </script>';
// }    

$sumquery_t = "SELECT SUM(
        CAST(
            CASE
                WHEN Expense_Cost REGEXP '^[0-9]+$' THEN Expense_Cost
                ELSE CAST(FROM_BASE64(Expense_Cost) AS DECIMAL(10,2))
            END AS DECIMAL(10,2)
        )
    ) AS sum
    FROM addexp
    WHERE Email='{$_SESSION['email']}' AND FROM_BASE64(Exp_type)='Transportation'";
$result1 = mysqli_query($conn, $sumquery_t);
$row1 = mysqli_fetch_assoc($result1);


$q2 = "SELECT SUM(
    CAST(
        CASE
            WHEN Expense_Cost REGEXP '^[0-9]+$' THEN Expense_Cost
            ELSE CAST(FROM_BASE64(Expense_Cost) AS DECIMAL(10,2))
        END AS DECIMAL(10,2)
    )
) AS sum 
FROM addexp 
WHERE Email='{$_SESSION['email']}' AND FROM_BASE64(Exp_type)='Food'";
$result2 = mysqli_query($conn, $q2);
$row2 = mysqli_fetch_assoc($result2);

$q3 = "SELECT SUM(
    CAST(
        CASE
            WHEN Expense_Cost REGEXP '^[0-9]+$' THEN Expense_Cost
            ELSE CAST(FROM_BASE64(Expense_Cost) AS DECIMAL(10,2))
        END AS DECIMAL(10,2)
    )
) AS sum 
FROM addexp 
WHERE Email='{$_SESSION['email']}' AND FROM_BASE64(Exp_type)='Utilities'";
$result3 = mysqli_query($conn, $q3);
$row3 = mysqli_fetch_assoc($result3);

$q4 = "SELECT SUM(
    CAST(
        CASE
            WHEN Expense_Cost REGEXP '^[0-9]+$' THEN Expense_Cost
            ELSE CAST(FROM_BASE64(Expense_Cost) AS DECIMAL(10,2))
        END AS DECIMAL(10,2)
    )
) AS sum 
FROM addexp 
WHERE Email='{$_SESSION['email']}' AND FROM_BASE64(Exp_type)='Clothing'";
$result4 = mysqli_query($conn, $q4);
$row4 = mysqli_fetch_assoc($result4);

$q5 = "SELECT SUM(
    CAST(
        CASE
            WHEN Expense_Cost REGEXP '^[0-9]+$' THEN Expense_Cost
            ELSE CAST(FROM_BASE64(Expense_Cost) AS DECIMAL(10,2))
        END AS DECIMAL(10,2)
    )
) AS sum 
FROM addexp 
WHERE Email='{$_SESSION['email']}' AND FROM_BASE64(Exp_type)='Medical/Healthcare'";
$result5 = mysqli_query($conn, $q5);
$row5 = mysqli_fetch_assoc($result5);

$q6 = "SELECT SUM(
    CAST(
        CASE
            WHEN Expense_Cost REGEXP '^[0-9]+$' THEN Expense_Cost
            ELSE CAST(FROM_BASE64(Expense_Cost) AS DECIMAL(10,2))
        END AS DECIMAL(10,2)
    )
) AS sum 
FROM addexp 
WHERE Email='{$_SESSION['email']}' AND FROM_BASE64(Exp_type)='Insurance'";
$result6 = mysqli_query($conn, $q6);
$row6 = mysqli_fetch_assoc($result6);

$q7 = "SELECT SUM(
    CAST(
        CASE
            WHEN Expense_Cost REGEXP '^[0-9]+$' THEN Expense_Cost
            ELSE CAST(FROM_BASE64(Expense_Cost) AS DECIMAL(10,2))
        END AS DECIMAL(10,2)
    )
) AS sum 
FROM addexp 
WHERE Email='{$_SESSION['email']}' AND FROM_BASE64(Exp_type)='Household_Items/Supplies'";
$result7 = mysqli_query($conn, $q7);
$row7 = mysqli_fetch_assoc($result7);

$q8 = "SELECT SUM(
    CAST(
        CASE
            WHEN Expense_Cost REGEXP '^[0-9]+$' THEN Expense_Cost
            ELSE CAST(FROM_BASE64(Expense_Cost) AS DECIMAL(10,2))
        END AS DECIMAL(10,2)
    )
) AS sum 
FROM addexp 
WHERE Email='{$_SESSION['email']}' AND FROM_BASE64(Exp_type)='Debt/Loan'";
$result8 = mysqli_query($conn, $q8);
$row8 = mysqli_fetch_assoc($result8);

$q9 = "SELECT SUM(
    CAST(
        CASE
            WHEN Expense_Cost REGEXP '^[0-9]+$' THEN Expense_Cost
            ELSE CAST(FROM_BASE64(Expense_Cost) AS DECIMAL(10,2))
        END AS DECIMAL(10,2)
    )
) AS sum 
FROM addexp 
WHERE Email='{$_SESSION['email']}' AND FROM_BASE64(Exp_type)='Education'";
$result9 = mysqli_query($conn, $q9);
$row9 = mysqli_fetch_assoc($result9);

$q10 = "SELECT SUM(
    CAST(
        CASE
            WHEN Expense_Cost REGEXP '^[0-9]+$' THEN Expense_Cost
            ELSE CAST(FROM_BASE64(Expense_Cost) AS DECIMAL(10,2))
        END AS DECIMAL(10,2)
    )
) AS sum 
FROM addexp 
WHERE Email='{$_SESSION['email']}' AND FROM_BASE64(Exp_type)='Savings'";
$result10 = mysqli_query($conn, $q10);
$row10 = mysqli_fetch_assoc($result10);

$q11 = "SELECT SUM(
    CAST(
        CASE
            WHEN Expense_Cost REGEXP '^[0-9]+$' THEN Expense_Cost
            ELSE CAST(FROM_BASE64(Expense_Cost) AS DECIMAL(10,2))
        END AS DECIMAL(10,2)
    )
) AS sum 
FROM addexp 
WHERE Email='{$_SESSION['email']}' AND FROM_BASE64(Exp_type)='Investments'";
$result11 = mysqli_query($conn, $q11);
$row11 = mysqli_fetch_assoc($result11);

$q12 = "SELECT SUM(
    CAST(
        CASE
            WHEN Expense_Cost REGEXP '^[0-9]+$' THEN Expense_Cost
            ELSE CAST(FROM_BASE64(Expense_Cost) AS DECIMAL(10,2))
        END AS DECIMAL(10,2)
    )
) AS sum 
FROM addexp 
WHERE Email='{$_SESSION['email']}' AND FROM_BASE64(Exp_type)='Entertainment'";
$result12 = mysqli_query($conn, $q12);
$row12 = mysqli_fetch_assoc($result12);

$q13 = "SELECT SUM(
    CAST(
        CASE
            WHEN Expense_Cost REGEXP '^[0-9]+$' THEN Expense_Cost
            ELSE CAST(FROM_BASE64(Expense_Cost) AS DECIMAL(10,2))
        END AS DECIMAL(10,2)
    )
) AS sum 
FROM addexp 
WHERE Email='{$_SESSION['email']}' AND FROM_BASE64(Exp_type)='Gifts/Donations'";
$result13 = mysqli_query($conn, $q13);
$row13 = mysqli_fetch_assoc($result13);

$q14 = "SELECT SUM(
    CAST(
        CASE
            WHEN Expense_Cost REGEXP '^[0-9]+$' THEN Expense_Cost
            ELSE CAST(FROM_BASE64(Expense_Cost) AS DECIMAL(10,2))
        END AS DECIMAL(10,2)
    )
) AS sum 
FROM addexp 
WHERE Email='{$_SESSION['email']}' AND FROM_BASE64(Exp_type)='Housing'";
$result14 = mysqli_query($conn, $q14);
$row14 = mysqli_fetch_assoc($result14);

$q15 = "SELECT SUM(
    CAST(
        CASE
            WHEN Expense_Cost REGEXP '^[0-9]+$' THEN Expense_Cost
            ELSE CAST(FROM_BASE64(Expense_Cost) AS DECIMAL(10,2))
        END AS DECIMAL(10,2)
    )
) AS sum 
FROM addexp 
WHERE Email='{$_SESSION['email']}' AND FROM_BASE64(Exp_type)='Personal'";
$result15 = mysqli_query($conn, $q15);
$row15 = mysqli_fetch_assoc($result15);

$q16 = "SELECT * from login where Email='{$_SESSION['email']}'";
$result16 = mysqli_query($conn, $q16);
$row16 = mysqli_fetch_assoc($result16);

$output = '
<div class="table-responsive">
<div class="container">
<h4>Expense_Type Sum of Money Spent Till_Date</h4>

<table class="table table-bordered table-striped table-hover">
<thead class="table-primary">
<tr>
<th scope="col">Srno</th>
<th scope="col">Expense_Type</th>
<th scope="col">Total Sum of Money Spend</th>
</tr>    
</thead>
    ';
// Row 1
$output .= '
<tbody>
<tr>
                <td>1</td>
                <td>Transportation</td>
                <td>';
if ($row1["sum"] == 0) {
    $output .= "0";
} else {
    $output .= $row1["sum"];
}
$output .= '</td>
            </tr>';

// Row 2
$output .= '<tr>
                <td>2</td>
                <td>Food</td>
                <td>';
if ($row2["sum"] == 0) {
    $output .= "0";
} else {
    $output .= $row2["sum"];
}
$output .= '</td>
            </tr>';

// Row 3
$output .= '<tr>
                <td>3</td>
                <td>Utilities</td>
                <td>';
if ($row3["sum"] == 0) {
    $output .= "0";
} else {
    $output .= $row3["sum"];
}
$output .= '</td>
            </tr>';

// Row 4
$output .= '<tr>
                <td>4</td>
                <td>Clothing</td>
                <td>';
if ($row4["sum"] == 0) {
    $output .= "0";
} else {
    $output .= $row4["sum"];
}
$output .= '</td>
            </tr>';

// Row 5
$output .= '<tr>
                <td>5</td>
                <td>Medical/Healthcare</td>
                <td>';
if ($row5["sum"] == 0) {
    $output .= "0";
} else {
    $output .= $row5["sum"];
}
$output .= '</td>
            </tr>';

// Row 6
$output .= '<tr>
                <td>6</td>
                <td>Insurance</td>
                <td>';
if ($row6["sum"] == 0) {
    $output .= "0";
} else {
    $output .= $row6["sum"];
}
$output .= '</td>
            </tr>';

// Row 7
$output .= '<tr>
                <td>7</td>
                <td>Household_Items/Supplies</td>
                <td>';
if ($row7["sum"] == 0) {
    $output .= "0";
} else {
    $output .= $row7["sum"];
}
$output .= '</td>
            </tr>';

// Row 8
$output .= '<tr>
                <td>8</td>
                <td>Debt/Loan</td>
                <td>';
if ($row8["sum"] == 0) {
    $output .= "0";
} else {
    $output .= $row8["sum"];
}
$output .= '</td>
            </tr>';

// Row 9
$output .= '<tr>
                <td>9</td>
                <td>Education</td>
                <td>';
if ($row9["sum"] == 0) {
    $output .= "0";
} else {
    $output .= $row9["sum"];
}
$output .= '</td>
            </tr>';

// Row 10
$output .= '<tr>
                <td>10</td>
                <td>Savings</td>
                <td>';
if ($row10["sum"] == 0) {
    $output .= "0";
} else {
    $output .= $row10["sum"];
}
$output .= '</td>
            </tr>';

// Row 11
$output .= '<tr>
                <td>11</td>
                <td>Investments</td>
                <td>';
if ($row11["sum"] == 0) {
    $output .= "0";
} else {
    $output .= $row11["sum"];
}
$output .= '</td>
            </tr>';

// Row 12
$output .= '<tr>
                <td>12</td>
                <td>Entertainment</td>
                <td>';
if ($row12["sum"] == 0) {
    $output .= "0";
} else {
    $output .= $row12["sum"];
}
$output .= '</td>
            </tr>';

// Row 13
$output .= '<tr>
                <td>13</td>
                <td>Gifts/Donations</td>
                <td>';
if ($row13["sum"] == 0) {
    $output .= "0";
} else {
    $output .= $row13["sum"];
}
$output .= '</td>
            </tr>';

// Row 14
$output .= '<tr>
                <td>14</td>
                <td>Housing</td>
                <td>';
if ($row14["sum"] == 0) {
    $output .= "0";
} else {
    $output .= $row14["sum"];
}
$output .= '</td>
            </tr>';

$output .= '</tbody></table>';
echo $output;
