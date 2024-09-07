<? $title = "Privacy Information"; include("head.php"); ?>
<div class="container">
    <div class="row">
        <div class="col-12 col-lg-6 offset-lg-3">
            <h2 class="mt-4 mb-4">Privacy Information</h2>
            <p>Last Updated December 24, 2022</p>
            <p>Here's a list of the type of data we store, as well as how you can delete it.</p>
            <ul>
                <li class="mb-0"><span class="fw-bolder">If all you do is visit the website</span> (without performing any actions like logging in or submitting an application), the only data stored is your user agent (sent automatically by your browser - it usually contains your browser, its version, and your operating system). This data is cleared roughly every 3 months, it is used purely for detecting bots and other malicious users. This information is generally useless on its own to anyone trying to harvest user data or compromise the server.</li>
                <li class="mt-3 mb-0"><span class="fw-bolder">If you register</span>, all things included whenever you registered are saved. Your hashed IP address (hashed using SHA512 and various <a href="https://en.wikipedia.org/wiki/Salt_(cryptography)">salts</a>) are also stored temporarily in order to detect when people are spamming registrations. Your IP is automatically deleted about 5 minutes after you register.</li>
                <li class="mt-3 mb-0"><span class="fw-bolder">After creating an account</span>, your username and password are both stored (with your password being hashed using <a href="https://en.wikipedia.org/wiki/Argon2">argon2</a>), as well as your account creation date/time, and any other on-site data generated at creation time (such as your avatar, its thumbnail, etc). Your hashed IP address is also stored for about 1 hour, as well as a count of your accounts created (although your IP is never directly linked to your account(s)).</li>
                <li class="mt-3 mb-0"><span class="fw-bolder">If you login to an account</span>, your hashed IP address is stored for about 1 hour, as well as a count of your login attempts (although your IP is never directly linked to your account(s)).</li>
                <!--<li class="mt-3 mb-0"><span class="fw-bolder">If you join a game</span>, your IP address is stored in a JSON file that is sent to your browser. The client and server use this in its client/server authentication system so that we can verify that the browser that generated the ticket is the same browser that is playing the game. Although this IP is never stored on our servers, it does mean that if you give the ticket to somebody, they might be able to find out your IP address.</li>-->
            </ul>
            <p>As well as what's noted above, any information you directly input into the website (such as a description, status, etc) is saved. Every status update you make (either for users or groups) is saved permanently, while only your most recent description is saved (and all others are discarded). Any outfits you create, as well as your latest avatar and its thumbnail, are saved to the website. Any content uploaded to the website, such as images, is saved permanently (unless it is deleted due to violating our <a href="/auth/tos">terms of service</a>). When you delete your account, all information is deleted, aside from any content you have uploaded to the site (such as images).</p>
            <p>You can request an account deletion by <a href="/auth/account-deletion">clicking here</a>.</p>
            <p>This site makes use of <a href="https://www.jsdelivr.com/terms/privacy-policy-jsdelivr-net">jsdelivr</a>, which has its respective privacy policy linked.</p>
        </div>
    </div>
</div>
<? include("footer.php"); ?>