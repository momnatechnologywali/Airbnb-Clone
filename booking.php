<?php
$servername = "localhost";
$username = "uws1gwyttyg2r";
$password = "k1tdlhq4qpsf";
$dbname = "dbppl4h5j6bz9g";
 
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}
 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $property_id = $_POST['property_id'];
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];
    $guest_name = $_POST['guest_name'];
    $guest_email = $_POST['guest_email'];
 
    $sql = "INSERT INTO bookings (property_id, checkin, checkout, guest_name, guest_email, booking_date) 
            VALUES (:property_id, :checkin, :checkout, :guest_name, :guest_email, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':property_id' => $property_id,
        ':checkin' => $checkin,
        ':checkout' => $checkout,
        ':guest_name' => $guest_name,
        ':guest_email' => $guest_email
    ]);
 
    $confirmation = "Booking confirmed for $guest_name! Check your email ($guest_email) for details.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book a Property</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
 
        body {
            background-color: #FFF7ED;
            color: #333;
        }
 
        header {
            background: linear-gradient(90deg, #FF6200, #FF8C00);
            padding: 20px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }
 
        header h1 {
            color: white;
            font-size: 2.5em;
        }
 
        .booking-form {
            max-width: 600px;
            margin: 20px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
 
        .booking-form h2 {
            color: #FF6200;
            margin-bottom: 20px;
        }
 
        .booking-form label {
            display: block;
            margin: 10px 0 5px;
            color: #333;
        }
 
        .booking-form input {
            width: 100%;
            padding: 10px;
            border: 1px solid #FF6200;
            border-radius: 5px;
            margin-bottom: 10px;
        }
 
        .booking-form button {
            background-color: #FF6200;
            color: white;
            border: none;
            padding: 10px;
            width: 100%;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
 
        .booking-form button:hover {
            background-color: #E55A00;
        }
 
        .confirmation {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background: #D4EDDA;
            color: #155724;
            border-radius: 5px;
            text-align: center;
        }
 
        footer {
            background-color: #FF6200;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 20px;
        }
 
        @media (max-width: 600px) {
            .booking-form {
                margin: 20px;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>Book Your Stay</h1>
    </header>
 
    <?php if (isset($confirmation)): ?>
        <div class="confirmation">
            <p><?php echo htmlspecialchars($confirmation); ?></p>
            <button onclick="window.location.href='index.html'">Back to Home</button>
        </div>
    <?php else: ?>
        <?php
        $property_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $sql = "SELECT * FROM properties WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':id' => $property_id]);
        $property = $stmt->fetch(PDO::FETCH_ASSOC);
        ?>
        <div class="booking-form">
            <h2>Book <?php echo htmlspecialchars($property['name']); ?></h2>
            <form method="POST">
                <input type="hidden" name="property_id" value="<?php echo htmlspecialchars($property_id); ?>">
                <label for="checkin">Check-in Date</label>
                <input type="date" name="checkin" required>
                <label for="checkout">Check-out Date</label>
                <input type="date" name="checkout" required>
                <label for="guest_name">Your Name</label>
                <input type="text" name="guest_name" required>
                <label for="guest_email">Your Email</label>
                <input type="email" name="guest_email" required>
                <button type="submit">Confirm Booking</button>
            </form>
        </div>
    <?php endif; ?>
 
    <footer>
        <p>&copy; 2025 Airbnb Clone. All rights reserved.</p>
    </footer>
</body>
</html>
