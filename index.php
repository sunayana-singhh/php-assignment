<!-- index.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <form id="registrationForm" class="registration-form">
            <h2>Registration Form</h2>
            
            <div class="form-group">
                <label for="firstName">First Name</label>
                <input type="text" id="firstName" name="firstName" required>
            </div>

            <div class="form-group">
                <label for="lastName">Last Name</label>
                <input type="text" id="lastName" name="lastName" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="country">Country</label>
                <select id="country" name="country" required>
                    <option value="">Select a country</option>
                    <option value="usa">United States</option>
                    <option value="uk">United Kingdom</option>
                    <option value="canada">Canada</option>
                    <option value="australia">Australia</option>
                    <option value="india">India</option>
                </select>
            </div>

            <div class="form-group">
                <label>Gender</label>
                <div class="radio-group">
                    <label class="radio-label">
                        <input type="radio" name="gender" value="male" required>
                        Male
                    </label>
                    <label class="radio-label">
                        <input type="radio" name="gender" value="female">
                        Female
                    </label>
                    <label class="radio-label">
                        <input type="radio" name="gender" value="other">
                        Other
                    </label>
                </div>
            </div>

            <button type="submit">Register</button>
        </form>

        <div id="registrationsContainer" class="registrations-container">
            <div class="registrations-header">
                <h2>Recent Registrations</h2>
                <button id="clearRegistrations" type="button">Clear All</button>
            </div>
            <div id="registrationsList"></div>
        </div>
    </div>

    <script>
        function updateRegistrationsList() {
            fetch('get_registrations.php')
                .then(response => response.json())
                .then(registrations => {
                    const registrationsList = document.getElementById('registrationsList');
                    if (registrations.length === 0) {
                        registrationsList.innerHTML = '<p class="no-registrations">No registrations yet</p>';
                        return;
                    }

                    registrationsList.innerHTML = `
                        <div class="registrations-list">
                            ${registrations.map((registration, index) => `
                                <div class="registration-card">
                                    <div class="registration-header">
                                        <h3>Registration #${index + 1}</h3>
                                    </div>
                                    <div class="registration-details">
                                        <p><strong>Name:</strong> ${registration.firstName} ${registration.lastName}</p>
                                        <p><strong>Email:</strong> ${registration.email}</p>
                                        <p><strong>Country:</strong> ${registration.country}</p>
                                        <p><strong>Gender:</strong> ${registration.gender}</p>
                                        <p><strong>Registered:</strong> ${registration.created_at}</p>
                                    </div>
                                </div>
                            `).join('')}
                        </div>
                    `;
                });
        }

        document.getElementById('registrationForm').addEventListener('submit', (e) => {
            e.preventDefault();
            const formData = new FormData(e.target);
            
            fetch('save_registration.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    updateRegistrationsList();
                    e.target.reset();
                } else {
                    alert('Error saving registration');
                }
            });
        });

        document.getElementById('clearRegistrations').addEventListener('click', () => {
            fetch('clear_registrations.php', {
                method: 'POST'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    updateRegistrationsList();
                } else {
                    alert('Error clearing registrations');
                }
            });
        });

        // Initialize the registrations list
        updateRegistrationsList();
    </script>
</body>
</html>