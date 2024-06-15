<?php
session_start();

if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin'] == true) {
    header("location:projectlogin.php");
} else {

    $studend_id = $_POST['stud_id'];

    include "dbconnect1.php";
    $query = "SELECT * FROM `addexp` WHERE Email='{$_SESSION['email']}' AND ID='$studend_id'";
    $result = mysqli_query($conn, $query) or die("Sorry query failed");
    $nrows = mysqli_num_rows($result);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        $output = "
    <tr>
        <td>
        <input type='text' hidden name='updateqid' id='updateqid' value='$studend_id' ><br>
        <span>Expense_Date</span>
        <input type='date' name='ed' id='ed' value='{$row['Expense_Date']}' /><br>
        <input type='text' name='id' id='id' hidden value='{$row['ID']}' />
        </td>
        </tr>
        <tr>
        <td>
        <span style='margin-top:1rem;'>Expense_Name</span>
        <input type='text' style='margin-top:1rem;' name='en' id='en' value='" . base64_decode($row['Expense_Name']) . "' /><br>
        </td>
        </tr>
        <tr>
        <td>
        <span style='margin-top:1rem;'>Expense_Type</span>
        <select id='sel' required style='font-size: larger;margin-top:1rem;'>
        <option value='" . base64_decode($row['Exp_type']) . "' disabled selected>" . base64_decode($row['Exp_type']) . "</option>
        <option value='Transportation'>Transportation</option>
        <option value='Food'>Food</option>
        <option value='Utilities'>Utilities</option>
        <option value='Clothing'>Clothing</option>
        <option value='Medical/Healthcare'>Medical/Healthcare</option>
        <option value='Insurance'>Insurance</option>
        <option value='Household_Items/Supplies'>Household_Items/Supplies</option>
        <option value='Debt/Loan'>Debt/Loan</option>
        <option value='Education'>Education</option>
        <option value='Savings'>Savings</option>
        <option value='Investments'>Investments</option>
        <option value='Entertainment '>Entertainment</option>
        <option value='Gifts/Donations'>Gifts/Donations</option>
        <option value='Housing'>Housing</option>

    </select>
    <label for='m_o_p' style='margin-top:1rem;'>Mode of Payment</label>
    <select id='m_o_p' required>
        <option value='" . base64_decode($row['Payment_Mode']) . "' disabled selected>" . base64_decode($row['Payment_Mode']) . "</option>
        <option value='UPI/Gpay'>UPI/Gpay</option>
        <option value='UPI/Phonepay'>UPI/Phonepay</option>
        <option value='UPI/Paytm'>UPI/Paytm</option>
        <option value='Cash'>Cash</option>
        <option value='Credit_Card'>Credit Card</option>
        <option value='Debit_Card'>Debit_Card</option>
        <option value='Cheque'>Cheque</option>
    </select>

        </td>
        </tr>
        <tr>
        <td>
        <span>Expense_Cost</span>
        <input type='text' name='ec' id='ec' value='" . base64_decode($row['Expense_Cost']) . "' />
        <input type='text' name='et' id='et' hidden>
        <input type='text' name='mop' id='mop' hidden>


        </td>
        </tr>

<script>

    var val2 = $( '#sel option:selected' ).text();
    console.log(val2);
    $('#et').val(val2);

        var val3 = $( '#m_o_p option:selected' ).text();

    console.log(val3);

    $('#mop').val(val3);


$('#sel').change(function() {
    var val = $(this).val();
    console.log(val);
    $('#et').val(val);
});
$('#m_o_p').change(function() {
    var m_o_p = $(this).val();
    console.log(m_o_p);
    $('#mop').val(m_o_p);
});
</script>

    ";
        echo $output;
    }
}
