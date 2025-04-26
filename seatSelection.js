document.addEventListener('DOMContentLoaded', () => {
  const seats = document.querySelectorAll('.seat.available');
  const selectedSeatsElement = document.querySelector('.selected-seats');

  const isLoggedIn = window.isLoggedIn === true || window.isLoggedIn === 'true';
  
  seats.forEach(seat => {
    seat.addEventListener('click', () => {
      seat.classList.toggle('selected');
      

      const selectedSeats = document.querySelectorAll('.seat.selected');
      const selectedRegularSeats = document.querySelectorAll('.seat.available.selected');
      
      const ticketCountElement = document.querySelector('.ticket-count');
      if (ticketCountElement) {
        ticketCountElement.textContent = `Ticket x ${selectedRegularSeats.length}`;
      }
      if (selectedSeatsElement) {
        const seatIds = Array.from(selectedSeats).map(s => s.getAttribute('data-seat-id'));
        selectedSeatsElement.textContent = seatIds.length > 0 
          ? `You've selected ${seatIds.length-1} seat${seatIds.length > 1 ? 's' : ''}: ${seatIds.join(', ')}` 
          : 'No seats selected';
      }
      updateTotalAmount(selectedRegularSeats.length);
    });
  });
  
  function updateTotalAmount(regularSeats) {
    const regularPrice = 12.99;
    const regularTotal = regularSeats * regularPrice;
    const total = regularTotal;
    const regularTotalElement = document.querySelector('.regular-total');
    const totalElement = document.querySelector('.total-amount');
    
    if (regularTotalElement) {
      regularTotalElement.textContent = `${regularTotal.toFixed(2)} DT`;
      regularTotalElement.parentElement.style.display = regularSeats > 0 ? 'flex' : 'none';
    }
    
    if (totalElement) {
      totalElement.textContent = regularSeats > 0 
        ? `${total.toFixed(2)} DT`
        : '0.00 DT';
    }
    
    const paymentButton = document.querySelector('.payment-button');
    if (paymentButton) {
      if (!isLoggedIn) {
        paymentButton.setAttribute('disabled', 'disabled');
        paymentButton.classList.add('disabled');
        paymentButton.title = "Please sign in to proceed";
        return; 
      }
      if (regularSeats > 0) {
        paymentButton.removeAttribute('disabled');
        paymentButton.classList.remove('disabled');
        paymentButton.title = "";
      } else {
        paymentButton.setAttribute('disabled', 'disabled');
        paymentButton.classList.add('disabled');
        paymentButton.title = "";
      }
    }
  }
  const seatNumberInput = document.getElementById('seat_number_input');

  function updateSeatNumberInput() {
    const selectedSeats = document.querySelectorAll('.seat.available.selected');
    const seatIds = Array.from(selectedSeats).map(s => s.getAttribute('data-seat-id'));
    if (seatNumberInput) {
      seatNumberInput.value = seatIds.join(',');
    }
  }

  seats.forEach(seat => {
    seat.addEventListener('click', () => {
      updateSeatNumberInput();
    });
  });

  updateTotalAmount(0);
});
