<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructor Registration</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <style>
        /* Style the modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
        }

        /* Style the modal content */
        .modal-content {
            background-color: #fff;
            margin: 5% auto 0;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
            position: relative;
        }

        /* Style the close button */
        .close {
            position: absolute;
            top: 0;
            right: 0;
            padding: 10px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <!-- Modal for Terms and Conditions -->
    <div id="termsModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeModal">&times;</span>
            <h2>Terms and Conditions</h2>
            <div id="termsContent"></div>
        </div>
    </div>

    <div class="container shadow p-4" style="max-width: 400px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <form action="{{ route('instructor.register') }}" method="POST">
                    @csrf
                    <h2 class="mb-4">Instructor Registration</h2>
                    <div class="mb-3 custom-floating-label">
                        <input type="text" name="name" id="name" class="form-control" required value="{{ old('name') }}">
                        <label for="name">Name</label>
                    </div>
                    <div class="mb-3 custom-floating-label">
                        <input type="email" name="email" id="email" class="form-control" required value="{{ old('email') }}">
                        <label for="email">Email</label>
                    </div>
                    <div class="mb-3 custom-floating-label">
                        <input type="password" name="password" id="password" class="form-control" required value="{{ old('password') }}">
                        <label for="password">Password</label>
                    </div>
                    <div class="mb-3 custom-floating-label">
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required value="{{ old('password_confirmation') }}">
                        <label for="password_confirmation">Confirm Password</label>
                    </div>

                    <!-- Checkbox for accepting Terms and Conditions -->
                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" id="termsCheckbox" name="termsCheckbox" required>
                        <label class="form-check-label" for="termsCheckbox">
                            <a href="#" id="termsLink" style="text-decoration:none;">Terms and Conditions</a>
                        </label>
                    </div>

                    <input type="hidden" name="role" value="instructor">
                    <button type="submit" class="btn btn-primary">Register</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Function to open the modal
        function openModal() {
            document.getElementById("termsModal").style.display = "block";
            loadTermsAndConditions();
        }

        // Function to close the modal
        function closeModal() {
            document.getElementById("termsModal").style.display = "none";
        }
        
        // Attach a click event listener to the close button
        document.getElementById("closeModal").addEventListener("click", closeModal);

        // Close the modal if the user clicks outside of it
        window.addEventListener("click", function (event) {
            if (event.target === document.getElementById("termsModal")) {
                closeModal();
            }
        });

        // Load Terms and Conditions content using Ajax
        function loadTermsAndConditions() {
            $.ajax({
                url: '/terms-and-conditions', // Update with the actual path to your terms file
                success: function (data) {
                    $('#termsContent').html(data);
                },
                error: function () {
                    $('#termsContent').html('Failed to load Terms and Conditions.');
                }
            });
        }

        // Attach a click event listener to the "Terms and Conditions" link
        document.getElementById("termsLink").addEventListener("click", function (e) {
            e.preventDefault();
            openModal();
        });
    </script>
</body>
</html>
