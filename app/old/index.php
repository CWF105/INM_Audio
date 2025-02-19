<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <div class="profile">
                <img src="" alt="Profile">
                <p>Welcome back, <strong>Julian</strong></p>
            </div>
            <nav>
                <ul>
                    <li><a href="#"><i class="fas fa-user"></i> Edit Profile</a></li>
                    <li><a href="mylikes.php"><i class="fas fa-heart"></i> My Likes</a></li>
                    <li><a href="#"><i class="fas fa-shopping-cart"></i> My Purchases</a></li>
                </ul>
            </nav>
        </aside>

        <main class="content">
            <h2>Account Settings</h2>
            
            <form class="settings-form">
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" value="julianbarrientos@gmail.com">
                </div>

                <div class="form-group-row">
                    <div>
                        <label>First Name</label>
                        <input type="text" placeholder="First Name">
                    </div>
                    <div>
                        <label>Last Name</label>
                        <input type="text" placeholder="Last Name">
                    </div>
                </div>

                <div class="form-group">
                    <label>Address</label>
                    <div class="address-group">
                        <select>
                            <option>Naic</option>
                        </select>
                        <select>
                            <option>Cavite</option>
                        </select>
                        <input type="text" placeholder="Street">
                        <input type="text" placeholder="ZIP Code">
                    </div>
                </div>

                <button type="submit" class="save-btn">Save Changes</button>
            </form>
        </main>
    </div>
</body>
</html>
