document.addEventListener('DOMContentLoaded', () => {
  const seats = document.querySelectorAll('.seat.available, .seat.vip');
  const selectedSeatsElement = document.querySelector('.selected-seats');
  
  seats.forEach(seat => {
    seat.addEventListener('click', () => {
      // Toggle selected class
      seat.classList.toggle('selected');
      
      // Count selected seats
      const selectedSeats = document.querySelectorAll('.seat.selected');
      const selectedRegularSeats = document.querySelectorAll('.seat.available.selected');
      const selectedVipSeats = document.querySelectorAll('.seat.vip.selected');
      
      // Update the count in the summary
      const regularTicketsElement = document.querySelector('.regular-tickets');
      const vipTicketsElement = document.querySelector('.vip-tickets');
      
      if (regularTicketsElement) {
        regularTicketsElement.textContent = `Regular Ticket x ${selectedRegularSeats.length}`;
      }
      
      if (vipTicketsElement) {
        vipTicketsElement.textContent = `VIP Ticket x ${selectedVipSeats.length}`;
      }
      
      // Update the summary with selected seats
      if (selectedSeatsElement) {
        const seatIds = Array.from(selectedSeats).map(s => s.getAttribute('data-seat-id'));
        selectedSeatsElement.textContent = seatIds.length > 0 
          ? `You've selected ${seatIds.length} seat${seatIds.length > 1 ? 's' : ''}: ${seatIds.join(', ')}` 
          : 'No seats selected';
      }
      
      // Update the total amount
      updateTotalAmount(selectedRegularSeats.length, selectedVipSeats.length);
    });
  });
  
  function updateTotalAmount(regularSeats, vipSeats) {
    const regularPrice = 12.99;
    const vipPrice = 18.99;
    const convenienceFee = 1.5;
    
    const regularTotal = regularSeats * regularPrice;
    const vipTotal = vipSeats * vipPrice;
    const fees = (regularSeats + vipSeats) * convenienceFee;
    const total = regularTotal + vipTotal + fees;
    
    // Update the display
    const regularTotalElement = document.querySelector('.regular-total');
    const vipTotalElement = document.querySelector('.vip-total');
    const feesElement = document.querySelector('.convenience-fee');
    const totalElement = document.querySelector('.total-amount');
    
    if (regularTotalElement && regularSeats > 0) {
      regularTotalElement.textContent = `$${regularTotal.toFixed(2)}`;
      regularTotalElement.parentElement.style.display = 'flex';
    } else if (regularTotalElement) {
      regularTotalElement.parentElement.style.display = 'none';
    }
    
    if (vipTotalElement && vipSeats > 0) {
      vipTotalElement.textContent = `$${vipTotal.toFixed(2)}`;
      vipTotalElement.parentElement.style.display = 'flex';
    } else if (vipTotalElement) {
      vipTotalElement.parentElement.style.display = 'none';
    }
    
    if (feesElement && (regularSeats + vipSeats > 0)) {
      feesElement.textContent = `$${fees.toFixed(2)}`;
      feesElement.parentElement.style.display = 'flex';
    } else if (feesElement) {
      feesElement.parentElement.style.display = 'none';
    }
    
    if (totalElement) {
      totalElement.textContent = (regularSeats + vipSeats) > 0 
        ? `$${total.toFixed(2)}`
        : '$0.00';
    }
    
    // Enable/disable the payment button
    const paymentButton = document.querySelector('.payment-button');
    if (paymentButton) {
      if (regularSeats + vipSeats > 0) {
        paymentButton.removeAttribute('disabled');
        paymentButton.classList.remove('disabled');
      } else {
        paymentButton.setAttribute('disabled', 'disabled');
        paymentButton.classList.add('disabled');
      }
    }
  }
});
