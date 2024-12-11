// Menu Toggle
let toggle = document.querySelector(".toggle");
let navigation = document.querySelector(".navigation");
let main = document.querySelector(".main");

toggle.onclick = function () {
  navigation.classList.toggle("active");
  main.classList.toggle("active");
};

// Close menu when clicking outside on mobile devices
document.addEventListener("click", function(event) {
    if (!event.target.closest('.toggle') && !event.target.closest('.navigation')) {
        navigation.classList.remove("active");
        main.classList.remove("active");
    }
});

// Function to show the specified module
function showModule(moduleName) {
    // Get the module element
    var module = document.getElementById(moduleName);
    
    // Toggle the display of the module
    module.style.display = (module.style.display === "block") ? "none" : "block";

    // If the module is "feedback", adjust iframe height
    if (moduleName === 'feedback') {
        var iframe = document.getElementById('feedbackIframe');
        iframe.onload = function() {
            var height = iframe.contentWindow.document.body.scrollHeight + 'px';
            iframe.style.height = height;
        };
    }
}

// Fetch content from feedback_generator and display on admin_dashboard
fetch('feedback_generator_endpoint_here') // Replace 'feedback_generator_endpoint_here' with the actual endpoint URL
  .then(response => response.json())
  .then(data => {
    const feedbackContainer = document.querySelector('#feedback .module'); // Assuming this is the container where feedback will be displayed
    feedbackContainer.innerHTML = ''; // Clear previous content
    data.forEach(feedback => {
      const feedbackElement = document.createElement('div');
      feedbackElement.textContent = feedback.content; // Assuming feedback content is stored in the 'content' property
      feedbackContainer.appendChild(feedbackElement);
    });
    
    // Adjust height to fully display content
    const iframe = document.getElementById('feedbackIframe');
    iframe.style.height = '100%'; // Set iframe height to 100% to fully display content
  })
  .catch(error => {
    console.error('Error fetching feedback:', error);
  });
