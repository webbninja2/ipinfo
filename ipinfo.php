<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Info</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <style>
            body {font-family: Arial, sans-serif;background-color: #f4f4f4;color: #333;max-width: 800px;margin: 20px auto;padding: 20px;background: #fff;border-radius: 8px;box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);}
            h3 {border-bottom: 2px solid #ddd;padding-bottom: 10px;margin-bottom: 20px;color: #555;}
            .detail {margin-bottom: 10px;font-size: 16px;}
            .detail i {margin-right: 10px;color: #666;}
        </style>
    </head>
    <body>
        <?php
            function getUserIP() {
                if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                    return $_SERVER['HTTP_CLIENT_IP'];
                } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                    return $_SERVER['HTTP_X_FORWARDED_FOR'];
                } else {
                    return $_SERVER['REMOTE_ADDR'];
                }
            }
            function getBrowser() {
                return $_SERVER['HTTP_USER_AGENT'];
            }
            function getPlatform() {
                $userAgent = getBrowser();
                if (preg_match('/linux/i', $userAgent)) {
                    return 'Linux';
                } elseif (preg_match('/macintosh|mac os x/i', $userAgent)) {
                    return 'Mac';
                } elseif (preg_match('/windows|win32/i', $userAgent)) {
                    return 'Windows';
                } else {
                    return 'Unknown';
                }
            }

            $userIP = getUserIP();
            // Check if the IP is local (127.0.0.1 for IPv4 or ::1 for IPv6)
            if ($userIP === '::1' || $userIP === '127.0.0.1') {
                echo "<h3><i class='fas fa-server'></i> Local Environment Detected</h3>";
                echo "<div class='detail'><i class='fas fa-network-wired'></i> <b>Your IP:</b> $userIP</div>";
                echo "<div class='detail'><i class='fas fa-desktop'></i> <b>Platform:</b> " . getPlatform() . "</div>";
                echo "<div class='detail'><i class='fas fa-globe'></i> <b>Browser:</b> " . getBrowser() . "</div>";
                echo "<h3><i class='fas fa-info-circle'></i> Header Details</h3>";
                echo "<div class='detail'><i class='fas fa-compress'></i> <b>Accept-Encoding:</b> " . ($_SERVER['HTTP_ACCEPT_ENCODING'] ?? 'Unknown') . "</div>";
                echo "<div class='detail'><i class='fas fa-user-circle'></i> <b>User-Agent:</b> " . $_SERVER['HTTP_USER_AGENT'] . "</div>";
                echo "<div class='detail'><i class='fas fa-file-alt'></i> <b>Accept:</b> " . ($_SERVER['HTTP_ACCEPT'] ?? 'Unknown') . "</div>";
                echo "<div class='detail'><i class='fas fa-language'></i> <b>Accept-Language:</b> " . ($_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? 'Unknown') . "</div>";
                echo "<div class='detail'><i class='fas fa-cookie'></i> <b>Cookie:</b> " . ($_SERVER['HTTP_COOKIE'] ?? 'None') . "</div>";
                echo "<div class='detail'><i class='fas fa-code'></i> <b>JavaScript:</b> ";
                echo "<noscript>Disabled</noscript>";
                echo "<script>document.write('Enabled');</script></div>";

                exit;
            }

            // Use ipinfo.io API to get IP details
            $apiUrl = "https://ipinfo.io/{$userIP}/json";
            $ipDetails = json_decode(file_get_contents($apiUrl), true);
            if (isset($ipDetails['bogon']) && $ipDetails['bogon']) {
                echo "<h3><i class='fas fa-exclamation-triangle'></i> Bogon IP Detected</h3>";
                echo "The IP address $userIP is a non-routable address. No location details available.<br>";
                exit;
            }

            // Extract data
            $city = $ipDetails['city'] ?? 'Unknown';
            $region = $ipDetails['region'] ?? 'Unknown';
            $loc = explode(',', $ipDetails['loc'] ?? '0,0');
            $longitude = $loc[1];
            $latitude = $loc[0];
            $org = $ipDetails['org'] ?? 'Unknown';
            $postal = $ipDetails['postal'] ?? 'Unknown';
            $timezone = $ipDetails['timezone'] ?? 'Unknown';
            $isp = $org;
            $platform = getPlatform();
            $browser = getBrowser();

            // Display the user details
            echo "<h3><i class='fas fa-user'></i> User Details</h3>";
            echo "<div class='detail'><i class='fas fa-network-wired'></i> <b>Your IP:</b> $userIP</div>";
            echo "<div class='detail'><i class='fas fa-city'></i> <b>City/Region:</b> $city/$region</div>";
            echo "<div class='detail'><i class='fas fa-map-marker-alt'></i> <b>Longitude:</b> $longitude</div>";
            echo "<div class='detail'><i class='fas fa-map-marker-alt'></i> <b>Latitude:</b> $latitude</div>";
            echo "<div class='detail'><i class='fas fa-building'></i> <b>Organization:</b> $org</div>";
            echo "<div class='detail'><i class='fas fa-envelope'></i> <b>Postal Code:</b> $postal</div>";
            echo "<div class='detail'><i class='fas fa-clock'></i> <b>Timezone:</b> $timezone</div>";
            echo "<div class='detail'><i class='fas fa-globe'></i> <b>ISP:</b> $isp</div>";
            echo "<div class='detail'><i class='fas fa-desktop'></i> <b>Platform:</b> $platform</div>";
            echo "<div class='detail'><i class='fas fa-globe'></i> <b>Browser:</b> $browser</div>";
            // Display header details
            echo "<h3><i class='fas fa-info-circle'></i> Header Details</h3>";
            echo "<div class='detail'><i class='fas fa-compress'></i> <b>Accept-Encoding:</b> " . ($_SERVER['HTTP_ACCEPT_ENCODING'] ?? 'Unknown') . "</div>";
            echo "<div class='detail'><i class='fas fa-user-circle'></i> <b>User-Agent:</b> " . $_SERVER['HTTP_USER_AGENT'] . "</div>";
            echo "<div class='detail'><i class='fas fa-file-alt'></i> <b>Accept:</b> " . ($_SERVER['HTTP_ACCEPT'] ?? 'Unknown') . "</div>";
            echo "<div class='detail'><i class='fas fa-language'></i> <b>Accept-Language:</b> " . ($_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? 'Unknown') . "</div>";
            echo "<div class='detail'><i class='fas fa-cookie'></i> <b>Cookie:</b> " . ($_SERVER['HTTP_COOKIE'] ?? 'None') . "</div>";
            echo "<div class='detail'><i class='fas fa-code'></i> <b>JavaScript:</b> ";
            echo "<noscript>Disabled</noscript>";
            echo "<script>document.write('Enabled');</script></div>";
        ?>
    </body>
</html>
