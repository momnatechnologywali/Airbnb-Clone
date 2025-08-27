<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Airbnb Clone - Homepage</title>
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
 
        .search-bar {
            background: white;
            padding: 20px;
            margin: 20px auto;
            max-width: 800px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            gap: 10px;
        }
 
        .search-bar input, .search-bar button {
            padding: 10px;
            border: 1px solid #FF6200;
            border-radius: 5px;
            font-size: 1em;
        }
 
        .search-bar input {
            flex: 1;
        }
 
        .search-bar button {
            background-color: #FF6200;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }
 
        .search-bar button:hover {
            background-color: #E55A00;
        }
 
        .filters {
            max-width: 800px;
            margin: 20px auto;
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
 
        .filters select, .filters input {
            padding: 10px;
            border: 1px solid #FF6200;
            border-radius: 5px;
        }
 
        .featured {
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 20px;
        }
 
        .featured h2 {
            color: #FF6200;
            margin-bottom: 20px;
        }
 
        .property-grid {
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
            .search-bar {
                flex-direction: column;
            }
 
            .filters {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>Airbnb Clone</h1>
    </header>
 
    <div class="search-bar">
        <input type="text" id="destination" placeholder="Where are you going?">
        <input type="date" id="checkin">
        <input type="date" id="checkout">
        <button onclick="searchProperties()">Search</button>
    </div>
 
    <div class="filters">
        <select id="price-range">
            <option value="">Price Range</option>
            <option value="0-100">$0 - $100</option>
            <option value="100-200">$100 - $200</option>
            <option value="200+">$200+</option>
        </select>
        <select id="property-type">
            <option value="">Property Type</option>
            <option value="apartment">Apartment</option>
            <option value="house">House</option>
            <option value="villa">Villa</option>
        </select>
        <input type="text" id="amenities" placeholder="Amenities (e.g., WiFi, Pool)">
    </div>
 
    <div class="featured">
        <h2>Featured Stays</h2>
        <div class="property-grid" id="property-grid">
            <!-- Properties will be loaded dynamically -->
        </div>
    </div>
 
    <footer>
        <p>&copy; 2025 Airbnb Clone. All rights reserved.</p>
    </footer>
 
    <script>
        function searchProperties() {
            const destination = document.getElementById('destination').value;
            const checkin = document.getElementById('checkin').value;
            const checkout = document.getElementById('checkout').value;
            const priceRange = document.getElementById('price-range').value;
            const propertyType = document.getElementById('property-type').value;
            const amenities = document.getElementById('amenities').value;
 
            // Store search parameters in localStorage
            localStorage.setItem('searchParams', JSON.stringify({
                destination,
                checkin,
                checkout,
                priceRange,
                propertyType,
                amenities
            }));
 
            // Redirect to listings page
            window.location.href = 'listings.php';
        }
 
        // Sample featured properties
        const featuredProperties = [
            { id: 1, name: 'Cozy Apartment', price: 80, image: 'https://via.placeholder.com/300x200', rating: 4.5 },
            { id: 2, name: 'Luxury Villa', price: 250, image: 'https://via.placeholder.com/300x200', rating: 4.8 },
            { id: 3, name: 'Beach House', price: 150, image: 'https://via.placeholder.com/300x200', rating: 4.2 }
        ];
 
        function loadFeaturedProperties() {
            const grid = document.getElementById('property-grid');
            grid.innerHTML = '';
            featuredProperties.forEach(property => {
                const card = document.createElement('div');
                card.className = 'property-card';
                card.innerHTML = `
                    <img src="${property.image}" alt="${property.name}">
                    <div>
                        <h3>${property.name}</h3>
                        <p>$${property.price}/night</p>
                        <p>Rating: ${property.rating} ★</p>
                        <button onclick="window.location.href='booking.php?id=${property.id}'">Book Now</button>
                    </div>
                `;
                grid.appendChild(card);
            });
        }
 
        // Load featured properties on page load
        window.onload = loadFeaturedProperties;
    </script>
</body>
</html>
