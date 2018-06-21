    <!-- END SPECIFIC PAGE CONTENT -->
    </div> <!-- end container row -->
    <p class="copyright">&copy; <?php echo date("Y"); ?> Camosun College</p>
</div> <!-- end container -->
<!-- The below two script entries load JavaScript into the page. Bootstrap requires both its own
    JavaScript library and JQuery, another JavaScript library. We use a CDN here (Content Delivery Network)
    to load these. Using a CDN means getting it from a 3rd party server to reduce load on our website
    server. Of course, you have to trust the 3rd party server. That's what the integrity and crossorigin
    attributes are for. Integrity is a hash of the library. Crossorigin just means no credentials will be sent.
-->

<!-- Latest compiled and minified JQuery from a CDN. This has to come first before the bootstrap library below. -->
<script
    src="https://code.jquery.com/jquery-3.2.1.min.js"
    integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
    crossorigin="anonymous">
</script>
<!-- Latest compiled and minified Bootstrap JS from a CDN. Depends on JQuery above. -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
</script>
<!-- This is for LiveReload to work. -->
<script>
document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')
</script>
</body>
</html>