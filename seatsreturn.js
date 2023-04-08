$(document).ready(function() {
    // the continue button
    const seatButtons = $('.seat-button');
    const continueButton = $('#submit-seat-btn');
    const selectedSeatInput = $('#selected-seat-input');
    var lastSelectedSeat = '123';

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
        console.log('Continue button clicked');

        selectedSeatInput.val(lastSelectedSeat);
        console.log('Selected seat: ' + selectedSeatInput.val());
        
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













// document.addEventListener("DOMContentLoaded", function () {
//     // the continue button
//     const seatButtons = document.querySelectorAll('.seat-button');
//     const continueButton = document.querySelector('#submit-seat-btn');
//     const selectedSeatInput = document.querySelector('#selected-seat-input');
//     let lastSelectedSeat = '';

//     // Add event listener to each seat button
//     seatButtons.forEach((button) => {
//         button.addEventListener('click', () => {
//             //get the last selected button value
//             lastSelectedSeat = button.value;


//             //add the class 'selected' to new button cliked to change color
//             // but first we have remove the class 'selected' from any previously selected button
//             const selectedButton = document.querySelector('.seat-button.selected');
//             if (selectedButton) {
//                 selectedButton.classList.remove('selected');
//             }

//             // add selected class to clicked button
//             button.classList.add('selected');


//             //get the last selected button value
//             lastSelectedSeat = button.value;


//             // Show the "Continue" button
//             continueButton.style.display = 'block';
//         });
//     });

//     // Add event listener to the button with ID 'seat-button-booked'
//     const bookedButton = document.querySelector('.seat-button-booked');
//     bookedButton.addEventListener('click', (event) => {
//         event.preventDefault(); // prevent default behavior of the button (going to a new page)
//         alert('This seat is already booked'); // display a message to the user
//     });

//     continueButton.addEventListener('click', () => {
//         selectedSeatInput.value = lastSelectedSeat;
//         if (selectedSeatInput) {
//             // Send AJAX request to update seat status to 'reserved'
//             $.ajax({
//                 url: 'update_seat_status.php',
//                 type: 'POST',
//                 data: { seat_number: lastSelectedSeat, status: "reserved"  },
//                 success: function (response) {
//                     // Handle response from server if necessary
//                 },
//                 error: function () {
//                     // Handle error if necessary
//                 }
//             });
//             document.querySelector('#submit_seat_selection').submit();
//         } else {
//             // handle error - no seat selected
//             console.error('No seat selected')
//         }
//     });


// });