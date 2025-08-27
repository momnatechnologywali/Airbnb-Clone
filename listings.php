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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Property Listings</title>
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
 
        .sort-filter {
            max-width: 800px;
            margin: 20px auto;
            display: flex;
            gap: 10px;
        }
 
        .sort-filter select {
            padding: 10px;
            border: 1px solid #FF6200;
            border-radius: 5px;
        }
 
        .property-grid {
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }
 
        .property-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }
 
        .property-card:hover {
            transform: translateY(-5px);
        }
 
        .property-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
 
        .property-card div {
            padding: 15px;
        }
 
        .property-card h3 {
            color: #FF6200;
            margin-bottom: 10px;
        }
 
        .property-card p {
            color: #666;
            margin-bottom: 10px;
        }
 
        .property-card button {
            background-color: #FF6200;
            color: white;
            border: none;
            padding: 10px;
            width: 100%;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
 
        .property-card button:hover {
            background-color: #E55A00;
        }
 
        footer {
            background-color: #FF6200;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 20px;
        }
 
        @media (max-width: 600px) {
            .sort-filter {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>Property Listings</h1>
    </header>
 
    <div class="sort-filter">
        <select id="sort-by" onchange="loadProperties()">
            <option value="price-asc">Price: Low to High</option>
            <option value="price-desc">Price: High to Low</option>
            <option value="rating-desc">Best Rated</option>
        </select>
    </div>
 
    <div class="property-grid" id="property-grid">
        <?php
        $sql = "SELECT * FROM properties";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $properties = $stmt->fetchAll(PDO::FETCH_ASSOC);
 
        foreach ($properties as $property) {
            echo '
            <div class="property-card">
                <img src="' . htmlspecialchars($property['image']) . '" alt="' . htmlspecialchars($property['name']) . '">
                <div>
                    <h3>' . htmlspecialchars($property['name']) . '</h3>
                    <p>$' . htmlspecialchars($property['price']) . '/night</p>
                    <p>Location: ' . htmlspecialchars($property['location']) . '</p>
                    <p>Rating: ' . htmlspecialchars($property['rating']) . ' ★</p>
                    <button onclick="window.location.href=\'booking.php?id=' . htmlspecialchars($property['id']) . '\'">Book Now</button>
                </div>
            </div>';
        }
        ?>
    </div>
 
    <footer>
        <p>&copy; 2025 Airbnb Clone. All rights reserved.</p>
    </footer>
 
    <script>
        function loadProperties() {
            const sortBy = document.getElementById('sort-by').value;
            const searchParams = JSON.parse(localStorage.getItem('searchParams') || '{}');
            // In a real app, you'd make an AJAX call to filter/sort properties
            console.log('Sorting by:', sortBy, 'Search params:', searchParams);
        }
    </script>
</body>
</html>
