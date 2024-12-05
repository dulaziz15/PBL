</div>

<script>
    function OpenSidebar() {
        if ($(window).width() <= 768) {
            $(".sidebar").slideToggle("slow");
        }
    }

    $(window).resize(function() {
        if ($(window).width() > 768) {
            $(".sidebar").show();
        } else {
            $(".sidebar").hide();
        }
    });

    $(document).ready(function() {
        if ($(window).width() > 768) {
            $(".sidebar").show();
        }
    });
</script>
</body>

</html>