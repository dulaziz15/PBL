</div>

<script>
    function OpenSidebar() {
        if ($(window).width() <= 768) {
            $(".sidebar").slideToggle("slow");
            $('.content').css('backgorund-color', "0,0,0,0.7")
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