Site was created by me, using HTML, CSS, PHP and a bit of JS.

The file "spoti.php" works by using the API of the popular music listening tracker last.fm connected to streaming music service Spotify, and by using my token to conduct a GET request for current music data. If music isn't currently playing, it will pull the last played track information instead.

After pulling track information, I used PHP's GD-images library to embed this information into an image I provided, and display the final product as a usable image in ".php" format.

This is done on every load of the webpage.

The rest of the site is straightforward and uses bootstrap for CSS boilerplate code, and custom fonts. 
