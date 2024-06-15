<?php
session_start();
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin'] == true) {
    header("location:projectlogin.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Show Expense</title>

    <link rel="stylesheet" href="showexp1.css">
</head>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />

<body>
    <img src="norecordfound.png" alt="" hidden>
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">
                        Edit Info
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- modal body starts here -->
                <div class="modal-body">
                    <table id="tab">

                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" id="close" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-primary" id="esub">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
    <form method="POST" style="float: left;">
        <label for="start_date">Start Date:</label>
        <input type="date" id="start_date" name="start_date" required />
        <label for="end_date">End Date:</label>
        <input type="date" id="end_date" name="end_date" required />
        <button type="submit" id="dd" name="submit">Display Data</button>
        <br>
        <br><span>Search month-wise</span>
        <select name="month_wise" id="month_wise">
            <option value="Disabled">Disabled</option>

            <option name='Current_Month' id="Current_Month" value="Current_Month">Current_Month</option>
            <option name='Previous_Month' id="Previous_Month" value="Previous_Month">Previous_Month</option>
            <option name='Previous_3_Months' id="Previous_3_Months" value="Previous_3_Months">Previous_3_Months</option>
            <option name='Last_6_Month' id="Last_6_Month" value="Last_6_Months">Last_6_Months</option>
            <option name='Current_Year' id="Current_Year" value="Current_Year">Current_Year</option>

        </select>
        <br>
    </form>
    <div style="margin-left: 42vw;">
        <input type="text" aria-label="search" name="search" id="search" placeholder="search">
    </div>
    <br /><br />
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script type="text/javascript" src="jquery-3.7.0.min.js"></script>
    <script type="text/javascript">
        $(function() {
            function loadData1(page) {

                $.ajax({

                    url: "pagination.php",
                    type: "POST",
                    data: {
                        page_no: page
                    },
                    success: function(data) {
                        $('#td').html(data);

                    }
                });

            }

            function loadData2() {
                $.ajax({
                    url: "pageno.php",
                    type: "POST",

                    success: function(data) {
                        $('#tbkineeche').html(data);
                    }
                });


            }

            loadData1();
            loadData2();

            //prev and next button

            $(document).on("click", "#next", function(e) {
                loadData1();
                e.preventDefault();
                var tp = $('#total_pages').val();
                var pagination_pages = $('#pages').val();
                var pageid = pagination_pages;

                if (pageid == tp) {
                    pageid == tp;
                } else {
                    pageid++;
                }
                // console.log(pageid);
                loadData1(pageid);


            });
            $(document).on("click", "#prev", function(e) {
                loadData1();

                e.preventDefault();
                var tp = $('#total_pages').val();
                var pagination_pages = $('#pages').val();
                var pageid = pagination_pages;

                if (pageid == 1) {
                    pageid == 1;
                } else {
                    pageid--;
                }

                // console.log(pageidd);
                loadData1(pageid);


            });

            function Current_Month(page) {
                $.ajax({
                    url: "Current_Month.php",
                    type: "POST",
                    data: {
                        page_no: page
                    },
                    success: function(data) {
                        $('#td').html(data);

                    }
                });
            }

            //page code for current month

            $(document).on("click", "#next3", function(e) {
                e.preventDefault();
                var tp = $('#total_pages3').val();
                var pagination_pages = $('#pages3').val();
                var pageid = pagination_pages;
                $('#next3').show();

                if (pageid == tp) {
                    pageid == tp;
                } else {
                    pageid++;
                }
                console.log(pageid);
                Current_Month(pageid);


            });
            $(document).on("click", "#prev3", function(e) {
                e.preventDefault();
                var tp = $('#total_pages3').val();
                var pagination_pages = $('#pages3').val();
                var pageid = pagination_pages;

                if (pageid == 1) {
                    pageid == 1;
                } else {
                    pageid--;
                }

                console.log(pageid);
                Current_Month(pageid);


            });

            function loadData3Current_Month() {
                $.ajax({
                    url: "pageno3.php",
                    type: "POST",

                    success: function(data) {
                        $('#tbkineeche').html(data);
                    }
                });
            }
            //code for previous month
            function Previous_Month(page) {
                $.ajax({
                    url: "Previous_Month.php",
                    type: "POST",
                    data: {
                        page_no: page
                    },
                    success: function(data) {
                        $('#td').html(data);

                    }
                });

            }
            //for previous month page code

            $(document).on("click", "#next2", function(e) {
                e.preventDefault();
                var tp = $('#total_pages2').val();
                var pagination_pages = $('#pages2').val();
                var pageid = pagination_pages;

                if (pageid == tp) {
                    pageid == tp;
                } else {
                    pageid++;
                }
                console.log(pageid);
                Previous_Month(pageid);


            });
            $(document).on("click", "#prev2", function(e) {
                e.preventDefault();
                var tp = $('#total_pages2').val();
                var pagination_pages = $('#pages2').val();
                var pageid = pagination_pages;

                if (pageid == 1) {
                    pageid == 1;
                } else {
                    pageid--;
                }

                console.log(pageid);
                Previous_Month(pageid);


            });

            function loadData2Previous_Month() {
                $.ajax({
                    url: "pageno2.php",
                    type: "POST",

                    success: function(data) {
                        $('#tbkineeche').html(data);
                    }
                });
            }
            //code for previous 3 months
            function Previous_3_Months(page) {
                $.ajax({
                    url: "Previous_3_Months.php",
                    type: "POST",
                    data: {
                        page_no: page
                    },
                    success: function(data) {
                        $('#td').html(data);

                    }
                });
            }
            //page code for previous 3 months
            $(document).on("click", "#next4", function(e) {
                e.preventDefault();
                var tp = $('#total_pages4').val();
                var pagination_pages = $('#pages4').val();
                var pageid = pagination_pages;

                if (pageid == tp) {
                    pageid == tp;
                } else {
                    pageid++;
                }
                console.log(pageid);
                Previous_3_Months(pageid);


            });
            $(document).on("click", "#prev4", function(e) {
                e.preventDefault();
                var tp = $('#total_pages4').val();
                var pagination_pages = $('#pages4').val();
                var pageid = pagination_pages;

                if (pageid == 1) {
                    pageid == 1;
                } else {
                    pageid--;
                }

                console.log(pageid);
                Previous_3_Months(pageid);


            });

            function loadData4Previous_3_Months() {
                $.ajax({
                    url: "pageno4.php",
                    type: "POST",

                    success: function(data) {
                        $('#tbkineeche').html(data);
                    }
                });
            }

            function Previous_6_Months(page) {
                $.ajax({
                    url: "Previous_6_Months.php",
                    type: "POST",
                    data: {
                        page_no: page
                    },
                    success: function(data) {
                        $('#td').html(data);

                    }
                });
            }

            $(document).on("click", "#next5", function(e) {
                e.preventDefault();
                var tp = $('#total_pages5').val();
                var pagination_pages = $('#pages5').val();
                var pageid = pagination_pages;

                if (pageid == tp) {
                    pageid == tp;
                } else {
                    pageid++;
                }
                console.log(pageid);
                Previous_6_Months(pageid);


            });
            $(document).on("click", "#prev5", function(e) {
                e.preventDefault();
                var tp = $('#total_pages5').val();
                var pagination_pages = $('#pages5').val();
                var pageid = pagination_pages;

                if (pageid == 1) {
                    pageid == 1;
                } else {
                    pageid--;
                }

                console.log(pageid);
                Previous_6_Months(pageid);


            });

            function loadData5Previous_6_Months() {
                $.ajax({
                    url: "pageno5.php",
                    type: "POST",

                    success: function(data) {
                        $('#tbkineeche').html(data);
                    }
                });
            }

            //Current year 

            function Cy(page) {
                $.ajax({
                    url: "Current_year.php",
                    type: "POST",
                    data: {
                        page_no: page
                    },
                    success: function(data) {
                        $('#td').html(data);

                    }
                });
            }

            $(document).on("click", "#next6", function(e) {
                e.preventDefault();
                var tp = $('#total_pages6').val();
                var pagination_pages = $('#pages6').val();
                var pageid = pagination_pages;

                if (pageid == tp) {
                    pageid == tp;
                    console.log(pageid);
                } else {
                    pageid++;
                    console.log(pageid);

                }
                Cy(pageid);
            });

            $(document).on("click", "#prev6", function(e) {
                e.preventDefault();
                var tp = $('#total_pages6').val();
                var pagination_pages = $('#pages6').val();
                var pageid = pagination_pages;

                if (pageid == 1) {
                    pageid == 1;
                } else {
                    pageid--;
                }

                console.log(pageid);
                Cy(pageid);
            });

            function loadData6Cy() {
                $.ajax({
                    url: "pageno6.php",
                    type: "POST",

                    success: function(data) {
                        $('#tbkineeche').html(data);
                    }
                });
            }
            // function loaddata() {
            //     $.ajax({
            //         url: "fetchdata1.php",
            //         type: "POST",
            //         success: function(data) {

            //             $("#td").html(data);

            //         },
            //     });
            // }
            $(document).on("click", '#dbtn', function() {
                var user_id = $(this).data('id');
                //var url = "http://localhost/sidphp/TYBCA%20Project/showexp1.php";
                if (confirm("Are you sure you want to delete")) {
                    $.ajax({
                        url: "deletequery.php",
                        type: "POST",
                        data: {
                            user_id: user_id
                        },
                        success: function(data) {
                            if (data == 1) {
                                loadData1();
                                loadData2();
                                // $("#td").html(loaddata()).load(url);

                            } else {
                                alert("Sorry not deleted");
                            }
                        }
                    });
                }
            });
            $(document).on("click", "#ebtn", function() {
                var studId = $(this).data("uid");

                // $('#staticBackdrop').modal('show');
                $('#staticBackdrop').modal('toggle');

                $.ajax({
                    url: "updateq.php",
                    type: "POST",
                    data: {
                        stud_id: studId,

                    },
                    success: function(data) {

                        $('#tab').html(data);

                    }
                });
            });

            $(document).on("click", "#esub", function() {

                var stu_Id2 = $("#updateqid").val();
                console.log(stu_Id2);
                var ed = $("#ed").val();
                var en = $("#en").val();
                var ec = $("#ec").val();

                if (ed == "" || en == "" || ec == "") {
                    alert("Enter all the fields");
                } else {
                    $.ajax({
                        url: "updateq2.php",
                        type: "POST",
                        data: {
                            stud_id2: stu_Id2,
                            ed: ed,
                            en: en,
                            ec: ec
                        },
                        success: function(data) {
                            if (data == 1) {
                                $('#staticBackdrop').modal('toggle');
                                loadData1();
                                loadData2();
                            }

                        }
                    });
                }

            });

            $('#search').on("keyup", function() {
                var searchval = $(this).val();
                if (searchval != "") {

                    $.ajax({
                        url: "livesearchq1.php",
                        type: "POST",
                        data: {
                            search: searchval
                        },
                        success: function(data) {
                            $('#tdh4').hide();

                            $('#td').html(data);
                        }
                    });
                } else {
                    loadData1();
                    loadData2();
                }

            });

            $('#dd').on("click", function(e) {
                e.preventDefault();
                var sd = $('#start_date').val();
                var ed = $('#end_date').val();
                if (sd == "" || ed == "") {
                    alert("Please enter all fields");
                } else if (sd > ed) {
                    alert("Start date cannot be ahead of the end date");
                } else {
                    $.ajax({
                        url: 'datewiseq.php',
                        type: "POST",
                        data: {
                            sd: sd,
                            ed: ed
                        },
                        success: function(data) {
                            $('#tdh4').show();
                            $('#tdh4').html("Expense displayed from " + sd + " to " + ed);
                            $('#td').html(data);
                            $('#start_date').val("");
                            $('#end_date').val("");
                        }
                    });
                }
            });
            $(document).on("change", "#month_wise", function() {

                // e.preventDefault();

                var selectedname = $(this).val();
                if (selectedname == "Disabled") {
                    loadData1();
                    loadData2();
                } else if (selectedname == 'Current_Month') {

                    Current_Month();
                    loadData3Current_Month();

                } else if (selectedname == 'Previous_Month') {

                    Previous_Month();
                    loadData2Previous_Month();
                } else if (selectedname == 'Previous_3_Months') {

                    Previous_3_Months();
                    loadData4Previous_3_Months();
                } else if (selectedname == 'Last_6_Months') {

                    Previous_6_Months();
                    loadData5Previous_6_Months();
                } else {

                    Cy();
                    loadData6Cy();
                }
            });

            // $('#showog').on("click", function() {
            //     $('#tdh4').hide();
            //     $('#tbkineeche').hide();

            //     $('#showpagination').show();
            //     loaddata();
            // });

            // $('#showpagination').on("click", function() {
            //     $('#tbkineeche').show();
            //     loadData1();
            //     loadData2();
            // });

            $(document).on("click", "#divwala a", function(e) {
                e.preventDefault();
                var page_id = $(this).attr("id");
                loadData1(page_id);

            });

        });
    </script>
    <table id="td">
        <h4 id="tdh4"></h4>
    </table>
    <div id="tbkineeche"></div>
    <br>

    <!-- <button id="showog">Show Whole Table </button>
    <button id="showpagination">Show Pagination Table </button> -->

    <br>
    <a href="first.php">First Page</a>

</body>

</html>