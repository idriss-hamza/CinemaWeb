
document.addEventListener('DOMContentLoaded', () => {
  const dateItems = document.querySelectorAll('.date-item');
  const timeItems = document.querySelectorAll('.time-item');
  const selectedDateElement = document.querySelector('.selected-date');
  const selectedTimeElement = document.querySelector('.selected-time');
  
  dateItems.forEach(item => {
    item.addEventListener('click', () => {
      // Remove 'selected' class from all date items
      dateItems.forEach(d => d.classList.remove('selected'));
      
      // Add 'selected' class to clicked date item
      item.classList.add('selected');
      
      // Update the summary with selected date
      if (selectedDateElement) {
        const day = item.querySelector('.date-day').textContent;
        const number = item.querySelector('.date-number').textContent;
        const month = item.querySelector('.date-month').textContent;
        selectedDateElement.textContent = `${day}, ${month} ${number}`;
      }
    });
  });
  
  timeItems.forEach(item => {
    item.addEventListener('click', () => {
      // Remove 'selected' class from all time items
      timeItems.forEach(t => t.classList.remove('selected'));
      
      // Add 'selected' class to clicked time item
      item.classList.add('selected');
      
      // Update the summary with selected time
      if (selectedTimeElement) {
        selectedTimeElement.textContent = item.textContent;
      }
    });
  });
  
  // Initialize with the first date and time selected
  if (dateItems.length > 0) {
    dateItems[0].click();
  }
  
  if (timeItems.length > 0) {
    timeItems[0].click();
  }
});
