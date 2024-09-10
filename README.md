
## Overview
This script provides a detailed breakdown of the user's IP address information, browser, and system details. It also displays various header details like Accept-Encoding, User-Agent, Accept, Accept-Language, and Cookies. The script uses PHP to fetch data from the user's environment and also leverages the ipinfo.io API for retrieving IP-related information.

## Features
- **IP Address Detection: Retrieves the user's IP address and checks if it's a local environment.**
- **Platform Detection: Determines the user's operating system based on the user agent.**
- **Browser Detection: Fetches the user agent string to identify the browser.**
- **Location Information: Uses the ipinfo.io API to retrieve details like city, region, longitude, latitude, ISP, and more.**
- **Header Information: Displays HTTP header information sent by the browser.**
- **JavaScript Detection: Checks if JavaScript is enabled or disabled.**

## How It Works

1. IP Address Check:
- The script first checks if the user is running the script in a local environment (127.0.0.1 for IPv4 or ::1 for IPv6).
- If detected, the script displays a message indicating that a local environment is detected along with the IP address, platform, and browser details.

2. IP Details Lookup:
- For non-local environments, the script uses the ipinfo.io API to gather additional information about the user's IP address.

3. Platform and Browser Detection:
- The script analyzes the user agent string to identify the operating system and browser.

4. Header Information:
- Displays HTTP header information, including Accept-Encoding, User-Agent, Accept, Accept-Language, and Cookies.

5. JavaScript Detection:
- The script uses a combination of <noscript> and JavaScript to determine if JavaScript is enabled in the user's browser.

## Usage
To use this script, simply upload the user_info.php file to your web server. When accessed, the script will automatically display the relevant information.

Example Output
When you access the script via your browser, it might display something like this:


User Details
------------
Your IP: 192.168.1.1
City/Region: New York/New York
Longitude: -74.006
Latitude: 40.7128
Organization: ISP Corp
Postal Code: 10001
Timezone: America/New_York
ISP: ISP Corp
Platform: Windows
Browser: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36

Header Details
--------------
Accept-Encoding: gzip, deflate, br
User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36
Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8
Accept-Language: en-US,en;q=0.9
Cookie: None
JavaScript: Enabled

## Installation
1. Clone or download this repository.
2. Upload the user_info.php file to your PHP-enabled server.
3. Access the script via your browser to see the output.

## Dependencies 
- PHP: Make sure your server supports PHP.
- Internet Connection: Required for the ipinfo.io API request.

## Notes
- This script is designed for informational purposes and should be used accordingly.
- The accuracy of location data depends on the IP address and the information provided by ipinfo.io.

## License
This project is open-source and available under the MIT License.

  
