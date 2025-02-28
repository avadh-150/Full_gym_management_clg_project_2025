<!DOCTYPE html>
<html>

<head>
    <title>Gym Schedule Management</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- FullCalendar & jQuery -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Bootstrap & SweetAlert2 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            var calendar = $('#calendar').fullCalendar({
                editable: true,
                selectable: true,
                selectHelper: true,

                events: function(start, end, timezone, callback) {
                    $.ajax({
                        url: "display_schedule.php",
                        type: "GET",
                        dataType: "json",
                        success: function(response) {
                            if (response.status === "error") {
                                Swal.fire("Error!", response.message || "Failed to load events.", "error");
                            } else if (response.status === "success") {
                                console.log("Events Loaded Successfully:", response.message); // Debugging
                                Swal.fire("Success!", response.message, "success"); // Show success alert
                                callback(response.events); // Load events into the calendar
                            }
                        },
                        error: function(xhr, status, error) {
                            Swal.fire("Error!", "Failed to load events: " + xhr.responseText, "error");
                        }
                    });
                },

                select: function(start, end) {
                    $('#eventModal').modal('show');
                    $('#event_start_date').val(moment(start).format('YYYY-MM-DDTHH:mm'));
                    $('#event_end_date').val(moment(end).format('YYYY-MM-DDTHH:mm'));
                },

                eventDrop: function(event) {
                    var start = moment(event.start).format("YYYY-MM-DD HH:mm:ss");
                    var end = moment(event.end).format("YYYY-MM-DD HH:mm:ss");

                    $.ajax({
                        url: 'edit_schedule.php',
                        type: "POST",
                        dataType: "json",
                        data: {
                            id: event.id,
                            title: event.title,
                            start: start,
                            end: end
                        },
                        success: function(response) {
                            if (response.status === "success") {
                                Swal.fire({
                                    title: "Updated!",
                                    text: response.message,
                                    icon: "success",
                                    timer: 2000, // Auto-close after 2 seconds
                                    showConfirmButton: false
                                }).then(() => {
                                    location.reload(); // Reload page after update
                                });
                            } else {
                                Swal.fire("Error!", response.message, "error");
                            }
                        },
                        error: function() {
                            Swal.fire("Error!", "Failed to update event.", "error");
                        }
                    });
                },

                eventClick: function(event) {
                    Swal.fire({
                        title: "Are you sure?",
                        text: "You won't be able to revert this!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        cancelButtonColor: "#3085d6",
                        confirmButtonText: "Yes, delete it!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: "POST",
                                url: "delete_schedule.php",
                                dataType: "json",
                                data: {
                                    id: event.id
                                },
                                success: function(response) {
                                    if (response.status === "success") {
                                        $('#calendar').fullCalendar('removeEvents', event.id);
                                        Swal.fire({
                                            title: "Deleted!",
                                            text: response.message,
                                            icon: "success",
                                            timer: 2000, // Auto-close after 2 seconds
                                            showConfirmButton: false
                                        }).then(() => {
                                            location.reload(); // Reload after the message
                                        });
                                    } else {
                                        Swal.fire("Error!", response.message, "error");
                                    }
                                },
                                error: function() {
                                    Swal.fire("Error!", "Failed to delete event.", "error");
                                }
                            });
                        }
                    });
                }

            });

            $('#saveEvent').click(function() {
                var title = $('#event_title').val();
                var start = $('#event_start_date').val();
                var end = $('#event_end_date').val();

                if (!title || !start || !end) {
                    Swal.fire("Error!", "Please fill in all fields!", "error");
                    return;
                }

                $.ajax({
                    url: 'add_schedule.php',
                    type: "POST",
                    dataType: "json",
                    data: {
                        title: title,
                        start: start,
                        end: end
                    },
                    success: function(response) {
                        if (response.status === "success") {
                            Swal.fire({
                                title: "Success!",
                                text: response.message,
                                icon: "success",
                                timer: 2000, // Auto-close after 2 seconds
                                showConfirmButton: false
                            }).then(() => {
                                window.location.href = response.redirect; // Redirect after message
                            });
                        } else {
                            Swal.fire("Error!", response.message, "error");
                        }
                    },
                    error: function() {
                        Swal.fire("Error!", "Failed to add event.", "error");
                    }
                });
            });

        });
    </script>

    <style>
        body {
            margin-top: 50px;
            text-align: left;
            font-family: 'Poppins', sans-serif;
        }

        #calendar {
            width: 50%;
            margin: 0 auto;
        }
    </style>
</head>

<body>

    <center>
        <h2><b>GYM SCHEDULE</b> <i class="fa-solid fa-calendar-days"></i></h2>
        <a class="btn btn-link" style="text-decoration: none;" href="index.php">Go back</a>
    </center>

    <div id="calendar"></div>

    <!-- Event Modal -->
    <div class="modal fade" id="eventModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Event</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Event Title</label>
                        <input type="text" class="form-control" id="event_title" placeholder="Enter event title">
                    </div>
                    <div class="form-group">
                        <label>Start Date & Time</label>
                        <input type="datetime-local" class="form-control" id="event_start_date">
                    </div>
                    <div class="form-group">
                        <label>End Date & Time</label>
                        <input type="datetime-local" class="form-control" id="event_end_date">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="saveEvent">Save Event</button>
                </div>
            </div>
        </div>
    </div>

</body>

</html>