$(document).ready(function() {
    // the continue button
    const seatButtons = $('.seat-button');
    const continueButton = $('#submit-seat-btn');
    const selectedSeatInput = $('#selected-seat-input');
    var lastSelectedSeat = '';

    // Add event listener to each seat button
    seatButtons.on('click', function() {
        //get the last selected button value
        lastSelectedSeat = $(this).val();

        //add the class 'selected' to new button clicked to change color
        // but first we have to remove the class 'selected' from any previously selected button
        const selectedButton = $('.seat-button.selected');
        if (selectedButton) {
            selectedButton.removeClass('selected');
        }

        // add selected class to clicked button
        $(this).addClass('selected');

        // Show the "Continue" button
        continueButton.show();
    });

    // Add event listener to the button with class 'seat-button-booked'
    const bookedButton = $('.seat-button-booked');
    bookedButton.on('click', function(event) {
        event.preventDefault(); // prevent default behavior of the button (going to a new page)
        alert('This seat is already booked'); // display a message to the user
    });

    continueButton.on('click', function() {
        selectedSeatInput.val(lastSelectedSeat);
        if (selectedSeatInput.length) {
            // Send AJAX request to update seat status to 'reserved'
            $.ajax({
                url: 'update_seat_status.php',
                type: 'POST',
                data: { seat_number: lastSelectedSeat, status: "reserved"  },
                success: function (response) {
                    // Handle response from server if necessary
                },
                error: function () {
                    // Handle error if necessary
                }
            });

            $('#submit_seat_selection').submit();
        } else {
            // handle error - no seat selected
            console.error('No seat selected')
        }
    });
});
