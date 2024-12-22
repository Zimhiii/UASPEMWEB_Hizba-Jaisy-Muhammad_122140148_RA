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

// Bagian 1.1: Validation (15%)
document
  .getElementById("registrationForm")
  .addEventListener("submit", function (e) {
    let isValid = true;
    const name = document.getElementById("name");
    const educationLevel = document.getElementById("education_level");
    const memorizationLevel = document.getElementById("memorization_level");
    const phone = document.getElementById("phone");

    // Reset error messages
    document.querySelectorAll(".error-message").forEach((el) => el.remove());

    // Name validation
    if (name.value.trim() === "") {
      showError(name, "Nama tidak boleh kosong.");
      isValid = false;
    }

    // Education level validation
    if (educationLevel.value === "") {
      showError(educationLevel, "Pilih tingkat pendidikan.");
      isValid = false;
    }

    // Memorization level validation
    if (memorizationLevel.value === "") {
      showError(memorizationLevel, "Pilih tingkat hafalan.");
      isValid = false;
    }

    // Phone number validation
    if (!/^\d{10,12}$/.test(phone.value)) {
      showError(phone, "Nomor telepon harus berisi 10-12 digit angka.");
      isValid = false;
    }

    if (!isValid) e.preventDefault();
  });

function showError(input, message) {
  const error = document.createElement("span");
  error.className = "error-message";
  error.style.color = "red";
  error.innerText = message;
  input.parentElement.appendChild(error);
}

// Bagian 1.2: Event Handling (15%)

// Event 1: Menampilkan jumlah karakter di input nama
document.getElementById("name").addEventListener("input", function () {
  const charCount = document.getElementById("charCount");
  if (!charCount) {
    const counter = document.createElement("span");
    counter.id = "charCount";
    counter.style.fontSize = "12px";
    counter.style.color = "gray";
    this.parentElement.appendChild(counter);
  }
  document.getElementById(
    "charCount"
  ).innerText = ` (${this.value.length} karakter)`;
});

document
  .getElementById("registrationForm")
  .addEventListener("submit", function (e) {
    const name = document.getElementById("name").value;
    const educationLevel = document.getElementById("education_level").value;
    if (!name || !educationLevel) {
      e.preventDefault();
      alert("Semua field harus diisi!");
    }
  });
