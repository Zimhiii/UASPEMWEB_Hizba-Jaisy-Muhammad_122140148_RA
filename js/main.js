// ============= js/main.js =============
// Bagian 1.2: Event Handling
document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("registrationForm");

  if (form) {
    // Event 1: Form validation before submit
    form.addEventListener("submit", function (e) {
      e.preventDefault();

      const name = document.getElementById("name").value.trim();
      const educationLevel = document.getElementById("education_level").value;
      const memorizationLevel =
        document.getElementById("memorization_level").value;
      const phone = document.getElementById("phone").value.trim();

      // Validate all fields
      if (!name || !educationLevel || !memorizationLevel || !phone) {
        alert("Mohon isi semua field yang diperlukan");
        return;
      }

      // Validate phone number format
      const phoneRegex = /^[0-9]{10,13}$/;
      if (!phoneRegex.test(phone)) {
        alert(
          "Nomor telepon tidak valid. Gunakan format yang benar (10-13 digit)"
        );
        return;
      }

      // If all validations pass, submit the form
      this.submit();
    });

    // Event 2: Real-time phone number validation
    const phoneInput = document.getElementById("phone");
    phoneInput.addEventListener("input", function (e) {
      const value = e.target.value;
      // Only allow numbers
      if (!/^\d*$/.test(value)) {
        e.target.value = value.replace(/[^\d]/g, "");
      }
      // Limit to 13 digits
      if (value.length > 13) {
        e.target.value = value.slice(0, 13);
      }
    });

    // Event 3: Education level change validation
    const educationLevel = document.getElementById("education_level");
    educationLevel.addEventListener("change", function (e) {
      const memorizationLevel = document.getElementById("memorization_level");
      const selectedLevel = e.target.value;

      // Enable/disable certain memorization levels based on education
      if (selectedLevel === "SD") {
        // For SD, only allow Juz 30 and 5 Juz
        Array.from(memorizationLevel.options).forEach((option) => {
          if (option.value && !["Juz 30", "5 Juz"].includes(option.value)) {
            option.disabled = true;
          } else {
            option.disabled = false;
          }
        });
      } else {
        // Enable all options for other education levels
        Array.from(memorizationLevel.options).forEach((option) => {
          option.disabled = false;
        });
      }
    });
  }
});
