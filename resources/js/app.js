// Import CSS bundle (ensures Vite processes CSS and assets)
import "../css/app.css";

// If the template expects global jQuery:
import $ from 'jquery';
window.$ = window.jQuery = $;

// Vendor plugins (order matters if they depend on jQuery)
import "./vendor/bootstrap.min.js";
import "./vendor/slick.min.js";
import "./vendor/nouislider.min.js";

// Template’s own JS (if present)
import "./main.js";

// Optional: initialize plugins here if the template doesn't already
document.addEventListener("DOMContentLoaded", () => {
    // Example:
    // $(".your-slick-class").slick();
});
