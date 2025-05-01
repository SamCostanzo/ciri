console.log("Michaela and Amanda");

// Confirms clearing of task list
function confirmClear() {
    let confirmAction = confirm("Are you sure you want to clear your tasks?");
    if (confirmAction) {
        document.getElementById("clearForm").submit();
    }
}

// Confirms clearing of completed task list
function confirmCompletedClear() {
    let confirmAction = confirm("Are you sure you want to clear your completed tasks?");
    if (confirmAction) {
        document.getElementById("clearCompletedForm").submit();
    }
}

// Controls showing of main panels, task list and completed task list
// function showPanel(panelId) {
//     document.querySelectorAll(".panel").forEach(panel => panel.classList.remove("active"));
//     document.getElementById(panelId).classList.add("active");
// }

// Set "Tasks" link as active by default
// document.getElementById("tasks-link").classList.add("active");

// Controls the showing/hiding of the two main panels and toggling link states
document.getElementById("tasks-link").addEventListener("click", function(event) {
    event.preventDefault();
    // showPanel("tasks-panel");

    document.getElementById("completed-link").classList.remove("active");
    document.getElementById("tasks-link").classList.add("active");
});

document.getElementById("completed-link").addEventListener("click", function(event) {
    event.preventDefault();
    // showPanel("completed-panel");

    document.getElementById("tasks-link").classList.remove("active");
    document.getElementById("completed-link").classList.add("active");
});



// Trying this to use local storage to keep the active tab consistent through page reloads.
document.addEventListener("DOMContentLoaded", function () {
    const tabs = document.querySelectorAll(".nav-link"); // Navigation links
    const panels = document.querySelectorAll(".panel"); // Content panels
    const activeTab = localStorage.getItem("activeTab") || "tasks-panel"; // Default panel

    // Find corresponding nav link
    const navLinks = document.querySelectorAll(".header-link");

    // Set active panel on load
    panels.forEach(panel => {
        panel.classList.toggle("active", panel.id === activeTab);
    });

    // Set active nav link on load
    navLinks.forEach(link => {
        link.classList.toggle("active", link.dataset.target === activeTab);
    });

    // Handle clicks on navigation links
    navLinks.forEach(link => {
        link.addEventListener("click", function (e) {
            e.preventDefault(); // Prevent default anchor behavior

            const targetPanel = this.getAttribute("data-target"); // Get the panel ID

            // Store active tab in localStorage
            localStorage.setItem("activeTab", targetPanel);

            // Toggle active class for panels
            panels.forEach(panel => {
                panel.classList.toggle("active", panel.id === targetPanel);
            });

            // Toggle active class for nav links
            navLinks.forEach(navLink => {
                navLink.classList.toggle("active", navLink.dataset.target === targetPanel);
            });
        });
    });
});